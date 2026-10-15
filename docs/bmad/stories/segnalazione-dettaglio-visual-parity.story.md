---
id: segnalazione-dettaglio-visual-parity-97
title: Segnalazione Dettaglio Visual Parity 97% Target
type: story
status: draft
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "segnalazione dettaglio   visual parity 97% sixteen"
---
# Segnalazione Dettaglio — Visual Parity 97%
## Objective
Achieve at least 97% visual parity with Design Comuni reference (https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-dettaglio.html).

## Acceptance Criteria
- HTML/body similarity ≥90% (body only, excluding scripts)
- Visual parity ≥98% (pixel+DOM comparison)
- WCAG 2.1 AA: zero errors, contrast ≥4.5:1 body, ≥3:1 UI
- Zero overflow, zero missing images, zero console errors
- Form wizard steps: privacy, dati, riepilogo, conferma navigabili

## References
- Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-dettaglio.html
- Local: http://192.168.1.40:8000/it/tests/segnalazione-dettaglio
- JSON: tests.segnalazione-dettaglio.json
- Stack: Tailwind+Alpine+Lit+DaisyUI+Flowbite (NO Bootstrap Italia)

## Tasks
- [ ] Verify JSON contains all form wizard steps and field data
- [ ] Match reference structure: breadcrumb, heading, stepper, form sections, nav steps, contact card
- [ ] Apply correct tokens: primary #007a52, dark #006b4f, text #17324d, etc.
- [ ] Ensure interactive states on all form controls
- [ ] Verify responsive at 375/768/1440px
- [ ] Playwright screenshots + pixel comparison + WCAG audit