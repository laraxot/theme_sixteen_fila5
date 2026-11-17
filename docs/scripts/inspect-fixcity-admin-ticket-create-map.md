# inspect-fixcity-admin-ticket-create-map.cjs

- **movement**: already in scripts/ before this cleanup pass (pre-existing)
- **deps**: Playwright (`chromium`), path, fs
- **run**: `node scripts/inspect-fixcity-admin-ticket-create-map.cjs`
- **target URL**: http://127.0.0.1:8001/fixcity/admin/tickets/create?step=form.data%3A%3Adata%3A%3Awizard-step
- **env creds**: `FIXCITY_ADMIN_EMAIL`, `FIXCITY_ADMIN_PASSWORD` (auto-loaded from `laravel/.env` if missing)
- **output**: JSON on stdout + screenshot `scripts/fixcity-admin-ticket-create-map.png`
- **snapshot fields**: mapContainer bounding box, leaflet container, marker count, tile count, body/html class names, outerHTML snippet
- **fail when**: no host found OR JS errors OR HTTP failures
