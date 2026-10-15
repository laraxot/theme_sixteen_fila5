---
id: homepage-visual-parity-97
title: Homepage Visual Parity 97% Target (Tailwind + Alpine + Lit + DaisyUI + Flowbite)
type: story
status: in_progress
links:
  github_issue: #54
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "homepage visual parity 97% target (tailwind + alpine + lit + daisyui + flowbite) sixteen"
---
# Homepage Visual Parity 97% Target (Tailwind + Alpine + Lit + DaisyUI + Flowbite)

## Objective
Achieve at least 97% visual parity with Design Comuni reference homepage (https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html) for the Sixteen theme.

## Acceptance Criteria
- HTML/body similarity ≥90% (body only, excluding scripts)
- Visual parity ≥97% (pixel+DOM comparison at 375, 768, 1440px)
- WCAG 2.1 AA: zero errors, contrast ≥4.5:1 body, ≥3:1 UI
- Zero overflow, zero missing images, zero console errors
- All 14 listed discrepancies from user (m00484) resolved:
  1. Header: search lens icon (white, no black), hamburger (mobile), links underline (removed)
  2. Social: white inline SVG (no letters)
  3. News/Notizie: 18-mag-2022 date badge, "Estate in città" badge (color corrected)
  4. Governance: image+"vai alla pagina" button for gov organs
  5. Calendar: correct color, nav navigation
  6. Argomenti: correct background colors, margins, paddings
  7. Siti tematici: proper bg colors and images
  8. Keyword search: attached lens + "Cerca" label
  9. Rating: behavior fixed
  10. Contatti: spacing corrected

## Stack Confirmed
- **Core framework**: TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite
- **No Bootstrap Italia**: removed @import 'bootstrap-italia.css' and @import './components/bootstrap-italia-classes.css' (m00621-m00642)
- **JSON-driven content**: from laravel/config/local/fixcity/database/content/pages/homepage.json
- **Layout**: uses `<x-layouts.test>` via tests.index route
- **Header/Footer**: CMS-driven via x-section "header" / "footer" using JSON (header.json, footer.json)

## References
- Reference homepage: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- Local homepage: http://192.168.1.40:8000/it/tests (via tests.index)
- JSON data: laravel/config/local/fixcity/database/content/pages/tests.index.json
- Header/footer JSON: laravel/config/local/fixcity/database/content/sections/header.json / footer.json

## Verification Status
- HTTP 200 OK, body 99400 bytes (cached after view:clear → view:cache)
- No bootstrap-italia CDN injected
- All 9 core pages (homepage, segnalazione-dettaglio, segnalazione-01-privacy, segnalazione-02-dati, segnalazione-03-riepilogo, segnalazione-04-conferma, risultati-ricerca, domande-frequenti, eventi) verified via 200 response, no catalog-page fallback
- Page-slug fix applied: `$this->pageSlug = $slug ? 'tests.'.$slug : 'tests.index'` (m00616)
- Template-index parse error (m00617) isolated to stray @endforeach; now balance verified (components/blocks/template-index.blade.php:119)
- JSON-driven layout (m00588) enforced; no duplicate Blade duplication (homepage.blade.php removed)

## Tasks
- [x] Remove Bootstrap Italia CDN (@import removals, m00621-m00642)
- [x] Fix page-slug bug in mount() (m00616)
- [x] Balance template-index Blade loops (m00617)
- [ ] Fix 14 specific discrepancies (ongoing)
- [x] Document all 14 in BMAD docs (architecture, brainstorm, decisions)
- [x] Verify JSON driven content (tests.index)
- [x] Confirm header/footer JSON-driven via x-section
- [x] Run view:clear → view:cache, verify 200 OK

## Next Steps
- Resolve remaining 14 defects (header, search, hamburger, links underline, news, badge, gov organs, calendar, argomenti, siti, keyword search, rating, contatti)
- Run Playwright visual parity at 375, 768, 1440px
- WCAG AA audit
- Final confirmation for 97% visual parity