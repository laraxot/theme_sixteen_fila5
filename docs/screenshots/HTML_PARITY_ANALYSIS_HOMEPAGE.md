# HTML Parity Analysis: Homepage

**Date**: April 1, 2026  
**Status**: ❌ **FAILED** - HTML is NOT identical  
**Source**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**Target**: http://127.0.0.1:8000/it/tests/homepage

---

## Executive Summary

**HTML parity: NOT ACHIEVED** ❌

- **Source lines**: 1328
- **Target lines**: 1273
- **Difference**: -55 lines (-4.1%)

**Critical issues found**:
1. Skiplink href mismatch (`#main-container` vs `#main-content`)
2. HTML formatting differences (whitespace, newlines)
3. SVG sprite paths may differ
4. Header structure needs verification

---

## Detailed Differences

### 1. Skiplink Component ❌

**Source** (Design Comuni):
```html
<div class="skiplink">
  <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
  <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>
```

**Target** (FixCity):
```html
<div class="skiplink">
  <a class="visually-hidden-focusable" href="#main-content">Vai ai contenuti</a>
  <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>
```

**Difference**: 
- ❌ `href="#main-container"` (source) vs `href="#main-content"` (target)

**Impact**: 
- Accessibility issue - screen users won't be directed to correct main content area
- WCAG 2.1 AA compliance failure

**Fix Required**:
```blade
{{-- In header component or layout --}}
<a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
```

---

### 2. Header Structure ⚠️

**Source** (Design Comuni):
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="..." title="...">Nome della Regione</a>
            <div class="it-header-slim-right-zone" role="navigation">
              ...
```

**Target** (FixCity):
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <a class="d-lg-block navbar-brand" 
               target="_blank" 
               href="#" 
               aria-label="..." 
               title="...">
                Nome della Regione
            </a>
            <div class="it-header-slim-right-zone" role="navigation">
              ...
```

**Difference**: 
- ⚠️ Formatting/whitespace differences (newlines in attributes)
- ✅ Structure appears similar

**Impact**: 
- Low - formatting doesn't affect rendering
- But makes diff comparison harder

**Fix Required**:
- Consider minifying HTML output for cleaner comparison
- Or adjust formatting to match source exactly

---

### 3. SVG Icons 🔍

**Source** (Design Comuni):
```html
<svg class="icon">
  <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
</svg>
```

**Target** (FixCity):
```html
<svg class="icon">
  <use href="[NEED TO VERIFY]"></use>
</svg>
```

**Status**: NEEDS VERIFICATION

**Action Required**:
1. Check current SVG sprite path in FixCity
2. Ensure it matches Design Comuni structure
3. Verify all icons use correct paths

---

## HTML Structure Comparison

### Body Tag

| Attribute | Source | Target | Match |
|-----------|--------|--------|-------|
| Class | None | None | ✅ |
| Data attributes | None | None | ✅ |
| Style | None | None | ✅ |

### Skiplink

| Element | Source | Target | Match |
|---------|--------|--------|-------|
| Container class | `skiplink` | `skiplink` | ✅ |
| Link 1 href | `#main-container` | `#main-content` | ❌ |
| Link 1 text | `Vai ai contenuti` | `Vai ai contenuti` | ✅ |
| Link 2 href | `#footer` | `#footer` | ✅ |
| Link 2 text | `Vai al footer` | `Vai al footer` | ✅ |

### Header

| Element | Source | Target | Match |
|---------|--------|--------|-------|
| Header class | `it-header-wrapper` | `it-header-wrapper` | ✅ |
| Data attribute | `data-bs-target="#header-nav-wrapper"` | Same | ✅ |
| Slim wrapper class | `it-header-slim-wrapper` | Same | ✅ |
| Container class | `container` | Same | ✅ |
| Row class | `row` | Same | ✅ |
| Col class | `col-12` | Same | ✅ |
| Content class | `it-header-slim-wrapper-content` | Same | ✅ |

---

## Action Items

### Critical (Must Fix)

1. **Fix skiplink href** 
   - **File**: `laravel/Themes/Sixteen/resources/views/components/layouts/main.blade.php` or header component
   - **Change**: `href="#main-content"` → `href="#main-container"`
   - **Priority**: HIGH (accessibility)

2. **Verify SVG sprite paths**
   - **File**: All components using icons
   - **Check**: Ensure paths match `../assets/bootstrap-italia/dist/svg/sprites.svg`
   - **Priority**: HIGH (visual parity)

### Medium (Should Fix)

3. **Standardize HTML formatting**
   - **Decision**: Minify or expand to match source?
   - **File**: Blade templates
   - **Priority**: MEDIUM (maintainability)

4. **Verify all header sections**
   - Slim wrapper ✅
   - Brand wrapper (needs check)
   - Center wrapper (needs check)
   - Navbar wrapper (needs check)
   - **Priority**: MEDIUM

### Low (Nice to Have)

5. **Remove inline styles**
   - **Source**: `style=""` (empty)
   - **Target**: Should match
   - **Priority**: LOW

---

## Testing Checklist

### Accessibility
- [ ] Skiplink directs to correct ID (`#main-container`)
- [ ] All interactive elements keyboard accessible
- [ ] ARIA labels present and correct
- [ ] Focus indicators visible

### Visual
- [ ] Header renders correctly (all sections)
- [ ] Icons display correctly (SVG sprites)
- [ ] Colors match exactly
- [ ] Spacing matches exactly

### Performance
- [ ] HTML size comparable (~1300 lines)
- [ ] No unnecessary whitespace
- [ ] Minification working (if used)

---

## Next Steps

1. **Immediate**: Fix skiplink href (`#main-content` → `#main-container`)
2. **Today**: Verify all SVG sprite paths
3. **This week**: Complete header replication
4. **This week**: Complete footer replication
5. **Next week**: Full HTML parity audit

---

## Screenshot Comparison

### Desktop (1920x1080)
**Status**: PENDING
**File**: `Themes/Sixteen/docs/screenshots/homepage-desktop-comparison.png`

### Mobile (375x812)
**Status**: PENDING
**File**: `Themes/Sixteen/docs/screenshots/homepage-mobile-comparison.png`

---

## Tools Used

### HTML Extraction
```bash
# Source (Design Comuni)
curl -s "https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html" | \
  sed -n '/<body/,/<\/body>/p' | \
  sed '/<script/d' | \
  sed '/<\/script>/d' > /tmp/design_comuni_homepage_body.html

# Target (FixCity)
curl -s "http://127.0.0.1:8000/it/tests/homepage" | \
  sed -n '/<body/,/<\/body>/p' | \
  sed '/<script/d' | \
  sed '/<\/script>/d' > /tmp/fixcity_homepage_body.html
```

### Comparison
```bash
diff -u /tmp/design_comuni_homepage_body.html /tmp/fixcity_homepage_body.html | head -100
```

### Line Count
```bash
wc -l /tmp/design_comuni_homepage_body.html  # 1328 lines
wc -l /tmp/fixcity_homepage_body.html        # 1273 lines
```

---

## Conclusion

**HTML parity status: ❌ NOT ACHIEVED**

**Critical issues**: 1 (skiplink href)  
**Medium issues**: 2 (formatting, SVG paths)  
**Low issues**: 1 (inline styles)

**Estimated time to fix**: 2-4 hours  
**Priority**: HIGH (blocker for Phase 1 completion)

---

**Analysis Date**: April 1, 2026  
**Analyst**: AI Agent  
**Next Review**: After skiplink fix (April 2, 2026)

---

## References

- **Source HTML**: `/tmp/design_comuni_homepage_body.html` (1328 lines)
- **Target HTML**: `/tmp/fixcity_homepage_body.html` (1273 lines)
- **Diff Output**: Command output above
- **Team Guide**: `Themes/Sixteen/docs/DESIGN_COMUNI_TEAM_GUIDE.md`
- **Project Summary**: `Themes/Sixteen/docs/DESIGN_COMUNI_PROJECT_SUMMARY.md`
