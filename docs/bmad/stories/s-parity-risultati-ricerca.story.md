---
title: "STORY-PARITY-RISULTATI-RICERCA — Parity visuale e funzionale"
type: story
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story-parity-risultati-ricerca   parity visuale e funzionale sixteen"
---
# STORY-PARITY-RISULTATI-RICERCA — Parity visuale e funzionale

## URL
- Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html`
- Locale: `http://192.168.1.40:8000/it/tests/risultati-ricerca`

## Problemi rilevati
- Mancata parità HTML del body rispetto alla reference (struttura, filtri, risultati).
- Mancata parità visuale (spaziature, font, icone, filtri).
- Filtri non conformi a Design Comuni.

## Azioni
1. Analizzare il JSON tenant e il componente Blade corrispondente (`search-results.default`).
2. Allineare la struttura HTML del body e i componenti Tailwind/DaisyUI.
3. Verificare i filtri e l'accessibilità conforme design-comuni.

## Acceptance Criteria
- Parità HTML > 90%, visual >= 97%.
- Filtri, risultati e ricerca accessibili e conformi.
