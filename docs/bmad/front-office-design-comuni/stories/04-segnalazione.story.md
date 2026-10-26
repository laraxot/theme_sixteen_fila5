---
title: "Segnalazione service and four-step flow"
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

As a resident, I want to submit a report through a clear four-step service flow,
so that I know what data is required and can recover from mistakes.

## Acceptance criteria

1. Presentation, privacy, data, summary and confirmation match the official templates.
2. Validation retains input, links inline errors to fields, focuses the error summary and announces status.
3. Confirmation shows identifier, next steps and tracking without exposing private data.
4. The flow works with keyboard, reduced motion and a usable no-JS fallback.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/resources/views/pages/**/segnalazioni/**`
- `laravel/Themes/Sixteen/resources/views/components/wizard/**`
- `laravel/Themes/Sixteen/resources/js/components/report/**`
- `laravel/Modules/Fixcity/resources/views/**`

## Testing

Existing Actions remain the source of truth; run browser journey, validation/error,
privacy, owner-visibility and axe tests.
