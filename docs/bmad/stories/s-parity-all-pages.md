---
title: "BMAD Story — s-parity-all-pages (complete)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad story   s-parity-all-pages (complete) sixteen"
---
# BMAD Story — s-parity-all-pages (complete)

- Type: epic-story
- Title: "Visual parity — ALL /it/tests/* pages vs Design Comuni (complete mapping)"
- Status: IN_PROGRESS — 14 pages captured; screenshot pixel-diff analysis in progress; CSS fixes pending
- Required parity: HTML ≥90% / visual ≥95%
- Stack: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap)
- Reference: https://italia.github.io/design-comuni-pagine-statiche/

## Complete page mapping (all 14 mapped pages)

| # | Tests slug | Local URL | Reference file | BMAD story | Status |
|---|---|---|---|---|---|
| 1 | tests.index | /it/tests/ | / | s-parity-visual.md | ✅ screenshot captured |
| 2 | homepage | /it/tests/homepage | /sito/homepage.html | s-parity-visual.md | ✅ screenshot captured |
| 3 | segnalazione-dettaglio | /it/tests/segnalazione-dettaglio | /sito/segnalazione-dettaglio.html | s-parity-visual.md | ✅ screenshot captured |
| 4 | segnalazioni-elenco | /it/tests/segnalazioni-elenco | /sito/segnalazioni-elenco.html | (story pending) | ✅ screenshot captured |
| 5 | segnalazione-area-personale | /it/tests/segnalazione-area-personale | /sito/segnalazione-area-personale.html | (story pending) | ✅ screenshot captured |
| 6 | segnalazione-01-privacy | /it/tests/segnalazione-01-privacy | /sito/segnalazione-01-privacy.html | (story pending) | ✅ screenshot captured |
| 7 | segnalazione-02-dati | /it/tests/segnalazione-02-dati | /sito/segnalazione-02-dati.html | (story pending) | ✅ screenshot captured |
| 8 | segnalazione-03-riepilogo | /it/tests/segnalazione-03-riepilogo | /sito/segnalazione-03-riepilogo.html | (story pending) | ✅ screenshot captured |
| 9 | segnalazione-04-conferma | /it/tests/segnalazione-04-conferma | /sito/segnalazione-04-conferma.html | (story pending) | ✅ screenshot captured |
| 10 | amministrazione | /it/tests/amministrazione | /sito/amministrazione.html | (story pending) | ✅ screenshot captured |
| 11 | domande-frequenti | /it/tests/domande-frequenti | /sito/domande-frequenti.html | (story pending) | ✅ screenshot captured |
| 12 | risultati-ricerca | /it/tests/risultati-ricerca | /sito/risultati-ricerca.html | (story pending) | ✅ screenshot captured |
| 13 | argomenti | /it/tests/argomenti | /sito/argomenti.html | (story pending) | ✅ screenshot captured |
| 14 | catalog | /it/tests/catalog | /sito/ (map) | s-parity-catalog (laterale) | ✅ screenshot captured |

## Current state (as of capture)
- 14 page screenshot pairs captured (local vs reference), all at 1280×800
- Pixel-diff analysis in progress (preliminary: homepage 48.3%, domande-frequenti 75.6%, amministrazione 32.1%, risultati-ricerca 50.3%)

## Remaining actions
1. Generate individual BMAD story for each page (4 stories: segnalazioni-elenco, segnalazione-area-personale, segnalazione-01-privacy, segnalazione-02-dati, segnalazione-03-riepilogo, segnalazione-04-conferma, amministrazione, domande-frequenti, risultati-ricerca, argomenti)
2. Apply CSS fixes:
   - Complete header fix (nav icons, language switcher, Accedi button, skiplinks)
   - Complete footer fix (column titles white on dark bg, EU logo alignment, legal links)
   - Apply homepage-parity.css tokens (#007a52, #17334f, #24323f) consistently
3. Re-capture screenshots after fixes
4. Compare anew → iterate until visual parity ≥95% (pixel diff ≤30%)
5. Document final delta in docs/bmad/parity-status.md

## Initiatives
- kp-b4af21c7bb2a4f5d93e0cce9fc18a80c: Visual parity — all tests pages
- kp-264c30f45bc1477ca99bfbf8015e9b92: WCAG/improvement — header/footer elements
- kp-174d15a58ff94901b2b0df0d86b8907a: Header/footer design (second brain)
