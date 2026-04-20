const { chromium } = require('playwright');

const TARGET_URL =
    'http://127.0.0.1:8000/it/tests/segnalazione-crea?step=form.dati-della-segnalazione%3A%3Adata%3A%3Awizard-step';

async function run() {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1440, height: 900 } });

    const jsErrors = [];
    const failedRequests = [];

    page.on('console', (msg) => {
        if (msg.type() === 'error') {
            jsErrors.push(msg.text());
        }
    });

    page.on('requestfailed', (request) => {
        failedRequests.push({
            url: request.url(),
            method: request.method(),
            failure: request.failure()?.errorText ?? 'unknown',
        });
    });

    page.on('response', (response) => {
        const status = response.status();
        if (status >= 400) {
            failedRequests.push({
                url: response.url(),
                method: response.request().method(),
                failure: `HTTP ${status}`,
            });
        }
    });

    await page.goto(TARGET_URL, { waitUntil: 'networkidle', timeout: 60000 });

    await page.waitForSelector('map-picker-lit', { timeout: 30000 });
    // Scope al componente Geo: evita collisioni con altre `.leaflet-container` nella pagina.
    const mapPane = page.locator('map-picker-lit .leaflet-container').first();
    await mapPane.waitFor({ state: 'visible', timeout: 60000 });

    const beforeValues = await page.$$eval('input[type="number"]', (inputs) =>
        inputs.map((input) => input.value),
    );

    await mapPane.click({ position: { x: 320, y: 200 } });
    await page.waitForTimeout(800);

    const afterValues = await page.$$eval('input[type="number"]', (inputs) =>
        inputs.map((input) => input.value),
    );

    const markerCount = await page.evaluate(() => {
        const markerNodes = document.querySelectorAll(
            '.leaflet-marker-pane .leaflet-marker-icon, .leaflet-marker-pane .map-picker-marker, .leaflet-marker-pane img, .leaflet-marker-pane div',
        );

        return markerNodes.length;
    });
    const coordChanged =
        beforeValues.length >= 2 &&
        afterValues.length >= 2 &&
        (beforeValues[0] !== afterValues[0] || beforeValues[1] !== afterValues[1]);

    const markerAssetErrors = failedRequests.filter((entry) =>
        /markers_default|markers_shadow|map-picker-marker/i.test(entry.url),
    );

    await page.screenshot({
        path: 'scripts/map-picker-smoke.png',
        fullPage: true,
    });

    await browser.close();

    const summary = {
        url: TARGET_URL,
        markerVisible: markerCount > 0,
        markerCount,
        coordChanged,
        markerAssetErrorsCount: markerAssetErrors.length,
        jsErrorsCount: jsErrors.length,
        failedRequestsCount: failedRequests.length,
    };

    console.log(JSON.stringify(summary, null, 2));

    if (!summary.coordChanged || summary.markerAssetErrorsCount > 0 || summary.failedRequestsCount > 0) {
        process.exitCode = 1;
    }
}

run().catch((error) => {
    console.error(error);
    process.exit(1);
});

