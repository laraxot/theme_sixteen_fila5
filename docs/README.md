# Sixteen Theme - Design Comuni Italia Documentation Index
## FixCity Theme Documentation

**Project Goal**: Replicate Design Comuni static pages using Tailwind CSS + Alpine.js (no Bootstrap Italia runtime)

## Routing & Multilingual Rule

- The theme should consume named routes and CMS/config slugs, not PHP literals with Italian path fragments.
- User-facing copy belongs in translations or CMS JSON.
- For `/tests/[slug]` pages, keep route names stable and let content/config decide the slug value.

---

## 📋 Page Parity Analysis & Implementation

| Page | HTML Parity | Visual Parity | Status | Documentation |
|------|-------------|---------------|--------|---------------|
| **Homepage** | 99.5% | 85% | ✅ CSS Complete | [Homepage Analysis](HOMEPAGE-VISUAL-ANALYSIS.md) |
| **segnalazione-01-privacy** | 99.5% | ~80% | 🔄 CSS Global Fixes Applied | [CSS/JS Parity Fix](css-js-parity/segnalazione-01-privacy-css-fix.md) |
| **segnalazione-02-dati** | 97.0% | ~80% | 🔄 CSS Global Fixes Applied + File Upload UI | [CSS/JS Parity Fix](css-js-parity/segnalazione-01-privacy-css-fix.md) |
| **segnalazione-03-riepilogo** | 83.3% | ~80% | 🔄 CSS Global Fixes Applied | [CSS/JS Parity Fix](css-js-parity/segnalazione-01-privacy-css-fix.md) |
| **segnalazione-area-personale** | 91.9% | ~80% | 🔄 CSS Global Fixes Applied | [CSS/JS Parity Fix](css-js-parity/segnalazione-01-privacy-css-fix.md) |
| **segnalazione-dettaglio** | 86.8% | ~80% | 🔄 CSS Global Fixes Applied | [CSS/JS Parity Fix](css-js-parity/segnalazione-01-privacy-css-fix.md) |
| **segnalazioni-elenco** | 72.5% | - | ❌ HTML fix needed first | - |
| **segnalazione-04-conferma** | 43.6% | - | ❌ HTML fix needed first | - |

---

## 🎯 Current Phase: CSS/JS Visual Parity

### Active Work: segnalazione-01-privacy

**Date Started**: 2026-04-09  
**Methodology**: BMAD + GSD  
**Tools**: Playwright visual parity analysis, Supermemory AI context

| Task | Status | Details |
|------|--------|---------|
| HTML Parity Check | ✅ 99.8% | Locked - DO NOT TOUCH HTML |
| Visual Analysis | ✅ Complete | Playwright screenshots + font/color analysis |
| Reference Colors | ✅ Added | CSS variables from reference analysis |
| text-paragraph Fix | ✅ Applied | Color changed #5C6F82 → #191919 |
| Border Colors | ⏳ TODO | Add #d4d4d4 borders |
| Secondary Text | ⏳ TODO | Change to #455a64 |
| Build & Test | ✅ Complete | CSS built and deployed |
| Screenshot Comparison | ⏳ TODO | After all fixes applied |

### Quick Commands

```bash
# Build and deploy CSS changes
cd laravel/Themes/Sixteen
npm run build && npm run copy

# Run visual parity analysis
node scripts/visual-parity.mjs segnalazione-01-privacy

# Check HTML parity
bash ../../bashscripts/html/compare-html.sh \
  "http://127.0.0.1:8000/it/tests/segnalazione-01-privacy" \
  "https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html"
```

---

## 📊 Global Metrics

| Metric | Value | Trend |
|--------|-------|-------|
| **Total Pages** | 38 | Design Comuni reference |
| **HTML Parity (avg)** | 99.8% | ✅ Excellent |
| **Visual Parity (avg)** | 75% | 🔄 Improving |
| **CSS Files** | 28 | Organized by feature |
| **Reference Colors** | ✅ Added | CSS variables system |

---

## 🛠️ Tools & Scripts

| Tool | Purpose | Location |
|------|---------|----------|
| **visual-parity.mjs** | Playwright screenshot + font/color analysis | `scripts/visual-parity.mjs` |
| **compare-html.sh** | HTML structure parity check | `../../bashscripts/html/compare-html.sh` |
| **supermemory-context.js** | AI context indexing | `scripts/supermemory-context.js` |

---

## 📚 Architecture & Guidelines

| Document | Purpose |
|----------|---------|
| [CSS/JS Parity Guide](css-js-parity/segnalazione-01-privacy-css-fix.md) | How to achieve visual parity |
| [Bootstrap Italia Colors](bootstrap-italia-colors.md) | Color system documentation |
| [Font System](font-system.md) | Typography guidelines |

---

## 🚀 Development Workflow

1. **Check HTML parity** → Must be >95% before CSS work
2. **Run visual analysis** → Capture baseline screenshots
3. **Identify differences** → Fonts, colors, spacing, layout
4. **Apply CSS fixes** → Use `*-parity.css` files
5. **Build & deploy** → `npm run build && npm run copy`
6. **Verify visually** → New screenshots + manual review
7. **Update docs** → Record changes and metrics

---

## 📖 Related Documentation

- **Project Docs**: [../../../docs/](../../../docs/)
- **Module Docs**: [../../../Modules/*/docs/](../../../Modules/)
- **Bash Scripts**: [../../../bashscripts/docs/](../../../bashscripts/docs/)
- **Reference**: [Design Comuni GitHub](https://github.com/italia/design-comuni-pagine-statiche)

---

**See detailed analysis in [HOMEPAGE-VISUAL-ANALYSIS.md](HOMEPAGE-VISUAL-ANALYSIS.md)**  
**See Phase 1 completion in [HOMEPAGE-CSS-JS-FIXES-COMPLETE.md](HOMEPAGE-CSS-JS-FIXES-COMPLETE.md)**

---

## Current Active Docs

Per il lavoro attuale sulla homepage parity usare questi documenti canonici:
- [design-comuni/homepage-parity-report.md](./design-comuni/homepage-parity-report.md)
- [design-comuni/screenshots/homepage-parity/readmore-analysis.md](./design-comuni/screenshots/homepage-parity/readmore-analysis.md)
- [../../../../bashscripts/docs/homepage-visual-parity/inspectors.md](../../../../bashscripts/docs/homepage-visual-parity/inspectors.md)

I report storici nella root `docs/` restano utili come archivio, ma lo stato corrente va mantenuto nei file sopra.

- [design-comuni/risultati-ricerca-parity-2026-04-03.md](./design-comuni/risultati-ricerca-parity-2026-04-03.md)
- [design-comuni/argomenti-parity-2026-04-02.md](./design-comuni/argomenti-parity-2026-04-02.md)
- [design-comuni/argomento-parity-2026-04-02.md](./design-comuni/argomento-parity-2026-04-02.md)
- [design-comuni/design-comuni-batch-audit.md](./design-comuni/design-comuni-batch-audit.md)

## LLM Wiki Workflow

- Canonical wiki layer: [../../../../docs/wiki/README.md](../../../../docs/wiki/README.md)
- Theme synthesis entrypoint: [../../../../docs/wiki/index.md](../../../../docs/wiki/index.md)

## LLM Wiki

- [Sixteen Theme LLM Wiki](./llm-wiki.md)
- [Sixteen Wiki README](./wiki/README.md)
