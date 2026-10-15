---
title: "Responsive tracking search form"
type: ux-comparison-and-correction-plan
status: verified
owner: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, ui-ux, tracking, responsive, accessibility]
qmd: "tracking ticket code search form responsive mobile full width button"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../../../Modules/Fixcity/docs/bmad/stories/STORY-508-confirmation-tracking-fo.md
  - ../../../../Modules/Fixcity/docs/wiki/concepts/comuni-design-system-guidance.md
---

# Tracking search form — expected, observed and correction

## Expected experience

- The tracking-code field remains the main input and can show the complete code
  without competing with its submit action on narrow screens.
- At mobile widths (up to 575 px), the field and submit button are full width,
  vertically separated, and each offers a clear focus target.
- At tablet/desktop widths, the field and button share one horizontal row.
- The label, native required validation, error state and help association remain
  intact. No breakpoint introduces horizontal scrolling.

## Observed baseline

Playwright at 320 px measured a 240 px inner form row. The field occupied 154 px
and the submit button 86 px. Their boxes did not geometrically overlap, but the
short field made a 19-character ticket code unnecessarily difficult to review
and created a cramped underline-to-button join. The page still returned 200 and
had no horizontal overflow; those checks alone did not catch this usability gap.

## Correction plan

Add an explicit tracking-form hook in the owner page and a Sixteen mobile rule:
stack the controls below 576 px, give both full row width, and retain the inline
input-group layout from 576 px upward. Verify rendered bounding boxes in Chromium
for 320/390/575/576/768/1440 px, including all supported locales; confirm required
validation, label/help links and zero JavaScript errors.

The change belongs to the theme presentation layer. The Folio page remains owned
by Fixcity and continues to own the localized form semantics.

## Implemented and verified

The Folio form and input group now expose explicit styling hooks. Sixteen stacks
the field and full-width button below 576 px, with an 8 px gap; tablet and desktop
retain the horizontal row. Playwright passed one browser test covering 24
combinations (4 locales × 6 widths: 320, 390, 575, 576, 768 and 1440 px), checking
HTTP 200, responsive geometry, required input, label/help association, keyboard
focus order, page overflow and JavaScript errors. At 320 px the field and button
each measure 240 px; at widths from 576 px they remain on one row. Screenshot:
`/tmp/fixcity-tracking-mobile-it-fixed.png`. Vite production build passes; its
existing unresolved `/themes/Sixteen/images/logo.svg` warning remains separate.
