---
name: "DCP-154 Disclaimer Page WCAG Audit"
title: "Disclaimer Page — WCAG 2.1 AA Compliance Audit"
description: "Verify disclaimer.blade.php for WCAG 2.1 AA compliance and Design Italia guidelines."
status: "ready-for-dev"
module: "Sixteen"
epic: "Front Office Redesign"
created: "2026-10-14"
updated: "2026-10-14"
github:
  repository: "https://github.com/your-org/your-repo"
  issue: "https://github.com/your-org/your-repo/issues/XXX"
  discussion: "https://github.com/your-org/your-repo/discussions/XXX"
links:
  github_issue: "https://github.com/your-org/your-repo/issues/XXX"
type: story
tags: [docs, sixteen, bmad]
qmd: "dcp 154 disclaimer wcag audit.story sixteen"
---

## Obiettivo
Verificare che la pagina disclaimer soddisfi WCAG 2.1 AA e le Linee Guida Design Italia.

## Checklist da eseguire
- [ ] Contrasto APCA Lc ≥75 per body, ≥45 per heading (large-bold)
- [ ] Struttura semantica: `<article>` → `<section>` → `<header>` → `<footer>`
- [ ] Heading hierarchy corretta (h1 → h2 → h3)
- [ ] Link a contatti PA (PEC, PIV, telefono) verificabili
- [ ] Mobile-responsive: max-width 42rem su tablet
- [ ] Focus visibile su tutti gli elementi interattivi
- [ ] `prefers-reduced-motion` rispettato

## Files coinvolti
- `resources/views/disclaimer.blade.php`
- `resources/views/terms.blade.php`
- `resources/css/app.css` (potrebbero servire override)

## Documentazione relazionata
- `DESIGN.md` (repo root)
- `design-italia-guidelines-integration.story.md`
- `second-brain-disclaimer-integration.md`

## Acceptance Criteria
- [ ] `ux_audit` passa su disclaimer
- [ ] Playwright screenshot (320/768/1440) senza overflow
- [ ] Mobile test passa su Focus-visible
- [ ] Contatti PA configurabili via `.env`