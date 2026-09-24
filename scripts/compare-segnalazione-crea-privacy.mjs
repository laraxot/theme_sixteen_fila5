#!/usr/bin/env node

import { chromium } from 'playwright';
import puppeteer from 'puppeteer';
import { mkdirSync, writeFileSync } from 'node:fs';
import { dirname, join } from 'node:path';
import { fileURLToPath } from 'node:url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

const outputDir = join(__dirname, '..', 'docs', 'visual-analysis', 'segnalazione-crea-privacy');
const viewport = { width: 1366, height: 900 };

const urls = {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-crea?step=form.privacy',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html',
};

const expected = {
    steps: ['Autorizzazioni e condizioni', 'Dati di segnalazione', 'Riepilogo'],
    privacyText: 'Il Comune di Firenze gestisce i dati personali forniti e liberamente comunicati',
    checkbox: 'Ho letto e compreso',
};

mkdirSync(outputDir, { recursive: true });

function isVisibleRect(rect) {
    return rect !== null && rect.width > 0 && rect.height > 0;
}

async function collectMetrics(page, label, engine) {
    await page.goto(urls[label], {
        waitUntil: engine === 'puppeteer' ? 'networkidle0' : 'networkidle',
        timeout: 45000,
    });

    if (page.evaluate) {
        await page.evaluate(() => document.fonts?.ready ?? Promise.resolve());
    }

    await new Promise((resolve) => setTimeout(resolve, 1200));

    const screenshotPath = join(outputDir, `${engine}-${label}.png`);
    await page.screenshot({ path: screenshotPath, fullPage: true });

    return page.evaluate((expectedValues) => {
        const rectFor = (selector) => {
            const element = document.querySelector(selector);
            if (!element) {
                return null;
            }

            const rect = element.getBoundingClientRect();

            return {
                x: Math.round(rect.x),
                y: Math.round(rect.y),
                width: Math.round(rect.width),
                height: Math.round(rect.height),
            };
        };

        const styleFor = (selector) => {
            const element = document.querySelector(selector);
            if (!element) {
                return null;
            }

            const style = window.getComputedStyle(element);

            return {
                color: style.color,
                backgroundColor: style.backgroundColor,
                fontFamily: style.fontFamily,
                fontSize: style.fontSize,
                fontWeight: style.fontWeight,
                lineHeight: style.lineHeight,
                display: style.display,
            };
        };

        const visibleText = document.body.innerText.replace(/\s+/g, ' ').trim();
        const stepLabels = Array.from(document.querySelectorAll('.steppers li, .steppers-list li'))
            .map((element) => element.textContent.replace(/\s+/g, ' ').replace(/\(.*?\)/g, '').trim())
            .filter(Boolean);
        const activeStep = document.querySelector('.steppers li.active, .steppers-list li.active, .steppers li[aria-current="step"]');
        const form = document.querySelector('.wizard-dc-form-shell form');
        const wrongHook = document.querySelector('.fixcity-wizard-form');

        return {
            url: window.location.href,
            title: document.querySelector('h1')?.textContent?.trim() ?? null,
            stepLabels,
            activeStep: activeStep?.textContent?.replace(/\s+/g, ' ').trim() ?? null,
            containsExpectedSteps: expectedValues.steps.every((step) => visibleText.includes(step)),
            containsPrivacyText: visibleText.includes(expectedValues.privacyText),
            containsCheckboxText: visibleText.includes(expectedValues.checkbox),
            containsWrongHook: Boolean(wrongHook),
            rects: {
                title: rectFor('h1'),
                stepper: rectFor('.steppers'),
                stepperHeader: rectFor('.steppers-header'),
                formShell: rectFor('.wizard-dc-form-shell'),
                form: form ? rectFor('.wizard-dc-form-shell form') : null,
                activeStep: rectFor('.steppers li.active, .steppers-list li.active, .steppers li[aria-current="step"]'),
                privacySection: rectFor('.fi-section, .privacy-section, [data-field-wrapper]'),
                checkbox: rectFor('input[type="checkbox"]'),
            },
            styles: {
                body: styleFor('body'),
                title: styleFor('h1'),
                stepper: styleFor('.steppers'),
                activeStep: styleFor('.steppers li.active, .steppers-list li.active, .steppers li[aria-current="step"]'),
                form: styleFor('.wizard-dc-form-shell form'),
                checkboxLabel: styleFor('label, .fi-fo-field-wrp-label'),
            },
        };
    }, expected);
}

function compare(local, reference) {
    const localFormVisible = isVisibleRect(local.rects.form);
    const refStepperVisible = isVisibleRect(reference.rects.stepper);
    const localStepperVisible = isVisibleRect(local.rects.stepper);

    return {
        labelsMatchReference: expected.steps.every((step) => local.stepLabels.includes(step)),
        privacyTextVisible: local.containsPrivacyText,
        checkboxTextVisible: local.containsCheckboxText,
        wrongHookAbsent: !local.containsWrongHook,
        localFormVisible,
        localStepperVisible,
        refStepperVisible,
        widthDelta: {
            stepper: localStepperVisible && refStepperVisible
                ? local.rects.stepper.width - reference.rects.stepper.width
                : null,
            form: localFormVisible && isVisibleRect(reference.rects.form)
                ? local.rects.form.width - reference.rects.form.width
                : null,
        },
        activeStepColor: {
            local: local.styles.activeStep?.color ?? null,
            reference: reference.styles.activeStep?.color ?? null,
        },
    };
}

async function runPlaywright() {
    const browser = await chromium.launch({ headless: true });
    const context = await browser.newContext({ viewport });

    try {
        const localPage = await context.newPage();
        const referencePage = await context.newPage();
        const local = await collectMetrics(localPage, 'local', 'playwright');
        const reference = await collectMetrics(referencePage, 'reference', 'playwright');

        return { local, reference, comparison: compare(local, reference) };
    } finally {
        await browser.close();
    }
}

async function runPuppeteer() {
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox'],
    });

    try {
        const localPage = await browser.newPage();
        const referencePage = await browser.newPage();
        await localPage.setViewport(viewport);
        await referencePage.setViewport(viewport);

        const local = await collectMetrics(localPage, 'local', 'puppeteer');
        const reference = await collectMetrics(referencePage, 'reference', 'puppeteer');

        return { local, reference, comparison: compare(local, reference) };
    } finally {
        await browser.close();
    }
}

const report = {
    timestamp: new Date().toISOString(),
    viewport,
    urls,
    expected,
    playwright: await runPlaywright(),
    puppeteer: await runPuppeteer(),
};

const reportPath = join(outputDir, 'visual-comparison.json');
writeFileSync(reportPath, JSON.stringify(report, null, 2));

console.log(JSON.stringify({
    reportPath,
    playwright: report.playwright.comparison,
    puppeteer: report.puppeteer.comparison,
}, null, 2));
