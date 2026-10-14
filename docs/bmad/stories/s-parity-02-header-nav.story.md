---
title: "STORY-REF-HEADER-NAV-FIX — Correzione parità header e navigazione homepage"
type: story
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story-ref-header-nav-fix   correzione parità header e navigazione homepage sixteen"
---
# STORY-REF-HEADER-NAV-FIX — Correzione parità header e navigazione homepage

## URL
- Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`
- Locale: `http://192.168.1.40:8000/it/tests/homepage`

## Problemi rilevati
- Header "Seguici su": icone sociali mostrano codice/lettere anziché SVG, colore nero anziché bianco.
- Search box: lente di ingrandimento disallineata dal box "cerca", manca lo spazio per la scritta "cerca".
- Navigazione: hamburger menu invisibile/errato; links sottolineati (non conforme Design Comuni).

## Azioni
1. Analizzare `laravel/Themes/Sixteen/resources/views/components/sections/header/v1.blade.php`.
2. Correggerre il rendering delle icone social (usare SVG correttamente).
3. Migliorare il layout del search box (Flexbox, padding, allineamento lente).
4. Rimuovere le sottolineature e configurare correttamente l'hamburger menu.

## Acceptance Criteria
- Header e icone SVG conformi e visibili (bianchi su sfondo scuro).
- Search box allineato con etichetta "Cerca".
- Hamburger menu visibile e funzionante.
- Zero link con sottolineatura errata.
- Visual parity > 98%.
