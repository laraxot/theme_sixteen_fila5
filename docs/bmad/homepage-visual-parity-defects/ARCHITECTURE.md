---
id: homepage-visual-parity-defects-arch
title: Homepage Visual Defect Architecture
document_type: architecture
category: visual-parity
status: in-progress
source_of_truth: true
scope: [laravel/Themes/Sixteen/docs/prompts/02.md, homepage blade, header/footer JSON]
related:
  - ../../visual-parity-improvement-plan.md
  - ../../visual-parity-verified.md
type: note
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "architecture sixteen"
---

Reason for failure (per user audit): header icons (SVG missing, black not white), all links underlined, hero font/color wrong, badges missing, calendar wrong, featured topics missing geometric bg + padding, thematic sites missing bg + images, search missing icon/button, rating wrong, contact spacing wrong.

Fix architecture: per-section BMAD docs (brainstorming + stories + architecture) for each defect; component-level fixes in pub_theme/components/blocks/; JSON content updates; verification via Playwright screenshot comparison.

Prevention: enforce token-only colors, named elevation, full states, no underlines by default, reference-first comparison before declaring done.
