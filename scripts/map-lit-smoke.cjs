const { chromium } = require('playwright');

const BASE_URL = process.env.PLAYWRIGHT_BASE_URL ?? 'http://127.0.0.1:8000';
const TARGET_URL = `${BASE_URL}/it/`;

async function run() {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1280, height: 900 } });

    const jsErrors = [];
    const asset404 = [];

    page.on('console', (msg) => {
        if (msg.type() === 'error') {
            jsErrors.push(msg.text());
        }
    });

    page.on('response', (response) => {
        const url = response.url();
        if (response.status() >= 400 && /themes\/Sixteen\/assets\/(app|map-lit)-/.test(url)) {
            asset404.push({ url, status: response.status() });
        }
    });

    const jsonRes = await page.request.get(`${BASE_URL}/data/tickets.json`);
    if (!jsonRes.ok()) {
        throw new Error(`tickets.json non disponibile: HTTP ${jsonRes.status()}`);
    }

    const geojson = await jsonRes.json();
    const expectedFeatures = Number(geojson.total ?? geojson.features?.length ?? 0);
    if (expectedFeatures < 1) {
        throw new Error('Nessuna feature in tickets.json');
    }

    await page.goto(TARGET_URL, { waitUntil: 'networkidle', timeout: 90000 });
    await page.waitForTimeout(6000);

    const mapLit = page.locator('map-lit#block-map');
    await mapLit.waitFor({ state: 'visible', timeout: 20000 });
    await expectAttribute(mapLit, 'data-url', '/data/tickets.json');

    await page.locator('.map-box').scrollIntoViewIfNeeded();
    await page.waitForTimeout(1500);

    const runtime = await page.evaluate(() => {
        const el = document.querySelector('map-lit#block-map');
        const mapDefined = !!customElements.get('map-lit');
        const allMarkers = el?._allMarkers?.length ?? 0;
        const domMarkers = document.querySelectorAll('.leaflet-marker-icon').length;
        const clusters = document.querySelectorAll('.geo-cluster-wrapper').length;
        const tiles = document.querySelectorAll('.leaflet-tile').length;
        const mapRect = document.querySelector('.geo-map-leaflet')?.getBoundingClientRect();
        const filterCount = document.querySelectorAll(
            'input[type="checkbox"][name="category"][data-filter-type]',
        ).length;

        return {
            mapDefined,
            allMarkers,
            domMarkers,
            clusters,
            tiles,
            mapHeight: mapRect?.height ?? 0,
            filterCount,
        };
    });

    const summary = {
        url: TARGET_URL,
        expectedFeatures,
        ...runtime,
        mapLitRegistered: runtime.mapDefined,
        markersOk: runtime.allMarkers === expectedFeatures,
        clusterOrMarkersVisible: runtime.domMarkers + runtime.clusters > 0,
        tilesLoaded: runtime.tiles > 0,
        asset404Count: asset404.length,
        jsErrorsCount: jsErrors.length,
    };

    console.log(JSON.stringify(summary, null, 2));

    await page.screenshot({ path: 'scripts/map-lit-smoke.png', fullPage: false });
    await browser.close();

    const failed =
        !summary.mapLitRegistered ||
        !summary.markersOk ||
        !summary.clusterOrMarkersVisible ||
        !summary.tilesLoaded ||
        summary.asset404Count > 0;

    if (failed) {
        process.exitCode = 1;
    }
}

async function expectAttribute(locator, name, value) {
    const actual = await locator.getAttribute(name);
    if (actual !== value) {
        throw new Error(`Atteso ${name}="${value}", trovato "${actual}"`);
    }
}

run().catch((error) => {
    console.error(error);
    process.exit(1);
});
