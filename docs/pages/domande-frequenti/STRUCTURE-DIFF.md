# HTML Structure Comparison: DOMANDE FREQUENTI

**Analysis Date:** 2026-04-03T09:16:45.823Z

## URLs
- **Local:** http://127.0.0.1:8000/it/tests/domande-frequenti
- **Reference:** https://italia.github.io/design-comuni-pagine-statiche/sito/domande-frequenti.html

## Structural Elements Comparison

| Element | Local | Reference | Diff |
|---------|-------|-----------|------|
| headers | 1 | 1 | 0 ✅ |
| navs | 3 | 3 | 0 ✅ |
| mains | 1 | 1 | 0 ✅ |
| sections | 0 | 1 | -1 ⚠️ |
| articles | 0 | 0 | 0 ✅ |
| asides | 0 | 0 | 0 ✅ |
| footers | 1 | 1 | 0 ✅ |
| divContainers | 9 | 11 | -2 ⚠️ |
| lists | 15 | 19 | -4 ⚠️ |
| listItems | 71 | 75 | -4 ⚠️ |
| forms | 1 | 1 | 0 ✅ |
| inputs | 2 | 18 | -16 ⚠️ |
| buttons | 32 | 31 | +1 ⚠️ |
| scripts | 4 | 3 | +1 ⚠️ |

## Bootstrap Italia Classes Comparison

| Class | Local | Reference | Diff |
|-------|-------|-----------|------|
| .it-page-title | 0 | 0 | 0 ✅ |
| .cmp-hero | 0 | 1 | -1 ⚠️ |
| .evidence-section | 0 | 0 | 0 ✅ |
| .useful-links | 0 | 0 | 0 ✅ |
| .card-teaser | 0 | 2 | -2 ⚠️ |
| .carousel | 0 | 0 | 0 ✅ |
| .faq-item | 9 | 1 | +8 ⚠️ |
| .breadcrumb | 1 | 1 | 0 ✅ |
| .accordion | 1 | 1 | 0 ✅ |

## Heading Structure

| Level | Local | Reference | Match |
|-------|-------|-----------|-------|
| h1 | 1 | 1 | ✅ |
| h2 | 3 | 6 | ⚠️ |
| h3 | 2 | 3 | ⚠️ |
| h4 | 6 | 6 | ✅ |
| h5 | 0 | 0 | ✅ |
| h6 | 0 | 0 | ✅ |

## Structural Parity
- **Identical Elements:** 13/23
- **Different Elements:** 10/23
- **Parity:** 57%
- **Status:** ⚠️ REQUIRES STRUCTURAL ALIGNMENT

## JSON Data Files
- Local data: `laravel/config/local/fixcity/database/content/pages/tests.domande-frequenti.json`
- Template: `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`

## Next Steps
1. ⚠️ HTML structure has significant differences (57% parity)
2. Review differences table above
3. Align blade templates with reference structure
4. Re-run analysis to verify alignment
