---
id: tickets-visual-parity-high-purpose
type: bmad-story
status: open
links:
  github_issue: "#999"
  discussion: "#design-comuni"
title: "/it/tickets — High Visual Parity with Function + Purpose"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets   high visual parity with function + purpose sixteen"
---
# /it/tickets — High Visual Parity with Function + Purpose

## Why (function, philosophy, logic — NOT decoration)
Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html` (HTTP 200, 76553 bytes — design-comuni standard)

- `/it/tickets` is NOT `/tests/` — it is a real public-service page (function = transparency, service status visibility, user access to own data)
- Philosophy (public service): a citizen must see service status without identity barrier (guest) and with full service access (authenticated) — this is not a test; it's a democratic function
- Logic: the tickets list serves GDPR art 5 (purpose limitation, minimization) + art 15 (access) — user sees only their data; no decoration; each card/item serves a real purpose (status, action, tracking)

## Design-Comuni Visual Parity Target (97%)
Reference page `segnalazioni-elenco.html` defines the standard:
- Civic green (#007A52) header/navigation
- Clean list/card layout for service items
- Clear status labels (not decorative badges — they encode real service state)
- Focus-visible on all interactive elements (WCAG 2.1 AA)
- Touch targets >=44px (mobile/tablet: 375/768/1440 verified)
- `prefers-reduced-motion` fallback
- Multi-language labels (IT/EN) — `SetFolioLocale` middleware

## Legal Framework (every change must respect)
- GDPR (Reg EU 2016/679): art 5,6,13,15,20,32 — purpose limitation, data minimization, transparency, access, portability, security
- Italian PA Code (CAD) — public administration digital service requirements
- Accessibility: WCAG 2.1 AA / Legge Stanca / EU Directive 2016/2102 / EU 2019/882 EAA
- eIDAS (Reg EU 910/2014) — digital identity/authentication for service access
- Multi-language: EU rules (access in user's language) + `SetFolioLocale` middleware

## Mobile/Responsive + Professional Quality
- Responsive verified at 375/768/1440
- Touch targets >=44px
- Reduced-motion fallback present
- Every change: purpose documented (this file), verified (`view:clear` + `curl` + `ux_audit`), no decoration (function = service)
- Professional academic: study + document + verify — no quick fixes; reason for everything

## Implementation Rules (no invent — R006)
- Check `laravel/config/local/fixcity/database/content/pages/` for existing `/it/tickets` JSON/page
- Check existing component (`pub_theme/components/blocks/tests/` and related) for structure/pattern
- If `/tests/` exists: migrate/rename/rebuild to `/it/` — NOT create from scratch unless needed
- Auth-state (`auth()->check()`): guest sees basic navigation + login; authenticated sees service links (function = service access, GDPR art 6 + 15)
- Every change verified with `curl` + visual check against reference; documented in BMAD + second brain

## Status
Reference fetched (200 OK, 76553 bytes). Current `/it/tickets`: 200 OK (104621 bytes — larger than reference; needs alignment with design-comuni standard). Page must not remain as `tests/` stub; must reflect design-comuni visual standard with real service function.
