# check-header-local.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Puppeteer
- **run**: `node scripts/check-header-local.cjs`
- **target URL**: http://127.0.0.1:8000/it/tests/segnalazione-crea
- **output**: stdout dump — bounding box + computed styles for `.it-header-slim-wrapper`, `.it-header-center-wrapper`, `.it-header-navbar-wrapper`
- **notes**: single-run; opens browser, navigates, dumps boxes for all three header wrappers, iterates over raw children of `.it-header-wrapper`
