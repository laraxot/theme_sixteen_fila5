# 🚨 HOMEPAGE: CRITICAL HTML DIFFERENCES

**Status**: BLOCKER - HTML is only ~60% aligned, not 90%

## 📊 SIZE COMPARISON

| Metric | Reference | Local | Difference |
|--------|-----------|-------|-----------|
| Total bytes | 72,845 | 109,086 | +36,241 (**+49.8%**) |
| Sections | 4 | 5 | +1 EXTRA |
| Divs | 215 | 284 | +69 extra |

## 🔴 CRITICAL ISSUES FOUND

### Issue #1: EXTRA AMMINISTRAZIONE SECTION
- **Status**: 🔴 BLOCKING
- **Problem**: Local has `<section>` or `<div>` with "AMMINISTRAZIONE" heading
- **Reference**: Does NOT have this section
- **Impact**: Breaks structure alignment by 50%+
- **Location**: Between head-section and footer
- **Solution**: REMOVE the entire AMMINISTRAZIONE section from local version

### Issue #2: DUPLICATE "Mario Rossi" 
- **Status**: 🔴 CRITICAL
- **Problem**: "Mario Rossi" appears 2x in local, only 1x in reference
- **Reference**: Mario Rossi card in calendario section only
- **Local**: Mario Rossi appears somewhere else too
- **Solution**: Check why Mario Rossi is duplicated - remove extra occurrence

### Issue #3: HEAD-SECTION TEXT DIFFERENCE
- **Status**: 🟠 HIGH
- **Problem**: Reference has "Parte l'estate..." text, local doesn't
- **Reference**: Full text "Parte l'estate con oltre 300 eventi..."
- **Local**: Missing this exact text content
- **Solution**: Update JSON content to match reference exactly

### Issue #4: CALENDARIO SECTION 50% LARGER
- **Status**: 🟠 HIGH
- **Problem**: calendario is 52.2% larger in local
- **Reference**: 12,151 bytes
- **Local**: 18,494 bytes
- **Reason**: Extra HTML wrapper divs, redundant classes, extra content
- **Solution**: Simplify HTML structure to match reference

### Issue #5: OVERALL HTML BLOAT  
- **Status**: 🟠 HIGH
- **Problem**: 69 extra div tags, many Bootstrap Italia classes
- **Solution**: Remove Bootstrap Italia dependencies, use only necessary HTML structure

## ✅ WHAT'S CORRECT

- ✅ Main sections exist in correct order (head-section, calendario)
- ✅ Number of evento slides matches (7)
- ✅ Overall section hierarchy is OK
- ✅ Navigation structure exists

## 🎯 IMMEDIATE ACTIONS

### Step 1: Identify Extra Sections (URGENT)
```bash
# Check what's between calendario and footer
grep -n "AMMINISTRAZIONE\|block-amministrazione" laravel/config/local/fixcity/database/content/pages/tests.homepage.json
```

### Step 2: Find Duplicate Mario Rossi (URGENT)
```bash
# Check JSON for multiple Mario Rossi entries
grep -n "Mario Rossi" laravel/config/local/fixcity/database/content/pages/tests.homepage.json
```

### Step 3: Compare Calendario HTML Structure
- Extract both calendario sections
- Compare line-by-line
- Remove extra Bootstrap classes
- Simplify div nesting

### Step 4: Fix Content
- Ensure "Parte l'estate..." text is in JSON
- Ensure all content matches reference word-for-word

## ⚠️ ROOT CAUSE ANALYSIS

Why is Local 50% larger?

1. **Extra sections**: AMMINISTRAZIONE section not in reference
2. **Extra wrappers**: Redundant div nesting (col-lg-4, col-sm-6, etc.)
3. **Extra Bootstrap classes**: Accumulation of Bootstrap Italia styles
4. **Duplicate content**: Mario Rossi appears multiple times

## 📋 NEXT STEPS

1. **Find and remove AMMINISTRAZIONE section** → Delete from JSON or disable
2. **Find and remove duplicate Mario Rossi** → Check JSON
3. **Simplify calendario HTML** → Less Bootstrap, more Tailwind
4. **Verify content matches reference word-for-word**

**Current HTML Match**: ~60%  
**Target**: 90%+  
**Blocker**: +50% HTML bloat must be fixed first
