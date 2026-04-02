# Homepage HTML Parity Analysis

**Data**: 2026-04-01  
**Status**: ❌ **HTML NON IDENTICO - 3.20% MATCH**  
**Priority**: CRITICAL

---

## 📊 Confronto Generale

| Metric | AGID Original | FixCity | Status |
|--------|---------------|---------|--------|
| Body Length (no scripts) | 42,195 chars | 32,311 chars | ❌ Diverse |
| Match Percentage | - | 3.20% | ❌ TOO LOW |
| Target | - | 95%+ | ❌ NOT MET |

---

## 🔍 Differenze Identificate

### 1. Skip Links ❌

**AGID**:
```html
<a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
```

**FixCity**:
```html
<a class="visually-hidden-focusable" href="#main-content">Vai ai contenuti</a>
```

**Fix**: Cambiare `#main-content` → `#main-container`

---

### 2. Header Wrapper Attributes ❌

**AGID**:
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
```

**FixCity**:
```html
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" role="banner">
```

**Differenze**:
- AGID: `style=""`
- FixCity: `role="banner"`

**Fix**: Rimuovere `role="banner"`, aggiungere `style=""`

---

### 3. Asset Paths ❌

**AGID**:
```html
<use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-down"></use>
```

**FixCity**:
```html
<use href="/themes/Sixteen/..."></use>
```

**Fix**: Usare path relativi o sprite SVG inline come AGID

---

### 4. Missing Content ❌

**AGID**: 42,195 chars  
**FixCity**: 32,311 chars  
**Missing**: ~10,000 chars (~24%)

Sezioni probabilmente mancanti o incomplete:
- [ ] Header completo (slim + center + navbar)
- [ ] Hero section con news card
- [ ] Services section
- [ ] Administration section
- [ ] News section
- [ ] Events section
- [ ] Footer completo

---

## 🎯 Priorità di Fix

### CRITICAL (Deve essere identico)
1. ✅ Skip links: `#main-container`
2. ✅ Header attributes: `style=""`
3. ❌ SVG sprite paths: Usare inline o path corretti
4. ❌ Tutti i contenuti: Aggiungere sezioni mancanti

### HIGH (Importante per parity)
- [ ] Classi CSS identiche
- [ ] Attributi ARIA identici
- [ ] Data attributes identici
- [ ] Ordine elementi identico

### MEDIUM (Visuale)
- [ ] Spaziatura
- [ ] Colori
- [ ] Fonts

---

## 📝 Action Plan

### Step 1: Fix Header HTML ✅
- [ ] Skip link href: `#main-container`
- [ ] Header attributes: `style=""`
- [ ] Rimuovere `role="banner"`

### Step 2: Fix SVG Icons ❌
- [ ] Usare sprite SVG inline come AGID
- [ ] O usare path corretti verso bootstrap-italia

### Step 3: Add Missing Sections ❌
- [ ] Hero section completa
- [ ] Services section
- [ ] Administration section  
- [ ] News section
- [ ] Events section
- [ ] Footer completo

### Step 4: Verify Content ❌
- [ ] Confrontare ogni sezione
- [ ] Assicurarsi classi identiche
- [ ] Assicurarsi attributi identici

---

## 🔧 Files da Modificare

1. **JSON Content**: `laravel/config/local/fixcity/database/content/pages/tests.homepage.json`
   - Aggiornare blocchi con contenuti corretti

2. **Block Views**: `laravel/Themes/Sixteen/resources/views/components/blocks/`
   - Fix header/slim.blade.php
   - Fix header/main.blade.php
   - Fix header/navbar.blade.php
   - Creare hero/homepage.blade.php
   - Creare services/homepage.blade.php
   - etc.

3. **Layout**: `laravel/Themes/Sixteen/resources/views/components/layouts/app.blade.php`
   - Fix main container ID

---

## 📈 Progress Tracking

| Step | Status | Match % |
|------|--------|---------|
| Initial | ❌ Done | 3.20% |
| Fix Skip Links | ⏳ Pending | - |
| Fix Header Attributes | ⏳ Pending | - |
| Fix SVG Icons | ⏳ Pending | - |
| Add Missing Sections | ⏳ Pending | - |
| Final Verification | ⏳ Pending | 95%+ |

---

## 🎯 Target

**Obiettivo**: 95%+ HTML match (esclusi scripts)

**Timeline**: 
- Step 1-2: Immediate (oggi)
- Step 3: High priority (questa settimana)
- Step 4: Before deployment

---

**Next Action**: Fix skip links e header attributes immediatamente!
