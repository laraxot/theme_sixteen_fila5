# 🏠 Homepage Gap Analysis

**Date**: 2026-03-30  
**Status**: 🔴 **CRITICAL GAP**  
**Target**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**Current**: http://fixcity.local/it/tests/homepage

---

## 🎯 Gap Summary

| Section | Upstream | FixCity | Gap | Priority |
|---------|----------|---------|-----|----------|
| **Header** | ✅ Complete AGID | ⚠️ Partial | 🔴 High | 🔴 P0 |
| **Hero** | ✅ Full width, image | ⚠️ Basic | 🟡 Medium | 🟡 P1 |
| **Featured Services** | ✅ 6 cards with icons | ⚠️ Basic cards | 🔴 High | 🔴 P0 |
| **Explore Topics** | ✅ Grid with descriptions | ⚠️ Missing | 🔴 High | 🔴 P0 |
| **Latest News** | ✅ 3 cards with dates | ⚠️ Missing | 🔴 High | 🔴 P0 |
| **Events** | ✅ Calendar cards | ⚠️ Missing | 🔴 High | 🔴 P0 |
| **Footer** | ✅ 6 columns + social | ⚠️ Basic | 🔴 High | 🔴 P0 |

**Overall Match**: ~30%  
**Target**: 95%+  
**Work Remaining**: 65%

---

## 🔍 Detailed Analysis

### 1. Header (AGID Standard)

**Upstream Structure**:
```html
<div class="it-header-wrapper">
  <!-- Header Slim (Top Bar) -->
  <div class="it-header-slim-wrapper">
    - Region link
    - Language dropdown (ITA/ENG)
    - Login button
    - Social icons (6)
  </div>
  
  <!-- Header Main -->
  <div class="it-header-main-wrapper">
    - Brand (logo + text)
    - Municipality name
    - Search button
  </div>
  
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    - Hamburger toggle
    - Menu items (Amministrazione, Novità, Servizi, Vivere)
  </nav>
</div>
```

**FixCity Status**: ⚠️ Partial  
**Missing**:
- [ ] Header slim wrapper with region, language, login
- [ ] Proper AGID navbar structure
- [ ] Social icons in header
- [ ] Search button

**Priority**: 🔴 P0

---

### 2. Hero Section

**Upstream Structure**:
```html
<section class="hero-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h1>Il mio Comune</h1>
        <p class="lead">Un comune da vivere</p>
        <p>Benvenuto nel portale del tuo Comune...</p>
      </div>
      <div class="col-lg-6">
        <img src="hero-image.jpg" alt="" class="img-fluid">
      </div>
    </div>
  </div>
</section>
```

**FixCity Status**: ⚠️ Basic  
**Missing**:
- [ ] Two-column layout (text + image)
- [ ] Hero image
- [ ] Proper AGID styling

**Priority**: 🟡 P1

---

### 3. Featured Services (Servizi in Evidenza)

**Upstream Structure**:
```html
<section class="featured-services">
  <h2 class="section-title">Servizi in evidenza</h2>
  <div class="row g-4">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <h3 class="card-title">
              <svg class="icon icon-primary">...</svg>
              Servizi Digitali
            </h3>
            <p class="card-text">Accedi ai servizi online</p>
            <a href="#" class="read-more">
              <span>Leggi di più</span>
              <svg class="icon icon-primary icon-xs">...</svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    <!-- 6 services total -->
  </div>
</section>
```

**FixCity Status**: ⚠️ Basic cards  
**Missing**:
- [ ] AGID card wrapper structure
- [ ] Icon integration
- [ ] Read more link with arrow
- [ ] Proper card styling
- [ ] 6 services (currently has placeholder)

**Priority**: 🔴 P0

---

### 4. Explore by Topic (Esplora per Argomento)

**Upstream Structure**:
```html
<section class="topics-section">
  <h2 class="section-title">Esplora per argomento</h2>
  <div class="row g-4">
    <div class="col-12 col-md-6">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <h3 class="card-title">
              <svg class="icon icon-primary">...</svg>
              Iscrizioni
            </h3>
            <p class="card-text">Servizi per iscrizioni e registrazioni</p>
            <a href="#" class="read-more">...</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 8 topics total -->
  </div>
</section>
```

**FixCity Status**: ❌ Missing  
**Missing**:
- [ ] Entire section
- [ ] Topic cards with icons
- [ ] 8 topics grid

**Priority**: 🔴 P0

---

### 5. Latest News (Ultime Notizie)

**Upstream Structure**:
```html
<section class="news-section">
  <h2 class="section-title">Ultime notizie</h2>
  <div class="row g-4">
    <article class="col-12 col-md-6 col-lg-4">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <span class="card-date">15 Mar 2026</span>
            <h3 class="card-title">Nuovo orario uffici</h3>
            <p class="card-text">Dal 1 aprile il nuovo orario...</p>
            <a href="#" class="read-more">...</a>
          </div>
        </div>
      </div>
    </article>
    <!-- 3 news items -->
  </div>
</section>
```

**FixCity Status**: ❌ Missing  
**Missing**:
- [ ] Entire news section
- [ ] News cards with dates
- [ ] 3 news items

**Priority**: 🔴 P0

---

### 6. Events (Eventi)

**Upstream Structure**:
```html
<section class="events-section">
  <h2 class="section-title">Eventi</h2>
  <div class="row g-4">
    <article class="col-12 col-md-6 col-lg-4">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <span class="card-date">20 Mar 2026</span>
            <h3 class="card-title">Mercatino dell'artigianato</h3>
            <p class="card-text">Piazza Roma - Esposizione...</p>
            <a href="#" class="read-more">...</a>
          </div>
        </div>
      </div>
    </article>
    <!-- 3 events -->
  </div>
</section>
```

**FixCity Status**: ❌ Missing  
**Missing**:
- [ ] Entire events section
- [ ] Event cards with dates
- [ ] 3 events

**Priority**: 🔴 P0

---

### 7. Footer (AGID Standard)

**Upstream Structure**:
```html
<footer class="it-footer">
  <!-- Footer Top (Quick Links) -->
  <div class="footer-top">
    <div class="container">
      <div class="row">
        <!-- 4 columns: Contatta, Problemi, Cerca, Forse stavi cercando -->
      </div>
    </div>
  </div>
  
  <!-- Footer Main -->
  <div class="footer-main">
    <div class="container">
      <div class="row">
        <!-- 6 columns: Nome Comune, Amministrazione, Categorie, Novità, Vivere, Contatti -->
      </div>
    </div>
  </div>
  
  <!-- Footer Bottom (Social + Legal) -->
  <div class="footer-bottom">
    <div class="container">
      <!-- Social icons (6) -->
      <!-- Legal links -->
    </div>
  </div>
  
  <!-- Copyright -->
  <div class="footer-copyright">
    <div class="container">
      <p>© 2024 Comune di Nome Comune</p>
    </div>
  </div>
</footer>
```

**FixCity Status**: ⚠️ Basic  
**Missing**:
- [ ] Footer top section (4 columns)
- [ ] Footer main section (6 columns)
- [ ] Footer bottom with social icons
- [ ] Copyright section
- [ ] AGID footer structure

**Priority**: 🔴 P0

---

## 🛠️ Fix Plan

### Phase 1: Header (P0)
**ETA**: 1 hour  
**Tasks**:
1. Create header-slim component
2. Create header-main component  
3. Create navbar component
4. Integrate with homepage

### Phase 2: Hero Section (P1)
**ETA**: 30 min  
**Tasks**:
1. Update hero block with two-column layout
2. Add hero image placeholder
3. Apply AGID styling

### Phase 3: Featured Services (P0)
**ETA**: 1 hour  
**Tasks**:
1. Create service card block
2. Add icon integration
3. Create read-more link component
4. Populate with 6 services

### Phase 4: Explore Topics (P0)
**ETA**: 1 hour  
**Tasks**:
1. Create topics grid block
2. Add 8 topic cards
3. Integrate icons

### Phase 5: News Section (P0)
**ETA**: 1 hour  
**Tasks**:
1. Create news card block
2. Add date display
3. Populate with 3 news items

### Phase 6: Events Section (P0)
**ETA**: 1 hour  
**Tasks**:
1. Create event card block
2. Add calendar integration
3. Populate with 3 events

### Phase 7: Footer (P0)
**ETA**: 2 hours  
**Tasks**:
1. Create footer-top component
2. Create footer-main component
3. Create footer-bottom component
4. Create copyright component
5. Integrate all sections

---

## 📊 Success Metrics

| Metric | Current | Target |
|--------|---------|--------|
| **Visual Match** | 30% | 95%+ |
| **Header Compliance** | 50% | 100% |
| **Sections Complete** | 2/7 | 7/7 |
| **Blocks Created** | 5 | 15+ |
| **AGID Compliance** | 40% | 100% |

---

## 🤖 Multi-Agent Assignment

### Wave 1: Header + Footer (Amelia + Ralph)
**Agent**: Amelia + Ralph Loop  
**ETA**: 3 hours  
**Tasks**: Header (4 components) + Footer (4 components)

### Wave 2: Content Sections (Amelia)
**Agent**: Amelia  
**ETA**: 3 hours  
**Tasks**: Hero, Services, Topics, News, Events blocks

### Wave 3: Integration (Amelia)
**Agent**: Amelia  
**ETA**: 1 hour  
**Tasks**: Integrate all blocks in homepage

### Verification (gsd-verifier)
**Agent**: gsd-verifier  
**ETA**: 30 min  
**Tasks**: Visual comparison with upstream

---

## 🤖 OpenViking Context

```bash
openviking add-memory "Homepage gap analysis: 30% match, need 95%+. Missing: Header (slim+main+nav), Hero (2-col), Services (6 cards), Topics (8 cards), News (3 cards), Events (3 cards), Footer (4 sections). 7 phases planned."
```

---

**Last Updated**: 2026-03-30  
**Priority**: 🔴 **CRITICAL**  
**Next Action**: Execute Phase 1 (Header)  
**Owner**: Multi-Agent Team
