# visual-compare-02-dati.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), fs, path
- **run**: `node scripts/visual-compare-02-dati.cjs`
- **src ref**: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html
- **src loc**: http://127.0.0.1:8000/it/tests/segnalazione-02-dati
- **output dir**: `docs/visual-analysis/segnalazione-02-dati/`
- **output files**: `reference-full.png`, `reference-viewport.png`, `local-full.png`, `local-viewport.png`, `ref-styles.json`, `loc-styles.json`
- **scans 17 selectors**: body, h1-h3, p, label, input, select, textarea, .btn, .btn-primary, .card, .card-body, .form-group, .form-check — blood of diff is logged to stdout
