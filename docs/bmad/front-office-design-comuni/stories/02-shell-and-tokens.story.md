---
title: "DesignComuni shell and token system"
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

As a resident, I want every public page to share a predictable municipal shell,
so that navigation and trust do not change between flows.

## Acceptance criteria

1. Header, skip links, breadcrumb, main landmark, feedback/contact and footer are reusable.
2. Tokens and focus states match `DESIGN.md` at 320–1440px.
3. Shell passes keyboard navigation and has no horizontal overflow.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/resources/views/components/sections/header/**`
- `laravel/Themes/Sixteen/resources/views/sections/**`
- `laravel/Themes/Sixteen/resources/css/components/**`
- `laravel/Themes/Sixteen/resources/css/app.css`

## Testing

Blade render smoke, axe scan, keyboard-only traversal and screenshots at 320, 390, 768 and 1440px.
