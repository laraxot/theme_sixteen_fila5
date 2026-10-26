---
title: "homepage a11y and pixel verification"
type: verification
status: completed
updated: 2026-10-23
tags: [bmad, sixteen, homepage, axe, wcag, pixelmatch, vite]
qmd: "homepage axe wcag pixel verification vite chunks measured"
related:
  - ../accessibility-audit-homepage-wcag.md
  - ./homepage-guest-visual-contract.md
  - ./filament-blueprint.md
  - ./knowledge/why-home-blade-must-not-exist.md
  - ./stories/dcp-143-accessibilita-difetti-aria-e-audit-manuale-wcag-21-aa.story.md
  - ../../../../../docs/second-brain/process/civic-homepage-marketing.md
---

# Verifica misurata homepage FO (`/it`)

Eseguita 2026-10-23. Dettaglio: [accessibility-audit-homepage-wcag.md](../accessibility-audit-homepage-wcag.md).

## Axe / WCAG 2.1 AA

- Tool: `tests/browser/a11y-axe.spec.mjs` (`@axe-core/playwright`)
- Guest home `/it` `/en` + login, tickets, track, FAQ a **375 e 1440**: **0**
  violazioni serious/critical (tooling debugbar escluso)
- Dump 375/768/1440 homepage: `/tmp/fc-a11y/axe-home-it.json` — 0 violazioni

## Pixel local vs `fixcity.eu`

| Viewport | Match % | Diff % |
|----------|---------|--------|
| 1440 | 95.537 | 4.463 |
| 768 | 88.445 | 11.555 |
| 375 | 89.049 | 10.951 |

Delta intenzionale: hero locale `#head-section.fc-home-head` + mappa (studio
pages_old) vs hero charcoal `.eu`. Artefatti `/tmp/fc-pixel/`.

## Vite chunks

First-paint home ~520 KiB JS condivisi; entry `app-CF5BdshJ.js` ~15 KiB.
HEIC `vendor-image-conversion` ~1.3 MiB = lazy. Warning Vite >500 KiB resta
su lazy/orphan; `chunkSizeWarningLimit: 1400` intenzionale. Orphan `app-*.js`
~1.8 MiB da GC (`emptyOutDir: false`).

## Guardia test

`a11y-axe.spec.mjs` ora dismiss cookie + exclude `.phpdebugbar` per non
contaminare il contratto FO con UI di sviluppo.
