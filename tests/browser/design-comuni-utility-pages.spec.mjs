import { test, expect } from '@playwright/test';

const BASE = process.env.FIXCITY_BASE_URL || 'http://localhost:8001';
const LOCALES = [
    { code: 'it', faq: 'Domande frequenti', sitemap: 'Mappa del sito', service: 'Servizio di segnalazione' },
    { code: 'en', faq: 'Frequently asked questions', sitemap: 'Site map', service: 'Reporting service' },
    { code: 'de', faq: 'Häufige Fragen', sitemap: 'Sitemap', service: 'Meldedienst' },
    { code: 'es', faq: 'Preguntas frecuentes', sitemap: 'Mapa del sitio', service: 'Servicio de avisos' },
];
const WIDTHS = [320, 390, 768, 1440];

test('FAQ and site map are real, localized and usable at all supported widths', async ({ page }) => {
    for (const locale of LOCALES) {
        for (const width of WIDTHS) {
            await page.setViewportSize({ width, height: 900 });
            const pageErrors = [];
            const onPageError = (error) => pageErrors.push(error.message);
            page.on('pageerror', onPageError);

            const faqResponse = await page.goto(`${BASE}/${locale.code}/domande-frequenti`, { waitUntil: 'networkidle' });
            expect(faqResponse?.status()).toBe(200);
            await expect(page.getByRole('heading', { level: 1, name: locale.faq })).toBeVisible();
            await expect(page.locator('#faq-content details')).toHaveCount(5);
            await expect(page.locator('#faq-content')).not.toContainText(/Lorem Ipsum|pub_theme::|fixcity::/i);
            const firstFaq = page.locator('#faq-content details').first();
            await firstFaq.locator('summary').focus();
            await page.keyboard.press('Enter');
            await expect(firstFaq.locator('p')).toBeVisible();
            await expect(page.getByRole('link', { name: locale.service })).toHaveAttribute('href', new RegExp(`/${locale.code}/services/report-issue$`));
            await expect(page.locator(`footer a[href$="/${locale.code}/mappa-sito"]`)).toBeVisible();
            expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBe(width);
            expect(pageErrors).toEqual([]);

            const sitemapResponse = await page.goto(`${BASE}/${locale.code}/mappa-sito`, { waitUntil: 'networkidle' });
            expect(sitemapResponse?.status()).toBe(200);
            await expect(page.getByRole('heading', { level: 1, name: locale.sitemap })).toBeVisible();
            await expect(page.locator('#sitemap-content section')).toHaveCount(3);
            await expect(page.locator('#sitemap-content')).not.toContainText(/pub_theme::|fixcity::/i);
            await expect(page.locator(`#sitemap-content a[href$="/${locale.code}/tickets"]`)).toBeVisible();
            await expect(page.locator(`#sitemap-content a[href$="/${locale.code}/area-personale/pratiche"]`)).toBeVisible();
            await expect(page.locator(`footer a[href$="/${locale.code}/domande-frequenti"]`)).toBeVisible();
            expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBe(width);
            expect(pageErrors).toEqual([]);

            page.off('pageerror', onPageError);
        }
    }
});

test('site map keeps the guest personal-area redirect local to the selected language', async ({ page }) => {
    for (const locale of LOCALES) {
        await page.goto(`${BASE}/${locale.code}/mappa-sito`, { waitUntil: 'networkidle' });
        await page.locator(`#sitemap-content a[href$="/${locale.code}/area-personale/pratiche"]`).click();
        await expect(page).toHaveURL(new RegExp(`/${locale.code}/auth/login$`));
    }
});
