---
id: dcp-07
title: "DCP-07: risultati-ricerca a 90% HTML e 97% visual"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-07: risultati-ricerca a 90% html e 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-07: risultati-ricerca a 90% HTML e 97% visual

## Richiesta
`http://192.168.1.40:8000/it/tests/risultati-ricerca` con HTML parity >= 90% e visual >= 97% rispetto a `https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html`.

## Baseline 2026-10-13
HTML 13,2% (2214 token riferimento, 580 locali); visual 34,0% / 26,4% / 24,3%; altezze 4084/2309 (1440), 5247/2975 (375). Era HTTP 500 per due JSON con lo stesso
slug (`risultati-ricerca.json` e `tests.risultati-ricerca.json`): unificati sul nome canonico, ora 200. Il riferimento ha 157 classi nel `<main>` (67 KB).

## RISULTATO FINALE (2026-10-13 sera, misurato con il gate)
`risultati-ricerca`: **HTML body 92%** (>= 90), **visual 99,92 / 99,9 / 99,88 / 99,84 / 99,76%** a 1920 / 1440 / 992 / 768 / 375 px (>= 97), altezze identiche a ogni larghezza (4084 a 1440, 5247 a 375). Comportamenti con i pixel dopo il clic: filtro 99,7%, modale di ricerca 99,9%, menu mobile 99,72%, rating 99,8-100%. Pagina servita da `pages/tests/[slug]` -> `layouts/design-comuni` -> `<x-page>` -> blocco `search-results/design-comuni` -> JSON, `<body>` plain.
Cio' che ha portato l'HTML da 13% a 92%: dati completi nel JSON, chrome Design Comuni (header/footer/modale), modale `modal-disservizio` del riferimento da JSON (`report_modal`), id come nel riferimento, nessun wrapper o attributo inventato (Alpine montato per selettore, `x-data` non nel markup).
Limite noto: i valori degli URL (`href`, `src`, percorsi sprite assoluti contro `../assets/`) pesano circa 6% dei token; con URL normalizzati la similarity e' ~96%.

## Avanzamento (2026-10-13 sera, misurato)
- Blocco `blocks/search-results/design-comuni.blade.php` da JSON (`tests.risultati-ricerca.json`: breadcrumb, ricerca, 7 tipologie + 62 argomenti, 10 risultati, rating e contatti condivisi con la homepage tramite partial `blocks/partials/dc-rating` e `dc-contacts`). Il vecchio `default.blade.php` non e' piu' usato (la selezione e' la chiave `view` del JSON); non cancellato.
- `<main>` 99,86% / 99,83% (992) / 99,76% (768) / 99,58% (375); comportamenti verificati con i pixel (filtro, "Cerca", rating) 99,5-99,9%.
- Pagina intera 93,0% a 1440 (4084/4252 px); HTML body 65,0%. Restano header (92%), footer (78%) e modale: DCP-05/06.
- Segnalazione dell'utente sul pulsante "Cerca" (bianco su bianco, verde solo in hover): causa nelle toppe `!important` a mano di un altro agente e nella regola legacy `p, span, body { color: #1a1a1a !important }`; ora lo stile arriva dal CSS generato e in hover scurisce come il riferimento (`#006342`).
- Il riferimento non apre nulla con "Filtra" (la modale `#modal-categories` non esiste nella pagina statica) e i filtri cambiano solo lo stato del checkbox: nessun JS da replicare oltre al rating.

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
