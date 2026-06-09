const { chromium } = require('playwright');

const BASE_URL = process.env.PLAYWRIGHT_BASE_URL ?? 'http://127.0.0.1:8000';

async function stressScenario(label, geolocation) {
    const browser = await chromium.launch({ headless: true });
    const context = await browser.newContext({
        geolocation,
        permissions: ['geolocation'],
    });
    const page = await context.newPage({ viewport: { width: 1280, height: 900 } });

    await page.goto(`${BASE_URL}/it/`, { waitUntil: 'networkidle', timeout: 90000 });
    await page.waitForTimeout(7000);
    await page.locator('.map-box').scrollIntoViewIfNeeded();
    await page.waitForTimeout(1000);

    const snapshot = async (step) =>
        page.evaluate((stepName) => {
            const el = document.querySelector('map-lit#block-map');
            const center = el?._map?.getCenter();
            return {
                step: stepName,
                allMarkers: el?._allMarkers?.length ?? 0,
                domMarkers: document.querySelectorAll('.leaflet-marker-icon').length,
                clusters: document.querySelectorAll('.geo-cluster-wrapper').length,
                layerCount: el?._markersLayer?.getLayers?.()?.length ?? -1,
                removeOutside: el?._markersLayer?.options?.removeOutsideVisibleBounds ?? null,
                center: center ? { lat: center.lat, lng: center.lng, zoom: el._map.getZoom() } : null,
            };
        }, step);

    const steps = [];
    steps.push(await snapshot('initial'));

    for (let i = 0; i < 5; i++) {
        await page.evaluate(() => document.querySelector('map-lit#block-map')?._map?.panBy([90, 70]));
        await page.waitForTimeout(350);
        steps.push(await snapshot(`pan-${i}`));
    }

    await page.evaluate(() => document.querySelector('map-lit#block-map')?._map?.setZoom(16));
    await page.waitForTimeout(400);
    steps.push(await snapshot('zoom-16'));

    await page.evaluate(() => document.querySelector('map-lit#block-map')?._map?.setZoom(11));
    await page.waitForTimeout(400);
    steps.push(await snapshot('zoom-11'));

    await browser.close();

    const failed = steps.filter(
        (s) => s.allMarkers < 1 || s.layerCount < 1 || (label === 'bologna' && s.domMarkers + s.clusters < 1 && s.step !== 'initial'),
    );

    return { label, geolocation, steps, failed: failed.length, ok: failed.length === 0 };
}

async function run() {
    const bologna = await stressScenario('bologna', { latitude: 44.4875, longitude: 11.3425 });
    const rome = await stressScenario('rome', { latitude: 41.9028, longitude: 12.4964 });

    const summary = {
        bologna: { ok: bologna.ok, failed: bologna.failed, final: bologna.steps[bologna.steps.length - 1] },
        rome: {
            ok: rome.steps.every((s) => s.allMarkers === 12 && s.layerCount === 12),
            initialDom: rome.steps[0].domMarkers + rome.steps[0].clusters,
            removeOutside: rome.steps[0].removeOutside,
            final: rome.steps[rome.steps.length - 1],
        },
    };

    console.log(JSON.stringify({ bologna, rome, summary }, null, 2));

    if (!bologna.ok || !summary.rome.ok || summary.rome.removeOutside !== false) {
        process.exitCode = 1;
    }
}

run().catch((error) => {
    console.error(error);
    process.exit(1);
});
