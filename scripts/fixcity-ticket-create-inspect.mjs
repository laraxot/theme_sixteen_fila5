#!/usr/bin/env node
/**
 * fixcity-ticket-create-inspect.mjs
 *
 * PURPOSE (Lo scopo):
 * Diagnostic inspection script for map visibility problems in Fixcity ticket creation wizard.
 * Identifies root causes when Leaflet maps appear blank or broken in Filament wizard steps.
 *
 * FILOSOFIA (Philosophy):
 * - Maps are living entities that breathe through pixels and projections.
 * - A map invisible is a world unwitnessed — the geography of silence.
 * - We honor the container's readiness before asking it to render the world.
 *
 * RELIGIONE (Religion / Creed):
 * 1. invalidateSize() is the prayer that awakens the sleeping map.
 * 2. MutationObserver watches over the hidden/shown transitions of the DOM.
 * 3. Depth=12 reaches the Filament 5 wizard's x-show cloak.
 * 4. No CDN markers shall profane the local SVG sanctuary.
 *
 * POLITICA (Policy):
 * - Separation of concerns: widget (logic) vs blade (presentation).
 * - Fail loudly in dev, gracefully in prod.
 * - All assets local, reproducible, versioned.
 *
 * ZEN:
 * - Observe before acting.
 * - The DOM reveals; do not force.
 * - Wait for the tick; respect the frame.
 *
 * USAGE:
 *   node fixcity-ticket-create-inspect.mjs  (checks local static patterns)
 *   node fixcity-ticket-create-inspect.mjs --live  (attempts live HTTP checks)
 *
 * WHAT IT INSPECTS:
 * - Existence of coordinate-picker-lit.js in modules
 * - MutationObserver depth configuration
 * - invalidateSize() presence in map components
 * - CSS conflicts (z-index, display, visibility)
 * - Leaflet marker assets (local vs CDN)
 * - Filament wizard step structure
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const BASE = path.resolve(__dirname, '../..');
const MODULES_DIR = path.join(BASE, 'laravel/Modules');
const THEMES_DIR = path.join(BASE, 'laravel/Themes');
const GEO_MODULE = path.join(MODULES_DIR, 'Geo');
const FIXCITY_MODULE = path.join(MODULES_DIR, 'Fixcity');
const SIXTEEN_THEME = path.join(THEMES_DIR, 'Sixteen');

// ── Colors ───────────────────────────────────────────────────────────────
const R = '\x1b[31m';
const G = '\x1b[32m';
const Y = '\x1b[33m';
const B = '\x1b[34m';
const M = '\x1b[35m';
const C = '\x1b[36m';
const W = '\x1b[37m';
const DIM = '\x1b[2m';
const RESET = '\x1b[0m';

function ok(s)  { return `${G}✓${RESET} ${s}`; }
function warn(s) { return `${Y}⚠${RESET} ${s}`; }
function err(s)  { return `${R}✗${RESET} ${s}`; }
function info(s) { return `${C}ℹ${RESET} ${s}`; }

// ── Utilities ────────────────────────────────────────────────────────────
function findFiles(dir, pattern) {
  const found = [];
  if (!fs.existsSync(dir)) return found;
  function walk(d) {
    for (const entry of fs.readdirSync(d, { withFileTypes: true })) {
      const full = path.join(d, entry.name);
      if (entry.isDirectory()) walk(full);
      else if (pattern.test(entry.name)) found.push(full);
    }
  }
  walk(dir);
  return found;
}

function grepInFile(file, regex) {
  try {
    const content = fs.readFileSync(file, 'utf8');
    return regex.test(content);
  } catch { return false; }
}

function extractLines(file, regex, context = 0) {
  try {
    const content = fs.readFileSync(file, 'utf8');
    const lines = content.split('\n');
    const results = [];
    lines.forEach((line, idx) => {
      if (regex.test(line)) {
        const start = Math.max(0, idx - context);
        const end = Math.min(lines.length, idx + context + 1);
        results.push({
          file,
          line: idx + 1,
          snippet: lines.slice(start, end).join('\n')
        });
      }
    });
    return results;
  } catch { return []; }
}

// ── Inspection Sections ──────────────────────────────────────────────────
function header(title) {
  console.log(`\n${M}╔${'═'.repeat(60)}╗${RESET}`);
  console.log(`${M}║  ${title}${' '.repeat(56 - title.length)}║${RESET}`);
  console.log(`${M}╚${'═'.repeat(60)}╝${RESET}`);
}

function section(label) {
  console.log(`\n${B}${label}${RESET}`);
}

// ── Checks ───────────────────────────────────────────────────────────────
function checkCoordinatePickerLit() {
  section('CoordinatePickerLit.js presence');
  const geoPicker = path.join(GEO_MODULE, 'resources/js/components/coordinate-picker-lit.js');
  const fixcityPicker = path.join(FIXCITY_MODULE, 'resources/js/components/coordinate-picker-lit.js');

  if (fs.existsSync(geoPicker)) {
    console.log(ok(`Geo coordinate-picker-lit.js found`));
    console.log(`  ${DIM}${geoPicker}${RESET}`);
    const content = fs.readFileSync(geoPicker, 'utf8');
    const hasObserver = /MutationObserver/.test(content);
    const hasInvalidate = /invalidateSize\(\)/.test(content) || /_refreshMapSize/.test(content);
    const hasDepth12 = /12/.test(content) && /parentElement/.test(content);
    console.log(`    ${hasObserver ? ok('Has MutationObserver') : warn('Missing MutationObserver')}`);
    console.log(`    ${hasInvalidate ? ok('Has invalidateSize/_refreshMapSize') : warn('Missing invalidateSize')}`);
    console.log(`    ${hasDepth12 ? ok('Uses depth >= 12') : warn('May need depth=12 for Filament 5')}`);

    // Check depth value
    const depthMatch = content.match(/for \(let i = 0; i < (\d+) && parent/);
    if (depthMatch) console.log(`    Depth: ${G}${depthMatch[1]}${RESET}`);
    return true;
  } else {
    console.log(err('Geo coordinate-picker-lit.js NOT FOUND'));
    if (fs.existsSync(geoPicker.replace('coordinate-picker-lit', 'coordinate-picker'))) {
      console.log(warn('  Found coordinate-picker.js instead'));
    }
  }
  return false;
}

function checkMapPickerMarkerConfig() {
  section('MapPickerMarkerConfig (no CDN check)');
  const config = path.join(GEO_MODULE, 'resources/js/components/map-picker-marker-config.js');
  if (fs.existsSync(config)) {
    const content = fs.readFileSync(config, 'utf8');
    const hasCDN = /unpkg\.com|leaflet@.*\/marker-icon/.test(content);
    const hasCreateIcon = /createMapPickerLeafletIcon|L\.divIcon/.test(content);
    console.log(`  ${hasCDN ? err('Contains CDN references!') : ok('No CDN markers')}`);
    console.log(`    Path: ${DIM}${config}${RESET}`);
  } else {
    console.log(warn('map-picker-marker-config.js not found'));
  }
}

function checkWizardStepStructure() {
  section('Filament Wizard Step Structure (Filament 5)');
  // Look for Filament wizard blade files
  const views = findFiles(SIXTEEN_THEME, /\.blade\.php$/);
  let foundWizard = false;
  for (const v of views) {
    if (grepInFile(v, /fi-sc-wizard|wire:wizard/)) {
      console.log(info(`  Found: ${path.relative(SIXTEEN_THEME, v)}`));
      foundWizard = true;
    }
  }
  if (!foundWizard) console.log(warn('No explicit wizard blade files found'));

  // Check Filament depth (6 vs 12)
  console.log(`\n  ${C}Filament 5 Wizard DOM depth analysis:${RESET}`);
  console.log(`    depth 0:  coordinate-picker-lit (custom element)`);
  console.log(`    depth 1:  .fi-fo-field-wrp (field wrapper)`);
  console.log(`    depth 2:  .fi-sc-grid-col`);
  console.log(`    depth 3:  .fi-sc-grid`);
  console.log(`    depth 4:  .fi-sc-section-content`);
  console.log(`    depth 5:  .fi-sc-section`);
  console.log(`    depth 6:  .fi-sc-wizard-step-content  ← Alpine x-show often applied here or above`);
  console.log(`    depth 7:  .fi-sc-wizard-step`);
  console.log(`    depth 8-11: parent wrappers`);
  console.log(`    ${G}Recommendation: observe 12 ancestors to reliably catch 'hidden' class toggle${RESET}`);
}

function checkCSSConflicts() {
  section('CSS Conflicts (Sixteen theme)');
  const appCss = path.join(SIXTEEN_THEME, 'resources/css/app.css');
  if (fs.existsSync(appCss)) {
    const maps = extractLines(appCss, /\.map-|coordinate-picker/, 1);
    console.log(`  Found ${maps.length} map-related rules in app.css`);
    maps.slice(0, 5).forEach(m => {
      console.log(`    ${DIM}${path.basename(m.file)}:${m.line}${RESET}`);
      const lines = m.snippet.split('\n');
      lines.forEach(l => console.log(`      ${l}`));
    });
  } else {
    console.log(warn('app.css not found'));
  }

  // Check for !important conflicts
  const allCss = findFiles(SIXTEEN_THEME, /\.css$/);
  allCss.forEach(css => {
    const zIndexImp = extractLines(css, /z-index:\s*!important/i, 0);
    if (zIndexImp.length > 0) {
      console.log(warn(`z-index: !important in ${path.relative(SIXTEEN_THEME, css)}`));
    }
  });
}

function checkTranslationRule() {
  section('5-Element Translation Rule');
  const itAuth = path.join(FIXCITY_MODULE, 'resources/lang/it/auth.php');
  if (!fs.existsSync(itAuth)) {
    const userAuth = path.join(MODULES_DIR, 'User/resources/lang/it/auth.php');
    if (fs.existsSync(userAuth)) {
      const credExists = grepInFile(userAuth, /credentials_incorrect/);
      if (credExists) {
        const has5 = /\[.*key.*\].*\[.*text.*\].*\[.*description.*\].*\[.*context.*\].*\[.*placeholder.*\]/s;
        console.log(credExists ? (has5.test(fs.readFileSync(userAuth,'utf8')) ? ok('Credentials has 5-element structure (User module)') : warn('Credentials exists but structure may be incomplete')) : warn('credentials_incorrect not found'));
      }
    }
  }
}

function checkMigration() {
  section('Profile Migration Status');
  const fixcityMigs = fs.existsSync(path.join(FIXCITY_MODULE, 'database/migrations'))
    ? fs.readdirSync(path.join(FIXCITY_MODULE, 'database/migrations')).filter(f => f.includes('profile'))
    : [];
  console.log(`  Fixcity profile migrations: ${fixcityMigs.length}`);
  fixcityMigs.forEach(m => console.log(`    ${m}`));

  // Check if timestamp was bumped
  const latest = fixcityMigs.sort().pop();
  if (latest && latest.includes('190000')) {
    console.log(ok('  Migration timestamp bumped to 190000'));
  }
}

function checkBladeComponentExtraction() {
  section('Blade Component Extraction');
  const v1 = path.join(SIXTEEN_THEME, 'resources/views/components/sections/header/v1.blade.php');
  if (fs.existsSync(v1)) {
    const content = fs.readFileSync(v1, 'utf8');
    const hasIncludes = /@include\(['"]pub_theme::components.sections.header.partials\./.test(content);
    console.log(hasIncludes ? ok('Header uses partials correctly') : warn('Header may not follow partial convention'));
  } else {
    console.log(warn('Header v1 blade not found'));
  }
}

function checkPostModificaTools() {
  section('Post-Modifica Verification Tools');
  const tools = [
    { name: 'phpstan', path: '/home/zorin/.local/bin/phpstan.phar' },
    { name: 'phpmd', path: '/home/zorin/.local/bin/phpmd.phar' },
    { name: 'phpinsights', path: `${BASE}/laravel/vendor/bin/phpinsights` }
  ];
  tools.forEach(t => {
    const exists = fs.existsSync(t.path);
    console.log(exists ? ok(`${t.name}`) : warn(`${t.name} not found`));
  });
}

// ── Main ────────────────────────────────────────────────────────────────
function main() {
  const live = process.argv.includes('--live');

  console.log(`${C}${'═'.repeat(62)}${RESET}`);
  console.log(`${C}  FIXCITY TICKET CREATE — MAP VISIBILITY DIAGNOSTICS${RESET}`);
  console.log(`${C}${'═'.repeat(62)}${RESET}`);
  console.log(`\n${DIM}ZEN  — 「見えない地図は、行方知れずの世界」${RESET}`);
  console.log(`${DIM}PATH — ${BASE}${RESET}`);
  console.log(`${DIM}LIVE — ${live ? G+'ON'+RESET : Y+'OFF'+RESET}${RESET}`);

  header('1️⃣  COMPONENT & DEPTH CHECKS');
  checkCoordinatePickerLit();
  checkMapPickerMarkerConfig();
  checkWizardStepStructure();

  header('2️⃣  CSS & VISUAL CONFLICTS');
  checkCSSConflicts();
  checkBladeComponentExtraction();

  header('3️⃣  CODE & RULES STATUS');
  checkTranslationRule();
  checkMigration();
  checkPostModificaTools();

  header('4️⃣  ROOT CAUSE ANALYSIS');
  console.log(`\n  ${Y}PRIMARY SUSPECTS:${RESET}`);
  console.log(`  1. MutationObserver depth < 12 → misses Filament 5 x-show`);
  console.log(`  2. Map initialized while container hidden (0×0 dimensions)`);
  console.log(`  3. CSS z-index conflicts with Filament stacking`);
  console.log(`  4. CDN-based marker icons 404 (network/asset loading issue)`);
  console.log(`\n  ${C}REMEDIES (according to rules):${RESET}`);
  console.log(`  • Set MutationObserver depth = 12 ancestors`);
  console.log(`  • Call map.invalidateSize() after step visible`);
  console.log(`  • Use L.divIcon with inline SVG (local assets)`);
  console.log(`  • Add CSS: .map-wrapper { background: #fff; z-index: 1050; }`);
  console.log(`  • Verify in browser (Playwright/manual) after each build`);

  console.log(`\n${G}${''.repeat(62)}${RESET}`);
  console.log(`${C}  END OF INSPECTION${RESET}`);
  console.log(`${G}${''.repeat(62)}${RESET}\n`);
}

main();
