---
title: "STORY-REF-HOMEPAGE-BLOCKS-FIX — Correzione parità blocchi e contenuti homepage"
type: story
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story-ref-homepage-blocks-fix   correzione parità blocchi e contenuti homepage sixteen"
---
# STORY-REF-HOMEPAGE-BLOCKS-FIX — Correzione parità blocchi e contenuti homepage

## URL
- Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`
- Locale: `http://192.168.1.40:8000/it/tests/homepage`

## Problemi rilevati
- Notizia in evidenza: manca "Notizie 18 mag 2022", titolo errato (font/colore), manca badge "Estate in città".
- Organi di governo: manca immagine e tasto "vai alla pagina".
- Calendario eventi: struttura errata.
- Argomenti in evidenza: manca sfondo geometrico, margini e padding errati.
- Siti tematici: colori e immagini non conformi.
- Sezione cerca parola chiave: manca lente di ingrandimento e tasto invia.
- Rating: comportamento errato.
- Contatta il comune: spaziature errate.

## Azioni
1. Aggiornare `laravel/config/local/fixcity/database/content/pages/tests.homepage.json` con dati e badge corretti.
2. Migliorare i componenti Blade corrispondenti in `laravel/Themes/Sixteen/resources/views/components/blocks/`.
3. Verificare i token di colore e tipografia (Titillium Web, Lora, sfondi geometrici, padding).

## Acceptance Criteria
- Notizie, badge, organi di governo, eventi e argomenti identici alla reference.
- Spaziature e rating allineati alle specifiche Design Comuni.
- Visual parity > 98%.
