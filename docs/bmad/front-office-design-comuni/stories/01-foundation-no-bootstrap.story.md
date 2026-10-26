---
title: "Foundation: remove Bootstrap runtime from Sixteen"
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

As a frontend maintainer, I want the Sixteen runtime to use only the approved stack,
so that DesignComuni styling is owned by Tailwind and not hidden behind Bootstrap.

## Acceptance criteria

1. Theme build and dependency manifests contain no Bootstrap or Bootstrap Italia runtime dependency.
2. Interactive behaviours previously using `data-bs-*` have Alpine/Lit/Flowbite equivalents.
3. Static assets required by the shell are local and do not require a package runtime.
4. A dependency grep and production build are recorded in the story evidence.

## Owned File/Module Scope

- `laravel/Themes/Sixteen/package.json`
- `laravel/Themes/Sixteen/vite.config.js`
- `laravel/Themes/Sixteen/resources/js/**`
- `laravel/Themes/Sixteen/resources/css/**`

## Testing

Vite production build, dependency grep, keyboard menu/modal smoke and visual shell screenshot.
