---
id: DC-CATALOG
status: ready-for-dev
type: bmad-story-index
title: "Story index — complete Design Comuni catalogue"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story index   complete design comuni catalogue sixteen"
---

# Story index — complete Design Comuni catalogue

## Verification checkpoint — 2026-10-11

The full Playwright matrix covers all 37 discovered reference pages at 375,
768 and 1440 px. All local routes return HTTP 200 with no browser errors,
missing images or horizontal overflow. The 1440px screenshot gate currently
passes for 20/37 pages; every remaining page stays in progress and its
individual `DC-###` story remains ready-for-dev.

As the FixCity product team, we need one traceable story for every page in the
official Design Comuni catalogue so that no route is considered complete merely
because the five initial smoke pages work.

## Child stories

The 37 page IDs and their reference/local routes are in
`bmad-output/front-office-design-comuni/visual-parity-catalog.md`. Each row is
an independently verifiable child story. The dynamic verifier discovers the
same rows from the official index and writes the runtime evidence report.

## Acceptance criteria

1. Every discovered reference HTML page has a local candidate route.
2. Every candidate is JSON-driven and rendered by Sixteen blocks; no duplicate
   `pub_theme` Design Comuni theme is introduced.
3. Each page has a block/data mapping, accessibility notes, and screenshot
   evidence.
4. Each page reaches the catalogue thresholds: HTML >= 90%, visual >= 95%,
   HTTP 200, zero browser errors, no missing images and no horizontal overflow.
5. The runtime contains TailwindCSS, Alpine.js, Lit, DaisyUI and Flowbite only;
   Bootstrap Italia is not loaded.

## Verification

Run `node bashscripts/design-comuni/verify-parity.mjs`. The generated
`catalog.json` and `report.json` are evidence, not claims of completion; a row
remains in-progress until its measured thresholds pass.
