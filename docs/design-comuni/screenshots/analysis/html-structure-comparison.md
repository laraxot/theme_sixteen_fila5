# 📐 HTML Structure Comparison - Reference vs FixCity

**Date**: 2026-03-31  
**Source**: Official Design Comuni Repository  
**File**: `/tmp/design-comuni-pagine-statiche/dist/sito/homepage.html`

---

## 🎯 Header Structure Analysis

### Reference HTML (EXACT)

```html
<!-- TOP BAR -->
<div class="it-header-slim-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-slim-wrapper-content">
          <a class="d-lg-block navbar-brand" href="#" aria-label="Vai al portale {Nome della Regione}">
            Nome della Regione
          </a>
          <div class="it-header-slim-right-zone" role="navigation">
            <div class="nav-item dropdown">
              <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span>ITA</span>
                <svg class="icon">
                  <use href="sprites.svg#it-expand"></use>
                </svg>
              </button>
              <div class="dropdown-menu">
                <ul class="link-list">
                  <li><a class="dropdown-item list-item" href="#">ITA</a></li>
                  <li><a class="dropdown-item list-item" href="#">ENG</a></li>
                </ul>
              </div>
            </div>
            <a class="btn btn-primary btn-icon btn-full" href="#">
              <span class="rounded-icon">
                <svg class="icon icon-primary">
                  <use xlink:href="sprites.svg#it-user"></use>
                </svg>
              </span>
              <span class="d-none d-lg-block">Accedi all'area personale</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MAIN HEADER -->
<div class="it-nav-wrapper">
  <div class="it-header-center-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-center-content-wrapper">
            <div class="it-brand-wrapper">
              <a href="homepage.html">
                <svg width="82" height="82" class="icon" aria-hidden="true">
                  <image xlink:href="logo-comune.svg"/>
                </svg>
                <div class="it-brand-text">
                  <div class="it-brand-title">Il mio Comune</div>
                  <div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
                </div>
              </a>
            </div>
            <div class="it-right-zone">
              <div class="it-socials d-none d-lg-flex">
                <span>Seguici su</span>
                <ul>
                  <li><a href="#" target="_blank">Twitter</a></li>
                  <li><a href="#" target="_blank">Facebook</a></li>
                  <!-- more social links -->
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

---

## 🔍 Key Differences Identified

### Top Bar

| Element | Reference | FixCity | Issue |
|---------|-----------|---------|-------|
| **Wrapper Class** | `it-header-slim-wrapper-content` | Missing | ❌ |
| **Region Link** | `<a>` with aria-label | `<span>` | ❌ |
| **Language Selector** | Bootstrap dropdown with SVG icon | Simple buttons | ❌ |
| **Login Button** | `btn btn-primary btn-icon btn-full` with SVG | Simple button with icon | ❌ |
| **Right Zone** | `it-header-slim-right-zone` | Missing | ❌ |

### Main Header

| Element | Reference | FixCity | Issue |
|---------|-----------|---------|-------|
| **Wrapper Order** | `it-nav-wrapper` > `it-header-center-wrapper` | Reversed | ❌ |
| **Content Wrapper** | `it-header-center-content-wrapper` | Missing | ❌ |
| **Brand Wrapper** | `it-brand-wrapper` with SVG logo | Simple img tag | ❌ |
| **Brand Title** | `it-brand-title` class | `h5` | ❌ |
| **Brand Tagline** | `it-brand-tagline d-none d-md-block` | Simple `p` | ❌ |
| **Social Section** | `it-right-zone` > `it-socials` | Simple div | ❌ |

---

## 📐 Footer Structure Analysis

### Reference HTML (EXACT)

```html
<footer class="it-footer" id="footer">
  <div class="it-footer-main">
    <div class="container">
      <div class="row">
        <div class="col-12 footer-items-wrapper logo-wrapper">
          <img class="ue-logo" src="logo-eu-inverted.svg" alt="logo Unione Europea">
          <div class="it-brand-wrapper">
            <a href="#">
              <svg class="icon" aria-hidden="true">
                <use xlink:href="sprites.svg#it-pa"></use>
              </svg>
              <div class="it-brand-text">
                <h2 class="no_toc">Nome del Comune</h2>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 footer-items-wrapper">
          <h4 class="footer-heading-title">Amministrazione</h4>
          <ul class="footer-list">
            <li><a href="#">Organi di governo</a></li>
            <li><a href="#">Aree amministrative</a></li>
            <!-- more links -->
          </ul>
        </div>
        <div class="col-md-6 footer-items-wrapper">
          <h4 class="footer-heading-title">Categorie di servizio</h4>
          <div class="row">
            <div class="col-md-6">
              <ul class="footer-list">
                <!-- links -->
              </ul>
            </div>
          </div>
        </div>
        <!-- more columns -->
      </div>
    </div>
  </div>
</footer>
```

---

## 🔍 Footer Differences

| Element | Reference | FixCity | Issue |
|---------|-----------|---------|-------|
| **Main Wrapper** | `it-footer-main` | Missing | ❌ |
| **Logo Wrapper** | `footer-items-wrapper logo-wrapper` | Missing | ❌ |
| **UE Logo** | `<img class="ue-logo">` | Missing | ❌ |
| **Brand SVG** | SVG with `#it-pa` | Simple text | ❌ |
| **Heading Class** | `footer-heading-title` | `h3` | ❌ |
| **List Class** | `footer-list` | `ul` without class | ❌ |
| **Column Wrapper** | `footer-items-wrapper` | Missing | ❌ |

---

## ✅ Required Corrections

### Priority 1: Structure

1. **Top Bar**
   - Add `it-header-slim-wrapper-content` wrapper
   - Change region name to `<a>` link
   - Add `it-header-slim-right-zone` wrapper
   - Convert language selector to Bootstrap dropdown
   - Convert login to proper button with SVG

2. **Main Header**
   - Fix wrapper order: `it-nav-wrapper` > `it-header-center-wrapper`
   - Add `it-header-center-content-wrapper`
   - Add `it-brand-wrapper` with proper structure
   - Add `it-brand-title` and `it-brand-tagline` classes
   - Add `it-right-zone` and `it-socials` structure

3. **Footer**
   - Add `it-footer-main` wrapper
   - Add `footer-items-wrapper` classes
   - Add UE logo
   - Convert to SVG brand with `#it-pa`
   - Add `footer-heading-title` classes
   - Add `footer-list` classes to all lists

### Priority 2: Colors (Already Fixed)

- ✅ Top Bar: `#003D73`
- ✅ Header: `#0066CC`, `#666666`
- ✅ Footer: `#003D73`, `rgba(255,255,255,0.8)`

---

**Status**: 🟡 **STRUCTURE ANALYSIS COMPLETE**  
**Next**: Update blade components with exact HTML structure  
**Priority**: P0 (Critical - HTML mismatch)

**HTML structure documented! 📐**
