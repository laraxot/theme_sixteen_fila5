import { chromium } from 'playwright';

const defaultUrl =
  'http://127.0.0.1:8000/it/segnalazione-crea?step=form.dati-della-segnalazione%3A%3Adata%3A%3Awizard-step';
const url = process.argv[2] || defaultUrl;

const browser = await chromium.launch({ headless: true });
const page = await browser.newPage({ viewport: { width: 1366, height: 1200 } });

const consoleErrors = [];
page.on('pageerror', (err) =>
  consoleErrors.push({ type: 'pageerror', message: String(err), stack: err?.stack ? String(err.stack) : null }),
);
page.on('console', (msg) => {
  if (msg.type() === 'error') {
    consoleErrors.push({ type: 'console', message: msg.text() });
  }
});

const failed = [];
page.on('requestfailed', request => {
  const requestUrl = request.url();
  if (requestUrl.includes('tile.openstreetmap.org') || requestUrl.includes('ArcGIS') || requestUrl.includes('opentopomap')) {
    failed.push({ url: requestUrl, failure: request.failure()?.errorText ?? 'unknown' });
  }
});

await page.goto(url, { waitUntil: 'domcontentloaded', timeout: 30000 });
await page.waitForTimeout(4500);

const report = await page.evaluate(() => {
  const picker = document.querySelector('coordinate-picker-lit');
  const shadow = picker?.shadowRoot;
  const pane = shadow?.querySelector('.map-picker-leaflet-pane');
  const container = shadow?.querySelector('.map-container');
  const tiles = Array.from(shadow?.querySelectorAll('.leaflet-tile') ?? []);
  const loadedTiles = tiles.filter(tile => tile.complete && tile.naturalWidth > 0 && !tile.classList.contains('leaflet-tile-error'));
  const erroredTiles = tiles.filter(tile => tile.classList.contains('leaflet-tile-error') || (tile.complete && tile.naturalWidth === 0));
  const header = document.querySelector('.it-header-wrapper, header');
  const paneRect = pane?.getBoundingClientRect();
  const containerRect = container?.getBoundingClientRect();
  const headerRect = header?.getBoundingClientRect();

  return {
    pickerFound: Boolean(picker),
    ceDefined: {
      coordinatePicker: Boolean(customElements.get('coordinate-picker-lit')),
      mapPicker: Boolean(customElements.get('map-picker-lit')),
    },
    paneRect: paneRect ? { width: paneRect.width, height: paneRect.height, top: paneRect.top, left: paneRect.left } : null,
    containerRect: containerRect ? { width: containerRect.width, height: containerRect.height, top: containerRect.top, left: containerRect.left } : null,
    headerRect: headerRect ? { width: headerRect.width, height: headerRect.height, top: headerRect.top, left: headerRect.left } : null,
    tileCount: tiles.length,
    loadedTileCount: loadedTiles.length,
    erroredTileCount: erroredTiles.length,
    tileSrcSamples: tiles.slice(0, 8).map(tile => tile.currentSrc || tile.src),
  };
});

await page.screenshot({
  path: 'docs/design-comuni/screenshots/segnalazione-crea-step2-map-check.png',
  fullPage: true,
});
console.log(JSON.stringify({ report, failed, consoleErrors }, null, 2));

await browser.close();
