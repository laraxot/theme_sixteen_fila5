# dati-deep.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`)
- **run**: `node scripts/dati-deep.cjs`
- **src ref**: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html
- **src loc**: http://127.0.0.1:8000/it/tests/segnalazione-02-dati
- **output dir**: `bashscripts/compare-html/output/`
- **pages explored**: REF + LOC (reference, local)
- **output files**: `dati-REF-full.png`, `dati-LOC-full.png`, per-section PNGs (breadcrumbs, steppers, section-*) , computed-style JSON (in-memory, not saved to disk)
- **selectors covered**: body, h1, h2, steppers-headerli.active, steppers-index, #report-*, card, card-body, select, input, textarea, btn-wrapper, cmp-contacts, contact-list
