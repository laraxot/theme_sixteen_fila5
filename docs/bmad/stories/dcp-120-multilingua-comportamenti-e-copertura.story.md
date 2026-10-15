---
id: dcp-120
title: "DCP-120: multilingua, comportamenti e copertura di de ed es"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "multilingua i18n de es it en fallback_locale lang html hreflang selettore lingua glossario ContentLocaleParityTest wcag 3.1.1 3.1.2 skip link localizeURL"
related: [dcp-106, dcp-123, dcp-121]
tags: [docs, sixteen, bmad]
---

# DCP-120: il sito dice la lingua che parla

## Richiesta (utente, 2026-10-13)
Il sito deve essere multilingua; capire e studiare anche i comportamenti e gli effetti; mobile, professionale, accessibile.

## Perche'
Il sito serve `it`, `en`, `de`, `es` (`laravel/config/laravellocalization.php`), ma `/de` e `/es` rispondevano 200 con `<html lang="de">` e tutto il testo in italiano: 114 righe visibili uguali all'italiano nella home. Il fallback e' `it`, quindi una traduzione mancante non da' errore, si vede solo guardando. Conseguenze verificate:
1. La pagina dichiara una lingua che non e' quella del testo (WCAG 2.1, criteri 3.1.1 lingua della pagina e 3.1.2 lingua delle parti). Non si cita qui nessuna norma italiana sul multilinguismo dei servizi digitali della PA perche' non e' stata verificata in questa sessione.
2. Un cittadino tedesco o spagnolo non capisce nulla: header, footer, ricerca, home.
3. `<title>` `FixCity` e `<meta description>` in italiano per de/es.
4. I pulsanti principali della home portavano a `/it/tickets/create` in tutte le lingue: la lingua si perdeva al primo clic.

Mappa completa dei comportamenti: [`docs/i18n/00-comportamento-multilingua.md`](../../i18n/00-comportamento-multilingua.md). Glossario: [`docs/i18n/01-glossario.md`](../../i18n/01-glossario.md).

## Decisioni
| # | Decisione | Perche' |
|---|---|---|
| 1 | Tradotti in de ed es header, footer, modale di ricerca, home (titolo, descrizione, 4 blocchi) | e' il chrome di ogni pagina e la porta d'ingresso; il contenuto resta quello dell'italiano (nessun testo inventato) |
| 2 | I blocchi si generano dall'italiano, non dall'inglese | URL e struttura restano identici alla fonte; l'inglese aveva URL tradotti |
| 3 | `en`: URL interni riallineati a `it` (`/administration` diventa `/amministrazione`), colonne del footer `columns` riordinate come in `it`, email di contatto uguale a `it` | lo slug di una pagina e' uno solo; un URL tradotto non corrisponde a nessuna pagina; l'email di contatto non cambia con la lingua |
| 4 | Selettore lingua con `ITA ENG DEU SPA` in tutti i blocchi | prima un `/de` non aveva la propria voce |
| 5 | Skip link da chiavi `pub_theme::ui.skip_to_content` e `skip_to_footer` (esistevano in it/en/de/es) in `components/layouts/{app,design-comuni,test}.blade.php` | erano testo italiano nei layout; stesso testo in italiano, quindi nessun cambio per `it` |
| 6 | CTA e due link del footer con `LaravelLocalization::localizeURL('/...')` al posto di `route('container0.view')` e `/tickets/create` | `route()` restituisce sempre `/it/...` (provato), il percorso senza prefisso e' 404 |
| 7 | Guardia `ContentLocaleParityTest` (solo filesystem) | stesse chiavi e URL, nessun testo italiano rimasto in de/es/en tranne elenco motivato, selettore = lingue servite, copie tenant e modulo identiche |
| 8 | Lingua dichiarata (`lang="it"` sul contenuto in fallback) rimandata a DCP-123 | richiede di toccare `Modules/Cms/resources/views/components/page.blade.php` (altro repo git) e un criterio per il fallback dei file lang; la vista `Themes/Sixteen/.../components/page.blade.php` NON e' quella usata da `<x-page>` (provato: `x-page` e' la classe `Modules\Cms\View\Components\Page` che rende `cms::components.page`) |

## File
Contenuti (tenant `laravel/config/local/fixcity/database/content/` e modulo `laravel/Modules/Fixcity/config/database/content/`, identici byte per byte): `sections/header.json`, `sections/footer.json`, `sections/search-modal.json`, `pages/home.json`.
Lang nuovi: `Modules/Fixcity/lang/de/homepage.php`, `Modules/Fixcity/lang/es/homepage.php` (CTA e didascalia della mappa della home: mancavano, ricadevano sull'italiano).
Layout (solo le due righe dello skip link): `Themes/Sixteen/resources/views/components/layouts/{app,design-comuni,test}.blade.php`.
Test: `Modules/Fixcity/tests/Unit/ContentLocaleParityTest.php`.
Docs: `Themes/Sixteen/docs/i18n/{INDEX,00-comportamento-multilingua,01-glossario}.md`.

Nota di coordinamento: la copia modulo di `sections/header.json` era rimasta indietro rispetto al tenant (nome "Mario Rossi" e avatar `picsum.photos` in `account.signed_in`, gia' tolti dal tenant da un'altra sessione). Allineata al tenant senza altre modifiche a `account` e `signed_in`.

## Misure prima e dopo (audit-locales, `BASE=http://192.168.1.40:8000`)
Righe visibili uguali all'italiano. Le "chiavi grezze" sono commenti HTML delle viste e si ignorano.

| Pagina | en prima | en dopo | de prima | de dopo | es prima | es dopo |
|---|---|---|---|---|---|---|
| `/` (home) | 9 | 7 | 114 | 7 | 114 | 8 |
| `/tickets` | 9 | 38 | 102 | 37 | 102 | 40 |
| `/auth/login` | 11 | 9 | 89 | 9 | 89 | 10 |

Residuo della home, tutto motivato: 6 nomi di marchio (Twitter, Facebook, YouTube, Telegram, Whatsapp, WhatsApp), `Media policy` in en (gia' inglese), `Via Roma 123 - 00100 Comune` in de ed es (indirizzo del Comune), `Turismo` in es (omografo).

`/tickets` e' salito (en 9 -> 38) perche' nel frattempo un altro agente ha riempito la pagina con titoli, indirizzi e descrizioni di segnalazioni di esempio (testo "dell'autore", italiano per natura) e un breadcrumb: il chrome e' ora tradotto (da 102 a quasi zero le righe di chrome), il resto e' contenuto di quella pagina. `/auth/login`: restano `Accedi a FixCity` e `Accedi per inviare e seguire le tue segnalazioni.` (pagina del modulo User, altra story).

`<html lang>`, `<title>`, `<meta description>` della home (curl, prima -> dopo):

| Lingua | `<html lang>` | `<title>` | `<meta description>` |
|---|---|---|---|
| it | it | invariato | invariata |
| en | en | invariato | invariata |
| de | de | `FixCity` -> `FixCity — Civic-Tech-Plattform für die Instandhaltung der Stadt` | italiana -> tedesca |
| es | es | `FixCity` -> `FixCity - Civic tech para un mejor mantenimiento urbano` | italiana -> spagnola |

Screenshot Playwright a 375 px della home in it, de, es (letti uno per uno): testi piu' lunghi in de ed es non rompono header, pulsanti, mappa, "come funziona", blocco "segui la tua segnalazione", footer (nessuno scroll orizzontale, `scrollWidth` 375). Difetti presenti anche in italiano, quindi non dovuti alla traduzione, da DCP-121 (mobile): il nome della regione nella barra superiore e' coperto dall'icona del menu (`Nome della Regione` appare come `e della Regione`, in de `e der Region`); il pannello del menu mobile si apre con classe `is-open show` ma ha larghezza 47,6 px; il contenitore del marchio nel footer (`.it-brand-wrapper`) arriva a `right=518` px (it), 532 (de), 571 (es) oltre i 375 del viewport, tagliato dal contenitore. Regola CSS mancante da proporre (non e' stato toccato nessun CSS): sotto `lg` dare a `.it-header-slim-wrapper-content` un padding sinistro pari alla larghezza del pulsante del menu e `min-width: 0; overflow-wrap: anywhere` a `.it-brand-text` nel footer.

## Verifiche eseguite
- `ContentLocaleParityTest`: 5 test, 120 asserzioni, verde; PHPStan sul file: `[OK] No errors` (config `laravel/phpstan.neon`). Rosso poi verde provato su una copia in scratchpad con 5 mutazioni (blocco `es` tolto, URL del footer diverso, testo de rimasto italiano, selettore senza `DEU`, copia modulo diversa dal tenant): ognuna rende rosso almeno un test, la copia intatta e' verde.
- PHPStan sui due file lang nuovi: nessun errore.
- `curl` 200 su `/it`, `/en`, `/de`, `/es`, `/it/tickets`, `/it/tests/homepage` dopo le modifiche; skip link letti nelle quattro lingue; link `/{lingua}/tickets/create` e `/{lingua}/tickets/track` per ogni lingua.
- Non rieseguito, estraneo: `Modules/Cms/tests/Feature/HeaderNavJsonTest.php` fallisce con `BindingResolutionException: Target class [config] does not exist` (test senza TestCase, non dipende da questi file).

## Limiti (cosa NON e' tradotto)
- Le 88 pagine di prova `tests.*` (hanno `it` ed `en`; de/es ricadono sull'italiano) e le pagine `tickets.*`, `area-personale.*` di altri agenti.
- Contenuti scritti dai cittadini: lingua dell'autore.
- Il logo del finanziamento europeo del footer contiene testo italiano nell'immagine.
- Le etichette delle tessere della mappa (OpenStreetMap) restano nella lingua locale.
- Il fallback `__()` dei file lang di tema e moduli per tutte le altre pagine: l'audit lo misura, non lo corregge.
- Date, numeri e valute con formato fisso: elencati con file e riga in `00-comportamento-multilingua.md`.
- Traduzioni da far rivedere a un madrelingua prima del rilascio (scelte in `01-glossario.md`).

## Difetti fuori ambito (file e riga)
1. `Themes/Sixteen/resources/views/pages/[container0]/index.blade.php:58`: `<meta description>` di `/it/tickets` con il JSON grezzo dell'oggetto per lingua (la home lo decodifica in `pages/index.blade.php:33-34`).
2. `Modules/Cms/app/Providers/FolioVoltServiceProvider.php:117,157`: le rotte Folio hanno lo stesso nome in ogni lingua e `route()` risolve sempre `it` (causa del punto 6 delle decisioni).
3. `Modules/Cms/routes/web.php:16-17`: la radice rimanda sempre a `/it`, ignora `Accept-Language` e la scelta fatta.
4. `Themes/Sixteen/resources/views/components/sections/header/design-comuni.blade.php:21-31`: il cambio lingua perde la query string; righe 51-66: link senza `lang`/`hreflang`.
5. `Modules/Cms/app/Http/Middleware/SetFolioLocale.php:12-18`: il commento elenca la priorita' al contrario del codice.
6. Formati fissi: `ticket-card.blade.php:21`, `data-display/table.blade.php:198-201`, `pagopa-button.blade.php:38`, `municipal/service-card.blade.php:121` (`->locale('it')` fisso), `ticket-list/results-header.blade.php:15`.
7. `Themes/Sixteen/resources/views/components/layouts/main.blade.php:11-13`: nessun `hreflang` ne' `canonical`.
8. Quasi tutti i `url` di header, footer e modale sono segnaposto che rispondono 404 (es. `/it/amministrazione`, `/it/privacy`, `/it/note-legali`).

## Rischi
- Il tenant e il modulo Fixcity hanno ognuno una copia dei quattro JSON: oggi identici (guardia), ma un agente che edita una sola copia fa rosso il test (e' voluto).
- Un'altra sessione puo' riscrivere i JSON con un formato diverso: gli inserimenti sono ancorati, l'unico inserimento testuale e' in `home.json` (formato misto, non round-trip).
- `LaravelLocalization::localizeURL` dentro il JSON dipende dall'alias globale `LaravelLocalization`; provato con `Blade::render`, se l'alias sparisce le CTA rompono la pagina.
- Vedere DCP-123 per la dichiarazione della lingua: fino ad allora le pagine in fallback restano sotto `lang` sbagliato.
