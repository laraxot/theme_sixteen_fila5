---
title: "Decision log — Sixteen JSON-driven homepage"
type: bmad-decision-log
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
qmd: "Sixteen homepage JSON CMS decisions"
status: draft
tags: [docs, sixteen, bmad]
---

# Decision log

## 2026-10-09 — TwentyOne come riferimento

`Themes/TwentyOne/resources/views/pages/index.blade.php` è il riferimento
perché delega a `<x-cms::page side="content" slug="home" />`.

## 2026-10-09 — Primo payload rifiutato

Il primo `home.json` è rifiutato: contiene chiavi custom (`hero`, `map`,
`layout`) ma non il contratto `content_blocks` letto da `Page`. La
correzione deve partire da `tickets.confirmation.json` e dalla fonte
`index.blade.php.old`, non da un elenco marketing inventato.

## 2026-10-09 — Perimetro funzionale fissato

La homepage conserva soltanto hero con mappa/CTA, tre step "Come funziona" e
tracking. Features, statistiche, categorie e testimonianze sono fuori scope.

## 2026-10-09 — Nessun loader parallelo

Sixteen non deve chiamare `json_decode` o leggere file direttamente dalla Blade:
il contratto runtime resta `Modules/Cms\View\Components\Page` + `BlockData`.

## 2026-10-09 — Route nominate nei link ticket

`home.json` usa `route('container0.index', ['container0' => 'tickets'])`
per la lista e `route('container0.view', ['container0' => 'tickets', 'slug0' => 'create'])`
per la creazione/report. Entrambi i target passano dalle Folio page generiche del
tema Sixteen: `[container0]/index` per la lista e `[container0]/[slug0]` per lo
slug CMS `tickets.create`. `container0.create`, `container0.store`,
`tickets.create` e i percorsi hardcoded sono esclusi dal contratto JSON della
homepage.

## 2026-10-09 — Cutover JSON completato

Il JSON e le block view minime sono stati aggiornati dopo la verifica del
contratto CMS. Il workflow resta forward-only; il solo gate pendente è lo smoke
browser Playwright/Puppeteer nell'ambiente con Chromium disponibile.
