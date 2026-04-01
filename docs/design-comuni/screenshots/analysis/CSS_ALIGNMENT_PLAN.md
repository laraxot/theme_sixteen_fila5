# 🎨 CSS Alignment Plan - Based on Screenshots

**Date**: 2026-03-31  
**Goal**: Make FixCity VISUALLY IDENTICAL to Design Comuni  
**Status**: 🟡 ANALYZING SCREENSHOTS

---

## 📸 Screenshot Analysis

### Reference vs FixCity Comparison

| Viewport | Reference | FixCity | Analysis |
|----------|-----------|---------|----------|
| **Desktop (1920x1080)** | `ref_header_1920.png` | `fix_header_1920.png` | ⏳ Analyzing |
| **Tablet (768x1024)** | `ref_tablet.png` | `fix_tablet.png` | ⏳ Analyzing |
| **Mobile (375x667)** | `ref_mobile.png` | `fix_mobile.png` | ⏳ Analyzing |

---

## 🔍 CSS Elements to Match

### 1. Top Bar (it-header-slim-wrapper)

**Reference Values** (from Design Comuni):
```css
.it-header-slim-wrapper {
    background-color: #003D73;  /* Blu Scuro */
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding: 0.5rem 0;  /* py-2 = 8px */
}

.navbar-brand {
    color: #FFFFFF;
    font-size: 0.875rem;  /* 14px */
    font-weight: 600;  /* Semi-bold */
}
```

**FixCity Current**:
```css
/* Need to verify from screenshot */
```

**Action Items**:
- [ ] Verify exact #003D73 color
- [ ] Verify border opacity (0.2)
- [ ] Verify padding (8px top/bottom)
- [ ] Verify font-size (14px)
- [ ] Verify font-weight (600)

---

### 2. Language Dropdown

**Reference Values**:
```css
.nav-link.dropdown-toggle {
    color: #FFFFFF;
    font-size: 0.875rem;
    padding: 0.25rem 0.5rem;
}

.dropdown-menu {
    background-color: #FFFFFF;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.25rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.dropdown-item {
    color: #333333;
    padding: 0.5rem 1rem;
}

.dropdown-item:hover {
    background-color: #F5F5F5;
}
```

**Action Items**:
- [ ] Verify dropdown positioning
- [ ] Verify border radius
- [ ] Verify shadow
- [ ] Verify hover states

---

### 3. Login Button

**Reference Values**:
```css
.btn.btn-primary.btn-icon.btn-full {
    background-color: #FFFFFF;
    color: #0066CC;
    border: 2px solid #FFFFFF;
    padding: 0.375rem 1rem;
    font-size: 0.875rem;
    font-weight: 600;
    border-radius: 0.25rem;
    gap: 0.5rem;  /* Space between icon and text */
}

.btn:hover {
    background-color: #F0F0F0;
}
```

**Action Items**:
- [ ] Verify exact padding
- [ ] Verify border width (2px)
- [ ] Verify font-weight (600)
- [ ] Verify gap (8px)
- [ ] Verify hover state

---

### 4. Main Header (it-header-center-wrapper)

**Reference Values**:
```css
.it-header-center-wrapper {
    background-color: #FFFFFF;
    padding: 1.5rem 0;  /* py-6 = 24px */
}

.it-brand-wrapper svg.icon {
    width: 82px;
    height: 82px;
}

.it-brand-title {
    color: #0066CC;  /* Blu Italia */
    font-size: 1.5rem;  /* 24px */
    font-weight: 700;  /* Bold */
    line-height: 1.2;
    margin: 0;
}

.it-brand-tagline {
    color: #666666;  /* Grigio Medio */
    font-size: 0.875rem;  /* 14px */
    font-weight: 400;
    margin-top: 0.25rem;  /* 4px */
}
```

**Action Items**:
- [ ] Verify logo size (82x82px)
- [ ] Verify city name color (#0066CC)
- [ ] Verify city name size (24px)
- [ ] Verify tagline color (#666666)
- [ ] Verify tagline size (14px)
- [ ] Verify spacing between title/tagline (4px)

---

### 5. Social Links

**Reference Values**:
```css
.it-socials {
    display: flex;
    align-items: center;
    gap: 0.5rem;  /* 8px */
}

.it-socials > span {
    color: #666666;
    font-size: 0.875rem;
    margin-right: 0.5rem;
}

.it-socials ul {
    display: flex;
    list-style: none;
    gap: 0.75rem;  /* 12px */
}

.it-socials a {
    color: #0066CC;
}

.it-socials a:hover {
    color: #003D73;
}

.icon.icon-sm {
    width: 16px;
    height: 16px;
}
```

**Action Items**:
- [ ] Verify "Seguici su" text color
- [ ] Verify icon size (16x16px)
- [ ] Verify gap between icons (12px)
- [ ] Verify hover color (#003D73)

---

### 6. Navigation

**Reference Values**:
```css
.it-nav-wrapper {
    background-color: #FFFFFF;
    border-top: 1px solid #E0E0E0;
    border-bottom: 1px solid #E0E0E0;
}

.navbar-nav .nav-item .nav-link {
    color: #333333;
    font-size: 1rem;
    font-weight: 500;
    padding: 1rem 1.5rem;
    text-decoration: none;
}

.navbar-nav .nav-item .nav-link:hover {
    color: #0066CC;
    text-decoration: underline;
}

.nav-item.highlighted .nav-link {
    color: #0066CC;
    font-weight: 700;
}
```

**Action Items**:
- [ ] Verify border colors (#E0E0E0)
- [ ] Verify nav link color (#333333)
- [ ] Verify hover color (#0066CC)
- [ ] Verify padding (16px 24px)
- [ ] Verify highlighted item styling

---

## 📊 CSS Variables to Define

```css
:root {
    /* Design Comuni Colors - EXACT VALUES */
    --color-primary-dark: #003D73;    /* Top bar, footer */
    --color-primary: #0066CC;         /* Brand, links */
    --color-primary-light: #4D9BE6;   /* Hover states */
    
    --color-gray-dark: #333333;       /* Primary text */
    --color-gray-medium: #666666;     /* Secondary text */
    --color-gray-light: #999999;      /* Tertiary text */
    --color-gray-lighter: #CCCCCC;    /* Borders */
    --color-gray-lightest: #F2F2F2;   /* Backgrounds */
    
    --color-white: #FFFFFF;
    --color-black: #000000;
    
    /* Spacing */
    --spacing-xs: 0.25rem;   /* 4px */
    --spacing-sm: 0.5rem;    /* 8px */
    --spacing-md: 1rem;      /* 16px */
    --spacing-lg: 1.5rem;    /* 24px */
    --spacing-xl: 2rem;      /* 32px */
    
    /* Typography */
    --font-size-xs: 0.75rem;   /* 12px */
    --font-size-sm: 0.875rem;  /* 14px */
    --font-size-base: 1rem;    /* 16px */
    --font-size-lg: 1.25rem;   /* 20px */
    --font-size-xl: 1.5rem;    /* 24px */
    --font-size-xxl: 2rem;     /* 32px */
    
    /* Font Weights */
    --font-weight-normal: 400;
    --font-weight-medium: 500;
    --font-weight-semibold: 600;
    --font-weight-bold: 700;
    
    /* Border Radius */
    --radius-sm: 0.25rem;   /* 4px */
    --radius-md: 0.5rem;    /* 8px */
    --radius-lg: 0.75rem;   /* 12px */
    
    /* Shadows */
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 8px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 8px 16px rgba(0, 0, 0, 0.15);
}
```

---

## 🎯 Priority Fixes

### P0 - Critical (Must Match Exactly)

1. **Top Bar Background** - #003D73
2. **City Name Color** - #0066CC
3. **Tagline Color** - #666666
4. **Logo Size** - 82x82px
5. **Login Button** - White with correct padding

### P1 - High (Important for Visual Match)

1. **Dropdown Menu** - Positioning and shadow
2. **Social Icons** - Size and spacing
3. **Navigation Links** - Colors and hover states
4. **Border Colors** - #E0E0E0 for nav wrapper

### P2 - Medium (Polish)

1. **Font Weights** - Exact weights
2. **Line Heights** - Exact values
3. **Transition Durations** - Smooth animations

---

## ✅ Action Plan

### Step 1: Create CSS Variables File
- [ ] Create `design-comuni-tokens.css`
- [ ] Define all colors
- [ ] Define all spacing
- [ ] Define all typography

### Step 2: Update Component CSS
- [ ] Update `top-bar.blade.php` styles
- [ ] Update `header-enhanced.blade.php` styles
- [ ] Update `navigation.blade.php` styles
- [ ] Update `footer.blade.php` styles

### Step 3: Verify with Screenshots
- [ ] Compare desktop view
- [ ] Compare tablet view
- [ ] Compare mobile view
- [ ] Verify hover states

### Step 4: Fine-tune
- [ ] Adjust spacing if needed
- [ ] Adjust colors if needed
- [ ] Adjust typography if needed

---

**Status**: 🟡 **SCREENSHOT ANALYSIS IN PROGRESS**  
**Next**: Extract exact CSS values from reference  
**ETA**: 2h for complete CSS alignment

**CSS alignment plan created! Working from screenshots... 🎨📐**
