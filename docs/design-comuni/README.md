# Design Comuni Documentation Index

This directory contains all documentation for the Design Comuni Italiani static pages replication project.

## Overview

The goal is to replicate the Bootstrap Italia design using **Tailwind CSS + Alpine.js** (NO Bootstrap Italia CSS/JS).

**Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
**Local:** http://127.0.0.1:8000/it/tests/homepage

## Documents

| Document | Description | Last Updated |
|----------|-------------|--------------|
| [Homepage HTML Structure Comparison](homepage-html-comparison.md) | Detailed analysis of HTML structure and CSS differences between reference and local homepage | 2026-04-07 |
| [Block Analysis](../../../../_bmad-output/design-comuni-block-analysis.md) | 47 reusable components identified across 38 pages (BMad) | 2026-03-15 |
| [PRD](../../../../_bmad-output/design-comuni-prd.md) | Product Requirements Document (BMad) | 2026-03-15 |
| [Architecture](../../../../_bmad-output/design-comuni-architecture.md) | Technical architecture document (BMad) | 2026-03-15 |
| [UI Spec](../../../../_bmad-output/design-comuni-ui-spec.md) | UI specifications (BMad) | 2026-03-15 |

## Architecture

### Key Files
- **Layout:** `resources/views/components/layouts/main.blade.php` - Adds `dc-homepage-parity` body class
- **Page Component:** `resources/views/components/page.blade.php` - Block assembler
- **Route:** `resources/views/pages/tests/[slug].blade.php` - Dynamic page handler
- **Content:** `config/local/fixcity/database/content/pages/tests.homepage.json`

### CSS Pipeline
- **Entry:** `resources/css/app.css` (2514+ lines)
- **Homepage Parity:** `resources/css/homepage-parity-v2.css` (1252 lines)
- **Style Mapping:** `resources/css/style-apply.css` - Bootstrap Italia → Tailwind @apply
- **Build:** Vite → `public/` → `npm run copy` → `public_html/themes/Sixteen/`

### Block Components
All homepage blocks are in `resources/views/components/blocks/`:
- `hero/homepage.blade.php` - Hero section with news card
- `governance/cards.blade.php` - Organi di governo + events calendar
- `topics/highlight.blade.php` - Argomenti in evidenza + siti tematici
- `search/support-links.blade.php` - Search + useful links
- `feedback/rating.blade.php` - Star rating with Alpine.js
- `contact/homepage.blade.php` - Contact links
- `services/homepage.blade.php` - Services grid
- `administration/homepage.blade.php` - Administration grid

## Screenshots

All comparison screenshots are in the `screenshots/` subdirectory:

### Before Fixes
- [Reference Homepage](screenshots/ref-homepage.png)
- [Local Homepage (before)](screenshots/local-homepage.png)

### After Fixes
- [Local Homepage (after)](screenshots/local-homepage-after-fix.png)
- Section screenshots: hero, calendar, evidence, rating, contacts, footer

## Related Documentation

### Module Docs
- [Cms Module - Page Component Architecture](../../../../Modules/Cms/docs/PAGE_COMPONENT_ARCHITECTURE.md)
- [Theme - Page Routing Architecture](../architecture/PAGE_ROUTING_ARCHITECTURE.md)

### BMad Docs
- [Design Comuni Block Analysis](../../../../_bmad-output/design-comuni-block-analysis.md)
- [Design Comuni PRD](../../../../_bmad-output/design-comuni-prd.md)

## Progress Status

### Completed ✓
- [x] HTML structure comparison
- [x] Screenshot capture and analysis
- [x] CSS color fixes (hero, chip, read-more)
- [x] Rating block styling (white card, green bg, stars)
- [x] Login button styling
- [x] Governance cards layout (3-column)
- [x] Events carousel visibility
- [x] Evidence section styling
- [x] Siti tematici colored cards
- [x] Footer dark navy background
- [x] Documentation with bidirectional links

### In Progress ~
- [ ] Responsive breakpoint testing (mobile/tablet)
- [ ] Alpine.js interactivity (rating steps, carousel)
- [ ] Cross-browser verification

### Planned
- [ ] Remaining 37 pages replication
- [ ] Performance optimization
- [ ] Accessibility audit (WCAG 2.1 AA)
