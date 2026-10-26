---
title: "Reports list, map, detail and tracking"
type: story
status: backlog
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
tags: [docs, sixteen, bmad]
qmd: "story sixteen"
---

# Story

As a resident, I want to browse reports in a list or map and track one report,
so that the spatial and textual views remain equivalent.

## Acceptance criteria

1. Filters update the list and map without hiding the list alternative.
2. Every marker has an accessible equivalent, readable popup and real detail link.
3. Detail and tracking expose public status/timeline with clear recovery for not found.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/resources/views/tickets/**`
- `laravel/Themes/Sixteen/resources/js/components/map/**`
- `laravel/Modules/Geo/resources/js/components/map/**`
- `laravel/Modules/Fixcity/resources/views/pages/**`

## Testing

Map/list parity, marker keyboard/focus smoke, filters, mobile overflow and public privacy tests.
