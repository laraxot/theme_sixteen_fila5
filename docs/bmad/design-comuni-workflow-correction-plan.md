---
title: "Sixteen — report workflow transparency correction plan"
type: bmad-implementation-plan
status: in-progress
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [design-comuni, service-report, workflow, localization]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../../Modules/Fixcity/docs/bmad/design-comuni-service-workflow-audit-2026-09-27.md
  - ../../../Modules/Fixcity/docs/bmad/stories/STORY-525-design-comuni-report-journey-transparency.md
---

# Correction plan

1. Keep the existing Folio service sheet and its localized login/create and
   public-reports destinations.
2. Replace the current three generic process bullets with five runtime-aligned
   phases: account, privacy step, report details, review/submit, receipt/follow-up.
3. Provide reviewed equivalents for `it`, `en`, `de` and `es`; do not paste
   Italian fallback text into Blade.
4. Add a stable semantic list identifier and browser assertions for all five
   phases in each locale.
5. Run the browser catalogue matrix and relevant PHP/quality gates; update the
   Fixcity story with evidence and unresolved privacy review.

## Exclusions

Do not advertise SPID/CIE, pagoPA, F24, appointment booking, benefits or
permits. These require real integration and tenant ownership. Do not change
privacy checkbox semantics or present sample legal text as approved policy.

## Current evidence — 2026-09-27

Five-step copy is implemented in IT/EN/DE/ES. Live HTTP checks returned 200 and
confirmed five rendered steps per locale; view cache and wiki quality gate
passed. Playwright could not launch Chromium because `libatk-1.0.so.0` is
missing, so viewport/browser assertions remain open.
