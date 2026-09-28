---
title: "Sixteen public navigation — correction plan"
type: bmad-implementation-plan
status: completed
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, design-comuni, navigation, cms, fixcity]
qmd: "Sixteen correction plan filter unpublished navigation return 404 empty CMS pages"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ./design-comuni-navigation-expected-2026-09-27.md
  - ./design-comuni-navigation-comparison-2026-09-27.md
  - ../wiki/concepts/comuni-design-system-guidance.md
---

# Correction plan

## Scope

Correct empty public destinations found in the Design Comuni navigation audit.
The tenant JSON remains the source for labels, URLs, order, enabled/visible
flags and topics URL. No controller or service layer is added, and no sample
municipal content is fabricated.

## Changes

1. Treat a menu item as displayable only when its configured flags allow it and
   its destination resolves to a Folio page or published CMS page. Keep the
   current configured entries intact for future owner-managed publication.
2. Render the topics link only when the tenant explicitly enables it and its
   page exists.
3. Make the generic Folio container page return 404 when its slug has neither a
   CMS page nor a supported utility page.
4. Keep `/services` as the sole service catalogue; old `/servizi` must no
   longer produce an empty page.
5. Extend the browser regression for all four locales: visible destinations,
   hidden unpublished items, valid service catalogue, unknown-path status,
   no console errors and responsive behavior.

## Verification

- PHP syntax and Blade view compilation.
- Existing service catalogue browser suite.
- Navigation browser check at 390 and 1440 px in `it`, `en`, `de`, `es`.
- Repository wiki quality gate and whitespace diff check.

## Completion record — 2026-09-27

- The tenant header JSON remains the source of truth. Unsupported sections are
  retained but disabled; `topics_enabled` is false until a topic page exists.
- The secondary menu now respects the topics flag.
- Generic Folio container indexes without a CMS page return 404 rather than an
  empty layout response.
- `php artisan view:cache` passed; tenant JSON parsed successfully; Node syntax
  check passed.
- Playwright: **4/4 passed**. The navigation regression covers six unpublished
  routes in all four locales; the existing catalogue coverage includes four
  viewports, search, category links and report/login navigation.
- Design Comuni utility pages: **2/2 passed** for localized FAQ/sitemap at
  supported widths and locale-preserving personal-area redirects.
- Direct HTTP baseline is documented above; no browser/HTTP checks fabricate
  municipal data or imply legal approval.
