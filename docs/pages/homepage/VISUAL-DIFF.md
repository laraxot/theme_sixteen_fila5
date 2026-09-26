# Visual Difference Report: homepage

**Analysis Date:** 2026-04-03T10:01:03.665Z

## Section Comparison

### HEADER

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| height | 211 | 222 | -11 ⚠️ |
| width | 1920 | 1920 | ✅ |
| padding | 0px | 0px | ✅ |
| margin | 0px | 0px | ✅ |
| backgroundColor | rgba(0, 0, 0, 0) | rgba(0, 0, 0, 0) | ✅ |
| backgroundImage | none | none | ✅ |
| color | rgb(25, 25, 25) | rgb(25, 25, 25) | ✅ |
| fontSize | 16px | 16px | ✅ |

### FEATURED

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| height | 860 | 860 | ✅ |
| width | 1920 | 1920 | ✅ |
| padding | 0px | 0px | ✅ |
| margin | 0px | 0px | ✅ |
| backgroundColor | rgba(0, 0, 0, 0) | rgba(0, 0, 0, 0) | ✅ |
| backgroundImage | none | none | ✅ |
| color | rgb(26, 26, 26) | rgb(25, 25, 25) | ⚠️ |
| fontSize | 16px | 16px | ✅ |

### EVIDENCE

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| height | 2592 | 1102 | +1490 ⚠️ |
| width | 1920 | 1920 | ✅ |
| padding | 0px | 0px | ✅ |
| margin | 0px | 0px | ✅ |
| backgroundColor | rgba(0, 0, 0, 0) | rgba(0, 0, 0, 0) | ✅ |
| backgroundImage | none | none | ✅ |
| color | rgb(26, 26, 26) | rgb(25, 25, 25) | ⚠️ |
| fontSize | 16px | 16px | ✅ |

### FOOTER

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| height | 775 | 775 | ✅ |
| width | 1920 | 1920 | ✅ |
| padding | 0px | 0px | ✅ |
| margin | 0px | 0px | ✅ |
| backgroundColor | rgb(32, 42, 46) | rgba(0, 0, 0, 0) | ⚠️ |
| backgroundImage | none | none | ✅ |
| color | rgb(255, 255, 255) | rgb(25, 25, 25) | ⚠️ |
| fontSize | 16px | 16px | ✅ |

### CONTAINER

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| width | 1320 | 1320 | ✅ |
| maxWidth | 1320px | 1320px | ✅ |
| marginLeft | 300px | 300px | ✅ |
| marginRight | 300px | 300px | ✅ |
| paddingLeft | 12px | 12px | ✅ |
| paddingRight | 12px | 12px | ✅ |

### SOCIALICONS

| Property | Local | Reference | Diff |
|----------|-------|-----------|------|
| height | 33 | 27 | +6 ⚠️ |
| display | flex | flex | ✅ |
| visibility | visible | visible | ✅ |

## CSS Fixes Required

1. **header height**
   - Local: 211px
   - Reference: 222px
   - CSS: `[class*="header"] { height: 222px !important; }`

2. **evidence height**
   - Local: 2592px
   - Reference: 1102px
   - CSS: `[class*="evidence"] { height: 1102px !important; }`

3. **socialIcons height**
   - Local: 33px
   - Reference: 27px
   - CSS: `[class*="socialIcons"] { height: 27px !important; }`

