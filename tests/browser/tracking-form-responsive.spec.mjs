import { test, expect, chromium } from '@playwright/test';

const BASE = process.env.FIXCITY_BASE_URL || 'http://localhost:8001';
const LOCALES = ['it', 'en', 'de', 'es'];
const WIDTHS = [320, 390, 575, 576, 768, 1440];

test('tracking search remains readable, responsive and keyboard-operable', async () => {
  const browser = await chromium.launch({ headless: true });
  const failures = [];

  for (const locale of LOCALES) {
    const page = await browser.newPage({ viewport: { width: WIDTHS[0], height: 900 } });
    const pageErrors = [];
    page.on('pageerror', (error) => pageErrors.push(error.message));

    try {
      const response = await page.goto(`${BASE}/${locale}/tickets/track`, {
        waitUntil: 'domcontentloaded',
        timeout: 30000,
      });
      expect(response?.status(), `${locale} response`).toBe(200);

      const input = page.locator('#ticket-track-code');
      const button = page.locator('.ticket-track-search-group button[type="submit"]');
      await expect(input).toBeVisible();
      await expect(input).toHaveAttribute('required', '');
      await expect(input).toHaveAttribute('aria-describedby', /ticket-track-help/);
      await expect(page.locator('label[for="ticket-track-code"]')).toBeVisible();
      await expect(page.locator('#ticket-track-help')).toBeVisible();

      for (const width of WIDTHS) {
        await page.setViewportSize({ width, height: 900 });
        const geometry = await page.evaluate(() => {
          const inputRect = document.querySelector('#ticket-track-code').getBoundingClientRect();
          const buttonRect = document.querySelector('.ticket-track-search-group button').getBoundingClientRect();
          return {
            input: { x: inputRect.x, y: inputRect.y, width: inputRect.width, right: inputRect.right, bottom: inputRect.bottom },
            button: { x: buttonRect.x, y: buttonRect.y, width: buttonRect.width, right: buttonRect.right, bottom: buttonRect.bottom },
            scrollWidth: document.documentElement.scrollWidth,
            clientWidth: document.documentElement.clientWidth,
          };
        });

        expect(geometry.scrollWidth, `${locale} ${width}px page overflow`).toBeLessThanOrEqual(geometry.clientWidth);
        if (width <= 575) {
          expect(Math.abs(geometry.input.x - geometry.button.x), `${locale} ${width}px alignment`).toBeLessThanOrEqual(1);
          expect(Math.abs(geometry.input.width - geometry.button.width), `${locale} ${width}px full width`).toBeLessThanOrEqual(1);
          expect(geometry.button.y, `${locale} ${width}px stacked action`).toBeGreaterThanOrEqual(geometry.input.bottom + 7);
          expect(geometry.button.width, `${locale} ${width}px touch target`).toBeGreaterThanOrEqual(44);
        } else {
          expect(Math.abs(geometry.input.y - geometry.button.y), `${locale} ${width}px inline alignment`).toBeLessThanOrEqual(1);
          expect(geometry.button.x, `${locale} ${width}px inline order`).toBeGreaterThanOrEqual(geometry.input.right);
        }
      }

      await input.focus();
      await expect(input).toBeFocused();
      await page.keyboard.press('Tab');
      await expect(button).toBeFocused();
      expect(pageErrors, `${locale} page errors`).toEqual([]);
    } catch (error) {
      failures.push(`${locale}: ${error.message}`);
    } finally {
      await page.close();
    }
  }

  await browser.close();
  expect(failures).toEqual([]);
});
