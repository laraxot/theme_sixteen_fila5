---
id: evento-dettaglio-visual-parity-97
title: Evento Dettaglio Visual Parity 97% Target
type: story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "evento dettaglio visual parity 97% target sixteen"
---
# Evento Dettaglio Visual Parity 97% Target

## Reference Page
URL: https://italia.github.io/design-comuni-pagine-statiche/sito/evento-dettaglio.html
Reference size: 80,191 bytes
Title: "Festa di Sant'Efisio" (h1 with audio data attribute)

## Reference Structure
- **Header**: breadcrumb navigation, page title, rating section
- **Main Content**: event card with teaser wrapper
- **Card Structure**: `card-wrapper` → `card card-teaser shadow rounded` → `card-body` → `card-title h5 m-0` + image → `card-text`
- **Sections**: breadcrumbs, event details, meta info (date, location, organizer)
- **Footer/Nav**: related links, contact information

## Stack
- TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite (NO Bootstrap Italia)
- All layout driven by JSON (`tests.evento-dettaglio`)
- Page uses `tests.view` Volt component (`pages/[slug].blade.php`) with `layout: test`

## Acceptance Criteria
- 90% HTML body / 90%+ visual parity with Design Comuni `evento-dettaglio.html`
- Event card displays with title, description, metadata
- Breadcrumbs navigation present
- Rating/feedback section present
- Responsive at 375/768/1440px

## Implementation Notes
- Replace Bootstrap `.col-12`/`.row`/`.container` with Tailwind flex/grid
- Replace `.card.card-teaser.shadow.rounded` with Tailwind card + shadow + rounded token
- Replace `.d-flex.justify-content` with Tailwind flex utilities
- Use DaisyUI card component adapted to Tailwind tokens
- Inline SVG for any icons (no Bootstrap icon fonts)