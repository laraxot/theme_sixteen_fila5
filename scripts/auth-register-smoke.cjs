/**
 * Puppeteer smoke — /it/auth/register (RegisterWidget Sixteen).
 * Run: npm run test:auth-register-smoke (from laravel/Themes/Sixteen)
 */
const puppeteer = require('puppeteer');

const BASE_URL = process.env.PUPPETEER_BASE_URL ?? 'http://127.0.0.1:8000';
const TARGET_URL = `${BASE_URL}/it/auth/register`;
const STRONG_PASSWORD = 'Password1!Secure';

async function run() {
    const browser = await puppeteer.launch({ headless: true });
    const page = await browser.newPage();
    await page.setViewport({ width: 1280, height: 900 });

    await page.goto(TARGET_URL, { waitUntil: 'networkidle2', timeout: 60000 });

    const heading = await page.$('#auth-register-heading');
    if (!heading) {
        throw new Error('Register heading #auth-register-heading not found');
    }

    await page.type('input[autocomplete="given-name"]', 'Smoke');
    await page.type('input[autocomplete="family-name"]', 'Test');
    await page.type('input[autocomplete="email"]', `puppeteer-${Date.now()}@example.test`);

    const passwordInputs = await page.$$('input[autocomplete="new-password"]');
    if (passwordInputs.length < 2) {
        throw new Error('Expected two password fields on register form');
    }
    await passwordInputs[0].type(STRONG_PASSWORD);
    await passwordInputs[1].type(STRONG_PASSWORD);

    const [response] = await Promise.all([
        page.waitForResponse(
            (res) => res.url().includes('/livewire') && res.request().method() === 'POST',
            { timeout: 30000 },
        ),
        page.click('form button[type="submit"]'),
    ]);

    if (response.status() >= 500) {
        throw new Error(`Livewire POST HTTP ${response.status()}`);
    }

    const body = await response.text();
    if (body.includes('Internal Server Error') || body.includes('Class "standard" not found')) {
        throw new Error('Livewire response contains server error payload');
    }

    console.log('auth-register-smoke: OK');
    await browser.close();
}

run().catch((err) => {
    console.error('auth-register-smoke: FAIL', err.message);
    process.exit(1);
});
