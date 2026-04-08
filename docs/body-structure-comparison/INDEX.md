# Body Structure Comparison

Canonical output area for HTML body structure comparisons between Design Comuni reference pages and Sixteen theme implementations.

## Pages Compared

### segnalazioni-elenco

**Parity Score: 77.8%** (603/775 elements identical)

Artifacts in [`./segnalazioni-elenco/`](./segnalazioni-elenco/):
- [`report.md`](./segnalazioni-elenco/report.md) — Detailed report with identical, missing, different, and extra elements
- [`diff_details.json`](./segnalazioni-elenco/diff_details.json) — Machine-readable parity summary
- [`reference-body.html`](./segnalazioni-elenco/reference-body.html) — Reference body (no `<script>`/`<style>`)
- [`local-body.html`](./segnalazioni-elenco/local-body.html) — Local body (no `<script>`/`<style>`)
- [`reference-structure.json`](./segnalazioni-elenco/reference-structure.json) — Parsed reference tree
- [`local-structure.json`](./segnalazioni-elenco/local-structure.json) — Parsed local tree

### segnalazione-dettaglio

**Parity Score: 45.5%** (366/804 elements identical)

Artifacts in [`./segnalazione-dettaglio/`](./segnalazione-dettaglio/):
- [`report.md`](./segnalazione-dettaglio/report.md) — Detailed report with identical, missing, different, and extra elements
- [`diff_details.json`](./segnalazione-dettaglio/diff_details.json) — Machine-readable parity summary
- [`reference-body.html`](./segnalazione-dettaglio/reference-body.html) — Reference body (no `<script>`/`<style>`)
- [`local-body.html`](./segnalazione-dettaglio/local-body.html) — Local body (no `<script>`/`<style>`)
- [`reference-structure.json`](./segnalazione-dettaglio/reference-structure.json) — Parsed reference tree
- [`local-structure.json`](./segnalazione-dettaglio/local-structure.json) — Parsed local tree

## Tooling

Agnostic tooling lives in `bashscripts`:
- [`bashscripts/html/html-structure-compare.sh`](../../../bashscripts/html/html-structure-compare.sh) — Bash wrapper
- [`bashscripts/html/compare-html-body.py`](../../../bashscripts/html/compare-html-body.py) — Python engine
- [`bashscripts/docs/html/README.md`](../../../bashscripts/docs/html/README.md) — Tool documentation

## Project Bridge

- **Root bridge**: [`docs/html-structure-comparison.md`](../../../docs/html-structure-comparison.md)
- **Theme docs index**: [`../00-index.md`](../00-index.md)

## Governance

- `bashscripts` stays reusable and project-agnostic.
- Theme-specific outputs stay under `laravel/Themes/Sixteen/docs/...`.
- Source HTML snapshots go to [`../prompts/<page>/`](../prompts/).
- The root bridge note for this repo lives in [`docs/html-structure-comparison.md`](../../../docs/html-structure-comparison.md).
