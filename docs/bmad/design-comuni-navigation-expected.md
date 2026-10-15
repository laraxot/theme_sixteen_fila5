---
title: "Sixteen public navigation — expected behavior"
type: bmad-ux-contract
status: verified
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, design-comuni, navigation, cms, fixcity]
qmd: "Sixteen public navigation Design Comuni only published pages no empty links"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ./design-comuni-navigation-comparison-2026-09-27.md
  - ./design-comuni-navigation-correction-plan-2026-09-27.md
  - ../wiki/concepts/comuni-design-system-guidance.md
  - ../../../Modules/Fixcity/docs/bmad/design-comuni-workflow-expected-2026-09-27.md
---

# Expected behavior

## Reference scope

The official site index groups pages into general discovery, administration,
news, services, civic life, appointment booking, assistance and disservice
reporting. Its separate [`servizi/index.html`](https://italia.github.io/design-comuni-pagine-statiche/servizi/index.html)
contains reusable transactional patterns, including identity, privacy, data,
review, confirmation and personal-area follow-up. These templates describe
capabilities a municipality may implement; they are not evidence that FixCity
provides every service family.

## FixCity navigation contract

- Header choices continue to come from tenant `header.json` and remain editable
  there; the view must not invent menu entries.
- Render a menu entry only when its destination has an owner page (Folio view or
  published CMS page). Hidden entries remain in configuration so an authorized
  editor can enable them after publishing content.
- Keep verified pages visible: administration, news and the FixCity services
  catalogue. The topics link follows the same publication rule.
- Do not advertise empty events, enrollment, summer-program or local-police
  destinations as active journeys.
- A direct request for an unknown or unpublished CMS index must return 404, not
  a successful shell with no page heading or body.
- Keep `/services` as the canonical service catalogue. Its visible tasks are
  report, browse and track; the report flow remains the only FixCity workflow
  covered by the service-workflow templates.
- Published pages retain the shared skip links, language switcher, page title,
  institutional shell and locale-aware working links.

## Definition of done

- [x] Navigation renders only configured and published destinations.
- [x] Unknown CMS index pages return 404 instead of an empty 200 response.
- [x] `/it/services` stays available; `/it/servizi` no longer renders an empty
  duplicate page.
- [x] Browser checks cover desktop/mobile and the four supported locales.
- [x] No controller, service layer, fabricated civic data or new menu hardcoding.

## Verified result

Playwright passed four tests against the running app. It confirms the three
published navigation links, hides unpublished event/topic/enrollment pages,
and checks six unbacked slugs return 404 in `it`, `en`, `de` and `es`. Existing
catalogue checks continue to cover 16 locale/viewport combinations, search,
category navigation and the report/login journey.
