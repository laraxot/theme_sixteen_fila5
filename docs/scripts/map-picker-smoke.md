# map-picker-smoke.cjs

- **movement**: already in scripts/ before this cleanup pass (pre-existing)
- **deps**: Playwright (`chromium`)
- **run**: `node scripts/map-picker-smoke.cjs`
- **target URL**: http://127.0.0.1:8000/it/tests/segnalazione-crea?step=form.dati-della-segnalazione%3A%3Adata%3A%3Awizard-step
- **output**: JSON summary on stdout + screenshot `scripts/map-picker-smoke.png`
- **checks**: JS errors count, failed requests count, marker visible, marker count, coordinate-changed after click
- **fail when**: coordinate did not change OR marker asset errors OR failed requests
