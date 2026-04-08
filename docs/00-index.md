# Sixteen Theme Documentation Index

**Last verified**: 2026-04-03
**Status**: Active theme
**Focus area**: Design Comuni visual parity on `Sixteen`

## Quick Navigation

### Core references
- [README.md](./README.md) - Theme overview
- [DOCUMENTATION_INDEX.md](./DOCUMENTATION_INDEX.md) - Broader documentation map
- [design-comuni/00-index.md](./design-comuni/00-index.md) - Active Design Comuni parity workspace

### Active homepage parity docs
- [design-comuni/homepage-structure-diff-2026-04-02.md](./design-comuni/homepage-structure-diff-2026-04-02.md) - Body structure comparison, scripts excluded
- [design-comuni/work-plan.md](./design-comuni/work-plan.md) - Current BMAD + GSD operating plan
- [design-comuni/bmad-gsd-status-2026-04-03.md](./design-comuni/bmad-gsd-status-2026-04-03.md) - Latest execution status
- [design-comuni/screenshots/homepage-visual-pass-2026-04-02.md](./design-comuni/screenshots/homepage-visual-pass-2026-04-02.md) - Screenshot-driven visual log

### Risultati Ricerca parity docs
- [visual-comparison/RISULTATI-RICERCA-HTML-COMPARISON.md](./visual-comparison/RISULTATI-RICERCA-HTML-COMPARISON.md) - Full HTML/visual comparison with post-fix status (95%+ parity)
- [screenshots/risultati-ricerca/reference-after-fix.png](./screenshots/risultati-ricerca/reference-after-fix.png) - Reference page screenshot
- [screenshots/risultati-ricerca/local-after-fix.png](./screenshots/risultati-ricerca/local-after-fix.png) - Local page screenshot (post-fix)

### Argomenti & Argomento parity docs
- [visual-comparison/ARGOMENTI-ARGOMENTO-COMPARISON.md](./visual-comparison/ARGOMENTI-ARGOMENTO-COMPARISON.md) - Both topics pages comparison (90%+ parity)
- [visual-comparison/reference-argomenti.html](./visual-comparison/reference-argomenti.html) - Reference HTML source
- [visual-comparison/local-argomenti.html](./visual-comparison/local-argomenti.html) - Local HTML source
- [visual-comparison/reference-argomento.html](./visual-comparison/reference-argomento.html) - Reference HTML source
- [visual-comparison/local-argomento-v2.html](./visual-comparison/local-argomento-v2.html) - Local HTML source (post-fix)

### Segnalazioni Elenco parity docs
- [visual-comparison/SEGNALAZIONI-ELENCO-COMPARISON.md](./visual-comparison/SEGNALAZIONI-ELENCO-COMPARISON.md) - Reports listing page comparison (90%+ parity)
- [visual-comparison/reference-segnalazioni-elenco.html](./visual-comparison/reference-segnalazioni-elenco.html) - Reference HTML source
- [visual-comparison/local-segnalazioni-elenco-v2.html](./visual-comparison/local-segnalazioni-elenco-v2.html) - Local HTML source (post-fix)

### Segnalazione Pages (2026-04-07)
- [segnalazione-parity/README.md](./design-comuni/segnalazione-parity/README.md) - **Index** for all 7 segnalazione pages parity work
- [segnalazione-parity/HTML_STRUCTURE_ANALYSIS.md](./design-comuni/segnalazione-parity/HTML_STRUCTURE_ANALYSIS.md) - Detailed HTML structure comparison
- [segnalazione-parity/CSS_JS_PARITY_COMPLETE.md](./design-comuni/segnalazione-parity/CSS_JS_PARITY_COMPLETE.md) - CSS/JS parity completion report
- [segnalazione-parity/reference-html/](./design-comuni/segnalazione-parity/reference-html/) - Reference HBS templates from official repo
- [segnalazione-css-diff-2026-04-07.md](./segnalazione-css-diff-2026-04-07.md) - Previous CSS/JS differences analysis
- [design-comuni/segnalazione-comparison-analysis.md](./segnalazione-comparison-analysis.md) - Earlier parity analysis report

### HTML Structure Comparison Tools
- [body-structure-comparison/segnalazioni-elenco/report.md](./body-structure-comparison/segnalazioni-elenco/report.md) — Latest comparison report (**77.8% parity**, 2026-04-08)
- [body-structure-comparison/segnalazioni-elenco/diff_details.json](./body-structure-comparison/segnalazioni-elenco/diff_details.json) — Structured diff details (JSON)
- [prompts/tests/reference_segnalazioni-elenco.html](./prompts/tests/reference_segnalazioni-elenco.html) — Reference HTML source
- [prompts/tests/local_segnalazioni-elenco.html](./prompts/tests/local_segnalazioni-elenco.html) — Local HTML source
- [prompts/tests/local_segnalazioni.html](./prompts/tests/local_segnalazioni.html) — Earlier local HTML snapshot
- [bashscripts/html/README.md](../../../bashscripts/html/README.md) — Tool documentation
- [bashscripts/html/html-structure-compare.sh](../../../bashscripts/html/html-structure-compare.sh) — Shell wrapper (usage: `./html-structure-compare.sh <page_name>`)
- [bashscripts/html/compare-html-body.py](../../../bashscripts/html/compare-html-body.py) — Python comparison engine

### Translations
- [../../Modules/Fixcity/lang/it/segnalazione.php](../../Modules/Fixcity/lang/it/segnalazione.php) — Italian translations for segnalazione pages
- [../../Modules/Fixcity/lang/en/segnalazione.php](../../Modules/Fixcity/lang/en/segnalazione.php) — English translations for segnalazione pages

### Theme implementation entrypoints
- `resources/css/app.css` - Primary CSS entrypoint for visual parity overrides
- `resources/js/app.js` - Primary JS entrypoint for homepage runtime normalization
- `resources/views/pages/tests/[slug].blade.php` - Folio page entry for `/it/tests/*`

### Related module docs
- [../../Modules/Cms/docs/00-index.md](../../Modules/Cms/docs/00-index.md) - Cms module documentation index
- [../../Modules/Cms/docs/design-comuni-homepage.md](../../Modules/Cms/docs/design-comuni-homepage.md) - Cms-side parity coordination note
- [../../Modules/Cms/docs/architecture/homepage-structure.md](../../Modules/Cms/docs/architecture/homepage-structure.md) - Homepage runtime architecture
- [../../Modules/Cms/docs/body-structure-comparison/README.md](../../Modules/Cms/docs/body-structure-comparison/README.md) - Body structure comparison methodology

## Notes

- The active visual parity work is scoped to CSS/JS changes in the theme.
- The homepage test route remains CMS-driven through the Cms module and the local JSON content source.
- If this index diverges from the active parity docs, prefer the files under `docs/design-comuni/`.
- HTML structure comparison tools live in `bashscripts/html/` (Python comparison) and `bashscripts/body/` (Bash orchestration).
