---
title: "Sixteen service catalogue — correction plan"
type: bmad-implementation-plan
status: in-progress
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, design-comuni, services, ui-ux]
qmd: "Sixteen service catalogue correction search categories honest links locale test"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - services-catalog-expected-2026-09-27.md
  - ../wiki/concepts/comuni-design-system-guidance.md
  - ../../../Modules/Fixcity/docs/bmad/services-catalog-gap-analysis-2026-09-27.md
---

# Correction plan

## Follow-up from fresh mobile visual inspection

At 390 px, the three quick-task links were rendered as two narrow controls on
the first row and a third control below. Their labels were visibly squeezed,
even though the document had no horizontal overflow. Update the task navigation
to use full-width, centered, minimum-44px targets on narrow screens, then restore
the compact wrapping layout from the `sm` breakpoint. Regression coverage must
check each action's rendered label fits its target at 320, 390, 768 and 1440 px
in IT/EN/DE/ES. This is a presentation correction only; destinations and
supported service scope stay unchanged.

1. Keep the existing Folio route and compose it with the shared public app
   layout for skip links, global navigation and institutional footer; do not add
   controllers or claim unimplemented municipal capabilities.
2. Replace unsupported demo services and fabricated contacts with the three
   verifiable citizen tasks: report an issue, browse public reports, track a
   report. Explain this Fixcity scope in localized content.
   Explain that report submission requires sign-in.
3. Give each task a real locale-aware destination and an in-page section target;
   no `#` placeholders or self-links. Avoid claiming categories for services
   without an implementation or tenant-owned content.
   Replace the six illustrative municipal categories with one supported
   public-reports group. Link it to `/tickets`, and keep the
   `/lista-categorie` page consistent with the same real workflow.
4. On the report service sheet, expose a secondary locale-aware action to the
   public report list (`/tickets`) beside the report submission action. Do not
   add sample contacts, terms or appointments without tenant approval.
5. Search filters the three rendered tasks, announces result count through
   aria-live="polite", and shows a localized empty state. Search labels, result
   count, cards and section names exist in IT/EN/DE/ES.
6. Updated the existing Pest contract for locale parity, task destinations,
   search accessibility, and absence of placeholder contacts. Pest could not
   reach assertions because RefreshDatabase connects to MariaDB using the
   unresolved test username placeholder (SQLSTATE 1045).
7. Chromium covered IT/EN/DE/ES at 320, 390, 768 and 1440 px: HTTP 200, shared
   public shell, three
   initial tasks, zero after a no-match query, visible empty state, no horizontal
   overflow and no browser page errors. Heading and live count computed white
   against the green hero after scoped CSS overrides legacy global heading
   colors. Each locale emitted localized links for
   /tickets/create, /tickets and /tickets/track. Search is keyboard-addressable;
   complete screen-reader testing remains manual.

## Completion evidence

The correction below is a follow-up to the initial implementation: that page
still exposed generic categories after the plan said unsupported services had
been removed. Mark this plan complete only when the localized category page
and the services entry pass feature and browser checks. Implemented on
2026-09-27: the page and category directory now show one public-reports group;
the category anchor and `/tickets` destination work. The checked-in Playwright
spec passes 3 tests, including 16 locale/viewport combinations and the guest
route `services → report detail → login`. The PHP Feature suite could not reach
assertions because the test MariaDB username resolves to the placeholder
`${FIXCITY_TEST_DB_USERNAME}`; resolve the test environment before closing the
end-to-end story.

The follow-up comparison with the official
[`segnalazione-dettaglio.html`](https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-dettaglio.html)
found the missing secondary “all reports” action. The report detail now links
to `/tickets` beside its primary create action; Playwright verifies the
localized destination and visible label for IT/EN/DE/ES. The route remains
inside the existing Folio page and introduces no synthetic municipal content.

The responsive screenshot also exposed the page hero's white-on-white text:
`bg-primary-700` had no compiled background rule, while `text-white` did apply.
The hero now uses an explicit light surface and dark text to match the official
services template. Playwright computes text/background contrast and requires
4.5:1 for both title and description at every locale and viewport. The
production theme build and post-build Playwright run both pass; screenshot:
`/tmp/fixcity-services-catalogue-it-390.png`. Build still logs an unresolved
legacy `/themes/Sixteen/images/logo.svg` reference outside this page's hero.

Implementation is present in the active /services Folio page. Visual screenshot:
/tmp/fixcity-services-final-it-390.png. Blade cache, production Vite build and
repository wiki gate passed. Vite still reports an unresolved
/themes/Sixteen/images/logo.svg runtime reference, unrelated to this page.

## Mobile task navigation follow-up — 2026-09-27

Fresh inspection of `/tmp/fixcity-services-final-it-390.png` found the quick
task links sharing a narrow first row; their labels were cramped even though
the document had no horizontal overflow. The nav now stacks full-width, centered
links below 640 px and keeps compact wrapping on larger screens. Each target
has at least 44 px height. `services-catalogue.spec.mjs` now checks all three
targets for full-width mobile layout, no clipped text, and minimum target
height across IT/EN/DE/ES and the four existing viewport widths. Re-run the
spec after this change before marking this follow-up complete. Verified after
the production build: 3/3 browser tests pass; all links rendered at 342 × 58 px
on a 390 px viewport with `scrollWidth <= clientWidth`. Screenshot:
`/tmp/fixcity-services-mobile-followup-390.png`. The app still emits the
pre-existing unresolved logo asset warning during Vite build.
