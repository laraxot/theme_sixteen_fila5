---
type: philosophy-decision
decision: D16
story: ../bmad/stories/dcp-32-scope-data-dc-pagine-reali.story.md
title: "D16: il look Design Comuni si accende con un attributo, deciso dal JSON della pagina"
status: draft
updated: 2026-10-13
tags: [docs, sixteen, decision-log]
qmd: "d16: il look design comuni si accende con un attributo, deciso dal json della pagina sixteen"
---
# D16: il look Design Comuni si accende con un attributo, deciso dal JSON della pagina

**Problema**: `/it/tickets/create` (riepilogo) e `/it/tickets/confirmation` devono assomigliare in tutto ai riferimenti `segnalazione-03/04`, ma il CSS generato valeva solo per gli slug `tests.*` (scope `body:has(.page-content[data-slug*="tests."])`). Misurato: pagina reale HTML 24,84%, pixel 55,74%.

**Logica**: lo scope per sottostringa dello slug era un proxy di "pagina di prova". Serve la cosa vera: "questa pagina usa il chrome Design Comuni". La dice il JSON della pagina (`"layout": "design-comuni"`), la scrive il wrapper (`data-dc`), la legge il CSS (`.page-content[data-dc]`).
**Filosofia**: una pagina e' dato (JSON + blocchi). Il layout non si decide con un file Folio per pagina ne' con un controllo sullo slug nel codice.
**Politica**: ogni pagina reale sceglie da sola quando passare al nuovo look; le altre (`/it`, `/it/tickets`, login, dettaglio) non cambiano di un pixel (verificato con `curl`: 200 e nessun `data-dc`).
**Religione**: una sola fonte di verita' per il chrome: `layouts/design-comuni*` + `sections/*/design-comuni` con i testi in `header.json`/`footer.json`.
**Zen**: il cambio minimo: un attributo, cinque punti di codice, nessuna regola nuova.

**Conseguenze**: per riusare l'ultimo build si sostituisce il prefisso nel `components.css` e si fa un solo `npm run build`; la prossima rigenerazione completa usa lo scope nuovo. Collisioni di numerazione: esistono due `D15` (`D15-volt-fragment-explicit-root`, `D15-conferma-post-save`): questa e' `D16`, come da protocollo DCP-35.
