---
title: "Accessibility strategy — WCAG 2.1 AA and Mauve"
type: accessibility-plan
status: draft
tags: [wcag-21-aa, wcag-22, mauve, axe, keyboard, design-comuni]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "baseline sixteen"
---

# Baseline

WCAG 2.1 AA is the contractual baseline, checked against the official WCAG 2.1
success criteria and MAUVE++ supported criteria/techniques. WCAG 2.2 AA checks are
additional hardening where they do not conflict with the project baseline.

The official Italian web-service guidance treats accessibility, reliability,
security, simplicity of consultation, monitoring and UI as first-class requirements;
they are release gates here, not a final visual polish step.

# Tooling

- CFLW-AI `wcag-audit` skill for source review and contrast extraction;
- MAUVE++ (`mauve.isti.cnr.it`) for an independent validator pass;
- axe/Playwright for repeatable route checks;
- keyboard-only and reduced-motion manual journeys;
- contrast checks for normal text (4.5:1), large text (3:1), UI/graphics (3:1).

Reference: [MAUVE supported WCAG 2.1 criteria](https://mauve.isti.cnr.it/supported_wcag21.jsp).

# Gate matrix

| Area | Evidence |
|---|---|
| Perceivable | semantic headings, labels, alt text, contrast table |
| Operable | keyboard journey, focus-visible, focus not obscured, target sizes |
| Understandable | consistent shell, errors with recovery, language metadata |
| Robust | landmarks, valid ARIA, custom Lit elements, no-JS essentials |
| Flow | privacy → data → summary → confirmation with state retention |

# Audit output

Each vertical slice must attach a route matrix, contrast results, axe/Playwright
output and MAUVE result. Do not call a page compliant from a screenshot alone.
