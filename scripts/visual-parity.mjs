#!/usr/bin/env node
/**
 * Visual Parity Analysis - Playwright Screenshot Comparison
 * 
 * Takes screenshots of local and reference pages, creates side-by-side comparison.
 * 
 * Usage:
 *   node scripts/visual-parity.mjs segnalazione-01-privacy
 *   node scripts/visual-parity.mjs homepage
 *   node scripts/visual-parity.mjs tutti  (all pages)
 */

import { chromium } from 'playwright';
import { join, dirname } from 'path';
import { fileURLToPath } from 'url';
import { existsSync, mkdirSync, writeFileSync } from 'fs';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const OUTPUT_DIR = join(__dirname, '..', 'storage', 'visual-parity');

// Pages to analyze
const PAGES = {
  'segnalazione-01-privacy': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-01-privacy',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html'
  },
  'segnalazione-crea': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-crea',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html'
  },
  'segnalazione-02-dati': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-02-dati',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html'
  },
  'segnalazione-03-riepilogo': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-03-riepilogo',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-03-riepilogo.html'
  },
  'segnalazione-04-conferma': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-04-conferma',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-04-conferma.html'
  },
  'segnalazione-area-personale': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-area-personale',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-area-personale.html'
  },
  'segnalazioni-elenco': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazioni-elenco',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html'
  },
  'segnalazione-dettaglio': {
    local: 'http://127.0.0.1:8000/it/tests/segnalazione-dettaglio',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-dettaglio.html'
  },
  'homepage': {
    local: 'http://127.0.0.1:8000/it/',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/index.html'
  },
  'servizi': {
    local: 'http://127.0.0.1:8000/it/tests/servizi',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/servizi.html'
  },
  'amministrazione': {
    local: 'http://127.0.0.1:8000/it/tests/amministrazione',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/amministrazione.html'
  },
  'novita': {
    local: 'http://127.0.0.1:8000/it/tests/novita',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/novita.html'
  },
  'documenti': {
    local: 'http://127.0.0.1:8000/it/tests/documenti',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/documenti.html'
  },
  'luoghi': {
    local: 'http://127.0.0.1:8000/it/tests/luoghi',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/luoghi.html'
  },
  'faq': {
    local: 'http://127.0.0.1:8000/it/tests/faq',
    reference: 'https://italia.github.io/design-comuni-pagine-statiche/sito/faq.html'
  }
};

// Viewports to test
const VIEWPORTS = [
  { name: 'desktop', width: 1440, height: 900 },
  { name: 'tablet', width: 768, height: 1024 },
  { name: 'mobile', width: 375, height: 812 }
];

async function capturePage(browser, url, outputPath, viewport) {
  console.log(`   📸 Capturing: ${url} (${viewport.name})`);
  
  const context = await browser.newContext({
    viewport: { width: viewport.width, height: viewport.height },
    deviceScaleFactor: 1,
    javaScriptEnabled: true
  });

  const page = await context.newPage();
  
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
    // Wait for fonts to load
    await page.evaluate(() => document.fonts.ready);
    await new Promise(r => setTimeout(r, 1000));
    
    await page.screenshot({ 
      path: outputPath, 
      fullPage: true 
    });
    
    console.log(`   ✅ Saved: ${outputPath}`);
  } catch (err) {
    console.error(`   ❌ Failed: ${err.message}`);
  } finally {
    await context.close();
  }
}

async function analyzeFonts(browser, url, viewport) {
  console.log(`   🔍 Analyzing fonts: ${url}`);
  
  const context = await browser.newContext({
    viewport: { width: viewport.width, height: viewport.height }
  });

  const page = await context.newPage();
  
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
    await page.evaluate(() => document.fonts.ready);
    
    const fonts = await page.evaluate(() => {
      const elements = document.querySelectorAll('p, h1, h2, h3, h4, h5, h6, a, span, li');
      const fontMap = {};
      
      elements.forEach(el => {
        const style = window.getComputedStyle(el);
        const fontFamily = style.fontFamily;
        const fontSize = style.fontSize;
        const fontWeight = style.fontWeight;
        const color = style.color;
        const lineHeight = style.lineHeight;
        
        const key = `${fontFamily}|${fontSize}|${fontWeight}`;
        if (!fontMap[key]) {
          fontMap[key] = {
            fontFamily,
            fontSize,
            fontWeight,
            color,
            lineHeight,
            count: 0,
            sample: el.textContent?.substring(0, 50) || ''
          };
        }
        fontMap[key].count++;
      });
      
      return Object.values(fontMap).sort((a, b) => b.count - a.count);
    });
    
    return fonts.slice(0, 20); // Top 20 font combinations
  } catch (err) {
    console.error(`   ❌ Font analysis failed: ${err.message}`);
    return [];
  } finally {
    await context.close();
  }
}

async function analyzeColors(browser, url, viewport) {
  console.log(`   🎨 Analyzing colors: ${url}`);
  
  const context = await browser.newContext({
    viewport: { width: viewport.width, height: viewport.height }
  });

  const page = await context.newPage();
  
  try {
    await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
    
    const colors = await page.evaluate(() => {
      const elements = document.querySelectorAll('*');
      const colorMap = {};
      
      elements.forEach(el => {
        const style = window.getComputedStyle(el);
        const bgColor = style.backgroundColor;
        const textColor = style.color;
        const borderColor = style.borderColor;
        
        [bgColor, textColor, borderColor].forEach(color => {
          if (color && color !== 'rgba(0, 0, 0, 0)' && color !== 'transparent') {
            colorMap[color] = (colorMap[color] || 0) + 1;
          }
        });
      });
      
      return Object.entries(colorMap)
        .sort(([,a], [,b]) => b - a)
        .slice(0, 15)
        .map(([color, count]) => ({ color, count }));
    });
    
    return colors;
  } catch (err) {
    console.error(`   ❌ Color analysis failed: ${err.message}`);
    return [];
  } finally {
    await context.close();
  }
}

async function analyzePage(pageName, pageConfig) {
  console.log(`\n${'='.repeat(60)}`);
  console.log(`📊 Analyzing: ${pageName}`);
  console.log(`${'='.repeat(60)}`);
  
  const browser = await chromium.launch({ headless: true });
  const viewport = VIEWPORTS[0]; // Desktop first
  
  // Create output directory
  const pageDir = join(OUTPUT_DIR, pageName);
  if (!existsSync(pageDir)) {
    mkdirSync(pageDir, { recursive: true });
  }
  
  // 1. Screenshots
  console.log('\n📸 Taking screenshots...');
  await capturePage(browser, pageConfig.local, join(pageDir, 'local.png'), viewport);
  await capturePage(browser, pageConfig.reference, join(pageDir, 'reference.png'), viewport);
  
  // 2. Font analysis
  console.log('\n🔍 Analyzing fonts...');
  const localFonts = await analyzeFonts(browser, pageConfig.local, viewport);
  const refFonts = await analyzeFonts(browser, pageConfig.reference, viewport);
  
  // 3. Color analysis
  console.log('\n🎨 Analyzing colors...');
  const localColors = await analyzeColors(browser, pageConfig.local, viewport);
  const refColors = await analyzeColors(browser, pageConfig.reference, viewport);
  
  // 4. Generate report
  console.log('\n📝 Generating report...');
  
  const report = {
    page: pageName,
    timestamp: new Date().toISOString(),
    viewport: viewport,
    urls: pageConfig,
    fonts: {
      local: localFonts,
      reference: refFonts,
      differences: findFontDifferences(localFonts, refFonts)
    },
    colors: {
      local: localColors,
      reference: refColors,
      differences: findColorDifferences(localColors, refColors)
    }
  };
  
  const reportPath = join(pageDir, 'analysis.json');
  writeFileSync(reportPath, JSON.stringify(report, null, 2));
  console.log(`✅ Report saved: ${reportPath}`);
  
  // 5. Print summary
  printSummary(report);
  
  await browser.close();
  
  return report;
}

function findFontDifferences(localFonts, refFonts) {
  const differences = [];
  
  refFonts.forEach(refFont => {
    const match = localFonts.find(lf => 
      lf.fontFamily === refFont.fontFamily &&
      lf.fontSize === refFont.fontSize
    );
    
    if (!match) {
      differences.push({
        type: 'missing_in_local',
        reference: refFont
      });
    } else if (match.color !== refFont.color || match.fontWeight !== refFont.fontWeight) {
      differences.push({
        type: 'style_mismatch',
        reference: refFont,
        local: match
      });
    }
  });
  
  return differences;
}

function findColorDifferences(localColors, refColors) {
  const localColorSet = new Set(localColors.map(c => c.color));
  const refColorSet = new Set(refColors.map(c => c.color));
  
  const onlyInRef = refColors.filter(c => !localColorSet.has(c.color));
  const onlyInLocal = localColors.filter(c => !refColorSet.has(c.color));
  
  return { onlyInReference: onlyInRef, onlyInLocal: onlyInLocal };
}

function printSummary(report) {
  console.log(`\n${'─'.repeat(60)}`);
  console.log(`📋 VISUAL PARITY SUMMARY: ${report.page}`);
  console.log(`${'─'.repeat(60)}`);
  
  // Font differences
  if (report.fonts.differences.length > 0) {
    console.log(`\n⚠️  Font Differences (${report.fonts.differences.length}):`);
    report.fonts.differences.slice(0, 5).forEach((diff, i) => {
      if (diff.type === 'missing_in_local') {
        console.log(`   ${i+1}. MISSING: ${diff.reference.fontFamily} @ ${diff.reference.fontSize}`);
        console.log(`      Sample: "${diff.reference.sample}"`);
      } else if (diff.type === 'style_mismatch') {
        console.log(`   ${i+1}. MISMATCH: ${diff.reference.fontFamily}`);
        console.log(`      Ref color: ${diff.reference.color} vs Local: ${diff.local.color}`);
      }
    });
  } else {
    console.log('\n✅ Fonts: Perfect match!');
  }
  
  // Color differences
  if (report.colors.differences.onlyInReference.length > 0) {
    console.log(`\n⚠️  Colors only in Reference (${report.colors.differences.onlyInReference.length}):`);
    report.colors.differences.onlyInReference.slice(0, 5).forEach((c, i) => {
      console.log(`   ${i+1}. ${c.color} (used ${c.count} times)`);
    });
  }
  
  if (report.colors.differences.onlyInLocal.length > 0) {
    console.log(`\n⚠️  Colors only in Local (${report.colors.differences.onlyInLocal.length}):`);
    report.colors.differences.onlyInLocal.slice(0, 5).forEach((c, i) => {
      console.log(`   ${i+1}. ${c.color} (used ${c.count} times)`);
    });
  }
  
  console.log(`\n📸 Screenshots: ${OUTPUT_DIR}/${report.page}/`);
  console.log(`📊 Full report: ${OUTPUT_DIR}/${report.page}/analysis.json`);
}

// Main execution
const pageName = process.argv[2] || 'segnalazione-01-privacy';

if (pageName === 'tutti' || pageName === 'all') {
  console.log('🚀 Analyzing ALL pages...\n');
  for (const [name, config] of Object.entries(PAGES)) {
    await analyzePage(name, config);
  }
} else if (PAGES[pageName]) {
  await analyzePage(pageName, PAGES[pageName]);
} else {
  console.log(`❌ Unknown page: ${pageName}`);
  console.log('\nAvailable pages:');
  Object.keys(PAGES).forEach(p => console.log(`  - ${p}`));
  process.exit(1);
}
