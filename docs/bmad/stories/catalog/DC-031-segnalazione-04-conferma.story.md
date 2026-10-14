---
id: DC-031
status: ready-for-dev
type: design-comuni-page-parity
reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-04-conferma.html
local: http://192.168.1.40:8000/it/tests/segnalazione-04-conferma
title: "DC-031 — segnalazione-04-conferma"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "dc-031   segnalazione-04-conferma sixteen"
---

# DC-031 — segnalazione-04-conferma

Implement the JSON-driven Sixteen page for the reference route and preserve the existing <x-section slug="header" /> / <x-section slug="footer" /> shell.

## Acceptance criteria

1. The JSON page has a stable id and slug, and every visible reference region maps to a reusable Sixteen block with documented input data.
2. The page uses TailwindCSS, Alpine.js, Lit, DaisyUI and Flowbite only; no Bootstrap Italia runtime/CDN is added.
3. Playwright/Puppeteer screenshots at 375, 768 and 1440 px show no missing assets, browser errors or horizontal overflow.
4. HTML similarity is at least 90% and visual similarity is at least 95% against the reference URL.

## Verification

Run node bashscripts/design-comuni/verify-parity.mjs; attach the row from /tmp/fixcity-parity/automated/report.json and the screenshots to this story before marking done.

