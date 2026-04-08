# 📸 Homepage Screenshot Analysis

**Date**: 2026-03-30  
**Status**: 🔴 **CRITICAL GAP**  
**Upstream**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**FixCity**: http://fixcity.local/it/tests/homepage

---

## 🎯 Goal

Rendere FixCity homepage **IDENTICA** all'upstream AGID con 95%+ visual match.

---

## 📸 Screenshots

### Upstream Reference (AGID)

**URL**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html

**Saved**: `laravel/Themes/Sixteen/docs/design-comuni/screenshots/reference/homepage-*.png`

**Sections**:
1. `header-full.png` - Complete header (slim + main + navbar)
2. `hero-section.png` - Hero with title
3. `featured-news.png` - Featured news card
4. `governance-cards.png` - 3 governance cards
5. `events-calendar.png` - Events calendar
6. `topics-highlight.png` - Topics cards
7. `thematic-sites.png` - 3 thematic sites
8. `footer-full.png` - Complete footer

### FixCity Current

**URL**: http://fixcity.local/it/tests/homepage

**Saved**: `laravel/Themes/Sixteen/docs/design-comuni/screenshots/current/homepage-*.png`

---

## 🔍 Gap Analysis

### Section-by-Section Comparison

| Section | Upstream | FixCity | Gap | Priority |
|---------|----------|---------|-----|----------|
| **Header Slim** | ✅ Region, Lang, Login, Social | ❌ Missing | 🔴 100% | P0 |
| **Header Main** | ✅ Brand, Search | ⚠️ Partial | 🟡 50% | P0 |
| **Navbar** | ✅ 4 menu items + hamburger | ❌ Missing | 🔴 100% | P0 |
| **Hero** | ✅ Title "NOME DEL COMUNE" | ⚠️ Basic | 🟡 60% | P1 |
| **Featured News** | ✅ Large card with date, tag | ⚠️ Missing tag | 🟡 70% | P1 |
| **Governance** | ✅ 3 cards (Sindaco, Giunta, Consiglio) | ❌ Missing | 🔴 100% | P0 |
| **Events Calendar** | ✅ Calendar format with days | ❌ Missing | 🔴 100% | P0 |
| **Topics** | ✅ Cards with links | ⚠️ Basic | 🟡 60% | P1 |
| **Thematic Sites** | ✅ 3 sites with colors | ❌ Missing | 🔴 100% | P0 |
| **Search+Feedback** | ✅ Search + Rating form | ❌ Missing | 🔴 100% | P0 |
| **Footer** | ✅ 4 sections | ⚠️ Basic | 🟡 40% | P0 |

**Overall Visual Match**: ~35%  
**Target**: 95%+  
**Work Remaining**: 60%

---

## 📐 HTML Structure Differences

### Header (CRITICAL)

**Upstream**:
```html
<div class="it-header-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="it-header-slim-wrapper-content">
        <a href="#" class="it-header-slim-link">Nome della Regione</a>
        <div class="it-header-slim-right-zone">
          <div class="dropdown">
            <button class="dropdown-toggle">ITA</button>
            <div class="dropdown-menu">...</div>
          </div>
          <a href="#" class="btn-icon">Accedi</a>
          <div class="it-socials">...</div>
        </div>
      </div>
    </div>
  </div>
  <div class="it-header-main-wrapper">...</div>
  <nav class="navbar navbar-expand-lg">...</nav>
</div>
```

**FixCity**: ⚠️ **Missing most elements**

### Governance Cards (MISSING)

**Upstream**:
```html
<section class="governance-section">
  <h2>Organi di governo</h2>
  <div class="row g-4">
    <div class="col-lg-4">
      <div class="card-wrapper card-space">
        <div class="card card-bg">
          <div class="card-body">
            <h3>MARIO ROSSI</h3>
            <p>Il Sindaco della città</p>
            <a href="#" class="read-more">Vai alla pagina</a>
          </div>
        </div>
      </div>
    </div>
    <!-- 3 cards total -->
  </div>
</section>
```

**FixCity**: ❌ **Not implemented**

### Events Calendar (MISSING)

**Upstream**:
```html
<section class="events-section">
  <h2>EVENTI</h2>
  <h3>SETTEMBRE 2026</h3>
  <div class="events-calendar">
    <div class="calendar-day">
      <span class="day">15</span>
      <span class="weekday">LUN</span>
      <ul class="events-list">
        <li>Saldo TASI</li>
        <li>Concerto gratuito</li>
      </ul>
    </div>
    <!-- Multiple days -->
  </div>
</section>
```

**FixCity**: ❌ **Not implemented**

---

## 🛠️ Fix Plan

### Phase 1: Header (P0) - 2 hours

**Tasks**:
1. Create `header-slim.blade.php` component
2. Create `header-main.blade.php` component
3. Create `navbar.blade.php` component
4. Update JSON with header data
5. Test responsive (mobile/desktop)

**Files**:
- `blocks/header/slim.blade.php`
- `blocks/header/main.blade.php`
- `blocks/header/navbar.blade.php`

### Phase 2: Governance Cards (P0) - 1 hour

**Tasks**:
1. Create `governance/cards.blade.php` component
2. Update JSON with 3 cards data
3. Test card layout

**Files**:
- `blocks/governance/cards.blade.php`
- Update `tests.homepage.json`

### Phase 3: Events Calendar (P0) - 2 hours

**Tasks**:
1. Create `events/calendar.blade.php` component
2. Update JSON with calendar data
3. Test calendar layout

**Files**:
- `blocks/events/calendar.blade.php`
- Update `tests.homepage.json`

### Phase 4: Thematic Sites (P0) - 1 hour

**Tasks**:
1. Create `thematic/sites.blade.php` component
2. Update JSON with 3 sites
3. Test color variants

**Files**:
- `blocks/thematic/sites.blade.php`

### Phase 5: Search+Feedback (P0) - 1 hour

**Tasks**:
1. Create `search/feedback.blade.php` component
2. Update JSON with search + rating
3. Test form functionality

**Files**:
- `blocks/search/feedback.blade.php`

### Phase 6: Footer (P0) - 2 hours

**Tasks**:
1. Create `footer/top.blade.php` (4 columns)
2. Create `footer/main.blade.php` (6 columns)
3. Create `footer/bottom.blade.php` (social + legal)
4. Create `footer/copyright.blade.php`
5. Update JSON with footer data

**Files**:
- `blocks/footer/top.blade.php`
- `blocks/footer/main.blade.php`
- `blocks/footer/bottom.blade.php`
- `blocks/footer/copyright.blade.php`

### Phase 7: Verification (P0) - 30 min

**Tasks**:
1. Take new screenshots
2. Compare with upstream
3. Calculate visual match %
4. Document results

---

## 📊 Success Metrics

| Metric | Current | Target | After Fix |
|--------|---------|--------|-----------|
| **Visual Match** | 35% | 95%+ | 95%+ ✅ |
| **Header Complete** | 50% | 100% | 100% ✅ |
| **Governance** | 0% | 100% | 100% ✅ |
| **Events Calendar** | 0% | 100% | 100% ✅ |
| **Thematic Sites** | 0% | 100% | 100% ✅ |
| **Footer Complete** | 40% | 100% | 100% ✅ |

---

## 🤖 Multi-Agent Assignment

### BMAD Agents
| Agent | Role | Tasks |
|-------|------|-------|
| **John (PM)** | Requirements | Define parity metrics |
| **Winston (Architect)** | Architecture | Component structure |
| **Sally (UX)** | AGID Compliance | Visual parity |
| **Amelia (Dev)** | Implementation | Create components |

### GSD Agents
| Agent | Role | Tasks |
|-------|------|-------|
| **gsd-planner** | Planning | Phase breakdown |
| **gsd-executor** | Execution | Create 10+ components |
| **gsd-verifier** | Verification | Screenshot comparison |

### Other Agents
| Agent | Role | Tasks |
|-------|------|-------|
| **Ralph Loop** | Automation | Batch component creation |
| **OpenViking** | Context | Memory preservation |
| **NotebookLM** | Research | AGID structure analysis |

---

## 🤖 OpenViking Context

```bash
openviking add-memory "Homepage screenshot analysis: 35% match, need 95%+. Missing: Header (slim+main+nav), Governance cards, Events calendar, Thematic sites, Search+feedback, Footer sections. 7 phases planned."
```

---

## 📚 Related Documentation

- [BMAD Thread](../../../_bmad/threads/homepage-html-parity.md)
- [GSD Phase 13](../../../.planning/phases/13-homepage-html-parity/PLAN.md)
- [Bootstrap Italia + Tailwind](./BOOTSTRAP_ITALIA_TAILWIND_APPLY.md)
- [Superpowers Integration](./SUPERPOWERS_INTEGRATION_GUIDE.md)

---

**Last Updated**: 2026-03-30  
**Priority**: 🔴 **CRITICAL**  
**Next Action**: Execute Phase 1 (Header)  
**Owner**: Multi-Agent Team
