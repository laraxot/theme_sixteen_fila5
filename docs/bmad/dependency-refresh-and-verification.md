---
title: "Sixteen dependency refresh and verification record"
type: note
status: draft
updated: 2026-10-19
tags: [docs, sixteen, bmad]
qmd: "sixteen dependency refresh and verification record sixteen"
---
# Sixteen dependency refresh and verification record

## Decisions

- `laravel-vite-plugin/fonts` remains the font integration point in
  `vite.config.js`.
- `fontaine` remains on `^0.8.2` because `laravel-vite-plugin@3.2.0` declares
  an optional peer range of `^0.8.0`; `1.x` is not adopted without a compatible
  plugin release.
- `postcss-selector-parser` is `^7.1.6`, removing the direct audit finding.
- Major upgrades are accepted only after the theme build and package audit
  succeed.

## Required gates

```bash
cd laravel/Themes/Sixteen
NODE_ENV=development npm install --include=dev
npm outdated --json --include=dev
npm audit --json
npm run build
npm ls --depth=0
```

The Laravel test command must be run from `laravel/`, not from this theme
directory. Browser checks must record route, viewport, computed font family,
font loading state and failed network requests.

## Evidence

- Build completed after the refresh.
- `npm audit --omit=dev` reported zero production vulnerabilities at
  verification time.
- `fontaine` is intentionally held back for plugin compatibility.
- `npm test -- --runInBand` is not a valid browser-suite runner: Jest 30
  discovers the Playwright `.mjs` specs and fails before executing tests,
  while the standalone Playwright/Puppeteer smoke check passes. This remains
  a pre-existing script/configuration boundary, not a dependency install
  failure; use the Playwright runner for `tests/browser/`.

## Root-cause lesson

The earlier font work over-focused on manually reproducing generated CSS and did
not inspect the already-installed Laravel Vite plugin API. The correct order is
to inspect installed integration points, verify generated manifest/CSS, then
inspect browser computed styles.
