---
title: "Homepage Issues Audit (m00477)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "homepage issues audit (m00477) sixteen"
---
# Homepage Issues Audit (m00477)

## Summary of 13 Visual Parity Issues (40% → 97% target)

This document captures all visual parity issues found in the local homepage compared to the Design Comuni reference. Each issue is documented with:
1. Problem description
2. Reference expectation
3. Current local implementation
4. Fix plan
5. Verification method

## Issue 1: Header SVG Logo (m00477)
**Problem**: Local page shows text logo instead of SVG logo in header
**Expected**: SVG logo (`themes/Sixteen/design-comuni/assets/images/logo-comune.svg`)
**Current**: Text logo displayed in Neo font
**Fix**: Update header component to use correct logo path
**Verification**: `curl -s localhost:8000/it/tests/homepage | grep -i logo`

## Issue 2: Search Icon + Button (m00477)
**Problem**: Search box lacks icon + "Invio" button
**Expected**: Search icon + "Invio" button in modal
**Current**: Plain input with only placeholder
**Fix**: Add icon + button per Bootstrap Italia reference
**Verification**: Playwright screenshot comparison

## Issue 3: Hamburger Menu (m00477)
**Problem**: Hamburger menu not responsive
**Expected**: Mobile-first hamburger only (<768px)
**Current**: Always visible or missing
**Fix**: Add responsive hamburger menu
**Verification**: Screenshot at 375px width

## Issue 4: Link Styling (m00477)
**Problem**: All links underlined
**Expected**: Clean links without underlines
**Current**: `text-decoration-underline` classes applied
**Fix**: Remove all link underline classes
**Verification**: CSS inspection

## Issue 5: News Label (m00477)
**Problem**: Missing "Notizie 18 mag 2022" label
**Expected**: Proper date label with correct styling
**Current**: Incorrect or missing label
**Fix**: Add correct label element
**Verification**: HTML element inspection

## Issue 6: "Estate in città" Badge (m00477)
**Problem**: Missing summer events badge
**Expected**: "Estate in città" chip with correct styling
**Current**: No badge displayed
**Fix**: Add badge element
**Verification**: Screenshot includes badge

## Issue 7: Governance Cards (m00477)
**Problem**: Missing images + "Vai alla pagina" button
**Expected**: Cards with images + navigation buttons
**Current**: Empty cards
**Fix**: Add images + buttons
**Verification**: DOM inspection

## Issue 8: Calendar Layout (m00477)
**Problem**: Calendar structure incorrect
**Expected**: Proper calendar section with date/title layout
**Current**: Malformed calendar
**Fix**: Rebuild with correct structure
**Verification**: HTML structure comparison

## Issue 9: Topics Section (m00477)
**Problem**: Geometric background issues
**Expected**: Correct geometric background + padding
**Current**: Improper background + spacing
**Fix**: Apply correct Tailwind background + spacing classes
**Verification**: CSS property inspection

## Issue 10: Thematic Sites (m00477)
**Problem**: Wrong background colors + missing images
**Expected**: Correct background + images
**Current**: Incorrect styling
**Fix**: Apply correct background colors + add images
**Verification**: Visual comparison

## Issue 11: Search Input (m00477)
**Problem**: Missing search icon + button
**Expected**: Search with icon + "Invio"
**Current**: Plain input
**Fix**: Add icon + button
**Verification**: Screenshot includes search functionality

## Issue 12: Rating Component (m00477)
**Problem**: Incorrect rating behavior
**Expected**: Functional rating stars
**Current**: Non-functional or broken rating
**Fix**: Fix star functionality
**Verification**: Click rating stars + verify response

## Issue 13: Contacts (m00477)
**Problem**: Spacing issues
**Expected**: Proper spacing structure
**Current**: Incorrect spacing
**Fix**: Apply correct padding/margin
**Verification**: Visual spacing inspection

## Stack Constraint (D4)
- Stack: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap)
- Constraint D4 verified: NO Bootstrap Italia assets imported
- All fixes must use TailwindCSS token system (#007A52 primary)

## BMAD + Second Brain Integration
All 13 issues documented in this audit file:
- `docs/bmad/issues/homepage/homepage-audit.md`
- Issues archived under `docs/bmad/issues/header/` and `docs/bmad/issues/homepage/`
- Second brain updated with D21 (Homepage issues audit)

## Verification Commands
```bash
# Playwright visual comparison
playwright --compare homepage local-reference

# HTML parity check
bash bashscripts/design-comuni/verify-homepage-parity.sh

# CSS audit
ux_audit --path laravel/Themes/Sixteen/resources/views/components/sections/header.tailwind

# Context verification
ctx_search queries: ["Notizie", "Estate in città", "calendario", "argomenti in evidenza", "siti tematici", "cerca una parola chiave", "contatta il comune", "rating"]
```

## Target Verification
- HTML parity: ≥90%
- Visual parity: ≥97% (after fixes)
- WCAG 2.1 AA: Full compliance
- Zero errors: Console errors, images missing, overflow

## Next Steps
1. Implement all 13 fixes
2. Run verification commands
3. Update audit with fix verification
4. Document successful resolution
