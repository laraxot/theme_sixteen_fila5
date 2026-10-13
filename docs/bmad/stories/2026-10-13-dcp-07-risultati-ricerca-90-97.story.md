---
id: dcp-07
title: "DCP-07: risultati-ricerca a 90% HTML e 97% visual"
type: story
epic: dc-parity-v2
status: todo
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-07: risultati-ricerca a 90% html e 97% visual bmad story"
---

# DCP-07: risultati-ricerca a 90% HTML e 97% visual

## Richiesta
`http://192.168.1.40:8000/it/tests/risultati-ricerca` con HTML parity >= 90% e visual >= 97% rispetto a `https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html`.

## Baseline 2026-10-13
HTML 13,2% (2214 token riferimento, 580 locali); visual 34,0% / 26,4% / 24,3%; altezze 4084/2309 (1440), 5247/2975 (375). Era HTTP 500 per due JSON con lo stesso
slug (`risultati-ricerca.json` e `tests.risultati-ricerca.json`): unificati sul nome canonico, ora 200. Il riferimento ha 157 classi nel `<main>` (67 KB).

## Metodo (lo stesso della homepage, in questo ordine)
1. Leggere i contratti (DCP-02). Non creare file Folio ne' layout.
2. Struttura del riferimento in un file di lavoro, modello dati JSON in `tests.risultati-ricerca.json` (query, filtri, risultati, paginazione, testi), blocco `search-results/default.blade.php` riscritto da JSON.
3. Stili: `extract-used-css.mjs ... --within main --scope .dc-search`, import in `app.css`, stati con `--state` per filtri e menu.
4. Interazioni con Alpine (filtri, paginazione se presenti), verificate con `--click`.
5. Dipende da DCP-03, DCP-05, DCP-06 per il 90% sul body intero.

## Criteri di accettazione
- Output del gate (DCP-01) incollato qui: HTML >= 90, visual >= 97 a 375/768/1440, sentinelle invariate.

## Verifica
```bash
R=https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html
L=http://192.168.1.40:8000/it/tests/risultati-ricerca
node bashscripts/tools/visual/compare-body-html.mjs $R $L            # atteso >= 90
for w in 375 768 1440; do
  node bashscripts/tools/visual/compare-screenshots.mjs $R $L --width $w --stub-images 'picsum\.photos'   # atteso >= 97
done
```
