---
id: eventi-visual-parity-97
title: Eventi Visual Parity 97% Target
type: story
status: review
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "eventi visual parity 97% target sixteen"
---
# Eventi Visual Parity 97% Target

## Stato: implementata, in review

- HTTP: `200` su `/it/tests/eventi`.
- Risoluzione route: Folio `[slug]` → `tests.eventi` → fixture JSON tenant.
- Blocchi presenti: hero, sei eventi, sei luoghi, rating, contatti, header/footer.
- Responsive verificato con Playwright a `375`, `768` e `1440` px.
- A `1440` px la griglia è a tre colonne; a `375` e `768` px non produce overflow.
- Conteggio runtime: `13` card (`6` eventi + `6` luoghi + `1` contatti), `h1` e titoli di sezione attesi.
- Console locale senza errori e nessuna risposta locale `>=400`.
- JSON validato con `jq empty`; build Vite completata e viste pulite.
- La percentuale pixel/html non è dichiarata: manca ancora un diff metrico normalizzato sul body.

## Acceptance criteria

- [x] Fixture con `id`, `slug`, `layout: test` e contenuto completamente JSON-driven.
- [x] Nessuna Blade page-specific in `resources/views/pages/tests`.
- [x] Hero, eventi e luoghi condividono il blocco `events-page` e le sections del tema.
- [x] Layout responsive 1/2/3 colonne verificato alle tre viewport.
- [x] Build e rendering HTTP verificati; nessun errore console o asset locale mancante.
- [ ] Diff HTML del `<body>` >=90% misurato automaticamente.
- [ ] Diff visual >=95% misurato automaticamente; gli screenshot sono evidenza, non una percentuale.
- [ ] Audit WCAG completo con axe/WCAG tool ancora da eseguire su questa pagina.

## Root cause e guardrail

Il primo rendering desktop mostrava due colonne invece delle tre perché il CSS estratto per le altre pagine non includeva `.col-xl-4`. La correzione è stata confinata alla pagina tramite `body:has(.page-content[data-slug="tests.eventi"])`, senza aggiungere Bootstrap runtime. Le immagini panoramiche hanno ora un rapporto `16/9` scoped per evitare card deformate.

Guardrail: ogni nuova pagina deve controllare le classi responsive usate dalla reference, il selettore di scope runtime (`body:has(.page-content[data-slug^="tests."])`), asset/network errors, overflow e una misura DOM prima di dichiarare la parity.
