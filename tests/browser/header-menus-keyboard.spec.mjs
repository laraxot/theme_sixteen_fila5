/**
 * DCP-143: dai menu a tendina dell'intestazione (lingua, utente) Esc chiude il menu E riporta il focus sul pulsante che lo apre.
 * Prima il focus finiva sul body (la voce di menu col focus veniva nascosta): chi usa la tastiera ripartiva dall'inizio della pagina (WCAG 2.4.3).
 *
 * Run: cd laravel/Themes/Sixteen && FIXCITY_BASE_URL=http://127.0.0.1:8091 [FIXCITY_STORAGE_STATE=/tmp/scratch-auth-fixture-$USER/auth.json] \
 *        npx playwright test tests/browser/header-menus-keyboard.spec.mjs --reporter=list
 * Il menu utente richiede una sessione (storageState da scratch-auth-fixture.sh); senza, il test e' saltato e dichiarato tale.
 */
import { existsSync } from 'node:fs';
import { test, expect } from '@playwright/test';

const BASE = process.env.FIXCITY_BASE_URL || 'http://127.0.0.1:8000';
const STATE = process.env.FIXCITY_STORAGE_STATE || '';
const exe = [process.env.PLAYWRIGHT_CHROMIUM_EXECUTABLE_PATH, ...[1248, 1247, 1243].map((n) => `${process.env.HOME}/.cache/ms-playwright/chromium-${n}/chrome-linux64/chrome`)].filter(Boolean).find(existsSync);
test.use({ launchOptions: { executablePath: exe, args: ['--no-sandbox', '--disable-dev-shm-usage'] }, viewport: { width: 1280, height: 900 } });

async function escapeReturnsFocus(page, toggle) {
  await toggle.focus();
  await page.keyboard.press('Enter');
  await expect(toggle).toHaveAttribute('aria-expanded', 'true');
  await page.keyboard.press('Tab'); // il focus entra nel menu
  await page.keyboard.press('Escape');
  await expect(toggle).toHaveAttribute('aria-expanded', 'false');
  await expect(toggle, 'il focus torna sul pulsante del menu').toBeFocused();
}

test('selettore lingua: Esc chiude il menu e il focus torna al pulsante', async ({ page }) => {
  await page.goto(`${BASE}/it`, { waitUntil: 'load' });
  await escapeReturnsFocus(page, page.locator('button:has-text("Lingua attiva")').first());
});

test('menu utente: Esc chiude il menu e il focus torna al pulsante', async ({ browser }) => {
  test.skip(!STATE, 'serve FIXCITY_STORAGE_STATE (sessione di prova) per il menu utente');
  const context = await browser.newContext({ storageState: STATE, viewport: { width: 1280, height: 900 } });
  const page = await context.newPage();
  await page.goto(`${BASE}/it`, { waitUntil: 'load' });
  await escapeReturnsFocus(page, page.locator('#header-user-toggle'));
  await context.close();
});
