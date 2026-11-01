---
title: "Discrepancy Audit: Risultati Ricerca (m00579)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "discrepancy audit: risultati ricerca (m00579) sixteen"
---
# Discrepancy Audit: Risultati Ricerca (m00579)

## Visual Parity Gap Analysis (local vs reference)

### Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html
### Local: http://192.168.1.40:8000/it/tests/risultati-ricerca

## Structural Differences (summary)

| Category | Reference | Local | Gap |
|----------|-----------|-------|-----|
| **Heading count** | 34 headings (h2, h3) | 6 headings | **-28 headings missing** |
| **Search filters** | `filtri da applicare` section with 7 category types + checkboxes | Missing entirely | **-7 filter categories** |
| **Search results** | Results list with title, description, URL per result | Missing entirely | **-all results data** |
| **Pagination** | Pagination controls (next/prev, page numbers) | Missing entirely | **-pagination completo** |
| **Rating section** | `id="rating"` with star ratings + feedback form | Missing entirely | **-rating component** |
| **Contact section** | `id="contatta-il-comune"` with address, phone, email | Missing entirely | **-contact info complete** |
| **Breadcrumb** | `breadcrumb-container` with "Cerca" link | Present (different class) | **-breadcrumb styling** |
| **Hero title** | `h1.title-xl-1-semi-bold mb-4` | `h1.title-xl-1-semi-bold mb-4` | **OK (same)** |
| **Sub-headings** | 7 `h2.title-medium-2-semi-bold mb-1` + 3 `h2.!text-white text-lg font-bold` + 5 `h3.text-sm font-bold uppercase tracking-wide` | Limited subset | **-many sub-headings missing** |
| **Search input** | Autocomplete input with label "Cerca una parola chiave" + "Invio" button | Present (different implementation) | **-icon + button style** |
| **Green title style** | `h3.green-title-big t-primary mb-8` (34 instances) | Missing entirely | **-34 green title components** |

## Root Cause Analysis

The local implementation `/it/tests/risultati-ricerca` lacks the complete Design Comuni structure for search results pages. The JSON data (`tests.risultati-ricerca.json`) and Blade component (`pub_theme::components.blocks.search-results.default`) are incomplete and do not render the full set of UI elements expected by the Design Comuni reference.

## Required Fixes (from Discrepancies)

1. **Search Filters Section** (`filtri da applicare`)
   - Add `<h2 class="visually-hidden" id="filter">filtri da applicare</h2>`
   - Add `<fieldset>` with legend "Tipologie" + 7 category checkboxes (unità organizzativa, ambiente, arredo urbano, disinfestazione, igiene urbana, siti tematici, argomenti)
   - Each checkbox: `input[type="checkbox"]` with `class="form-check-input"` + label `class="form-check-label"` + description

2. **Search Results Section**
   - Add `<h2 class="visually-hidden" id="search-result">Risultati di ricerca</h2>`
   - Loop through JSON `content_blocks.it[0].data.results` array
   - Each result: `h3` title + `p` description + `a` URL link

3. **Pagination Section**
   - Add pagination nav with "Prev" / "Next" links + page numbers
   - Use Tailwind classes: `pagination`, `pagination-primary`, `page-item`, `page-link`

4. **Rating Component**
   - Add `<div id="rating">` with star ratings (`input[type="radio"]` name="ratingA" + `label.rating-star`)
   - Add feedback text + success message

5. **Contact Section**
   - Add `<h2 class="title-medium-2-semi-bold">Contatta il comune</h2>`
   - Add contact list: address, phone, email, URP office

6. **Header Adjustments**
   - Ensure breadcrumb has correct styling
   - Maintain current header component but align classes

## JSON Data Updates

Update `laravel/config/local/fixcity/database/content/pages/tests.risultati-ricerca.json` to include:
- Complete `content_blocks.it[0].data.results` array with realistic test data
- `content_blocks.it[1].data.filters` with 7 category options
- `content_blocks.it[2].data.pagination` with prev/next state
- `content_blocks.it[3].data.rating` with stars + feedback
- `content_blocks.it[4].data.contacts` with address, phone, email

## Verification Plan

After implementing fixes:
1. Run `playwright --compare risultati-ricerca local-reference` at 375, 768, 1440px
2. Check HTML body parity ≥90% (via `compare-body-html.mjs`)
3. Check visual parity ≥97% (pixel comparison)
4. Run WCAG audit (Mauve/axe): contrast ≥4.5:1 body, ≥3:1 UI
5. Verify zero console errors, zero missing images, zero horizontal overflow
6. Update `risultati-ricerca-visual-parity.story.md` with new metrics

## BMAD Integration

- Story: `risultati-ricerca-visual-parity.story.md` (already exists, needs update)
- Decision log: Record fixes in `docs/bmad/decision-log.md`
- Second brain: D21 tracking
- Commands: `bash bashscripts/quality-gates/verify-llm-wiki.sh`, Playwright screenshot comparison

## Stack Constraint (D4)

All fixes must use TailwindCSS utilities only — **NO Bootstrap Italia classes, no `.min.css` imports, no `d-none`/`d-md-block` without Tailwind equivalent.**
