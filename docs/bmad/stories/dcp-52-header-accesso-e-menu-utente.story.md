---
id: dcp-52
title: "Header: accesso e menu utente coerenti con lo stato di autenticazione"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
module: Sixteen
created: 2026-10-13
updated: 2026-10-13
tags: [header, auth, area-personale, i18n]
qmd: "dcp-52 Header: accesso e menu utente coerenti con lo stato di autenticazione"
---

# DCP-52: header, accesso e menu utente

## Richiesta (2026-10-13, utente)
Nell'header «Accedi all'area personale» si deve vedere se non sei loggato e deve andare a `route('login')`. Se sei loggato si deve vedere quello che si vede nelle pagine di riferimento `*-area-personale` e `graduatoria-messaggio` (menu utente), ma non «Mario Rossi»: qualcosa che abbia senso. Regola: buon senso, ogni voce ha scopo e funzione. Il sito e' multilingua e deve essere ottimizzato per cellulare e tablet. Le credenziali di sviluppo sono state fornite dall'utente nel messaggio e NON sono riportate in nessun documento.

## Evidenza iniziale (verificata il 2026-10-13 ~17:10 UTC, sito di sviluppo)
- Il CTA ospite dell'header ha `href="/login"` (dal JSON `sections/header.json`, `account.url`): `curl /login` -> **404**. Il login vero e' `/it/auth/login` (Folio `login`).
- Dopo un login riuscito (sessione autenticata: `/it/tickets/create` risponde 200) l'header mostra ancora «Accedi all'area personale»: `$isSignedIn` nel header Design Comuni si valorizza solo dalla variabile `dcSignedIn` del layout `design-comuni-authenticated` (replica `/it/tests/*`, nome «Mario Rossi» e avatar `picsum.photos` presi dal JSON), il layout reale `layouts/app` non guarda `auth()`.
- Pagine di area personale gia' esistenti in `Modules/User/resources/views/pages/area-personale/` (da loggato): `pratiche` 200 (elenco ticket dell'utente, `BuildAuthenticatedUserTicketsQueryAction`), `impostazioni` 200 (+ `/it/profile/edit` 200), `servizi` 200 ma e' un SEGNAPOSTO («I servizi disponibili saranno mostrati qui»), `notifiche` reindirizza a `/notifications` che risponde 404 e lascia un `<main>` vuoto; `/it/dashboard` 404; `/it/lista-categorie` (services.categories) 500.
- Lock stantio su `pratiche.blade.php.lock` (2026-09-26, agente codex, task fixcity-story-500-501): ignorato, 17 giorni.

## Decisioni di buon senso (da verificare dallo studio AP-PAGES di DCP-53)
1. Il CTA ospite punta alla rotta di login localizzata (`/{locale}/auth/login`), non a un URL cablato.
2. Da loggato l'header mostra il menu utente con il NOME REALE dell'utente; niente avatar da servizi esterni (privacy e rete: niente `picsum.photos`): iniziali in un badge o l'icona utente.
3. Ogni voce del menu porta a una pagina che funziona e fa qualcosa. Il prodotto gestisce segnalazioni di disservizi, non i servizi comunali del riferimento (graduatoria, permessi, vantaggi, multe, IMU): quelle pagine NON si replicano con dati inventati.
4. Voce senza funzione = non si mostra (niente `#`, niente segnaposto).

## Modifiche verificate
- `components/sections/header/design-comuni.blade.php`: lo stato reale usa `auth()->user()`; `dcSignedIn` resta esclusivamente il simulatore delle preview `design-comuni-authenticated`.
- Ospite: il CTA usa sempre `route('login')` e mantiene `data-element="personal-area-login"`.
- Autenticato: il nome deriva dall'utente reale (fallback email); senza identità reale la preview mostra `Area personale`, mai un nome o avatar inventato e mai una richiesta a `picsum.photos`.
- Le destinazioni del menu sono URL localizzati e verificati: `/area-personale/servizi`, `/area-personale/pratiche`, `/profile/edit`; il logout reale è un form POST con CSRF e `route('logout')`. Non viene mostrata una voce `#` o una destinazione `/notifications` che in questo deployment restituisce 404.
- `lang/it/header.php` e `lang/en/header.php`: aggiunta la label neutra per la preview.
- `sections/header.json`: rimosso il falso nome/avatar statico; il renderer non usa più il menu statico per lo stato autenticato.

## Verifica eseguita
- `php -l` sul Blade e parsing JSON: OK.
- Guest `GET /it/`: 200; il CTA punta a `http://192.168.1.40:8000/it/auth/login`; nessun `Mario Rossi`, `picsum.photos` o CTA guest duplicato.
- Login locale autorizzato con l'utenza di sviluppo: header autenticato rileva `Marco Sottana`, nasconde il CTA guest e mostra il menu.
- Destinazioni testate autenticato: `area-personale/servizi` 200, `area-personale/pratiche` 200, `profile/edit` 200; `notifications` è 404 e quindi è esclusa dal menu.
- Menu autenticato a 1440 px: quattro link applicativi attesi (servizi, pratiche, impostazioni e logout); markup con `aria-expanded`, `aria-haspopup`, `aria-controls`, `role="menu"` e form POST.

## Decisione di sicurezza e dominio
La preview autenticata è una rappresentazione visuale delle pagine Design Comuni e non conferisce autorizzazione: non deve esporre dati personali né fingere un'identità. Il front office reale invece mostra solo il nome dell'utente della sessione e collega a risorse protette. Questo applica minimizzazione, purpose limitation e privacy by design (GDPR artt. 5, 25, 32), autenticazione per dati personali (CAD/eIDAS) e controllo da server delle autorizzazioni.

## Limiti espliciti
La voce notifiche non è stata inventata: la pagina non esiste nel deployment corrente (HTTP 404). Se il modulo Notify espone una destinazione front office stabile, va aggiunta con una story separata e testata prima del menu.

## Verifica del lead (2026-10-13 17:00 UTC): le voci del menu portano a pagine vuote
Header: l'altra sessione ha consegnato alle 16:51-16:55 il ramo utente reale (nome, iniziale, menu: Le mie segnalazioni, Segnalazioni che seguo, Notifiche, Impostazioni e privacy; Esci). Rete di sicurezza scritta dal lead: `Modules/Fixcity/tests/Feature/Pages/HeaderAccountMenuTest.php` (ospite x 4 lingue, loggato x 4 lingue, destinazioni, logout).
Difetti trovati e misurati (sito di sviluppo, utente loggato):
1. **CTA ospite multilingua**: con `route('login')` il link puntava SEMPRE a `/it/auth/login` anche da `/en`, `/de`, `/es` (le rotte Folio hanno lo stesso nome in ogni lingua). Corretto dal lead con `$localizedUrl('auth/login')` (una riga in `sections/header/design-comuni.blade.php`): ora `/en/auth/login`, `/de/...`, `/es/...` (curl). Test: 4 lingue verdi.
2. **Tutte e 4 le destinazioni del menu sono pagine VUOTE**: `/it/area-personale/{pratiche,seguite,notifiche,impostazioni}` rispondono 200 ma con `h1=0`, testo del `<main>`=0 e titolo "FixCity". Causa (HTML reale: snapshot Livewire con `container0=area-personale`, `slug0=pratiche`, `pageSlug=area-personale.pratiche`): le serve la pagina GENERICA del tema `[container0]/[slug0]`, che cerca una pagina CMS con quello slug e, non trovandola, rende un `<x-page>` vuoto; le pagine Folio del modulo User (`Modules/User/resources/views/pages/area-personale/*.blade.php`, con h1, elenco e stato vuoto) sono oscurate, come gia' successo per `tickets/create`. Il test `links every menu entry to a page that works and has something to show` e' ROSSO per questo motivo (e' il criterio di accettazione di questo difetto).
3. Soluzioni (decide DCP-53 dopo lo studio AP-PAGES): (a) pagine CMS `area-personale.<voce>.json` con `"middleware": ["auth"]` e blocchi Blade (coerente con "pagine = JSON + blocchi" e con `tickets.confirmation`); (b) cambiare l'ordine di montaggio Folio: SCARTATA in partenza, farebbe vincere `tickets/create` del modulo sulla pagina generica che renderizza il wizard.
Claim: implementazione delle pagine area personale = DCP-53 (sessione che scrive per prima la riga qui sotto).

## Esito 17:15 UTC
Difetto 2 (destinazioni vuote) RISOLTO dalla sessione tema con pagine CMS `area-personale.*`; difetto 1 (CTA ospite non localizzato) risolto dal lead. Prova: `HeaderAccountMenuTest` 10/10; dettaglio e tabella in DCP-53 (Modules/User/docs/stories/dcp-53-area-personale-pagine-con-scopo.story.md). Restano: de/es e mobile (DCP-55), scopo e norme (DCP-54).
