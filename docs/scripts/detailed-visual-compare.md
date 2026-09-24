# detailed-visual-compare.cjs

- **movement**: moved from theme root to `scripts/` — 2026-05-16
- **deps**: Playwright (`chromium`), fs
- **run**: `node scripts/detailed-visual-compare.cjs`
- **src ref** : https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html
- **src loc** : http://127.0.0.1:8000/it/tests/segnalazione-01-privacy
- **output dir** : `docs/visual-analysis/segnalazione-01-privacy/`
- **viewports** : desktop (1440×900), tablet (768×1024), mobile (375×812)
- **per viewport**: full-page PNG, viewport PNG, per-element PNG (main-container, hero, h1, card, form-group, btn, footer)
- **computed style scan**: body, h1, container, card, btn — JSON saved to `computed-styles.json`
