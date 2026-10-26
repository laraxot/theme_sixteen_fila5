---
title: "Fixcity Header - Logo Bianco"
status: active
updated: "2026-10-20"
tags: [header, logo, wcag, bmad, design-comuni]
qmd: "fixcity header logo bianco"
type: note
---

# BMAD Plan — Logo Bianco nell'Header

## Scopo
Il logo dell'header di Fixcity appare nero su sfondo verde scuro (#004d3a/#007a52) → contrasto insufficiente (WCAG 2.1 AA). Il logo deve diventare bianco per coerenza con Design Comuni.

## Decisioni (Second Brain)
- **D1**: Usare filtro CSS invertito `filter: brightness(0) invert(1)` su SVG logo — eternabile, riusabile, non eritate dal sorgato JSON logo.
- **D2**: Aggiungere classi bersatti al CSS esistente (`components/header-footer-colors.css`), non creare classi nu
s/.
- **D3**: JSON `header.json` brand: nome fixcity, tagline, logo assets/fixcity/svg/logo.svg (colore dipendente da dove è segినся finestra/sotto regime colore).

## Storie

### Story 1 — CSS classi targeting
- **Azione**: Aggiungere `.design-comuni-header .it-brand-wrapper > a > svg { filter: brightness(0) invert(1) !important; }` a `components/header-footer-colors.css`.
- **Acceptance**: Logo bianco su ogni header design-comuni (desktop + mobile).

### Story 2 — JSON coerente
- **Azione**: `header.json` `brand` = name=FixCity, logo assets/fixcity/svg/logo.svg.
- **Acceptance**: Nessun JSON vuota; brand coerente con homepage.

## Gate
- [ ] CSS aggiunto e build passa.
- [ ] Logobianco su ogni viewport 375/768/1440.
- [ ] Contrasto WCAG AA per logo e testo header.

## Riferimenti
- Design Comuni header: https://italia.github.io/design-comuni-pagine-statiche/servizi/header.html
- CSS Color Palette: Vite `config.assets.*.fonts`
