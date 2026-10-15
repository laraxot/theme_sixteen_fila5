---
title: "BMAD verification — tests Design Comuni parity"
type: note
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "bmad verification   tests design comuni parity sixteen"
---
# BMAD verification — tests Design Comuni parity

## Scope

The Sixteen theme owns the Design Comuni presentation. The test catalogue,
homepage and service-detail page therefore use the canonical Sixteen section
renderer and JSON page blocks; no `pub_theme::...design-comuni` wrapper or
Bootstrap Italia runtime is introduced.

## Data flow

```text
config/local/fixcity/database/content/pages/*.json
        -> PageSlugMiddleware / Cms HasBlocks
        -> block `data.view`
        -> Sixteen resources/views/components/blocks/*.blade.php
        -> Tailwind CSS + Alpine interaction
```

The block payload is the contract. URLs remain route expressions in JSON so
localisation and the generic Folio route (`tests.view` or `container0.view`)
are resolved by Laravel, not hard-coded in the view.

## Implemented parity decisions

- `tests.index` explicitly uses `x-layouts.test` and the catalogue shell is
  marked `design-comuni-template-index`.
- Test detail pages use the normal `x-layouts.app`; they do not duplicate the
  Design Comuni layout.
- The header is section data (`<x-section slug="header" />`), with the green
  centre/navigation bands, white logo/links, utility top bar and social links
  only in the centre band.
- Homepage and service detail expose the reference anchors `head-section`,
  `calendario`, `rating`, `contacts` and `related-content` where applicable.
- The service-detail rating block now has the reference `#rating` anchor.
- Theme-owned parity corrections live in `resources/css/tests-design-comuni-parity.css`.

## Automated evidence

Executed on 2026-10-11 at 1440px with Puppeteer after the production Vite
build and Laravel view cache:

| Page | Reference height | Local height | Local header | Local footer |
|---|---:|---:|---:|---:|
| `/it/tests/` | 4155px | 4557px | catalogue shell | catalogue shell |
| `/it/tests/homepage` | 4601px | 4769px | 223px | 853px |
| `/it/tests/segnalazione-dettaglio` | 4425px | 4247px | 223px | 853px |

The catalogue screenshot diff reached 2.64% mean pixel difference in the
normalized 100×100 comparison. The homepage measured 20.17% and the service
detail 17.21%; both remain below the requested visual target and require
further block-level work (especially homepage hero/evidence cards,
contact/related bands and footer density).

Responsive smoke checks at 375, 768 and 1440px reported no horizontal
overflow, missing images or browser console errors on all three local URLs.

## Accessibility evidence

The WCAG contrast checker passed the six critical Design Comuni pairs:

- white on `#008758`: 4.56:1
- white on `#00402b`: 11.88:1
- `#007a52` on white: 5.38:1
- `#191919` on white: 17.58:1
- `#5d7083` on white: 5.11:1
- focus `#007a52` on white: 5.38:1

This is a contrast/smoke result, not a claim of full WCAG 2.1 AA conformance.
Full keyboard, screen-reader and state coverage remain acceptance criteria for
the next parity pass.

## Open BMAD story

`homepage.blade.php` and `service/detail.blade.php` still need structural
alignment to the reference template's exact hero, evidence, contact and footer
blocks. This document records the verified state so the next agent does not
mistake a passing build for completed visual parity.
