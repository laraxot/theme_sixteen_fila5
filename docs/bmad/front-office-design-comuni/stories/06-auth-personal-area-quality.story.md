---
title: "Auth, personal area and FO quality gate"
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

As a returning resident, I want auth and my personal area to use the same public
language, so that the journey remains understandable after sign-in.

## Acceptance criteria

1. Login, registration, verification, reset, profile and personal-area pages share the shell and states.
2. Empty/loading/error/success states have recovery actions and accessible announcements.
3. The final route matrix and visual/accessibility evidence are documented.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/resources/views/pages/**/auth/**`
- `laravel/Themes/Sixteen/resources/views/pages/**/area-personale/**`
- `laravel/Themes/Sixteen/resources/views/components/auth/**`
- `laravel/Themes/Sixteen/tests/**`

## Testing

Guest/authenticated route matrix, axe, keyboard, mobile screenshots, quality gate and view cache.
