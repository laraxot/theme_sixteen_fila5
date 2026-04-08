# 📊 HTML Body Comparison Report

**Date**: 2026-03-30  
**Upstream**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**FixCity**: http://fixcity.local/it/tests/homepage  
**Goal**: 1:1 HTML match (except scripts)

---

## 🎯 Comparison Status

| Section | Upstream | FixCity | Match? |
|---------|----------|---------|--------|
| **`<body>` tag** | `<body>` | `<body>` | ✅ |
| **Skip Links** | `<div class="skiplink">` | `<div class="skiplink">` | ✅ |
| **Header Wrapper** | `<header class="it-header-wrapper">` | `<x-section slug="header">` | ❌ |
| **Header Slim** | `<div class="it-header-slim-wrapper">` | Rendered via component | ⚠️ |
| **Header Main** | `<div class="it-header-main-wrapper">` | Rendered via component | ⚠️ |
| **Navbar** | `<div class="it-nav-wrapper">` | Rendered via component | ⚠️ |
| **Main Container** | `<main class="container" id="main-container">` | `<main id="main-container">` | ⚠️ |
| **Footer** | `<footer class="it-footer">` | `<x-section slug="footer">` | ❌ |

---

## 🚨 Critical Differences

### 1. Header Structure ❌

**Upstream (EXACT)**:
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <!-- Content -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="it-header-main-wrapper">
    <!-- Content -->
  </div>
  
  <div class="it-nav-wrapper">
    <nav class="navbar navbar-expand-lg">
      <!-- Content -->
    </nav>
  </div>
</header>
```

**FixCity (CURRENT)**:
```html
<x-section slug="header" :data="$headerData ?? []" />
```

**Problem**: Using Blade component instead of EXACT HTML structure.

---

### 2. Footer Structure ❌

**Upstream (EXACT)**:
```html
<footer class="it-footer" id="footer">
  <div class="footer-top">
    <!-- Content -->
  </div>
  <div class="footer-main">
    <!-- Content -->
  </div>
  <div class="footer-bottom">
    <!-- Content -->
  </div>
</footer>
```

**FixCity (CURRENT)**:
```html
<x-section slug="footer" :data="$footerData ?? []" tpl="full" />
```

**Problem**: Using Blade component instead of EXACT HTML structure.

---

### 3. Main Container ⚠️

**Upstream (EXACT)**:
```html
<main class="container" id="main-container">
  <div class="row">
    <div class="col-12">
      <!-- Content -->
    </div>
  </div>
</main>
```

**FixCity (CURRENT)**:
```html
<main id="main-container">
  {{ $slot }}
</main>
```

**Problem**: Missing `class="container"` and row/col structure.

---

## ✅ What Matches

| Element | Status |
|---------|--------|
| **`<body>` tag** | ✅ Match |
| **Skip Links structure** | ✅ Match |
| **Skip Links classes** | ✅ Match |
| **Skip Links hrefs** | ✅ Match |

---

## ❌ What Doesn't Match

| Element | Issue |
|---------|-------|
| **Header** | ❌ Uses `<x-section>` instead of EXACT HTML |
| **Footer** | ❌ Uses `<x-section>` instead of EXACT HTML |
| **Main** | ⚠️ Missing `class="container"` |
| **Row/Col structure** | ⚠️ Missing in main |

---

## 🔧 Required Fixes

### Fix 1: Header HTML (NOT component)

**Replace**:
```blade
<x-section slug="header" :data="$headerData ?? []" />
```

**With**:
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            <!-- EXACT content from upstream -->
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="it-header-main-wrapper">
    <!-- EXACT content -->
  </div>
  
  <div class="it-nav-wrapper">
    <nav class="navbar navbar-expand-lg">
      <!-- EXACT content -->
    </nav>
  </div>
</header>
```

---

### Fix 2: Footer HTML (NOT component)

**Replace**:
```blade
<x-section slug="footer" :data="$footerData ?? []" tpl="full" />
```

**With**:
```html
<footer class="it-footer" id="footer">
  <div class="footer-top">
    <!-- EXACT content from upstream -->
  </div>
  <div class="footer-main">
    <!-- EXACT content -->
  </div>
  <div class="footer-bottom">
    <!-- EXACT content -->
  </div>
</footer>
```

---

### Fix 3: Main Container

**Replace**:
```html
<main id="main-container">
  {{ $slot }}
</main>
```

**With**:
```html
<main class="container" id="main-container">
  <div class="row">
    <div class="col-12">
      {{ $slot }}
    </div>
  </div>
</main>
```

---

## 📊 Match Percentage

| Metric | Current | Target |
|--------|---------|--------|
| **HTML Structure Match** | ~40% | 95%+ |
| **Skip Links** | 100% | 100% ✅ |
| **Header** | 0% (component) | 100% (HTML) |
| **Main** | 50% | 100% |
| **Footer** | 0% (component) | 100% (HTML) |

---

## 🤖 OpenViking Context

```bash
openviking add-memory "HTML comparison: Header/Footer use components instead of EXACT HTML. Need to replace <x-section> with raw HTML structure from upstream. Main missing container class."
```

---

**Last Updated**: 2026-03-30  
**Status**: 🔴 **CRITICAL GAPS**  
**Priority**: P0 - Fix Header/Footer/Main HTML  
**Owner**: Multi-Agent Team
