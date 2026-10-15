---
title: "Segnalazioni Tailwind runtime audit"
type: audit
status: active
theme: Sixteen
date: 2026-10-11
tags: [bmad, design-comuni, tailwind, alpine, lit, accessibility]
updated: 2026-10-11
qmd: "segnalazioni   runtime evidence sixteen"
---

# Segnalazioni — runtime evidence

The public `/it/segnalazioni` and `/en/segnalazioni` pages are rendered by Sixteen's
native page components. Domain queries, visibility rules and ticket data remain in
`Modules/Fixcity`; the theme owns presentation and translations.

| Check | Result |
|---|---|
| HTTP guest smoke, 8 routes | PASS, 8/8 status and needle checks |
| Puppeteer guest smoke, 8 routes | PASS, 8/8 screenshots |
| Italian/English page title | PASS: `Elenco segnalazioni` / `Reports List` |
| 375px viewport horizontal overflow | PASS: none observed |
| Main landmark and one H1 | PASS |
| Browser page errors | PASS: none observed |
| Raw translation keys in public body | PASS: none observed after namespace correction |

## Decisions applied

- Tailwind classes and Alpine state drive tabs, disclosures and mobile filters.
- Lit owns the map and filter components.
- Theme translations use `pub_theme::segnalazione`; module translations are not
  duplicated in Sixteen.
- Native pages bypass the Volt fragment; the CMS fallback remains inside Volt.

## Auth vertical slice evidence

| Check | Result |
|---|---|
| `/it/auth/register` | PASS, HTTP 200; native Sixteen shell and registration inputs rendered |
| `/en/auth/register` | PASS, HTTP 200 smoke response |
| `/it/auth/password/reset` | PASS, HTTP 200; native Sixteen shell and email input rendered |
| `/it/auth/password/reset/{token}` | PASS, HTTP 200 smoke route; token is passed into the reset form state |
| Personal-area practices/settings/services guest smoke | PASS, HTTP 200 without error renderer |
| Blade view cache | PASS |
| Sixteen Vite build | PASS |
| `git diff --check` | PASS |
| Axe Playwright, 375px, registration | PASS for application content; only dev Debugbar badge contrast warning (4.47:1) |
| Axe Playwright, 375px, password reset | PASS for application content; same dev Debugbar badge warning |

Registration and recovery widgets remain domain/module-owned for validation,
consent collection and password delivery. The theme owns only their visual
surface, preserving the module/theme boundary.

The axe `region` findings are structural warnings from the global shell and
remain in the cross-page accessibility backlog. The contrast finding targets
`phpdebugbar-badge`, which is development tooling and is excluded from the
production accessibility verdict; production must still be audited with the
Debugbar disabled.

The selected legacy widget test run is not a clean gate: four assertions fail
because the tests still expect the former UserResource form class and helper
functions/data shape, while the current GDPR RegisterWidget uses its own
GDPR-aware public properties and the widget schema contract. This is recorded
as test-contract debt, not presented as a passing regression suite.

## Remaining limits

The global header/search/footer still contains legacy Bootstrap Italia markup and is a
separate migration slice. This audit does not claim complete WCAG or MAUVE conformance;
keyboard traversal, contrast extraction and authenticated wizard states remain to be
audited on the deployed environment.
