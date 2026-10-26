---
title: "Route catalog — DesignComuni front office"
type: bmad-route-catalog
status: in-progress
tags: [bmad, design-comuni, routes, visual-regression]
updated: 2026-10-17
qmd: "scope sixteen"
---

# Scope

The redesign covers the complete public DesignComuni catalogue, not only the
homepage and the report detail. Sixteen remains the single theme owner. Content
is JSON-driven and is resolved by CMS slug; route-specific Blade files only select
the shell and the reusable blocks.

## Public families

| Family | Representative routes | Rendering contract |
|---|---|---|
| Sito | `tests/homepage`, `tests/amministrazione`, `tests/novita`, `tests/eventi`, `tests/argomenti`, `tests/servizi`, search, FAQ and sitemap | DesignComuni shell + JSON page blocks |
| Servizi | service catalogue, category, service detail and access | breadcrumb, index, structured service sections, CTA, contacts, feedback |
| Segnalazione | report detail, privacy, data, summary, confirmation, personal area, list and tracking | four-step recoverable flow; map always paired with list |
| Appuntamenti/assistenza | booking and assistance steps | same stepper/error/success contract |

## Parity gates

1. HTTP 200 and no browser page errors for every route in the matrix.
2. No Bootstrap Italia CSS/JS or CDN URL in the Sixteen runtime.
3. JSON owns visible page content; Blade owns composition and accessible semantics.
4. Playwright and Puppeteer smoke at 1440, 1024, 768, 390 and 320px.
5. WCAG 2.1 AA review: labels, headings, contrast, focus, keyboard, reduced motion,
   map/list equivalence and no horizontal overflow.

## Current evidence

- Complete catalog run: 37/37 routes HTTP 200, zero browser errors, zero missing images and zero horizontal overflow at 375/768/1440 px.
- `tests/homepage`: HTTP 200, Playwright page errors 0; visual work remains.
- `tests/segnalazione-dettaglio`: HTTP 200, Playwright page errors 0; visual work remains.
- Reference heights at 1440px: homepage 4629px; report detail 4425px.
- Current implementation is a working vertical slice. The 37 page stories are
  ready-for-dev, but completion remains gated by measured screenshot and HTML
  thresholds; `/tmp/fixcity-parity/automated/report.json` is the source of truth.
