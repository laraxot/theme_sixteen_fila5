# HTML Parity Analysis - segnalazione-dettaglio

**Generated**: 2026-04-08  
**Current Score**: 45.5% (366/804 elements)  
**Target**: ≥90% (≥723 elements)  
**Gap**: ~357 elements needed

## Current Status

| Metric | Value |
|--------|-------|
| Reference elements | 804 |
| Local elements | 509 |
| Identical | 366 (45.5%) |
| Different | 134 |
| Missing in local | 304 |
| Extra in local | 9 |

## Root Cause Analysis

The **local implementation is incomplete** compared to reference:

### Missing Elements by Type

1. **List items (`<li>`)**: 9 missing
   - Expected in reference: Footer sections, navigation items
   - Local should have lists but are empty or missing

2. **SVG/Icons (`<svg>`, `<use>`)**: 14 missing (7 svg + 7 use)
   - Reference uses inline SVGs for icons
   - Local may be using different icon approach

3. **Structural elements**: div, span, button
   - Missing ~18 structural divs/spans
   - Missing 4 buttons (likely action buttons)

4. **Links (`<a>`)**: 5 missing
   - Navigation and reference links

### Attribute Differences

**Common Issue**: `xlink:href` vs `href` in SVG `<use>` elements
- Reference uses: `xlink:href="/path"`
- Local uses: `href="/path"`
- SVG namespace handling difference

## Strategy to Reach 90%

### Phase 1: Quick Wins (Low Effort, High Impact)
1. Fix SVG `xlink:href` → `href` namespace mapping
2. Add missing list items in footer sections
3. Ensure all navigation items are rendered

### Phase 2: Structural Completion
1. Review missing buttons → add missing action buttons
2. Review missing divs/spans → ensure section nesting matches
3. Verify all grid/flex wrappers exist

### Phase 3: Detailed Fixes
1. Element-by-element comparison using `reference-structure.json` vs `local-structure.json`
2. Identify sections in reference that don't exist in local
3. Add missing sections to blade or JSON config

## Next Steps

1. **Inspect reference structure** (`reference-structure.json`)
2. **Inspect local structure** (`local-structure.json`)
3. **Find top-level missing sections** (breadcrumb? footer? navigation?)
4. **Update blade/JSON config** to include missing sections
5. **Re-run comparison** and verify new score

## Files to Examine

- Reference HTML: `laravel/Themes/Sixteen/docs/prompts/segnalazione-dettaglio/reference.html`
- Reference structure: `laravel/Themes/Sixteen/docs/body-structure-comparison/segnalazione-dettaglio/reference-structure.json`
- Local structure: `laravel/Themes/Sixteen/docs/body-structure-comparison/segnalazione-dettaglio/local-structure.json`

## Critical Questions

1. Is local page rendering all blocks? (header, breadcrumb, content, footer)
2. Are all navigation items visible?
3. Are all footer sections populated?
4. Are all icons rendering correctly?

