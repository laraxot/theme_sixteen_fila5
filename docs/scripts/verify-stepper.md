# verify-stepper.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), path, fs
- **run**: `node scripts/verify-stepper.cjs`
- **src loc**: http://127.0.0.1:8000/it/tests/segnalazione-02-dati
- **output dir**: `docs/screenshots/stepper-verification/` (created if missing)
- **viewports**: desktop (1280×800), tablet (768×1024), mobile (375×667)
- **guard**: waits up to 10 s for `.steppers` to be in the DOM before snapping
- **output**: `stepper-<viewport>.png` — no full-page shots
