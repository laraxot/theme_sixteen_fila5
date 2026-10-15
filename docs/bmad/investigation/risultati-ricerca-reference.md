---
title: "Investigation — risultati ricerca parity gap 2026-10-13"
type: bmad-investigation
status: ready-for-dev
severity: high
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "investigation: risultati-ricerca sixteen"
---

# Investigation: risultati-ricerca

## Symptom summary

`/it/tests/risultati-ricerca` returns HTTP 200 but is not the official Design
Comuni search-results page: body HTML similarity is 12.87% and 1440px visual
parity is 24.02%, below the requested 90% / 97% gates.

## Evidence

| Grade | Evidence |
|---|---|
| A | Reference body is 56,518 bytes / 2,214 tokens; local body is 29,407 bytes / 539 tokens. |
| A | Reference screenshot is 4,084px high; local screenshot is 1,865px high at 1440px. |
| A | Reference has breadcrumb, search control, filters, ten result cards, load-more, rating, contacts and footer. |
| A | Local block renders only one section with a heading, subtitle and two generic cards. |
| A | Local heading/subtitle render raw translation keys `fixcity::search.results.*`. |
| B | The existing block contract exposes only `query`, `results` and `result_count`; it cannot express reference filters/rating/contacts. |
| B | Existing local shell is visually close in the header but uses a different DOM contract than the official static reference; shell parity must be measured separately. |

## Ranked hypotheses

### H1 — incomplete CMS block contract (High)

The page JSON contains only two results and the block has no fields for filters,
pagination, rating or contacts. This explains the missing regions and the
shorter page. Verify by expanding the JSON contract and comparing the rendered
region inventory.

### H2 — missing translation fallback (High)

The block calls translation keys that are not available in the active namespace,
so their key names become visible. Verify with an Italian render and a locale
catalogue check; fix with JSON-provided copy plus safe translation fallbacks.

### H3 — shell parity is not included in the page block (Medium)

The shared header/footer are Sixteen sections, while the reference uses official
Design Comuni markup. The page block cannot fix this without duplicating the
shell. Verify separately and route shell changes to the shared header/footer
story, not to a page-specific Blade.

## Component map

- CMS JSON: `laravel/config/local/fixcity/database/content/pages/tests.risultati-ricerca.json`
- Dynamic route: `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`
- Block: `laravel/Themes/Sixteen/resources/views/components/blocks/search-results/default.blade.php`
- Shared shell: `components/layouts/app.blade.php`, header/footer sections
- Comparator: `bashscripts/tools/visual/compare-body-html.mjs`,
  `compare-screenshots.mjs`

## Planning response

Option A: implement the child stories `DC-027.1` through `DC-027.5` in order.
The page needs a data-contract correction and a reusable block correction; a
new page-specific Folio Blade is explicitly out of scope.

## Non-goals

- Do not add Bootstrap Italia CSS/JS/CDN.
- Do not create `pages/tests/risultati-ricerca.blade.php`.
- Do not solve shared header/footer drift by duplicating them inside this page.
