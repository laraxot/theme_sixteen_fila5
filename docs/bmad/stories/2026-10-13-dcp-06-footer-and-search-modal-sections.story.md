---
id: dcp-06
title: "DCP-06: footer e modale di ricerca con markup Design Comuni"
type: story
epic: dc-parity-v2
status: done
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-06: footer e modale di ricerca con markup design comuni bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-06: footer e modale di ricerca con markup Design Comuni

## Contesto
Footer: 357 token nel riferimento, similarity locale 34,5%. La modale `#search-modal` e' inclusa dal layout (`sections/search-modal`).
Insieme a header (DCP-05) pesano circa 43% dei token del body: sono la condizione per il 90% di HTML parity su qualsiasi pagina.

## Risultato (2026-10-13 sera, misurato)
Footer **100% a 1440, 992 e 375 px** (776 / 824 / 1780 px, identici); modale `sections/search-modal/design-comuni.blade.php` da `sections/search-modal.json` (nuova sezione, tenant e modulo), aperta con `[data-bs-target="#search-modal"]`: 99,9% a 1440. `app.js` gestisce le modali `.modal.fade` come il riferimento (display block, `aria-modal`, backdrop, `modal-open` sul body) **solo nelle pagine /tests** (ci sono modali BI anche nei blocchi ticket del front office).

## Da fare (storico)
1. `footer.json` (it/en) esteso: logo UE, colonne, contatti, social, link legali, copyright. Template `sections/footer/full.blade.php` che emette il markup del riferimento.
2. Modale di ricerca guidata da JSON, aperta da Alpine (stato `show`, backdrop, blocco scroll, ESC) come in `docs/bmad/stories`.
3. Stili generati con scope dedicato.

## Criteri di accettazione
- Token parity `<footer>` >= 90%; pixel parity `footer` >= 97%; modale aperta (`--click '[data-bs-target="#search-modal"]'`) >= 97%.

## Verifica
```bash
node bashscripts/tools/visual/compare-screenshots.mjs https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html http://192.168.1.40:8000/it/tests/homepage --width 1440 --selector footer
```
