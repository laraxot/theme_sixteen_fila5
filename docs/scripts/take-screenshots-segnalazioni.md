---
title: "take screenshots segnalazioni"
type: note
tags: [documentation]
created: 2026-09-26
updated: 2026-09-26
qmd: "take screenshots segnalazioni"
issues: []
discussions: []
---

# take-screenshots-segnalazioni.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), path, fs
- **run**: `node scripts/take-screenshots-segnalazioni.cjs`
- **env**: `BASE_URL` (default http://127.0.0.1:8000), `OUTPUT_DIR` (default docs/screenshots/ticket-list)
- **target**: http://localhost:8000/it/tests/ticket-list
- **output**: full-page PNG, viewport PNG, 3-second load wait pre-capture
