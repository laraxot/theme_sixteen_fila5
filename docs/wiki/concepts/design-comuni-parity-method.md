---
title: "Metodo di parity Design Comuni (guidato da JSON, Tailwind + Alpine)"
type: concept
status: active
created: 2026-10-13
qmd: "design comuni parity metodo json blocchi tailwind alpine gate html visual extract css explain style"
---

# Metodo di parity Design Comuni

Per portare una pagina `/it/tests/<slug>` a >= 90% HTML e >= 97% visual rispetto al riferimento `.../sito/<pagina>.html`:

1. **Leggere i contratti** (`docs/layout-runtime-contract.md`, `docs/architecture/tailwind-alpine-philosophy.md`). Pagina = JSON + blocchi; nessun file Folio o layout per pagina.
2. **Misurare la baseline** con il gate (`bashscripts/docs/visual-comparison/definition-of-done.md`): HTML + visual a 375/768/1440, con `--stub-images`.
3. **Modello dati** in `tests.<slug>.json`: ogni testo, link e immagine del riferimento.
4. **Blocco Blade** che emette il markup del riferimento da JSON (cicli, `@class`, nessun testo cablato).
5. **Stili**: `extract-used-css.mjs --within main --scope .<scope>` verso `resources/css/design-comuni/`, import in `app.css`; font self-hosted.
6. **Cascata**: `explain-style.mjs` per ogni valore sbagliato; si cancella la regola legacy, non si aggiunge `!important`.
7. **Comportamenti** con Alpine in `resources/js/theme/*.js` (registrati in `app.js`), verificati con `--click`.
8. **Sentinelle** prima/dopo (indice test, argomenti, home reale `/it`).
9. **Chiudere**: story con l'output del gate; memoria e wiki aggiornate; `bash bashscripts/docs/llm-wiki-qmd.sh update`.

Cause degli errori del 2026-10-13 e guardrail: `docs/bmad/decisions/2026-10-13-parity-root-cause-and-guardrails.md`.
Stato e prossimi passi: `docs/bmad/stories/2026-10-13-dcp-00-epic-design-comuni-parity-v2.story.md`.
