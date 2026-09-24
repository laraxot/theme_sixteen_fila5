#!/usr/bin/env node
/**
 * Audit completo homepage /it — console, network, debugbar, asset tema.
 */
import { chromium } from 'playwright';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const URL = process.env.AUDIT_URL ?? 'http://127.0.0.1:8002/it';
const OUT_DIR = path.join(__dirname, '../docs/screenshots/audit-it');

const report = {
  url: URL,
  timestamp: new Date().toISOString(),
  httpStatus: null,
  title: null,
  console: { errors: [], warnings: [], logs: [] },
  pageErrors: [],
  network: { failed: [], ok404: [], themeAssets: [] },
  debugbar: { present: false, open: false, tabs: [] },
  dom: {},
  themeRefs: { sixteen: 0, two: 0 },
  screenshot: null,
};

fs.mkdirSync(OUT_DIR, { recursive: true });

const browser = await chromium.launch({ headless: true });
const context = await browser.newContext({ viewport: { width: 1440, height: 900 } });
const page = await context.newPage();

page.on('console', (msg) => {
  const entry = { type: msg.type(), text: msg.text() };
  if (msg.type() === 'error') report.console.errors.push(entry);
  else if (msg.type() === 'warning') report.console.warnings.push(entry);
  else if (msg.type() === 'error') report.console.logs.push(entry);
});

page.on('pageerror', (err) => {
  report.pageErrors.push(String(err));
});

page.on('response', (response) => {
  const u = response.url();
  const status = response.status();
  if (u.includes('/themes/Sixteen/') || u.includes('/themes/Two/')) {
    report.network.themeAssets.push({ url: u.replace(/^https?:\/\/[^/]+/, ''), status });
  }
  if (status === 404) {
    report.network.ok404.push({ url: u.replace(/^https?:\/\/[^/]+/, ''), status });
  }
});

page.on('requestfailed', (request) => {
  report.network.failed.push({
    url: request.url().replace(/^https?:\/\/[^/]+/, ''),
    failure: request.failure()?.errorText ?? 'unknown',
  });
});

const response = await page.goto(URL, { waitUntil: 'networkidle', timeout: 60000 });
report.httpStatus = response?.status() ?? null;
report.title = await page.title();

await page.waitForTimeout(1500);

report.dom = await page.evaluate(() => ({
  hasHeader: !!document.querySelector('header.it-header-wrapper, header[role="banner"], .it-header-wrapper'),
  hasMain: !!document.querySelector('main'),
  hasFooter: !!document.querySelector('footer, .it-footer'),
  hasLanguageSwitcher: !!document.querySelector('[aria-controls="languages"]'),
  hasSkipLink: !!document.querySelector('.skiplink a'),
  h1Count: document.querySelectorAll('h1').length,
  bodyTextLength: document.body?.innerText?.length ?? 0,
}));

const html = await page.content();
report.themeRefs.sixteen = (html.match(/themes\/Sixteen/g) ?? []).length;
report.themeRefs.two = (html.match(/themes\/Two/g) ?? []).length;

report.debugbar = await page.evaluate(() => {
  const bar = document.querySelector('#phpdebugbar, .phpdebugbar, [id*="debugbar"]');
  const openBtn = document.querySelector('.phpdebugbar-openhandler, .phpdebugbar-header');
  const tabs = [...document.querySelectorAll('.phpdebugbar-tab')].map((t) => t.textContent?.trim()).filter(Boolean);
  const badge = document.querySelector('.phpdebugbar-badge');
  return {
    present: !!bar,
    open: !!document.querySelector('.phpdebugbar-visible'),
    tabCount: tabs.length,
    tabs: tabs.slice(0, 15),
    badgeText: badge?.textContent?.trim() ?? null,
  };
});

const shotPath = path.join(OUT_DIR, `homepage-it-${Date.now()}.png`);
await page.screenshot({ path: shotPath, fullPage: true });
report.screenshot = shotPath;

await browser.close();

const jsonPath = path.join(OUT_DIR, 'audit-report.json');
fs.writeFileSync(jsonPath, JSON.stringify(report, null, 2));

console.log('=== AUDIT /it ===');
console.log('URL:', report.url);
console.log('HTTP:', report.httpStatus, '| Title:', report.title);
console.log('DOM:', JSON.stringify(report.dom));
console.log('Theme refs — Sixteen:', report.themeRefs.sixteen, '| Two:', report.themeRefs.two);
console.log('Debugbar:', report.debugbar.present ? 'YES' : 'NO', report.debugbar);
console.log('Console errors:', report.console.errors.length);
report.console.errors.forEach((e) => console.log('  [error]', e.text));
console.log('Page errors:', report.pageErrors.length);
report.pageErrors.forEach((e) => console.log('  [pageerror]', e));
console.log('Network failed:', report.network.failed.length);
report.network.failed.forEach((f) => console.log('  [fail]', f.url, f.failure));
console.log('404 resources:', report.network.ok404.length);
report.network.ok404.forEach((f) => console.log('  [404]', f.url));
const badTheme = report.network.themeAssets.filter((a) => a.status >= 400);
console.log('Theme assets bad:', badTheme.length);
badTheme.forEach((a) => console.log('  [theme]', a.status, a.url));
console.log('Screenshot:', report.screenshot);
console.log('Report JSON:', jsonPath);

const hasCritical =
  report.httpStatus !== 200 ||
  report.pageErrors.length > 0 ||
  report.network.failed.length > 0 ||
  report.network.ok404.some((r) => !r.url.includes('favicon.ico')) ||
  report.console.errors.some((e) => !e.text.includes('subsystem status'));

process.exit(hasCritical ? 1 : 0);
