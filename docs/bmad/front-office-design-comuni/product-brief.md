---
title: "Product brief — FixCity DesignComuni front office"
type: product-brief
status: draft
tags: [bmad, product, front-office, civic-tech]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "problem sixteen"
---

# Problem

FixCity exposes a public civic reporting journey whose pages must feel as coherent,
trustworthy and accessible as the official Italian municipal templates. Existing
Sixteen surfaces contain accumulated compatibility CSS and legacy framework traces,
which makes visual parity, mobile behaviour and maintenance inconsistent.

# Users

- residents on mobile who need to report or track a local problem quickly;
- residents browsing public reports and municipal services;
- authenticated residents managing their reports in the personal area;
- municipal staff consuming the same public information architecture through the
  existing Filament back office.

# Core outcome

Create one reusable DesignComuni visual language for every public-facing Sixteen
page, with the report flow as the reference implementation.

# MVP scope

Home, services catalogue/category/detail, reports list/map, report detail, report
tracking, report creation steps, auth, personal area, search, legal/accessibility,
errors, shared header/footer and reusable form/list/map components.

# Non-goals

No new domain model, no controller layer, no service layer, no replacement of
Leaflet with 3D, no Bootstrap/Bootstrap Italia runtime, no speculative CMS features.

# Success

All listed FO routes have the same DesignComuni shell; keyboard completion and axe
checks pass for the report flow; 320px/390px layouts have no horizontal overflow;
critical JS works without decorative animation; build has no Bootstrap dependency.
