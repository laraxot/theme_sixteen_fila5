---
id: homepage-coordination
title: Coordinamento tra agenti sulle pagine /it/tests
document_type: coordination
status: active
updated: 2026-10-13
---

# Coordinamento tra agenti

Il 2026-10-13 hanno scritto negli stessi file Claude, codex, opencode, qwen e omp, con approcci diversi. Regole per non sovrascriversi
(story [DCP-12](../../bmad/stories/2026-10-13-dcp-12-multi-agent-ownership-protocol.story.md)).

## Prima di scrivere (obbligatorio)
```bash
find laravel/Themes/Sixteen laravel/Modules/Fixcity laravel/config -mmin -10 -type f -not -path '*/node_modules/*'
git -C laravel/Themes/Sixteen diff --stat
ps -eo pid,etimes,args | grep -E "claude|codex|opencode|qwen|omp" | grep -v grep
```
Modifiche ancorate e idempotenti (aggiungere se manca, mai riscrivere un file intero), backup nello scratchpad, rilettura dopo.
Una sola build alla volta: `npm run build` nel tema (circa 11 secondi); il manifest si rilegge dopo, non si assume.

## Contratto non negoziabile
Le pagine `/it/tests/*` sono **dato**: Folio generico `[slug]` + `<x-page>` + blocchi/sezioni Blade + JSON `tests.<slug>.json`.
Vietato: file Folio o layout per singola pagina, testo nelle viste, Bootstrap Italia a runtime, nuovi `*-parity.css` con `!important`.
Fonte: `docs/layout-runtime-contract.md`, `docs/architecture/tailwind-alpine-philosophy.md`.

## Proprieta' (aggiornare a inizio e fine lavoro)
| Cosa | Proprietario | Stato |
|---|---|---|
| `components/blocks/homepage.blade.php`, `tests.homepage.json`, `resources/css/design-comuni/*`, `resources/js/theme/design-comuni-home.js` | sessione Claude 2026-10-13 | rilasciato a fine giornata, riprendere con DCP-04 |
| `components/sections/header/*`, `components/sections/footer/*`, `sections/search-modal` | libero | DCP-05, DCP-06 |
| `blocks/search-results/*`, `tests.risultati-ricerca.json` | libero | DCP-07 |
| `app.css` e file `*-parity.css` | libero, un solo agente per volta | DCP-03 |

Se due approcci confliggono, si confrontano con i numeri del gate (`bashscripts/tools/visual/`) e il risultato si scrive qui.
