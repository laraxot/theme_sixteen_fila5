---
type: decision
title: Consolidate Header and Footer into CMS-Driven Components
links:
  github_issue: "#55"
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "decision: header & footer consolidation sixteen"
---

# Decision: Header & Footer Consolidation

## Problem
Sixteen theme ha **duplicazione header/footer**:
- `header-comune.blade.php` / `footer-comune.blade.php` (statiche, hardcoded)
- `components/sections/header.blade.php` / `sections/footer-full.blade.php` (CMS-driven)
- `pub_theme::components.sections.header.v1` / `.tailwind` (nuova)
- `bootstrap-italia/*` (legacy, no bootstrap)

## Decision
Unico header + footer CMS-driven, alimentati dal JSON page content (`sections` array).

## Components
| Component | Slug | Template | Data |
|---|---|---|---|
| `x-section slug="header"` | `components/sections/header.blade.php` | `pub_theme::components.sections.header.v1` | CMS navigation, user auth |
| `x-section slug="footer" tpl="full"` | `components/sections/footer.blade.php` | `sections/footer-full.blade.php` | CMS footer data |
| `x-section slug="footer" tpl="slim"` | | `sections/footer-slim.blade.php` | bottom bar only |

## Header Structure
```
┌─────────────────────────────────────────────────────────────┐
│ Top bar: Language switcher (IT/DE/EN/ES) + Personal area    │
│ Main bar: Logo + "Il mio Comune" + tagline + search         │
│ Nav: Primary (7 links) + Secondary (elenco segnalazioni)    │
│ Mobile: Alpine overlay (toggled)                            │
└─────────────────────────────────────────────────────────────┘
```

## Footer Structure
```
┌─────────────────────────────────────────────────────────────┐
│ EU badge + 4 columns + contacts + bottom legal bar          │
│ Slim: bottom bar only                                       │
└─────────────────────────────────────────────────────────────┘
```

## Impact
- `layouts/app.blade.php`: `<x-section slug="header" />` / `<x-section slug="footer" tpl="full" />` ✅
- `layouts/test.blade.php`: stesso header/footer
- `header-comune`/`footer-comune`: deprecate → rimossi

## Status: APPROVED