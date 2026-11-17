// Removes stale build output from public/assets after `vite build`.
//
// vite.config.js keeps `emptyOutDir: false` because public/ also holds files copied from resources/static
// (sprites, design-comuni, images) that must keep a stable URL. The side effect: every build adds new
// hashed bundles (`app-<hash>.css` is ~3 MB) and never deletes the old ones. Before this script public/assets
// held 43 orphan bundles (64 MB) committed to git.
//
// Only files named `<name>-<8-char hash>.<ext>` that public/manifest.json does not reference are removed;
// anything else in public/assets is left untouched.
import { readFileSync, readdirSync, unlinkSync, statSync } from 'node:fs';
import { resolve } from 'node:path';

const publicDir = resolve(import.meta.dirname, '../../public');
const manifest = JSON.parse(readFileSync(resolve(publicDir, 'manifest.json'), 'utf8'));

const referenced = new Set();
for (const entry of Object.values(manifest)) {
    referenced.add(entry.file);
    for (const key of ['css', 'assets']) {
        for (const file of entry[key] ?? []) {
            referenced.add(file);
        }
    }
}

const hashed = /-[A-Za-z0-9_-]{8}\.[a-z0-9]+$/;
let removed = 0;
let bytes = 0;
for (const name of readdirSync(resolve(publicDir, 'assets'))) {
    const relative = `assets/${name}`;
    if (!hashed.test(name) || referenced.has(relative)) {
        continue;
    }
    const absolute = resolve(publicDir, relative);
    bytes += statSync(absolute).size;
    unlinkSync(absolute);
    removed++;
}

console.log(`prune-stale-assets: removed ${removed} stale file(s), ${Math.round(bytes / 1024)} KB`);
