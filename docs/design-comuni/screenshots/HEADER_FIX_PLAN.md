# 🎨 Header Fix - Complete Implementation Plan

**Data**: 2026-03-31  
**Stato**: 🔴 **IN CORSO - Header da rifare**

## 📸问题分析

### Screenshot Comparativi
1. **Original**: `screenshots/08-original-full-header.png`
2. **FixCity**: `screenshots/09-fixcity-full-header.png`

## 🔴 Elementi Mancanti

### Header Center (Sezione Principale)

**Originale**:
```html
<div class="it-header-center-content-wrapper">
  <div class="it-brand-wrapper">
    <a href="homepage.html">
      <svg width="82" height="82" class="icon">
        <image xlink:href="logo-comune.svg"/>
      </svg>
      <div class="it-brand-text">
        <div class="it-brand-title">Il mio Comune</div>
        <div class="it-brand-slogan">Slogan del Comune</div>
      </div>
    </a>
  </div>
  
  <div class="it-right-zone">
    <!-- Social icons -->
    <!-- Search bar -->
  </div>
</div>
```

**FixCity**: ❌ **QUESTA STRUTTURA MANCA!**

## 🔧 Fix Header Component

### File da Creare/Modificare

**File**: `resources/views/components/bootstrap-italia/header.blade.php`

**Struttura Completa**:
```blade
<header class="it-header-wrapper">
  {{-- Header Slim --}}
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            {{-- Regione/Comune link --}}
            <a class="d-lg-block navbar-brand" href="#">
              Nome della Regione
            </a>
            
            {{-- Right Zone: Language + Login --}}
            <div class="it-header-slim-right-zone">
              {{-- Language Selector --}}
              <div class="nav-item dropdown">
                <button class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                  <span>ITA</span>
                </button>
                <div class="dropdown-menu">
                  <ul class="link-list">
                    <li><a href="#">ITA</a></li>
                    <li><a href="#">ENG</a></li>
                  </ul>
                </div>
              </div>
              
              {{-- Login Button --}}
              <a class="btn btn-primary btn-icon btn-full" href="#">
                <span class="rounded-icon">
                  <svg class="icon icon-primary">
                    <use href="#it-user"></use>
                  </svg>
                </span>
                <span>Accedi all'area personale</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  {{-- Header Center - CRITICAL SECTION --}}
  <div class="it-header-center-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-center-content-wrapper">
            {{-- Brand Wrapper (Logo + Name + Slogan) --}}
            <div class="it-brand-wrapper">
              <a href="/">
                {{-- Logo SVG (82x82) --}}
                <svg width="82" height="82" class="icon">
                  <image xlink:href="/themes/sixteen/assets/images/logo-comune.svg"/>
                </svg>
                
                {{-- Brand Text --}}
                <div class="it-brand-text">
                  <div class="it-brand-title">Il mio Comune</div>
                  <div class="it-brand-slogan">Slogan del Comune</div>
                </div>
              </a>
            </div>
            
            {{-- Right Zone: Social + Search --}}
            <div class="it-right-zone">
              {{-- Social Icons --}}
              <div class="it-socials">
                <h4 class="sr-only">Seguici su</h4>
                <ul class="list-inline">
                  <li><a href="#"><svg class="icon"><use href="#it-facebook"></use></svg></a></li>
                  <li><a href="#"><svg class="icon"><use href="#it-twitter"></use></svg></a></li>
                  <li><a href="#"><svg class="icon"><use href="#it-youtube"></use></svg></a></li>
                </ul>
              </div>
              
              {{-- Search Bar --}}
              <div class="it-search-wrapper">
                <form role="search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cerca...">
                    <button class="btn" type="submit">
                      <svg class="icon"><use href="#it-search"></use></svg>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  {{-- Header Navbar --}}
  <div class="it-header-navbar-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
              <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Servizi</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Novità</a></li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
</header>
```

## 🎨 CSS Fixes

### File: `resources/css/design-comuni.css`

**Aggiungere**:

```css
/* Header Center - CRITICAL */
.it-header-center-wrapper {
  background-color: #FFFFFF !important;
  padding: 1.5rem 0;
  border-bottom: 1px solid #E5E7EB;
}

.it-header-center-content-wrapper {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
}

/* Brand Wrapper */
.it-brand-wrapper {
  display: flex;
  align-items: center;
}

.it-brand-wrapper a {
  display: flex;
  align-items: center;
  gap: 1rem;
  text-decoration: none;
  color: #000000;
}

.it-brand-wrapper a:hover {
  color: #0066B3;
}

/* Brand Text */
.it-brand-text {
  display: flex;
  flex-direction: column;
}

.it-brand-title {
  font-size: 1.5rem;
  font-weight: 700;
  color: #000000;
  line-height: 1.2;
}

.it-brand-slogan {
  font-size: 0.875rem;
  color: #666666;
  margin-top: 0.25rem;
}

/* Right Zone */
.it-right-zone {
  display: flex;
  align-items: center;
  gap: 2rem;
}

/* Social Icons */
.it-socials ul {
  display: flex;
  gap: 0.5rem;
  list-style: none;
  padding: 0;
  margin: 0;
}

.it-socials a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 2rem;
  height: 2rem;
  color: #0066B3;
  transition: color 0.2s;
}

.it-socials a:hover {
  color: #003366;
}

/* Search Wrapper */
.it-search-wrapper {
  flex: 1;
  max-width: 300px;
}

.it-search-wrapper .input-group {
  display: flex;
  gap: 0;
}

.it-search-wrapper .form-control {
  flex: 1;
  padding: 0.5rem 1rem;
  border: 1px solid #E5E7EB;
  border-radius: 0.25rem 0 0 0.25rem;
}

.it-search-wrapper .btn {
  padding: 0.5rem 1rem;
  background-color: #0066B3;
  color: #FFFFFF;
  border: none;
  border-radius: 0 0.25rem 0.25rem 0;
}
```

## ✅ Checklist Fix

### Header Center
- [ ] Creare `it-brand-wrapper`
- [ ] Aggiungere logo SVG (82x82)
- [ ] Aggiungere `it-brand-title`
- [ ] Aggiungere `it-brand-slogan`
- [ ] Aggiungere `it-right-zone`
- [ ] Aggiungere social icons
- [ ] Aggiungere search bar

### CSS
- [ ] Aggiungere stili per `.it-header-center-content-wrapper`
- [ ] Aggiungere stili per `.it-brand-wrapper`
- [ ] Aggiungere stili per `.it-brand-title`
- [ ] Aggiungere stili per `.it-brand-slogan`
- [ ] Aggiungere stili per `.it-right-zone`
- [ ] Aggiungere stili per `.it-socials`
- [ ] Aggiungere stili per `.it-search-wrapper`

### Testing
- [ ] Confronto screenshot
- [ ] Test responsive
- [ ] Test accessibilità

## 🔗 References

### Documentation
- [HEADER_CRITICAL_ISSUES.md](HEADER_CRITICAL_ISSUES.md)
- [TAILWIND_DESIGN_COMUNI_COMPLETE.md](TAILWIND_DESIGN_COMUNI_COMPLETE.md)

### Screenshots
- `screenshots/08-original-full-header.png`
- `screenshots/09-fixcity-full-header.png`

---

**Stato**: 🔴 **IN CORSO - Header component da rifare**  
**Prossimo**: **🔧 Implementare header completo**
