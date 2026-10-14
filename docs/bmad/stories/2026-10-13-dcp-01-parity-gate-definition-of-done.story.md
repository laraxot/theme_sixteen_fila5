---
id: dcp-01
title: "DCP-01: gate di parity e definizione di fatto"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-01: gate di parity e definizione di fatto bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-01: gate di parity e definizione di fatto

## Contesto
Il documento `docs/prompts/homepage/index.md` dichiarava 99,6% di HTML parity senza che nessun comando lo producesse; il valore
misurato il 2026-10-13 era 26,9%. Senza un gate eseguibile ogni sessione ha dichiarato "fatto" su impressioni.

## Gia' fatto (nel repo)
- `bashscripts/tools/visual/compare-body-html.mjs` (confronto token del body, script esclusi; ora decodifica le entita').
- `bashscripts/tools/visual/compare-screenshots.mjs` (pixel, stesso browser; `--stub-images`, `--selector`, `--click`, `--threshold`).
- `bashscripts/tools/visual/extract-used-css.mjs` (piu' pagine, `--within`, `--scope`), `explain-style.mjs` (`--state hover`), `compare-computed.mjs` (stili calcolati a confronto, `--hover`), `find-important-overrides.mjs` (regole esterne con `!important` in uno scope).
- `laravel/Themes/Sixteen/scripts/homepage-parity-defects.sh`: 14 difetti + comportamenti, parity per elemento.

## Fatto (2026-10-13 sera)
`bashscripts/tools/visual/parity-gate.sh <rif> <loc> [--stub-images re] [--widths ..] [--fail-if-contains testo]`: HTML rigoroso + URL normalizzati + pixel a 5 larghezze con le altezze accanto, exit 1 sotto 90 (HTML rigoroso) o 97 (pixel). `compare-body-html.mjs` stampa ora entrambe le misure.

## Da fare (storico)
1. Wrapper `bashscripts/tools/visual/parity-gate.sh <ref-url> <local-url>`: esegue HTML + visual a 375/768/1440, stampa tabella PASS/FAIL, salva JSON in `bmad-output/parity/<slug>/`, exit 1 sotto soglia.
2. Sweep di regressione: elenco di pagine "sentinella" (indice, argomenti, `/it`) con baseline salvata e confronto prima/dopo.
3. Regola nel template di story: "fatto" richiede l'output del gate incollato nella story.

## Criteri di accettazione
- Un solo comando produce il verdetto per una pagina; exit code non zero se HTML < 90 o visual < 97 a uno dei viewport.
- Il valore "raw" (immagini reali) e il valore "controllato" (`--stub-images`) sono entrambi riportati.
- La baseline delle pagine sentinella e' versionata in `bmad-output/parity/`.

## Verifica
```bash
R=https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
L=http://192.168.1.40:8000/it/tests/homepage
node bashscripts/tools/visual/compare-body-html.mjs $R $L            # atteso >= 90
for w in 375 768 1440; do
  node bashscripts/tools/visual/compare-screenshots.mjs $R $L --width $w --stub-images 'picsum\.photos'   # atteso >= 97
done
```
