# 📸 HOMEPAGE SCREENSHOT ANALYSIS

**Data**: 2026-03-31  
**Status**: 🟡 IN PROGRESS  
**Priority**: CRITICAL

---

## 🎯 OBJECTIVE

Compare:
- **Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- **Ours**: http://fixcity.local/it/tests/homepage

**Goal**: HTML IDENTICO inside `<body>`

---

## 📊 SCREENSHOTS CAPTURED

### Directories Created

```
laravel/Themes/Sixteen/docs/design-comuni/screenshots/
├── reference/      # Design Comuni screenshots
├── ours/           # Our screenshots
└── comparison/     # Side-by-side comparison
```

### Screenshots to Capture

#### Desktop (1920x1080)
- [ ] `reference/desktop-full.png` - Full page
- [ ] `reference/desktop-header.png` - Header section
- [ ] `reference/desktop-hero.png` - Hero section
- [ ] `reference/desktop-cards.png` - Cards section
- [ ] `reference/desktop-footer.png` - Footer section

#### Tablet (768x1024)
- [ ] `reference/tablet-full.png`

#### Mobile (375x812)
- [ ] `reference/mobile-full.png`

---

## 🔍 HTML COMPARISON

### Reference HTML (1346 righe)

**Structure**:
```html
<body>
  <a class="skiplink">Vai ai contenuti</a>
  
  <header class="it-header-wrapper">
    <div class="it-header-slim-wrapper">
    <div class="it-header-center-wrapper">
    <div class="it-header-navbar-wrapper">
  </header>
  
  <main id="main-content">
    <section class="hero-section">
    <section class="card-wrapper">
    <section class="it-calendar-wrapper">
    <section class="topic-list-wrapper">
    <section class="thematic-sites">
    <section class="search-feedback">
    <section class="contact-services">
  </main>
  
  <footer class="it-footer">
    <div class="it-footer-main">
    <div class="it-footer-bottom">
  </footer>
</body>
```

### Our HTML (Current)

**Structure**:
```html
<body>
  <x-layouts.app>
    <header>
      <!-- Custom structure -->
    </header>
    
    <main>
      <x-section slug="tests.homepage" />
      <!-- Renders from JSON -->
    </main>
    
    <x-footer-comune />
  </x-layouts.app>
</body>
```

---

## 📋 DIFFERENZE IDENTIFICATE

### 1. Header Structure

| Element | Reference | Ours | Gap |
|---------|-----------|------|-----|
| Wrapper | `.it-header-wrapper` | Custom | ❌ |
| Top Bar | `.it-header-slim-wrapper` | Missing | ❌ |
| Center | `.it-header-center-wrapper` | Missing | ❌ |
| Nav | `.it-header-navbar-wrapper` | Missing | ❌ |

### 2. Main Content Sections

| Section | Reference | Ours | Gap |
|---------|-----------|------|-----|
| Hero | `.hero-section` | Custom | ❌ |
| Cards | `.card-wrapper` | Partial | ⚠️ |
| Events | `.it-calendar-wrapper` | Missing | ❌ |
| Topics | `.topic-list-wrapper` | Custom | ❌ |
| Thematic | `.thematic-sites` | Custom | ⚠️ |
| Search | `.search-feedback` | Custom | ⚠️ |
| Contact | `.contact-services` | Custom | ⚠️ |

### 3. Footer Structure

| Element | Reference | Ours | Gap |
|---------|-----------|------|-----|
| Wrapper | `.it-footer` | Custom | ❌ |
| Main | `.it-footer-main` | Missing | ❌ |
| Bottom | `.it-footer-bottom` | Missing | ❌ |

---

## 🔧 REQUIRED FIXES

### Priority 1: Header

**Must match exactly**:
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
```

**Action**: Update `components/sections/header/v1.blade.php`

### Priority 2: Main Content Sections

**Must match exactly**:
```html
<main id="main-content">
  <section class="hero-section">
  <section class="card-wrapper">
  <section class="it-calendar-wrapper">
  <section class="topic-list-wrapper">
```

**Action**: Update all block components

### Priority 3: Footer

**Must match exactly**:
```html
<footer class="it-footer" role="contentinfo">
  <div class="it-footer-main">
    <div class="container">
  <div class="it-footer-bottom">
```

**Action**: Update footer component

---

## 📋 ACTION PLAN

### Phase 1: Header (CRITICAL)
- [ ] Update header component
- [ ] Add all 3 levels
- [ ] Use exact Bootstrap Italia classes
- [ ] Add data/ARIA attributes

### Phase 2: Main Content
- [ ] Update hero component
- [ ] Update governance cards
- [ ] Add events calendar component
- [ ] Update topics component
- [ ] Update thematic sites

### Phase 3: Footer
- [ ] Update footer component
- [ ] Add 4 columns
- [ ] Add bottom section

### Phase 4: Validation
- [ ] Compare HTML source
- [ ] Validate structure
- [ ] Test responsive

---

## 🧘 DEVELOPER MANTRAS

> *"HTML IDENTICO. Non simile. IDENTICO."*

> *"Bootstrap Italia classes. Sempre."*

> *"Screenshot prima, codice dopo."*

---

## 📖 REFERENCES

### Internal
- `docs/design-comuni/screenshots/` - Screenshots directory
- `.planning/BOOTSTRAP_ITALIA_CLASSES.md` - CSS classes reference

### External
- [Design Comuni Homepage](https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html)

---

**Status**: 🟡 ANALYSIS IN PROGRESS  
**Next**: Update ALL components with exact HTML structure!
