---
id: dcp-03
title: "DCP-03: debito di cascata CSS legacy"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-03: debito di cascata css legacy bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-03: debito di cascata CSS legacy

## Evidenza (2026-10-13)
`app.css` importa decine di file `*-parity.css` aggiunti sessione dopo sessione, molti con `!important`. Per la homepage di test:
`explain-style.mjs` mostra `.card-teaser-block-3 {display:grid!important}` e `display:contents!important` su
`.card-wrapper.card-teaser-wrapper-equal`, `h1,h2,h3 {color:#191919!important}`: battono qualunque regola non-important del blocco.
File coinvolti (import in `app.css`): `homepage-visual-fix`, `homepage-parity-v2`, `homepage-mobile-qa`, `app/04-homepage-components`,
`app/05-homepage-parity-overrides`, `app/16-homepage-civic-reframe`, `homepage-tailwind-parity`, piu' `civic-design-global*`, `topics-parity`.

## Esperimento (reversibile, gia' eseguito e ripristinato)
Disattivando i 7 import specifici della homepage: homepage di test 35,4% -> 52,4%; indice e argomenti invariati (88,1% / 51,1%);
**la home reale `/it` cambia** (altezza 3460 -> 3239 px). Quindi quei file servono anche al sito vero.

## Risolto in giornata (per le pagine `.dc-page`)
- `laravel/Themes/Sixteen/postcss/isolate-legacy-important.cjs` (registrato in `postcss.config.js`, che e' il file letto: `postcss.config.cjs` e' ignorato): in build, ogni regola fuori da `.dc-page` riceve `:not(:where(.dc-page, .dc-page *))`. Nessun cambio di specificita' altrove. Peso: app.css 2,17 MB raw, 228 KB gzip.
- Verifica: `find-important-overrides.mjs <url> .dc-page` da 143 regole esterne a 0; home reale `/it` identica (0,000% pixel diversi), indice 88,1% e argomenti invariati.
- Trappola scoperta: regole a mano con `.dc-page` nel selettore (aggiunte da altri agenti) non vengono isolate e rompono lo stile generato: vietate (DCP-12).

## Voce DCP-195 (reset button unlayered, 2026-10-15)
- **Problema:** preflight Tailwind su `button`/`[type=submit]` con `appearance:button` e `background-color:#0000` restava **fuori da `@layer`**, quindi batteva le utility (`bg-sky-800`) su pagine FO come `/it/tickets/track` (pulsante «Cerca» invisibile).
- **Fix:** `postcss/layer-button-preflight.cjs`, registrato in `postcss.config.js` **prima** di `isolate-legacy-important`, avvolge quel reset in `@layer base` (stessa esclusione Design Comuni del plugin successivo).
- **Verifica:** `node postcss/layer-button-preflight.test.cjs`; CSS compilato con `@layer base{button...background-color:#0000}`; Playwright su `/it/tickets/track` (contrasto >= 4,5:1 a 375 e 1280 px). Story: [DCP-195](./dcp-195-pulsante-cerca-invisibile-e-reset-button-senza-layer.story.md).

## Resta da fare
1. Inventario: per ogni file legacy, quali pagine/classi lo usano (grep sui blade + screenshot prima/dopo).
2. Isolare i file che servono a `/it` sotto un selettore del suo blocco (`.design-comuni-homepage` o attributo su body), poi scollegarli per le pagine `/tests`.
3. Regola nuova: niente nuovi `*-parity.css`, niente `!important` nuovo; per capire una cascata si usa `explain-style.mjs`, si corregge cancellando la regola sbagliata.
4. Regola di scope: gli stili generati restano sotto `.dc-home` (`resources/css/design-comuni/`).

## Criteri di accettazione
- `explain-style.mjs` su `.evidence-section .card-teaser-wrapper display` non mostra regole legacy `!important`.
- `/it` identica a prima (0,000% pixel diversi sopra soglia 16/255) e indice/argomenti non peggiorano.

## Verifica
```bash
node bashscripts/tools/visual/explain-style.mjs http://192.168.1.40:8000/it/tests/homepage '.evidence-section .card-teaser-wrapper' display
```
