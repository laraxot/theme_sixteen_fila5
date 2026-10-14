---
id: risultati-ricerca-random-page-fix
title: Fix random Design Comuni page replicate
status: open
type: story
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "fix random design comuni page (risultati-ricerca selected) sixteen"
---
# Fix Random Design Comuni Page (risultati-ricerca selected)

## Page selected
From https://italia.github.io/design-comuni-pagine-statiche/ index: `sito/risultati-ricerca.html`

## Goal
Reproduce Design Comuni page with 90% HTML parity and 97% visual parity using:
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap Italia)
- JSON-driven content
- BMAD + second brain documentation

## Source files
- Reference HTML: https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html
- Local page: http://192.168.1.40:8000/it/tests/risultati-ricerca
- JSON: laravel/config/local/fixcity/database/content/pages/risultati-ricerca.json
- Blade components: pub_theme/components/blocks/search-results/default.blade.php

## Discrepancies found (from comparison)
1. Search button color was wrong (fixed to verde PA #007A52)
2. Button hover/focus states need verification
3. Layout: filters/sorting/pagination rendering verified (all 3 components present)
4. Content: 645 results shown, filters for Tipologie and Argomenti visible

## Tests performed
- Screenshots at 375px, 768px, 1440px (Puppeteer Chrome 148)
- Reference indexed with ctx_fetch_and_index
- Component syntax verified

## Status
- ✅ HTTP 200 OK
- ✅ Content renders (results, filters, pagination)
- ✅ Search button green (#007A52)
- ⚠ Remaining: final visual parity verification with pixel-level comparison

## Actions for full replication
- [ ] Confirm filter sidebar layout at 1440px matches 2-column design
- [ ] Verify result card styling matches reference exactly
- [ ] Verify pagination and rating states
- [ ] Final audit with ux_audit after CSS token fix
- [ ] Update second brain with final learnings from comparison