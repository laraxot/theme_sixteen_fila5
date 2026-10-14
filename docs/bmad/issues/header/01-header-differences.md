---
title: "Header Issues (m00434)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "header issues (m00434) sixteen"
---
# Header Issues (m00434)

## Visual Parity Issues (40% → 97%)

### 1. Header SVG Logo (m00409)
**Issue**: Local page shows text logo instead of SVG logo in header
**Reference**: SVG logo (`themes/Sixteen/design-comuni/assets/images/logo-comune.svg`) should appear in header
**Fix**: Ensure SVG logo is properly loaded in `pub_theme::components.sections.header.tailwind` component

### 2. Search Functionality (m00409)
**Issue**: Search box in header lacks search icon and "Invio" button
**Reference**: Reference has search icon + "Invio" button in search modal
**Fix**: Update search input field to include icon + button; ensure modal ID matches reference

### 3. Hamburger Menu (m00409)
**Issue**: Hamburger menu only appears on mobile; should appear on desktop in narrow viewports
**Reference**: Reference shows hamburger menu on mobile viewports (<768px)
**Fix**: Ensure responsive behavior matches reference (mobile-first approach)

### 4. Link Styling (m00409)
**Issue**: All links are underlined (Bootstrap Italia style)
**Reference**: Reference uses clean links without underlines
**Fix**: Remove `text-decoration-underline` from all link classes

### 5. Event Title (m00409)
**Issue**: Missing "Notizie 18 mag 2022" label and wrong title text
**Reference**: Shows "Notizie 18 mag 2022" with specific styling
**Fix**: Add proper label class and correct title text

### 6. "Estate in città" Badge (m00409)
**Issue**: Missing badge for summer events
**Reference**: Has "Estate in città" badge with specific styling
**Fix**: Add badge element with proper class and positioning

### 7. Organi di Governo Box (m00409)
**Issue**: Missing image and "Vai alla pagina" button
**Reference**: Has image + "Vai alla pagina" button
**Fix**: Add image component + button with proper classes

### 8. Calendario Eventi (m00409)
**Issue**: Calendar layout incorrect
**Reference**: Has specific calendar structure with date/title layout
**Fix**: Rebuild calendar structure to match reference

### 9. Argomenti in Evidenza (m00409)
**Issue**: Geometric background and padding issues
**Reference**: Has specific geometric background and padding structure
**Fix**: Apply correct background class and padding utilities

### 10. Siti Tematici (m00409)
**Issue**: Wrong background colors and missing images
**Reference**: Has specific background colors and images
**Fix**: Apply correct background classes and image elements

### 11. Ricerca Parola Chiave (m00409)
**Issue**: Missing search icon and "Invio" button
**Reference**: Has search icon + "Invio" button
**Fix**: Add search icon + button to search input field

### 12. Rating Component (m00409)
**Issue**: Incorrect rating behavior
**Reference**: Has proper rating stars with active states
**Fix**: Fix rating star behavior and active states

### 13. Contatti (m00409)
**Issue**: Spacing issues in contact section
**Reference**: Has specific spacing structure
**Fix**: Apply correct padding/margin utilities

## Verification Steps
1. Use Playwright to capture local and reference screenshots
2. Run `bash bashscripts/design-comuni/visual-parity-check.sh`
3. Verify with `ux_audit` for CSS compliance
4. Confirm with `ctx_search` for specific element presence

## Documentation Requirements
- Create `header-architecture.md` with block diagram
- Document all differences in `docs/bmad/issues/header/01-header-differences.md`
- Update `docs/bmad/parity-status.md` with new metrics
