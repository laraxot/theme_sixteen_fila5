---
title: "Deep Visual Parity — Deep-dive Plan"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "deep visual parity   deep-dive plan sixteen"
---
# Deep Visual Parity — Deep-dive Plan

## Verified parity assets (real, not invented)
- `homepage-parity.css`: green #007a52, ink #17334f, white bg; header slim/center/navbar all #007a52; footer #24323f + light text; buttons zero-radius; evidence gradient.
- `footer-override.css`: PLACEHOLDER — needs footer column title colors (white on #24323f), EU logo alignment, legal links.
- `header-fix.css`: exists (not audited yet).
- Reference URL: https://italia.github.io/design-comuni-pagine-statiche/

## Deep-dive elements still missing / wrong (verified from code + error m00607 / m00611 / m00617)
1. Footer column titles: need `color: #fff` (currently inherited dark via Bootstrap Italia)
2. Footer EU logo + brand wrapper: needs flex alignment + 82px logo + white text
3. Header navbar icons (social/search): underline + wrong size → fix to 24px no-underline
4. Language switcher (it/en): active state missing → add `.lang-active` border/bold/accent
5. Accedi button (`header.json` account): `:focus-visible`, size ≥44px touch-target
6. Skiplinks (`Vai ai contenuti / Vai al footer`): must be visible on focus, not hidden
7. Hero card (tests/homepage): zero border, zero shadow, white bg (already in parity CSS)
8. Search modal: bg rgba(23,50,77,0.56) verified

## Action sequence (BMAD)
- Step 1: Complete `footer-override.css` (real CSS, based on `homepage-parity.css` footer section)
- Step 2: Fix header icon CSS + language + Accedi in `header-fix.css`
- Step 3: Re-run `ux_audit` on combined CSS
- Step 4: Capture screenshots (playwright) for all 10 pages — LOCAL vs REFERENCE
- Step 5: Document delta in `docs/bmad/parity-status.md` (honest)

Initiatives: kp-b4af21c7... (all pages parity), kp-264c30f... (WCAG improvement)
