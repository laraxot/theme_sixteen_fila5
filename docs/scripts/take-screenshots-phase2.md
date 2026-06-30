# take-screenshots-phase2.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), path, fs
- **run**: `node scripts/take-screenshots-phase2.cjs`
- **output dir**: `docs/html-compare/ticket-list/screenshots/`
- **targets**: local (localhost:8000/it/tests/ticket-list) and reference (itàlia…/ticket-list.html)
- **viewports**: desktop (1440×900), tablet (768×1024), mobile (375×667)
- **output tokens**: `<target>-<viewport>.png` (full-page)
