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
5. **Stili**: `extract-used-css.mjs <pagine...> --scope 'body:has(.page-content[data-slug*="tests."])'` (tutto il body, con gli stati dei menu/modali) verso `resources/css/design-comuni/components.css`, import in `app.css`; font self-hosted.
6. **Isolamento**: il plugin PostCSS `postcss/isolate-legacy-important.cjs` esclude le regole legacy dall'ambito (`body:has(...)`); `find-important-overrides.mjs <url> 'body:has(.page-content[data-slug*="tests."]) *'` va tenuto a 0. `<body>` plain, nessun wrapper o classe inventata (policy `docs/html-parity-body-policy.md`). Nessuna regola a mano con l'ambito fuori da `overrides.css`.
6b. **Differenze**: sezione per sezione `compare-screenshots.mjs --selector`; poi `compare-computed.mjs` (proprieta' sbagliate, anche `--hover`) e `explain-style.mjs` (quale regola, anche `--state hover`). Una differenza costante di y su tutti gli elementi indica un elemento a monte (padding di `main`, header, `id` duplicato).
7. **Comportamenti** con Alpine in `resources/js/theme/*.js` (registrati in `app.js`), verificati con `--click`.
8. **Sentinelle** prima/dopo (indice test, argomenti, home reale `/it`).
9. **Chiudere**: story con l'output del gate; memoria e wiki aggiornate; `bash bashscripts/docs/llm-wiki-qmd.sh update`.

Cause degli errori del 2026-10-13 e guardrail: `docs/bmad/decisions/2026-10-13-parity-root-cause-and-guardrails.md`.
Stato e prossimi passi: `docs/bmad/stories/2026-10-13-dcp-00-epic-design-comuni-parity-v2.story.md`.

10. **Chrome**: header, footer e modale sono sezioni JSON con `tpl="design-comuni"` (`layouts/design-comuni`, solo pagine `pages/tests/*`); `layouts/test` e' condiviso col front office reale e non si tocca. Comportamenti con Alpine montato per selettore (`mountDesignComuniComponents`) e controller del tema (`header-mobile-nav.js`, modali in `app.js`), attivi solo se c'e' `.page-content[data-slug*="tests."]`.
11. **Prima di cambiare un layout**: `grep` di chi lo usa e una sentinella per ciascun utente.
12. **Pagina nuova** (verificato su `appuntamento-02-data-orario`, estratta a caso): baseline con `parity-gate.sh`; JSON `tests.<slug>.json` (tenant e modulo); blocco `blocks/<famiglia>/design-comuni.blade.php` con le sezioni scelte per `type`; aggiungere la pagina e i suoi stati a `scripts/regenerate-design-comuni-css.sh` e rigenerare; comportamenti Alpine montati per selettore (`mountDesignComuniComponents`) cosi' il markup resta identico; poi gate, sentinelle (`/it` identica, `/it/tickets` invariata) e `php artisan view:clear` se compaiono `|---LINE:n---|`.
13. **Cache viste inquinata**: un qualunque 500 fa ricompilare le viste con marcatori `|---LINE:n---|` (exception renderer di Laravel, `BladeMapper`) che restano nella cache. Sintomo: testo strano nell'HTML, pagine che perdono lo stile. Rimedio: `php artisan view:clear`. Lo scope CSS usa `data-slug*="tests."` proprio per tollerarlo.
14. **Immagini del riferimento**: scaricarle da `https://italia.github.io/design-comuni-pagine-statiche/assets/images/` in `public/design-comuni/assets/images/` (non duplicarle in `docs/Main_files`: `npm run copy` non cancella i file in `public/`). Attenzione ai file da 0 byte.
15. **Altri agenti sulla stessa pagina**: prima di creare `tests.<slug>.json` controllare che non esista un altro file con lo stesso `slug` (es. `<slug>.json`): due record = 500 per tutti. Il nome canonico e' `tests.<slug>.json`.
16. **Comportamenti**: misurare dopo il clic con `--selector body --click ...` (pagina intera), non con un ritaglio: per 0,016 px di arrotondamento il ritaglio puo' avere 1 px di larghezza in piu' e dare una parity bassa su testo fitto. I menu a tendina e le modali del riferimento (Popper, backdrop) si riproducono in `app.js` solo nelle pagine /tests.
17. **Estrazione dei dati dal riferimento**: lavorare sul markup con `>\s+<` -> `><` e spazi collassati, un blocco per sezione (`<article id=...>`), e controllare i conteggi (`costi 4, cards 3, ...`) contro la pagina.
18. **Piu' pagine in parallelo**: ricetta `docs/prompts/design-comuni-page-recipe.md`; ogni agente scrive solo JSON, blocchi e story propri e righe in coda ai manifest; l'orchestratore rigenera il CSS (`regenerate-design-comuni-css.sh`, lock) e ricompila, poi `parity-sweep.sh` misura tutto. Mai una build durante un gate. Sorgenti condivise (JS, partial) le modifica solo l'orchestratore, raccogliendo le richieste degli agenti.
