/**
 * DCP-143: axe-core (wcag2a, wcag2aa, wcag21a, wcag21aa) sulle pagine pubbliche e, con una sessione, sul wizard e sull'area personale, a 375 e 1440 px.
 * Fallisce se compare una violazione serious o critical (A11Y_STRICT=1: qualunque violazione). Il resto resta nel report di ogni test.
 * Non sostituisce l'audit manuale (tastiera, ordine del focus, lettore di schermo): vedi la story DCP-143.
 *
 * Run: cd laravel/Themes/Sixteen && FIXCITY_BASE_URL=http://127.0.0.1:8091 FIXCITY_STORAGE_STATE=/tmp/scratch-auth-fixture-$USER/auth.json \
 *        npx playwright test tests/browser/a11y-axe.spec.mjs --reporter=list
 * Senza FIXCITY_STORAGE_STATE le pagine con login sono saltate (e dichiarate "skipped", non superate). Nessuna credenziale in questo file:
 * la sessione viene da scratch-auth-fixture.sh (utente di prova isolato, mai quello master).
 */
import { existsSync } from 'node:fs';
import { test, expect } from '@playwright/test';
import AxeBuilder from '@axe-core/playwright';

const BASE = process.env.FIXCITY_BASE_URL || 'http://127.0.0.1:8000';
const STATE = process.env.FIXCITY_STORAGE_STATE || '';
const STRICT = process.env.A11Y_STRICT === '1';
const TAGS = ['wcag2a', 'wcag2aa', 'wcag21a', 'wcag21aa'];
const WIDTHS = [375, 1440];
const WIZARD2 = '/it/tickets/create?step=form.dati-di-segnalazione%3A%3Adata%3A%3Awizard-step';
const exe = [process.env.PLAYWRIGHT_CHROMIUM_EXECUTABLE_PATH, ...[1248, 1247, 1243].map((n) => `${process.env.HOME}/.cache/ms-playwright/chromium-${n}/chrome-linux64/chrome`)].filter(Boolean).find(existsSync);
test.use({ launchOptions: { executablePath: exe, args: ['--no-sandbox', '--disable-dev-shm-usage'] } });

const guestPages = ['/it', '/en', '/it/auth/login', '/it/auth/register', '/it/tickets/track', '/it/domande-frequenti', '/it/mappa-sito', '/it/tickets'];
const accountPages = ['/it/area-personale/pratiche', '/it/area-personale/seguite', '/it/area-personale/notifiche', '/it/area-personale/impostazioni'];

/** Porta il wizard al Riepilogo: punto sulla mappa (i primi clic a zoom basso avvicinano soltanto), tipo, titolo, descrizione, Avanti. */
async function goToReview(page) {
  // Nominatim finto (come nella sonda della mappa): l'indirizzo obbligatorio arriva sempre, senza dipendere dal servizio pubblico e dai suoi limiti.
  await page.route(/nominatim\.openstreetmap\.org/, (route) => route.fulfill({ status: 200, contentType: 'application/json', headers: { 'access-control-allow-origin': '*' }, body: JSON.stringify({ display_name: 'Via di prova 1, Citta di prova' }) }));
  await page.goto(BASE + WIZARD2, { waitUntil: 'load', timeout: 60000 });
  await page.waitForFunction(() => document.querySelector('coordinate-picker-lit:not([readonly])')?._map, null, { timeout: 30000 });
  await page.waitForTimeout(2500);
  const pane = await page.$('coordinate-picker-lit:not([readonly]) .map-picker-leaflet-pane');
  await pane.scrollIntoViewIfNeeded();
  const box = await pane.boundingBox();
  for (let i = 0; i < 5; i += 1) {
    await page.mouse.click(box.x + box.width * 0.45, box.y + box.height * 0.5);
    await page.waitForTimeout(700);
    if (await page.evaluate(() => document.querySelector('coordinate-picker-lit:not([readonly])')?._lat != null)) break;
  }
  await page.selectOption('select[id="form.type"]', { index: 1 });
  await page.locator('input[id*="name"], input[wire\\:model*="name"]').first().fill('Prova accessibilita');
  await page.locator('textarea').first().fill('Descrizione di prova per la verifica di accessibilita del riepilogo.');
  await page.waitForTimeout(800);
  await page.locator('button:has-text("Avanti"):visible').first().click();
  await page.waitForSelector('coordinate-picker-lit[readonly]', { timeout: 20000 });
  await page.waitForTimeout(2500);
}

/** axe puo' scontrarsi con una navigazione o un morph Livewire ancora in corso ("Execution context was destroyed"): si riprova, un errore vero resta un errore. */
async function analyze(page) {
  for (let attempt = 1; ; attempt += 1) {
    try { return await new AxeBuilder({ page }).withTags(TAGS).exclude('.phpdebugbar').analyze(); } catch (error) {
      if (attempt >= 3 || !/context was destroyed|navigation|detached/i.test(String(error))) throw error;
      await page.waitForTimeout(1500);
    }
  }
}

const checks = [
  ...guestPages.map((path) => ({ name: path, auth: false, open: (page) => page.goto(BASE + path, { waitUntil: 'networkidle', timeout: 60000 }) })),
  { name: 'wizard passo 1', auth: true, open: (page) => page.goto(BASE + '/it/tickets/create', { waitUntil: 'networkidle', timeout: 60000 }) },
  { name: 'wizard passo 2 (dati e mappa)', auth: true, open: async (page) => { await page.goto(BASE + WIZARD2, { waitUntil: 'load', timeout: 60000 }); await page.waitForFunction(() => document.querySelector('coordinate-picker-lit')?._map, null, { timeout: 30000 }); await page.waitForTimeout(2500); } },
  { name: 'wizard Riepilogo', auth: true, open: goToReview },
  ...accountPages.map((path) => ({ name: path, auth: true, open: (page) => page.goto(BASE + path, { waitUntil: 'networkidle', timeout: 60000 }) })),
];

for (const width of WIDTHS) {
  for (const check of checks) {
    test(`axe ${check.name} a ${width}px`, async ({ browser }) => {
      test.skip(check.auth && !STATE, 'serve FIXCITY_STORAGE_STATE (sessione di prova) per le pagine con login');
      const context = await browser.newContext({
        viewport: { width, height: 800 }, locale: 'it-IT', timezoneId: 'Europe/Rome',
        ...(check.auth ? { storageState: STATE } : {}),
      });
      const page = await context.newPage();
      await check.open(page);
      await page.waitForTimeout(1200);
      const { violations } = await analyze(page);
      await context.close();

      const lines = violations.map((v) => `${v.impact} ${v.id} x${v.nodes.length} :: ${v.nodes[0].target.join(' ').slice(0, 90)} :: ${v.nodes[0].html.replace(/\s+/g, ' ').slice(0, 120)}`);
      console.log(`[${check.name} ${width}px] ${violations.length} violazioni${lines.length ? `\n  ${lines.join('\n  ')}` : ''}`);
      const blocking = violations.filter((v) => STRICT || ['serious', 'critical'].includes(v.impact));
      expect(blocking.map((v) => `${v.impact} ${v.id}`), 'violazioni axe bloccanti').toEqual([]);
    });
  }
}
