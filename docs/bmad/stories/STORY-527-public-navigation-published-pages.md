---
story_id: STORY-527
title: "Show only published destinations in the public navigation"
status: completed
owner: Themes/Sixteen
created: 2026-09-27
updated: 2026-09-27
issue: "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussion: "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
---

# User story

As a resident, I want the public menu to lead to real pages, so I do not land
on empty sections that appear to be available services.

## Acceptance criteria

- [x] The tenant `header.json` remains the source of menu labels, destinations,
  order and publication flags.
- [x] FixCity keeps unimplemented municipal sections configured but disabled
  until their owner content exists.
- [x] The topics destination has an explicit enable flag and is hidden while
  unpublished.
- [x] A direct request for an unknown generic CMS index returns 404 instead of
  a blank 200 shell.
- [x] The services catalogue, administration and news pages remain reachable.
- [x] No controller, service layer or unsupported municipal content is added.
- [x] Browser coverage passes in IT/EN/DE/ES with no regression to catalogue
  search, categories, report details or guest sign-in navigation.

## Implementation and evidence

In this tenant, the configured events, topics, enrollment, summer-program and
local-police destinations had no page heading or body. Their menu configuration
is retained but unpublished; the generic Folio fallback now returns 404 for
unknown CMS pages. The localized service catalogue remains `/services`.

`php artisan view:cache`, JSON parsing and Node syntax checks passed. The
`services-catalogue.spec.mjs` suite passed **4/4** with Playwright, including
six unbacked routes in four locales, 16 locale/viewport catalogue combinations,
search, category navigation and service-detail guest access. The Design Comuni
utility-page suite passed **2/2** for localized FAQ/sitemap rendering and
locale-preserving personal-area redirects.
