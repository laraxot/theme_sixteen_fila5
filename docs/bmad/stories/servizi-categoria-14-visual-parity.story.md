---
id: servizi-categoria-14-visual-parity-97
title: Servizi Categoria 14 Visual Parity 97% Target
type: story
status: draft
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "servizi categoria 14 visual parity 97% target sixteen"
---
# Servizi Categoria 14 Visual Parity 97% Target

## Objective
Achieve at least 97% visual parity with the Design Comuni reference servizi-categoria-14 page (https://italia.github.io/design-comuni-pagine-statiche/sito/servizi-categoria-14.html) for the Sixteen theme.

## Acceptance Criteria
- HTML/body similarity ≥90% (body only, excluding scripts)
- Visual parity ≥98% (pixel+DOM comparison)
- WCAG 2.1 AA: zero errors, contrast ≥4.5:1 body, ≥3:1 UI
- Zero overflow, zero missing images, zero console errors
- All discrepancies resolved (see investigation)

## References
- Reference servizi-categoria-14: https://italia.github.io/design-comuni-pagine-statiche/sito/servizi-categoria-14.html
- Local servizi-categoria-14: http://192.168.1.40:8000/it/tests/servizi-categoria-14 (to be created)
- JSON data: laravel/config/local/fixcity/database/content/pages/servizi-categoria-14.json (to be created)
- Blade template: laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php (Volt component)
- Blocks: laravel/Themes/Sixteen/resources/views/components/blocks/ and sections/
- Header/footer: laravel/config/local/fixcity/database/content/sections/header.json and footer.json

## Implementation Plan
1. Check if the reference page exists and note its structure.
2. Create JSON data for servizi-categoria-14 if it doesn't exist.
3. Ensure the Blade template and components can render the page.
4. Apply TailwindCSS classes to match Design Comuni tokens (colors, spacing, typography).
5. Ensure interactive states (hover, focus, active, disabled) are present.
6. Verify responsive behavior.
7. Validate with Playwright screenshots and pixel comparison.
8. Update BMAD decision log and second brain with lessons learned.

## Tasks
- [ ] Fetch reference page to confirm existence and structure.
- [ ] Create JSON data for servizi-categoria-14 (if needed) with appropriate content_blocks.
- [ ] Verify the [slug].blade.php Volt component correctly handles the slug.
- [ ] Check if any specific components are needed for this page type.
- [ ] Fix any missing sections, headings, buttons, links, or content.
- [ ] Correct visual styling (colors, spacing, typography) to match reference.
- [ ] Ensure the page returns HTTP 200 and no 500 errors.
- [ ] Document the fix in BMAD decision log.
- [ ] Update second brain with any new learnings.

## Verification
- Playwright screenshots at 375, 768, 1440px width
- Pixel comparison with reference
- WCAG audit (axe or similar)
- Manual inspection of each discrepancy
