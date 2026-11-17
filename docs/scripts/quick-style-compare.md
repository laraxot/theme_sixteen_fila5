# quick-style-compare.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), fs
- **run**: `node scripts/quick-style-compare.cjs`
- **src ref** : https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html
- **src loc** : http://127.0.0.1:8000/it/tests/segnalazione-01-privacy
- **output dir** : `docs/visual-analysis/segnalazione-01-privacy/`
- **scans**: 9 element groups (body, h1, h2, p, card, .btn-primary, container, .list-item, a) across font, color, spacing, box props
- **saves** `ref-styles.json` + `loc-styles.json` for later comparison
