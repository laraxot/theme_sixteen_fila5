# Visual Parity Report - 2026-04-06

**Generated**: 2026-04-06T19:24:57.368Z
**Total Pages**: 8
**Successful**: 8
**Failed**: 0

## Parity Distribution

| Category | Count | Examples |
|----------|-------|----------|
| 95-100% Excellent | 0 |  |
| 90-94% Very Good | 2 | segnalazione-dettaglio, segnalazioni-elenco |
| 85-89% Good | 1 | segnalazione-01-privacy |
| 80-84% Fair | 0 |  |
| <80% Needs Work | 5 | segnalazione-area-personale, segnalazione-02-dati, segnalazione-03-riepilogo |

## Top 15 Pages (Ready for CSS fixes)

| Rank | Page | Local Height | Ref Height | Diff | Parity |
|------|------|--------------|------------|------|--------|
| 1 | segnalazione-dettaglio | 4753px | 4425px | 328px | 93% |
| 2 | segnalazioni-elenco | 2847px | 3128px | 281px | 91% |
| 3 | segnalazione-01-privacy | 1698px | 1938px | 240px | 88% |
| 4 | segnalazione-area-personale | 1698px | 2854px | 1156px | 59% |
| 5 | segnalazione-02-dati | 1698px | 3064px | 1366px | 55% |
| 6 | segnalazione-03-riepilogo | 1698px | 3115px | 1417px | 55% |
| 7 | segnalazione-04-conferma | 3538px | 2301px | 1237px | 46% |
| 8 | segnalazione-disservizio | 1980px | 474px | 1506px | -218% |

## Bottom 10 Pages (Need Investigation)

| Rank | Page | Local Height | Ref Height | Diff | Parity |
|------|------|--------------|------------|------|--------|
| 8 | segnalazione-disservizio | 1980px | 474px | 1506px | -218% |
| 7 | segnalazione-04-conferma | 3538px | 2301px | 1237px | 46% |
| 6 | segnalazione-03-riepilogo | 1698px | 3115px | 1417px | 55% |
| 5 | segnalazione-02-dati | 1698px | 3064px | 1366px | 55% |
| 4 | segnalazione-area-personale | 1698px | 2854px | 1156px | 59% |
| 3 | segnalazione-01-privacy | 1698px | 1938px | 240px | 88% |
| 2 | segnalazioni-elenco | 2847px | 3128px | 281px | 91% |
| 1 | segnalazione-dettaglio | 4753px | 4425px | 328px | 93% |

## Errors

None

## Screenshots Location

All screenshots saved to: `laravel/Themes/Sixteen/docs/visual-comparison/screenshots/`

- Local: `local-<page>.png`
- Reference: `ref-<page>.png`

## Next Steps

1. Review top 15 pages for CSS differences
2. Fix Tailwind @apply rules in style-apply.css
3. Update Alpine.js components for interactivity
4. Build and deploy: `npm run build && npm run copy`
5. Re-run this script to verify improvements

---

**Related Docs**:
- [Visual Comparison README](../../../laravel/Themes/Sixteen/docs/visual-comparison/README.md)
- [CSS/JS Plan](../../../laravel/Themes/Sixteen/docs/design-comuni-html-match-css-js-plan.md)
- [Screenshot Tools](../../bashscripts/docs/SCREENSHOT-TOOLS.md)
