const { chromium } = require('playwright');
const path = require('path');
const fs = require('fs');

const TARGET_URL = 'http://127.0.0.1:8000/fixcity/admin/tickets/create';
const SCREENSHOT_PATH = 'scripts/fixcity-admin-ticket-create-map.png';

function loadAdminCredentials() {
    const envPath = path.resolve(__dirname, '../../../.env');
    if (fs.existsSync(envPath)) {
        require('dotenv').config({ path: envPath });
    }

    const email =
        process.env.FIXCITY_ADMIN_EMAIL ||
        process.env.ADMIN_EMAIL ||
        process.env.FILAMENT_ADMIN_EMAIL ||
        '';
    const password =
        process.env.FIXCITY_ADMIN_PASSWORD ||
        process.env.ADMIN_PASSWORD ||
        process.env.FILAMENT_ADMIN_PASSWORD ||
        '';

    if (!email || !password) {
        throw new Error(
            `Credenziali admin mancanti in laravel/.env (${envPath}). ` +
            'Definisci FIXCITY_ADMIN_EMAIL e FIXCITY_ADMIN_PASSWORD.',
        );
    }

    return { email, password };
}

async function loginIfNeeded(page) {
    await page.goto(TARGET_URL, { waitUntil: 'domcontentloaded', timeout: 60000 }).catch(() => {});
    await page.waitForTimeout(1000);

    if (!page.url().includes('/login') && !page.url().includes('/auth/login')) {
        return;
    }

    const creds = loadAdminCredentials();
    const email = page.locator('input[type="email"], input[name="email"], input[name="data.email"]').first();
    const password = page.locator('input[type="password"], input[name="password"], input[name="data.password"]').first();
    const submit = page.locator('button[type="submit"], button:has-text("Accedi"), button:has-text("Login")').first();

    await email.fill(creds.email);
    await password.fill(creds.password);

    await Promise.all([
        page.waitForURL((url) => !url.pathname.includes('/login') && !url.pathname.includes('/auth/login'), { timeout: 30000 }).catch(() => {}),
        submit.click(),
    ]);

    await page.waitForTimeout(1500);
}

async function run() {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1440, height: 1200 } });

    const jsErrors = [];
    const requestFailures = [];

    page.on('console', (msg) => {
        if (msg.type() === 'error') {
            jsErrors.push(msg.text());
        }
    });

    page.on('pageerror', (error) => {
        jsErrors.push(error.message);
    });

    page.on('requestfailed', (request) => {
        requestFailures.push({
            url: request.url(),
            method: request.method(),
            failure: request.failure()?.errorText ?? 'unknown',
        });
    });

    page.on('response', (response) => {
        if (response.status() >= 400) {
            requestFailures.push({
                url: response.url(),
                method: response.request().method(),
                failure: `HTTP ${response.status()}`,
            });
        }
    });

    await loginIfNeeded(page);
    await page.goto(TARGET_URL, { waitUntil: 'domcontentloaded', timeout: 60000 });
    await page.waitForSelector('coordinate-picker-lit', { timeout: 30000 });
    await page.waitForTimeout(1500);

    const snapshot = await page.evaluate(() => {
        const host = document.querySelector('coordinate-picker-lit');
        const mapContainer = host?.querySelector('.map-container') ?? null;
        const pane = host?.querySelector('.map-picker-leaflet-pane') ?? null;
        const leaflet = host?.querySelector('.leaflet-container') ?? null;
        const marker = host?.querySelector('.leaflet-marker-pane .leaflet-marker-icon, .leaflet-marker-pane img, .leaflet-marker-pane div') ?? null;

        const inspect = (el) => {
            if (!el) {
                return null;
            }

            const rect = el.getBoundingClientRect();
            const style = window.getComputedStyle(el);

            return {
                width: rect.width,
                height: rect.height,
                top: rect.top,
                left: rect.left,
                display: style.display,
                position: style.position,
                visibility: style.visibility,
                opacity: style.opacity,
                overflow: style.overflow,
                zIndex: style.zIndex,
            };
        };

        return {
            url: window.location.href,
            title: document.title,
            hostExists: Boolean(host),
            mapContainer: inspect(mapContainer),
            pane: inspect(pane),
            leaflet: inspect(leaflet),
            marker: inspect(marker),
            leafletTiles: host ? host.querySelectorAll('.leaflet-tile').length : 0,
            markerCount: host
                ? host.querySelectorAll('.leaflet-marker-pane .leaflet-marker-icon, .leaflet-marker-pane img, .leaflet-marker-pane div').length
                : 0,
            bodyClasses: document.body.className,
            htmlClasses: document.documentElement.className,
            snippet: host ? host.outerHTML.slice(0, 2000) : null,
        };
    });

    await page.screenshot({ path: SCREENSHOT_PATH, fullPage: true });
    await browser.close();

    const result = {
        targetUrl: TARGET_URL,
        screenshot: SCREENSHOT_PATH,
        jsErrors,
        requestFailures,
        snapshot,
    };

    console.log(JSON.stringify(result, null, 2));

    if (!snapshot.hostExists || jsErrors.length > 0) {
        process.exitCode = 1;
    }
}

run().catch((error) => {
    console.error(error);
    process.exit(1);
});
