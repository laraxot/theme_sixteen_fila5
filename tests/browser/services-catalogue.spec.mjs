import { test, expect } from '@playwright/test';

const BASE = process.env.FIXCITY_BASE_URL || 'http://localhost:8001';
const LOCALES = ['it', 'en', 'de', 'es'];
const VIEWPORTS = [320, 390, 768, 1440];

function relativeLuminance(color) {
    const channels = color.match(/[\d.]+/g).slice(0, 3).map(Number).map((value) => value / 255);
    const linear = channels.map((value) => value <= 0.04045 ? value / 12.92 : ((value + 0.055) / 1.055) ** 2.4);

    return (0.2126 * linear[0]) + (0.7152 * linear[1]) + (0.0722 * linear[2]);
}

function contrastRatio(foreground, background) {
    const first = relativeLuminance(foreground);
    const second = relativeLuminance(background);

    return (Math.max(first, second) + 0.05) / (Math.min(first, second) + 0.05);
}

test.describe('Design Comuni service catalogue scope', () => {
    test('keeps unpublished tenant sections out of navigation and rejects empty CMS pages', async ({ page }) => {
        test.setTimeout(90_000);
        const unpublishedPaths = [
            'events',
            'topics',
            'registrations',
            'summer-in-the-city',
            'local-police',
            'servizi',
        ];

        for (const locale of LOCALES) {
            await page.setViewportSize({ width: 390, height: 844 });
            const response = await page.goto(`${BASE}/${locale}/services`, { waitUntil: 'networkidle' });
            expect(response?.status()).toBe(200);

            const publishedDestinations = {
                management: `/${locale}/administration`,
                news: `/${locale}/news`,
                'all-services': `/${locale}/services`,
            };
            for (const [dataElement, destination] of Object.entries(publishedDestinations)) {
                await expect(page.locator(`[data-element="${dataElement}"]`).first()).toHaveAttribute('href', `${BASE}${destination}`);
            }

            for (const dataElement of ['live', 'all-topics']) {
                await expect(page.locator(`[data-element="${dataElement}"]`)).toHaveCount(0);
            }

            for (const path of unpublishedPaths) {
                const unavailable = await page.request.get(`${BASE}/${locale}/${path}`);
                expect(unavailable.status(), `${locale}/${path} must not render an empty 200 page`).toBe(404);
            }
        }
    });

    test('shows only supported FixCity tasks and a working report category at every locale and width', async ({ page }) => {
        for (const locale of LOCALES) {
            for (const width of VIEWPORTS) {
                await page.setViewportSize({ width, height: 900 });
                const pageErrors = [];
                const onPageError = (error) => pageErrors.push(error.message);
                page.on('pageerror', onPageError);

                const response = await page.goto(`${BASE}/${locale}/services`, { waitUntil: 'networkidle' });

                expect(response?.status()).toBe(200);
                await expect(page.locator('[data-service-searchable]')).toHaveCount(3);
                await expect(page.locator('#categories a')).toHaveAttribute('href', new RegExp(`/${locale}/lista-categorie#reports$`));
                const taskLinks = page.locator('a[href="#report"], a[href="#browse"], a[href="#track"]');
                await expect(taskLinks).toHaveCount(3);
                const taskLinkLayout = await taskLinks.evaluateAll((links) => links.map((link) => {
                    const nav = link.parentElement;
                    const style = getComputedStyle(nav);

                    return {
                        width: link.getBoundingClientRect().width,
                        navAvailableWidth: nav.clientWidth - Number.parseFloat(style.paddingLeft) - Number.parseFloat(style.paddingRight),
                        clientWidth: link.clientWidth,
                        scrollWidth: link.scrollWidth,
                        minHeight: link.getBoundingClientRect().height,
                    };
                }));
                for (const link of taskLinkLayout) {
                    expect(link.scrollWidth).toBeLessThanOrEqual(link.clientWidth + 1);
                    expect(link.minHeight).toBeGreaterThanOrEqual(44);
                    if (width < 640) {
                        expect(Math.abs(link.width - link.navAvailableWidth)).toBeLessThanOrEqual(1);
                    }
                }
                await expect(page.getByText(/Registry and civil status|Anagrafe e stato civile|Meldewesen und Personenstand|Padrón y registro civil/)).toHaveCount(0);
                const heroColors = await page.locator('#fixcity-services-hero').evaluate((hero) => ({
                    background: getComputedStyle(hero).backgroundColor,
                    heading: getComputedStyle(hero.querySelector('h1')).color,
                    subtitle: getComputedStyle(hero.querySelector('p')).color,
                }));
                expect(contrastRatio(heroColors.heading, heroColors.background)).toBeGreaterThanOrEqual(4.5);
                expect(contrastRatio(heroColors.subtitle, heroColors.background)).toBeGreaterThanOrEqual(4.5);
                expect(await page.evaluate(() => document.documentElement.scrollWidth)).toBe(width);
                expect(pageErrors).toEqual([]);

                page.off('pageerror', onPageError);
            }
        }
    });

    test('category route reaches reports and the service sheet guides guests into sign-in', async ({ page }) => {
        await page.setViewportSize({ width: 390, height: 844 });
        await page.goto(`${BASE}/it/services`, { waitUntil: 'networkidle' });
        await page.locator('#categories a').click();
        await expect(page).toHaveURL(/\/it\/lista-categorie#reports$/);
        await expect(page.locator('#reports')).toBeVisible();
        await expect(page.locator('#reports a')).toHaveAttribute('href', /\/it\/tickets$/);

        const locales = [
            { code: 'it', submit: 'Inizia la segnalazione', allReports: 'Tutte le segnalazioni' },
            { code: 'en', submit: 'Start a report', allReports: 'All reports' },
            { code: 'de', submit: 'Meldung starten', allReports: 'Alle Meldungen' },
            { code: 'es', submit: 'Iniciar una incidencia', allReports: 'Todas las incidencias' },
        ];

        for (const locale of locales) {
            await page.goto(`${BASE}/${locale.code}/services/report-issue`, { waitUntil: 'networkidle' });
            await expect(page.locator('#report-process-steps > li')).toHaveCount(5);
            await expect(page.getByRole('link', { name: locale.allReports })).toHaveAttribute('href', new RegExp(`/${locale.code}/tickets$`));
            await page.getByRole('link', { name: locale.allReports }).click();
            await expect(page).toHaveURL(new RegExp(`/${locale.code}/tickets$`));

            await page.goto(`${BASE}/${locale.code}/services/report-issue`, { waitUntil: 'networkidle' });
            await page.getByRole('link', { name: locale.submit }).click();
            await expect(page).toHaveURL(new RegExp(`/${locale.code}/auth/login$`));
        }
    });

    test('search announces a localized empty state and can be cleared', async ({ page }) => {
        await page.goto(`${BASE}/it/services`, { waitUntil: 'networkidle' });
        const search = page.getByRole('searchbox');
        await search.fill('termine-che-non-esiste');
        await expect(page.locator('#service-catalogue [data-service-searchable]:visible')).toHaveCount(0);
        await expect(page.getByText('Nessuna attività corrisponde alla ricerca. Prova con parole diverse.')).toBeVisible();
        await search.clear();
        await expect(page.locator('#service-catalogue [data-service-searchable]:visible')).toHaveCount(3);
    });
});
