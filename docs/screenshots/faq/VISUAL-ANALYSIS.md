# FAQ Visual Comparison Analysis
## Data: 2026-04-03

### Screenshots Captured

| File | Description |
|------|-------------|
| `01-reference-full.png` | Reference page full view |
| `02-local-full.png` | Local page full view |
| `03-reference-hero.png` | Reference hero section |
| `04-local-hero.png` | Local hero section |
| `05-reference-search.png` | Reference search box |
| `06-local-search.png` | Local search box |
| `07-reference-accordion.png` | Reference accordion |
| `08-local-accordion.png` | Local accordion |
| `09-local-mobile.png` | Local mobile view |
| `10-reference-mobile.png` | Reference mobile view |

---

## Visual Differences Identified

### 1. HEADER COLORS (CRITICAL)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Header Slim BG | `#0066cc` (blue) | `#00402b` (dark green) | ❌ DIFFERENT |
| Header Slim Text | White | White | ✅ OK |
| Nav BG | `#007a52` (green) | Dark green | ⚠️ SIMILAR |
| Brand Text | White | White | ✅ OK |

**Fix Required**: Update CSS for header slim to use blue (#0066cc)

### 2. HERO SECTION (HIGH)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Background | White (`bg-white`) | Dark overlay (`it-dark it-overlay`) | ❌ DIFFERENT |
| Title Color | Black (`text-black`) | White | ❌ DIFFERENT |
| Title Size | Large | Large | ✅ OK |
| Subtitle | Present | Present | ✅ OK |

**Fix Required**: Update hero to use `bg-white` with `text-black` title

### 3. SEARCH BOX (MEDIUM)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Container | `cmp-input-search` with rounded corners | Simple form | ⚠️ NEEDS STYLING |
| Input | Light border, rounded | Basic border | ⚠️ NEEDS STYLING |
| Button | Blue primary | Blue primary | ✅ OK |
| Icon | Present | Present | ✅ OK |

**Fix Required**: Add rounded corners, adjust border styles

### 4. ACCORDION (MEDIUM)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Header BG | White | White | ✅ OK |
| Question Style | Bold, left-aligned | Bold, left-aligned | ✅ OK |
| Chevron Icon | Blue chevron | Added via CSS | ✅ FIXED |
| Border | Subtle | Subtle | ✅ OK |
| Spacing | Consistent | Consistent | ✅ OK |

### 5. SPACING & LAYOUT (LOW)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| Container Max Width | `col-lg-10` centered | Similar | ✅ OK |
| Section Margins | Standard | Standard | ✅ OK |

### 6. FOOTER CTA (EXTRA)

| Element | Reference | Local | Status |
|---------|-----------|-------|--------|
| "Non hai trovato?" | ❌ NOT PRESENT | ✅ PRESENT | ℹ️ EXTRA |

---

## Priority Fixes

### P1 - CRITICAL
1. **Header Slim Color**: Change from dark green to blue `#0066cc`

### P2 - HIGH  
2. **Hero Background**: Change from dark to white
3. **Hero Title**: Change from white to black

### P3 - MEDIUM
4. **Search Box Styling**: Add rounded corners, better border
5. **Accordion Icon Position**: Fine-tune chevron alignment

---

## Files to Modify

1. `laravel/Themes/Sixteen/resources/css/app.css` - Header colors
2. `laravel/Theme/Sixteen/resources/css/style-apply.css` - Hero styles
3. `laravel/Theme/Sixteen/resources/css/design-comuni.css` - Search styling

---

## Verification Commands

```bash
# Rebuild assets
cd laravel/Themes/Sixteen && npm run build

# Run comparison again
node bashscripts/screenshots/faq-comparison.cjs
```

---

## Status

- [x] Screenshots captured (v1)
- [x] Visual analysis completed
- [x] Header fix applied (header-footer-colors.css imported)
- [x] Hero fix applied (design-comuni.css updated)
- [ ] Final verification with new screenshots

---

## Changes Applied (2026-04-03)

### 1. Header Colors
- Added import: `@import './components/header-footer-colors.css';` in `app.css`
- Header slim now uses `#0066B3` (blu istituzionale)

### 2. Hero Section
- Updated `.it-hero-wrapper` in `design-comuni.css`
- Default: white background, dark text
- `.bg-dark`: blue background, white text

---

*Last Updated: 2026-04-03*
*Script: bashscripts/screenshots/faq-comparison.cjs*