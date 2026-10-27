---
title: "Services catalogue, category and detail"
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

As a resident, I want to find a service by category or search and understand what
happens next, so that the service page is actionable rather than decorative.

## Acceptance criteria

1. Catalogue, category and detail preserve the official DesignComuni information order.
2. Search, empty and error states expose recovery actions and accessible labels.
3. Service detail exposes audience, description, procedure, requirements, costs/timing, conditions and contacts.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/resources/views/pages/**/servizi/**`
- `laravel/Themes/Sixteen/resources/views/components/service/**`
- `laravel/Themes/Sixteen/resources/js/components/service/**`

## Testing

Route smoke for all locales, search keyboard test, axe scan and responsive screenshots.
