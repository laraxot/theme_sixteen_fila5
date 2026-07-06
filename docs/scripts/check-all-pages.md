# check-all-pages.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), fs
- **run**: `node scripts/check-all-pages.cjs`
- **src ref**: https://italia.github.io/design-comuni-pagine-statiche/sito
- **src loc**: http://127.0.0.1:8000/it/tests
-**output dir**: `docs/screenshots/segnalazione-pages/<slug>/`
- **coverage**: same 7 pages as batch-parity
- **checks per page**: HTML tag-level parity, font-distribution histogram, full-page + viewport screenshots (ref + loc)
- **threshold**: ✅ PASS if HTML parity >= 80%
