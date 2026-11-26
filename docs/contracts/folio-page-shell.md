---
title: "Contratto — Sixteen Folio page shell"
type: presentation-contract
theme: Sixteen
status: accepted
contract: Themes\\Sixteen\\resources\\views\\pages
created: 2026-11-26
updated: 2026-11-26
related:
  - ../page-directory-structure.md
  - ../folio-page-pattern.md
  - ../../tests/Unit/FolioPageMountContractTest.php
  - ../../tests/Unit/NoSemanticFolioPageDirectoriesTest.php
---

# Sixteen Folio page shell

Contratto di **presentazione**, non di un'Action (nessuna classe PHP da collegare con `@contract`): promette la forma delle
pagine Folio di `resources/views/pages` e cosa non devono fare. È il solo punto in cui il tema decide quali URL esistono; i
contenuti sono blocchi JSON in `config/local/fixcity/database/content/pages/` (`AGENTS.md`). Il file omonimo di Civic descrive
una shell più sottile di questa: vedi «Limiti noti».

## Input

- Parametri Folio ricevuti da `mount()`: `container0`, `slug0`, `container1` (e `token` per `[token].blade.php`).
- `PageSlugMiddleware` (`Modules\Cms\Http\Middleware`) dichiarato con `middleware()` in ogni shell CMS.
- Per `container0.index`: l'esito di `Themes\Sixteen\Actions\Folio\ResolveContainer0IndexAction` (alias, area personale, 404).

## Output

Una pagina Volt che monta `<x-layouts.app>` (`components/layouts/app.blade.php`) e delega il contenuto a `<x-page>` con lo
slug CMS e il data bag ricevuti; oppure un redirect (alias di container, area personale) o un 404.

## Invarianti

| ID | Regola | Group Pest |
|:---|:---|:---|
| SIXTEEN-FOLIO-INV-1 | In ogni pagina Folio con un `Component` Volt il nome `@volt('<nome>')` è un letterale uguale a `name()`; mai `@volt($variabile)` né `@volt('folio.…')`. Se viene violata, Livewire monta il frammento sbagliato o due pagine condividono lo stesso componente. | `SIXTEEN-FOLIO-INV-1` |
| SIXTEEN-FOLIO-INV-2 | I parametri di rotta delle shell `[container0]` si leggono in `mount(string $container0, …)`; mai `request()->route('container0')` né `@php $container0 = …`. | `SIXTEEN-FOLIO-INV-2` |
| SIXTEEN-FOLIO-INV-3 | `resources/views/pages` ha come sole cartelle `[container0]`, `auth` e `tests` e come solo file `index.blade.php`; non esistono `domande-frequenti*` né `profile*`. Se viene violata, una cartella o un file Folio oscura il contenuto CMS (la FAQ) o crea un alias morto che copre un 404 del modulo User. | `SIXTEEN-FOLIO-INV-3` |
| SIXTEEN-FOLIO-INV-4 | La shell `container0.index` non contiene logica di dominio inline: niente `resolveHomeTitle`, `nativePage`, `utilityPage`, `x-dynamic-component`, confronti `=== 'blog'` / `'events'` / `'domande-frequenti'`, `foIndexAliases`, `Auth::check`; alias, area personale e 404 stanno in `ResolveContainer0IndexAction`. | `SIXTEEN-FOLIO-INV-4` |
| SIXTEEN-FOLIO-INV-5 | `/{lang}/{container}/{slug}` senza record né pagina CMS risponde 404, non 200 con il template vuoto `{container}.view` (soft-404). | `SIXTEEN-FOLIO-INV-5` |

INV-1…INV-4 sono controlli sul sorgente, senza app (`tests/Unit/FolioPageMountContractTest.php`,
`tests/Unit/NoSemanticFolioPageDirectoriesTest.php`). INV-5 richiede l'app e un database (`tests/Feature/Pages/DetailNotFoundTest.php`,
il cui terzo test scrive un `Article`): non eseguito in questa passata.

## Effetti collaterali

Nell'ordine in cui avvengono, per `container0.index`:

1. `PageSlugMiddleware`.
2. `render()` chiama `ResolveContainer0IndexAction`: può reindirizzare (301 per gli alias; login o pratiche per
   `area-personale`) o fare `abort(404)` se `Page::findUniqueBySlug('<container0>.index')` è `null`.
3. `mount()` imposta `container0`, `pageSlug` e `data` (nessuna scrittura).
4. Un blocco `@php` fuori da Volt legge la pagina CMS (`Page::findUniqueBySlug`) per titolo, descrizione e `parity_page`.

Per `container0.view`: `mount()` chiama `ResolvePageAction`, poi `Page::findUniqueBySlug`, poi i due `abort_if(…, 404)` (INV-5).
Nessuna delle due scrive dati.

## Errori

- 404 da `ResolveContainer0IndexAction` (shell senza pagina CMS) e dai due `abort_if` di `container0.view`
  (`[slug0]/index.blade.php:43` e `:45`); è la protezione di INV-5.
- Redirect 301 verso il container canonico per gli alias in `FrontofficeContainerAliases`.
- Il resto (pagina non risolta, middleware) lo decide `PageSlugMiddleware` / Cms.

## Non fa

- Non crea pagine semantiche parallele per ticket, profili, blog o eventi: una cartella Folio in più è vietata da INV-3.
- Non possiede dati, policy né autorizzazioni: stanno nei moduli owner (`Modules/Fixcity`, `Modules/User`, `Modules/Cms`).
- Non descrive i blocchi `components/blocks/*`: la regola che siano riutilizzabili e guidati dai dati (etichette e URL nel JSON, default
  in `config()`, nessuna copia della stessa vista) è in `AGENTS.md`, senza un contratto né un test d'insieme.

## Limiti noti

- Limite noto: la shell `container0.view` non è «lineare». `[slug0]/index.blade.php` contiene, fuori da Volt, rami speciali per
  `auth/login`, `auth/register`, `tickets/track` e `tickets/<id>`, la ricerca di articoli `blog`/`events` via `ThemeComposer`, e
  per il dettaglio del ticket chiama `BuildPublicTicketDetailAction` con `abort_if($ticketDetail === null, 404)` (riga 114).
  Anche `[container0]/index.blade.php:59` interroga `Page::findUniqueBySlug` nel blocco `@php`. INV-4 copre solo la shell
  `container0.index`, e solo per le stringhe elencate: non vieta le query CMS nel `@php`.
- Limite noto: `tests/Unit/FolioPageMountContractTest.php` ha l'elenco dei file di INV-1 e INV-2 scritto a mano (tre o quattro
  pagine): `[token].blade.php` (`name('container1.token')`) non è nell'elenco di INV-2; INV-1 la copre solo per la parte
  «niente `@volt($`».
- Limite noto: nessun test prova che le rotte di `container1.*` (terzo livello) rispettino INV-4; il test per `container0.index`
  è il solo che guarda l'assenza di logica inline.
