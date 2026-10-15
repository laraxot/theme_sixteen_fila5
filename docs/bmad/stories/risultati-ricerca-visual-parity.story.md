---
id: risultati-ricerca-visual-parity-97
title: Ricerca Risultati Visual Parity 97% Target
type: story
status: ready-for-dev
links:
  github_issue: #999
  discussion: #999
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "ricerca risultati visual parity 97% target sixteen"
---
# Ricerca Risultati Visual Parity 97% Target

## Objective
Achieve at least 97% visual parity with the Design Comuni reference ricerca risultati page (https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html) for the Sixteen theme.

## Acceptance Criteria
1. Body HTML similarity is at least 90%, excluding scripts, measured by
   `bashscripts/tools/visual/compare-body-html.mjs`.
2. Full-page visual parity is at least 97% at 375, 768 and 1440 CSS px; the
   report includes raw and controlled image metrics and screenshots.
3. The page contains the reference regions in the same order: breadcrumb,
   search form, filter taxonomy, result counter, ten result cards, load-more,
   rating, contacts and the shared footer.
4. All visible content is JSON-driven and the page remains served through
   `pages/tests/[slug].blade.php`; no page-specific Folio Blade is created.
5. WCAG 2.1 AA checks pass for labels, keyboard focus, contrast, accessible
   names, reduced motion and no horizontal overflow; no Bootstrap runtime is
   added.

## Verified gap baseline — 2026-10-13

- Reference body: 56,518 bytes / 2,214 tokens.
- Local body: 29,407 bytes / 539 tokens.
- Body similarity: **12.87%**.
- Visual similarity at 1440: **24.02%**; heights 4,084 / 1,865 px.
- The local block rendered only a heading, subtitle and two generic cards.
- The reference additionally renders search input/button, breadcrumb, filters,
  ten civic result cards, load-more, rating workflow, contacts and the complete
  Design Comuni content rhythm.
- Local translations rendered raw keys (`fixcity::search.results.*`), which is
  both a content defect and a parity defect.

These measurements supersede earlier unverified parity claims.

## References
- Reference ricerca risultati: https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html
- Local ricerca risultati: http://192.168.1.40:8000/it/tests/risultati-ricerca
- JSON data: laravel/config/local/fixcity/database/content/pages/risultati-ricerca.json
- Blade template: laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php (Volt component)
- Blocks: laravel/Themes/Sixteen/resources/views/components/blocks/ and sections/
- Header/footer: laravel/config/local/fixcity/database/content/sections/header.json and footer.json

## Implementation Plan
Child stories own the implementation in this order:

1. `DC-027.1` — reference evidence and block contract.
2. `DC-027.2` — JSON taxonomy/results/rating/contact data.
3. `DC-027.3` — body markup and Tailwind visual composition.
4. `DC-027.4` — Alpine interactions and WCAG states.
5. `DC-027.5` — automated parity and release evidence.

## Dependency Map

- Blocked by: none for the reference audit; implementation stories depend on
  `DC-027.1`.
- Blocks: `DC-027.2`, `DC-027.3`, `DC-027.4`, `DC-027.5`.

## Owned File/Module Scope

This umbrella story owns only this story and the parity decision record; child
stories own implementation files to avoid parallel conflicts.

- `laravel/Themes/Sixteen/docs/bmad/stories/risultati-ricerca-visual-parity.story.md`
- `laravel/Themes/Sixteen/docs/bmad/decision-log.md`

## Learnings from Previous Stories

- A single screenshot or a 100% controlled image score is not sufficient:
  body structure and raw image metrics must be reported separately.
- `pub_theme` is already Sixteen/Design Comuni; no second Design Comuni view
  namespace may be introduced.
- Search pages must use the same generic `[slug]` route as every test page.

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
