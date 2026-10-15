---
id: dcp-102
title: "DCP-102: il rate limit del tracking pubblico e' oscurato dalla pagina dinamica del tema"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "tracking pubblico rate limit throttle capability code ticket track oscurata tema folio ticket-track 429"
related: [dcp-90, dcp-42]
tags: [docs, sixteen, bmad]
---

# DCP-102: codici di tracking pubblici senza limite di tentativi

## Fatto (trovato dall'agente DCP-90, 2026-10-13)
Il modulo dichiara `middleware('throttle:10,1')` sulla sua pagina `tickets/track`, ma Folio monta prima il tema (`Modules/Cms/app/Providers/FolioVoltServiceProvider.php`, righe ~112-160): `/it/tickets/track` e' servita dalla pagina `ticket-track` del tema (`pages/[container0]/[slug0]/index.blade.php`, ramo `ticket-track`), che **non ha alcun limite**. Il codice di tracciamento e' un *capability token* (chi lo conosce vede stato e timeline pubblica): senza throttle si puo' provare a indovinarli. Stesso meccanismo che oscurava `tickets/create` (DCP-42) e `tickets/confirmation` (DCP-34).

## Perche' e' una story del tema
La correzione giusta e' dove arriva la richiesta: la pagina del tema. Va dichiarato nel modo CMS-driven (JSON della pagina `tickets.track` con `"middleware": ["throttle:10,1"]`, letto da `PageSlugMiddleware`) oppure con `middleware('throttle:10,1')` nel front matter Folio della pagina del tema, SOLO per il ramo del tracking. Attenzione: `PageSlugMiddleware` risolve ogni voce come alias/classe (`web` da' 500: vedi DCP-42): provare `throttle:10,1` con curl prima.

## Acceptance criteria
1. Dopo 10 richieste al minuto allo stesso `/it/tickets/track?code=...` (stesso IP) la risposta e' 429.
2. Le altre pagine dinamiche a 3 segmenti non cambiano (`/it/auth/password/reset` resta 200).
3. Test di regressione (429 all'undicesima richiesta; non all'ottava).
4. `TrackingTranslationTest` e `FollowedTicketsPageTest` (4 rossi per il 429 atteso, DCP-103) tornano verdi o si aggiornano con motivo.

## Esito (2026-10-14 22:50 UTC, coordinatore DCP-129)
**Fatto, in due livelli.** (1) Pagina: nuovo JSON CMS `tickets.track.json` (3 copie identiche: `config/local`, `config/eu`, `Modules/Fixcity/config`) con `"middleware": ["throttle:10,1"]`, letto da `PageSlugMiddleware` come la richiede il punto 21 di questa story; layout `app` (come prima: il ramo `ticket-track` del tema non cambia), titolo e descrizione in 4 lingue. Server di sviluppo: 12 richieste di fila a `/it/tickets/track` danno `200 x8` (due consumate dal ciclo di attesa) e poi `429`, con `x-ratelimit-limit: 10`. (2) Radice: `GetPublicTicketByCodeAction` limita i tentativi a vuoto (10 al minuto per indirizzo, 429 con `Retry-After`) per tutte le pagine che cercano per codice, anche la conferma `?code=` (vedi `Modules/Fixcity/docs/stories/2026-10-14-dcp-149-*.story.md`).
Prove: `FollowedTicketsPageTest` ("limits public ticket tracking lookups to ten requests per minute") torna verde senza modificarlo; guardia `Modules/Fixcity/tests/Unit/TicketTrackPageJsonGuardTest.php` (5 test: `middleware` esattamente `["throttle:10,1"]` in ogni copia, copie identiche, titolo e descrizione in 4 lingue), provata ROSSA (2 su 5) togliendo la chiave e verde dopo il ripristino; `ContentIntegrityGuardTest` del Cms verde; PHPStan a zero. 29 test passati in un giro (guardia + `FollowedTicketsPageTest` + test del limite + integrita' contenuti) su DB scratch.

