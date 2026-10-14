---
id: dcp-02
title: "DCP-02: contratto "le pagine /tests sono dato""
type: story
epic: dc-parity-v2
status: todo
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-02: contratto "le pagine /tests sono dato" bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-02: contratto "le pagine /tests sono dato"

## Contesto
Errore ripetuto in sessione: creare `pages/tests/homepage.blade.php`, `pages/tests/segnalazioni/[slug].blade.php`, un layout con il
nome della pagina e partial con testo cablato; reintrodurre in `[slug].blade.php` fallback `catalogFallback` con liste di slug.
Il contratto scritto in `docs/layout-runtime-contract.md` lo vieta e dice che una pagina e' solo JSON + blocchi.

## Regole (fonte: layout-runtime-contract.md, tailwind-alpine-philosophy.md, decision-layout-test.md)
1. `pages/tests/[slug].blade.php` contiene solo Folio, classe Volt, `<x-layouts.app>`, `<x-page>`. Slug vuoto = `tests.index`.
2. Nessun file Folio per singola pagina, nessun layout per singola pagina, nessun testo nelle viste: il testo e' nel JSON.
3. JSON canonico: `database/content/pages/tests.<slug>.json` (tenant sovrascrive modulo). Mai due file con lo stesso slug nella stessa cartella.
4. Stile in `resources/css/app.css` (import), comportamento Alpine registrato in `resources/js/app.js`.
5. Header, footer e skiplink vivono nel layout `app`, mai nella pagina o nel blocco.

## Da fare
- Test Pest (tema Sixteen) che fallisce se: esiste un `.blade.php` in `pages/tests/` oltre a `[slug]` e `index`; `[slug]` importa `File` o cita `catalog`; due JSON della stessa cartella hanno lo stesso `slug`.
- Aggiornare `docs/layout-runtime-contract.md` con la sezione "errori gia' commessi".

## Criteri di accettazione
- Il test esiste, passa oggi e fallisce se si reintroduce una delle violazioni sopra (provarlo con un file di prova).
