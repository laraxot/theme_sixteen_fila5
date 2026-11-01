---
id: dcp-04
title: "DCP-04: blocco homepage (main) a 97%"
type: story
epic: dc-parity-v2
status: done-main
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-04: blocco homepage (main) a 97% bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-04: blocco homepage (main) a 97%

## Fatto
- `components/blocks/homepage.blade.php` rigenerato: struttura del riferimento, ogni testo/link/immagine da JSON (`tests.homepage.json`, tenant e modulo), classi `@class` pulite. HTML parity del solo `<main>`: 93,2%.
- JSON canonico unico (rimossi i due `homepage.json` non canonici che causavano `CMS content collision`).
- Stili generati in `resources/css/design-comuni/` (fonts, isolation `all: revert`, homepage, overrides), importati in `app.css`; font self-hosted.
- Alpine `dcCalendar` (Splide, opzioni misurate dal riferimento) e `dcRating` in `resources/js/theme/design-comuni-home.js`.

## Risultato (2026-10-13, misurato)
`<main>` a 99,9% / 99,85% / 99,7% a 1440 / 768 / 375 px, altezze identiche; ogni sezione (`#head-section`, `.evidence-section`, `.useful-links-section`, `#rating`, `.bg-grey-card`) >= 99%. Pagina intera 93,5% (era 35,4%): il resto e' header/footer (DCP-05/06).
Il calendario dipendeva da una regola di classe: l'ultima voce di una giornata con piu' di 3 eventi non ha `pb-10 mb-10`.

## Resta
1. (superato) Chiudere DCP-03 (senza non si supera 52%).
2. Rigenerare `homepage.css` quando il markup cambia (comando in `bashscripts/docs/visual-comparison/extract-used-css.md`).
3. Verificare i comportamenti: menu, modale, dropdown lingua, rating positivo/negativo con `homepage-parity-defects.sh`.
4. Percorsi asset: `asset()` produce URL assoluti (token diversi da `../assets/...`): accettato, circa 2% dei token.

## Criteri di accettazione
- Per ogni sezione del `<main>` (`#head-section`, `#calendario`, `.evidence-section`, `.useful-links-section`, `#rating`, `.bg-grey-card`) parity >= 97% a 375/768/1440.
- 14 difetti dell'audit e comportamenti verificati dal runner.

## Verifica
```bash
bash laravel/Themes/Sixteen/scripts/homepage-parity-defects.sh
```
