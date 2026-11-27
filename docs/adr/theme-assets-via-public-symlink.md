---
title: "ADR — Gli asset di Sixteen si servono dal symlink public_html/themes/Sixteen, non da PHP"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-24
related:
  - ../../../../Modules/Xot/docs/wiki/rules/theme-public-symlink.md
  - ../wiki/concepts/public-html-themes-symlink.md
  - ../contracts/serve-theme-asset-action.md
---

# ADR: asset del tema via symlink relativo, l'Action PHP resta senza rotta

## Contesto

- La document root e' `public_html/`; Vite scrive la build in `Themes/Sixteen/public` (`manifest.json`, `assets/`).
- Le pagine Design Comuni referenziano gli asset con percorsi relativi `../assets/...`: per servirli esistono
  `app/Actions/Assets/ServeDesignComuniAssetAction.php` (`/{lingua}/assets/{path}`) e `ServeThemeAssetAction.php`, che
  leggono il file via PHP con cache di un anno. Oggi nessuna rotta le registra (cercato in `Themes/`, `Modules/`, `routes/`).
- Una copia degli asset in `public_html/` invecchia: dopo `npm run build` la pagina chiede hash che la copia non ha (404 su
  `app-<hash>.css`, JS assente, bottoni morti: `docs/wiki/concepts/public-html-themes-symlink.md`).
- Domanda: chi serve CSS, JS e immagini del tema?

## Decisione

- `public_html/themes/Sixteen` e' un symlink **relativo** a `../../laravel/Themes/Sixteen/public`, creato da
  `php artisan xot:theme-link` (regola di Xot `Modules/Xot/docs/wiki/rules/theme-public-symlink.md`). Il web server serve
  i file senza passare da PHP; `@vite([...], 'themes/Sixteen')` risolve nel manifest dietro il link.
- `vite.config.js` ha `emptyOutDir: false` (l'outDir e' tracciato in git) e non esiste piu' `npm run copy`.
- Le Action di servizio asset restano come fallback documentato ([contratto](../contracts/serve-theme-asset-action.md)):
  chi le ricollega a una rotta deve mantenere il rifiuto di `..` e il confinamento in `public/`.

## Alternative scartate

- **Copia degli asset in `public_html/themes/Sixteen`**: due copie, passo manuale dimenticato a ogni build.
- **Servire tutto via PHP con `ServeThemeAssetAction`**: un processo PHP per ogni immagine/CSS; il web server lo fa meglio.
- **Symlink all'intero tema**: esporrebbe `resources/`, `node_modules/`, `package.json`; si espone solo `public/`.

## Conseguenze

- Pro: una sola copia, build visibile subito, nessun asset vecchio.
- Contro: su checkout con `core.symlinks=false` (WSL/Windows) il link diventa un file di testo con il percorso: gli asset
  non si vedono finche' non si ricrea il link (`xot:theme-link`).
- Debito: due Action senza chiamanti; se restano inutilizzate vanno rimosse con una decisione esplicita.

## Verifica

- `Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php`: ogni tema con `public/` ha il link relativo e il manifest
  raggiungibile, nessun tema conserva lo script `npm run copy` (su un checkout con symlink come file di testo i casi del
  link falliscono: e' il sintomo che il test deve dare).
- `Themes/Sixteen/tests/Unit/AuthAndAssetActionContractsTest.php` (group `SIXTEEN-ASSET-INV-1`): l'Action rifiuta `..`.
