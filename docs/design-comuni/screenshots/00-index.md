# Screenshot Index - Design Comuni Homepage

**Data**: 2026-04-02
**Strumento**: Playwright (headless Chromium)
**Viewport**: Desktop 1440×900, Mobile 375×812

---

## 📸 Screenshot Full Page

| Tipo | File | Size |
|------|------|------|
| Reference Desktop | [reference-desktop.png](reference-desktop.png) | 799KB |
| FixCity Desktop | [fixcity-desktop.png](fixcity-desktop.png) | 756KB |
| Reference Mobile | [reference-mobile.png](reference-mobile.png) | 456KB |
| FixCity Mobile | [fixcity-mobile.png](fixcity-mobile.png) | 696KB |

---

## 📸 Screenshot per Sezione

### Header
| Sezione | Reference | FixCity | Ratio | Stato |
|---------|-----------|---------|-------|-------|
| Slim (Regione + Language) | [ref-02](reference-02-header-slim.png) | [fix-02](fixcity-02-header-slim.png) | 0.86x | ✅ |
| Center (Brand + Social) | [ref-03](reference-03-header-center.png) | [fix-03](fixcity-03-header-center.png) | 0.58x | ⚠️ |
| Navbar (Navigazione) | [ref-04](reference-04-header-navbar.png) | [fix-04](fixcity-04-header-navbar.png) | 1.29x | ✅ |
| Header Completo | [ref-05](reference-05-header-full.png) | [fix-05](fixcity-05-header-full.png) | 0.86x | ✅ |

### Main Content
| Sezione | Reference | FixCity | Ratio | Stato |
|---------|-----------|---------|-------|-------|
| Hero (Card principale) | [ref-06](reference-06-hero-section.png) | [fix-06](fixcity-06-hero-section.png) | 1.06x | ✅ |
| Calendario Eventi | [ref-07](reference-07-calendario.png) | [fix-07](fixcity-07-calendario.png) | 1.40x | ❌ |
| Argomenti in Evidenza | [ref-08](reference-08-evidence-section.png) | [fix-08](fixcity-08-evidence-section.png) | 0.88x | ✅ |
| Useful Links + Search | [ref-09](reference-09-useful-links.png) | [fix-09](fixcity-09-useful-links.png) | 1.14x | ✅ |
| Rating Feedback | [ref-10](reference-10-rating-section.png) | [fix-10](fixcity-10-rating-section.png) | 2.14x | ❌ |

### Footer
| Sezione | Reference | FixCity | Ratio | Stato |
|---------|-----------|---------|-------|-------|
| Footer | [ref-11](reference-11-footer.png) | [fix-11](fixcity-11-footer.png) | 1.27x | ✅ |

---

## 📊 Analisi Differenze

### Sezioni ✅ OK (8/10)
- Header Slim, Navbar, Full
- Hero Section
- Evidence Section
- Useful Links
- Footer

### Sezioni ⚠️ Da Verificare (2/10)
- **Header Center** (0.58x): Social icons più compatti, possibile differenza nel rendering SVG
- **Calendario** (1.40x): Stessa struttura, formatting HTML più verboso
- **Rating** (2.14x): Form steps aggiuntivi nascosti

---

## 🔗 Collegamenti

- [00-index.md](00-index.md) - Indice principale
- [visual-comparison-analysis-2026-04-02.md](visual-comparison-analysis-2026-04-02.md) - Analisi dettagliata
- [work-plan.md](work-plan.md) - Piano di lavoro
- [../../../docs/design-comuni/html-match.md](../../../docs/design-comuni/html-match.md) - Regola globale
