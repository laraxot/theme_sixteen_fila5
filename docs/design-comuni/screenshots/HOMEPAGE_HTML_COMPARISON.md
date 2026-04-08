# Homepage HTML Comparison Analysis

**Data:** 2026-04-01  
**Source:** https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**Target:** http://fixcity.local/it/tests/homepage  
**Stato:** 🔴 Differenze Rilevate  

---

## 📊 Summary

| Elemento | Source | Target | Stato |
|----------|--------|--------|-------|
| Skip links | ✅ Present | ✅ Present | ✅ OK |
| Header slim | ✅ Present | ✅ Present | ⚠️ Differenze |
| Header main | ✅ Present | ✅ Present | 🔴 Mancanti |
| Navigation | ✅ Present | ✅ Present | ⚠️ Differenze |
| Footer | ✅ Present | ✅ Present | 🔴 Differenze |
| Colori | Bootstrap Italia | Tailwind | ⚠️ Da verificare |

---

## 🔍 Analisi Dettagliata

### 1. Skip Links

**Source HTML:**
```html
<div class="skiplink">
  <a class="visually-hidden-focusable" href="#main-container">
    Vai ai contenuti
  </a>
  <a class="visually-hidden-focusable" href="#footer">
    Vai al footer
  </a>
</div>
```

**Target HTML:**
```html
<div class="skiplink">
  <a class="visually-hidden-focusable" href="#main-content">
    Vai ai contenuti
  </a>
  <a class="visually-hidden-focusable" href="#footer">
    Vai al footer
  </a>
</div>
```

**Differenza:** `#main-container` vs `#main-content`  
**Fix:** Cambiare href in `#main-container`

---

### 2. Header Slim

**Source HTML:**
```html
<div class="it-header-slim-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-slim-wrapper-content">
          <a class="d-lg-block navbar-brand" href="#">
            Nome della Regione
          </a>
          <div class="it-header-slim-right-zone" role="navigation">
            <!-- Language dropdown -->
            <!-- Login button -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

**Target HTML:**
```html
<div class="it-header-slim-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="it-header-slim-wrapper-content">
          <a class="d-lg-block navbar-brand" href="#">
            Nome della Regione
          </a>
          <div class="it-header-slim-right-zone" role="navigation">
            <!-- Language dropdown -->
            <!-- Login button -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

**Stato:** ✅ Strutturalmente identico  
**Differenze visive:** Colori, spaziature, font

**Fix Richiesti:**
1. Verificare colore `#00614a` per background
2. Verificare padding `py-2`
3. Verificare font-size `text-sm`

---

### 3. Header Main

**Source HTML:**
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">...</div>
  <div class="it-header-center-wrapper">
    <div class="container">
      <div class="it-header-center-content-wrapper">
        <div class="it-brand-wrapper">
          <a href="#">
            <img class="it-brand-logo" src="..." alt="...">
            <div class="it-brand-text">
              <h1 class="it-brand-title">Nome del Comune</h1>
              <p class="it-brand-tagline">Slogan del Comune</p>
            </div>
          </a>
        </div>
        <div class="it-right-zone">
          <!-- Social -->
          <!-- Search -->
        </div>
      </div>
    </div>
  </div>
  <div class="it-header-navbar-wrapper">...</div>
</header>
```

**Target HTML:**
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">...</div>
  <!-- ❌ MANCA: it-header-center-wrapper -->
  <div class="it-header-navbar-wrapper">...</div>
</header>
```

**Differenza:** Manca entire `it-header-center-wrapper` section  
**Fix:** Aggiungere centro header con logo, titolo, tagline

---

### 4. Navigation

**Source HTML:**
```html
<div class="it-header-navbar-wrapper">
  <div class="container">
    <nav class="navbar navbar-expand-lg">
      <button class="custom-navbar-toggler" data-bs-toggle="navbarcollapsible">
        <svg class="icon">...</svg>
      </button>
      <div class="navbar-collapsable">
        <div class="menu-wrapper">
          <div class="overlay"></div>
          <div class="close-div">
            <button class="close-menu">✕</button>
          </div>
          <nav aria-label="Principale">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <span>Amministrazione</span>
                </a>
              </li>
              <!-- ... -->
            </ul>
          </nav>
        </div>
      </div>
    </nav>
  </div>
</div>
```

**Target HTML:**
```html
<div class="it-nav-wrapper">
  <div class="container">
    <div class="it-nav-list">
      <ul class="link-list">
        <li>
          <a href="/it/amministrazione">
            <span>Amministrazione</span>
          </a>
          <!-- ... -->
        </li>
      </ul>
    </div>
  </div>
</div>
```

**Differenza:** Struttura navigation completamente diversa  
**Fix:** Riscrivere navigation block per matchare Bootstrap Italia structure

---

### 5. Footer

**Source HTML:**
```html
<footer class="it-footer-wrapper" id="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <h4>Amministrazione</h4>
        <ul>
          <li><a href="#">Giunta</a></li>
          <li><a href="#">Consiglio</a></li>
        </ul>
      </div>
      <!-- ... -->
    </div>
  </div>
</footer>
```

**Target HTML:**
```html
<footer class="it-footer-wrapper" id="footer">
  <!-- Struttura diversa -->
</footer>
```

**Differenza:** Layout e struttura diversi  
**Fix:** Riscrivere footer block per matchare Bootstrap Italia

---

## 📸 Screenshots

### Header Comparison

**Source:**
![Source Header](./screenshots/homepage-source-header.png)

**Target:**
![Target Header](./screenshots/homepage-target-header.png)

**Differenze:**
1. ❌ Manca logo comunale
2. ❌ Manca titolo comune
3. ❌ Manca tagline
4. ❌ Colori diversi (verde Bootstrap Italia vs altro)
5. ❌ Social icons mancanti
6. ❌ Search icon mancante

---

## 🔧 Fix Plan

### Immediati (Priority High)

1. **Header Center Wrapper**
   - File: `laravel/Themes/Sixteen/resources/views/components/blocks/header/main.blade.php`
   - Aggiungere logo, titolo, tagline
   - Aggiungere right zone con social e search

2. **Navigation Structure**
   - File: `laravel/Themes/Sixteen/resources/views/components/blocks/navigation/main.blade.php`
   - Riscrivere con struttura Bootstrap Italia
   - Aggiungere hamburger menu per mobile
   - Aggiungere overlay e close button

3. **Footer Structure**
   - File: `laravel/Themes/Sixteen/resources/views/components/blocks/footer/main.blade.php`
   - Riscrivere con layout a colonne
   - Aggiungere link istituzionali
   - Aggiungere social icons

### CSS Fixes

1. **Colori Bootstrap Italia**
   - File: `laravel/Themes/Sixteen/resources/css/app.css`
   - Verificare variabili `--bs-primary: #007a52`
   - Verificare variabili `--bs-primary-dark: #00614a`

2. **Font**
   - File: `laravel/Themes/Sixteen/resources/css/app.css`
   - Verificare import Titillium Web
   - Verificare font-family applicata

---

## ✅ Checklist Fix

- [ ] Skip links: cambiare `#main-content` → `#main-container`
- [ ] Header center: aggiungere logo, titolo, tagline
- [ ] Header right zone: aggiungere social, search
- [ ] Navigation: riscrivere struttura Bootstrap Italia
- [ ] Footer: riscrivere struttura a colonne
- [ ] CSS: verificare colori Bootstrap Italia
- [ ] CSS: verificare font Titillium Web
- [ ] Screenshot: salvare comparison aggiornati

---

**Ultimo Aggiornamento:** 2026-04-01  
**Prossima Verifica:** Dopo fix header/footer/navigation
