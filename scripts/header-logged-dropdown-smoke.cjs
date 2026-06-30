/**
 * Smoke: header logged dropdown — mobile avatar-only + menu parity.
 * Usage: node scripts/header-logged-dropdown-smoke.cjs
 */
const puppeteer = require('puppeteer');

const BASE = process.env.PLAYWRIGHT_BASE_URL || 'http://127.0.0.1:8000';
const EMAIL = 'test-header@fixcity.test';
const PASSWORD = 'testpassword123';
const OUT = '/tmp/header-parity/puppeteer-mobile-dropdown.png';

async function login(page) {
  await page.goto(`${BASE}/it/auth/login`, { waitUntil: 'networkidle2', timeout: 45000 });
  await page.waitForSelector('input[wire\\:model="data.email"]', { timeout: 15000 });
  await page.type('input[wire\\:model="data.email"]', EMAIL, { delay: 20 });
  await page.type('input[wire\\:model="data.password"]', PASSWORD, { delay: 20 });
  await page.click('button[type="submit"]');
  await page.waitForNavigation({ waitUntil: 'networkidle2', timeout: 45000 }).catch(() => {});
  await new Promise((r) => setTimeout(r, 3000));
}

async function assertMobile(page) {
  await page.setViewport({ width: 375, height: 812, deviceScaleFactor: 1 });
  await page.goto(`${BASE}/it/`, { waitUntil: 'networkidle2', timeout: 45000 });
  await page.waitForSelector('#header-user-toggle', { timeout: 15000 });

  const checks = await page.evaluate(() => {
    const toggle = document.querySelector('#header-user-toggle');
    const menu = document.querySelector('#header-user-menu');
    const nameSpans = toggle ? [...toggle.querySelectorAll('.d-none.d-lg-block')] : [];
    const nameVisible = nameSpans.some((el) => {
      const s = window.getComputedStyle(el);
      return s.display !== 'none' && s.visibility !== 'hidden' && el.offsetParent !== null;
    });
    const toggleRect = toggle?.getBoundingClientRect();
    const width = toggleRect ? Math.round(toggleRect.width) : 0;
    return {
      hasToggle: !!toggle,
      hasMenu: !!menu,
      nameVisible,
      toggleWidth: width,
      dividerCount: menu ? menu.querySelectorAll('span.divider').length : -1,
    };
  });

  if (!checks.hasToggle) throw new Error('Manca #header-user-toggle');
  if (checks.nameVisible) throw new Error('Nome utente visibile su mobile');
  if (checks.toggleWidth > 80) throw new Error(`Toggle troppo largo su mobile: ${checks.toggleWidth}px`);

  await page.click('#header-user-toggle');
  await new Promise((r) => setTimeout(r, 800));

  const menuOpen = await page.evaluate(() => {
    const menu = document.querySelector('#header-user-menu');
    if (!menu) return false;
    const s = window.getComputedStyle(menu);
    return s.display !== 'none' && menu.classList.contains('show');
  });
  if (!menuOpen) throw new Error('Dropdown non aperto');

  const items = await page.evaluate(() => {
    const menu = document.querySelector('#header-user-menu');
    return menu ? menu.innerText : '';
  });
  for (const label of ['I miei servizi', 'Le mie pratiche', 'Notifiche', 'Impostazioni', 'Esci']) {
    if (!items.includes(label)) throw new Error(`Voce mancante: ${label}`);
  }

  if (checks.dividerCount !== 1) throw new Error(`Divider attesi 1, trovati ${checks.dividerCount}`);

  const fs = require('fs');
  fs.mkdirSync('/tmp/header-parity', { recursive: true });
  await page.screenshot({ path: OUT, fullPage: false });
  console.log('OK puppeteer mobile dropdown →', OUT);
}

(async () => {
  const browser = await puppeteer.launch({ headless: 'new', args: ['--no-sandbox'] });
  try {
    const page = await browser.newPage();
    await login(page);
    await assertMobile(page);
  } finally {
    await browser.close();
  }
})().catch((err) => {
  console.error('FAIL', err.message);
  process.exit(1);
});
