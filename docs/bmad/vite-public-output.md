---
title: "BMAD — Vite Public Output (No Arbitrary Files)"
type: bmad-architecture
theme: sixteen-theme-theme
status: completed
tags: [bmad, second-brain, vite, build-output, public-directory, css]
related:
  - ../docs/second-brain-vite-public-output.md
  - ./typography-comunidesign-remediation-bmad.md
updated: 2026-10-20
qmd: "bmad   `laravel/themes/sixteen/public/`   build output only sixteen"
---

# BMAD — `laravel/Themes/Sixteen/public/` — Build Output Only

## Regola (Filament Blueprint + Vite)

- `vite.config.simple.js` definisce `outDir: './public'` con `emptyOutDir: true`
- Ogni `vite build` svuota `public/` e ricrea i file da `resources/css/` e `resources/js/`
- Non si posizionano file arbitrari in `public/` — violerebbe il processo di build

## Perché non mettere file arbitrari in `public/`

1. `emptyOutDir: true` → il contenuto viene cancellato a ogni build
2. Il CSS sorgente è in `resources/css/design-comuni/` (typography.css, components.css, overrides.css)
3. I font locali (`fonts.css`) vengono gestiti da `vite.config.js` con `assetsInlineLimit`
4. I file generati (map-lit, sw.js) derivano dalla compilazione Vite, non da aggiunte manuali

## Decisioni (ADRs)

| Codice | Decisione |
|---|---|
| D1 | `public/` è build-output: nessun file manuale |
| D2 | CSS sorgente: `resources/css/design-comuni/` |
| D3 | Font locali: `resources/css/design-comuni/fonts.css` (self-hosted, no CDN) |
| D4 | Vite build produce `public/assets/app-...js`, `public/css/app.css` |

## Second Brain reference

`docs/second-brain-vite-public-output.md`
