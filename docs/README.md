# Homepage Parity Analysis & Implementation Index
## FixCity Sixteen Theme - Design Comuni Italia Replication

**Project Goal**: Make local homepage (http://127.0.0.1:8000/it/tests/homepage) visually identical to reference (https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html) using Tailwind CSS + Alpine.js (no Bootstrap Italia)

---

## 📋 Analysis & Implementation Documents

| Document | Purpose | Status |
|----------|---------|--------|
| **[HOMEPAGE-VISUAL-ANALYSIS.md](HOMEPAGE-VISUAL-ANALYSIS.md)** | Complete visual comparison + Bootstrap→Tailwind mappings | ✅ 99.5% HTML match confirmed |
| **[HOMEPAGE-CSS-JS-FIXES-COMPLETE.md](HOMEPAGE-CSS-JS-FIXES-COMPLETE.md)** | CSS Phase 1 completion report | ✅ 63 mappings added, build working |

---

## 🎯 Current Status

| Phase | Task | Status |
|-------|------|--------|
| **1** | HTML Analysis | ✅ DONE - 99.5% match |
| **1** | Bootstrap Class Mapping | ✅ DONE - 88/88 classes |
| **1** | CSS Compilation | ✅ DONE - Builds successfully |
| **1** | Asset Deployment | ✅ DONE - Copied to public_html |
| **2** | Alpine.js Implementation | ⏳ NEXT - Mobile menu, modals, dropdowns |
| **3** | Color Customization | ⏳ TODO - Design Comuni green theme |

---

## 🚀 Quick Start

**Test the current CSS implementation**:
```bash
cd /var/www/_bases/base_fixcity_fila5/laravel/Themes/Sixteen
npm run build && npm run copy
# Open http://127.0.0.1:8000/it/tests/homepage
```

**Compare with reference**:
- Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
- Local: http://127.0.0.1:8000/it/tests/homepage

---

## 📊 Metrics

- **HTML Structural Match**: 99.5% ✅
- **Bootstrap Classes Mapped**: 88/88 (100%) ✅
- **CSS Compiled**: 161.87 kB ✅
- **Build Time**: 916ms ✅

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
