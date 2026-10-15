---
title: "Sixteen DesignComuni route catalog"
type: theme-bmad-reference
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "route catalog sixteen"
---

Sixteen is already the DesignComuni theme. This document records the theme-side
ownership of the complete front-office catalogue. Do not create another
`design-comuni` layout or namespace. Folio pages select `layouts.test` only for
the explicit template preview route; normal CMS pages use `layouts.app`.

All visible copy belongs in the tenant JSON page files under
`config/local/fixcity/database/content/pages/`. Blocks under
`resources/views/components/blocks/` contain only composition, semantics and
interaction states. Module-owned data and Actions remain in their module.

The parity order is: shared shell, Sito catalogue, service catalogue/detail,
report flow, appointments/assistance, then legal/search/error states. Every slice
must be checked with Playwright, Puppeteer and the WCAG/Mauve evidence contract.
