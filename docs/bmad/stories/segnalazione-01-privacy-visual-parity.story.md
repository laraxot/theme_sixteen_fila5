---
id: segnalazione-01-privacy-visual-parity-97
title: Segnalazione 01 Privacy Visual Parity 97% Target
type: story
status: draft
links:
  github_issue: #999
  discussion: #design-comuni
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "segnalazione 01   privacy sixteen"
---
# Segnalazione 01 — Privacy
## Objective
Achieve at least 97% visual parity with the Design Comuni reference privacy reporting page (https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html) for the Sixteen theme.

## Acceptance Criteria
- HTML/body similarity ≥90% (body only, excluding scripts)
- Visual parity ≥98% (pixel+DOM comparison)
- WCAG 2.1 AA: zero errors, contrast ≥4.5:1 body, ≥3:1 UI
- Zero overflow, zero missing images, zero console errors
- All content matches reference: form fields, steps, helper text, buttons, etc.

## References
- Reference pagina: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html
- Locale: http://192.168.1.40:8000/it/tests/segnalazione-01-privacy
- JSON dati: laravel/config/local/fixcity/database/content/pages/segnalazione-01-privacy.json
- Blade template: laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php (Volt component)
- Componenti: laravel/Themes/Sixteen/resources/views/components/blocks/ and sections/
- Header/footer: laravel/config/local/fixcity/database/content/sections/header.json e footer.json

## Implementation Plan
1. Verify JSON data matches reference structure and content (form steps, fields, labels)
2. Adjust Blade template and components to match reference HTML structure and classes
3. Apply TailwindCSS classes to match Design Comuni tokens (colors, spacing, typography)
4. Ensure interactive states (hover, focus, active, disabled) are present for all form elements
5. Verify responsive behavior at 375, 768, 1440px
6. Validate with Playwright screenshots and pixel comparison
7. Update BMAD decision log and second brain with lessons learned

## Tasks
- [ ] Analyze reference structure (skiplink, header, form steps, fields, buttons)
- [ ] Ensure JSON contains all necessary data for form wizard (steps, fields, validation)
- [ ] Fix missing sections, fields, buttons, helper text
- [ ] Add missing form validation and interactive behavior
- [ ] Correct visual styling (colors, spacing, typography, elevation)
- [ ] Verify file upload functionality if present
- [ ] Confirm success/error states match reference

## Verification
- Playwright screenshots at 375, 768, 1440px width
- Pixel comparison with reference
- WCAG audit (axe or similar)
- Manual inspection of form functionality (tab navigation, screen reader)
- Form submission testing (if applicable)
