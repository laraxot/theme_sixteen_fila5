---
title: "ADR — Gli asset di Sixteen si servono dal symlink public_html/themes/Sixteen, non da PHP"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-24
updated: 2026-11-26
decision-makers: [team front office]
related:
  - ../wiki/concepts/public-html-themes-symlink.md
  - ../contracts/serve-theme-asset-action.md
---

# ADR: asset del tema via symlink relativo, l'Action PHP resta solo come ripiego

## Contesto

La document root è `public_html/`; Vite scrive la build in `Themes/Sixteen/public` (`manifest.json`, `assets/`,
`vite.config.js:20-21`, `outDir: './public'`, `emptyOutDir: false`). Le pagine Design Comuni referenziano gli asset con
percorsi relativi `../assets/...`: per servirli via PHP esistono `app/Actions/Assets/ServeDesignComuniAssetAction.php`
(`/{lingua}/assets/{path}`) e `ServeThemeAssetAction.php` (`/themes/Sixteen/{path}`), che leggono il file dal disco con
cache di un anno. Una copia degli asset in `public_html/` invecchia: dopo `npm run build` la pagina chiede hash che la
copia non ha (404 su `app-<hash>.css`, JS assente, bottoni morti: `docs/wiki/concepts/public-html-themes-symlink.md`).
Chi serve CSS, JS e immagini del tema: il web server da una sola cartella, o PHP?

## Driver della decisione

- Una sola copia degli asset: la build deve essere visibile subito, senza un passo manuale dopo ogni `npm run build`.
- Il web server serve file statici meglio di un processo PHP per ogni immagine.
- Si espone solo ciò che è pubblico: non `resources/`, `node_modules/`, `package.json`.
- Un checkout nuovo o un ambiente senza symlink (NativePHP, `php -S`) deve poter servire comunque il tema.

## Alternative scartate

- **Copia degli asset in `public_html/themes/Sixteen`**: due copie e un passo manuale dimenticato a ogni build.
- **Servire tutto via PHP con `ServeThemeAssetAction`**: un processo PHP per ogni immagine o CSS, e la cache immutabile di
  un anno sarebbe sbagliata per file senza hash nel nome.
- **Symlink all'intero tema**: esporrebbe `resources/`, `node_modules/`, `package.json`; si espone solo `public/`.

## Decisione

- `public_html/themes/Sixteen` è un symlink **relativo** a `../../laravel/Themes/Sixteen/public`, creato da
  `php artisan xot:theme-link` (`Modules/Xot/app/Console/Commands/ThemeLinkCommand.php`). Il web server serve i file senza
  passare da PHP; `@vite([...], 'themes/Sixteen')` risolve nel manifest dietro il link.
- `vite.config.js` ha `emptyOutDir: false` (l'outDir è tracciato in git) e `package.json` non ha più lo script `copy`
  (`scripts`: `build`, `prepare:static-assets`, `prune:assets`, ...).
- Le Action di servizio asset restano come **ripiego**, con le rotte `laravel/routes/web.php:15` e `:20`: servono quando il
  file non è raggiungibile dal web server (WebView di NativePHP, come dice il commento a `web.php:13-14`; ambienti senza
  symlink). Chi le tocca deve mantenere il rifiuto di `..` e il confinamento in `public/`
  ([contratto](../contracts/serve-theme-asset-action.md)).

## Conseguenze

- Buono: una sola copia, build visibile subito, nessun asset vecchio.
- Cattivo: su un checkout con `core.symlinks=false` (WSL/Windows) il link diventa un file di testo con il percorso: gli asset
  non si vedono finché il link non si ricrea (`xot:theme-link`).
- Cattivo: il ripiego PHP risponde con `Cache-Control: public, max-age=31536000, immutable` anche a file senza hash nel nome
  (esempio: `design-comuni/assets/images/logo-comune.svg`): se il file cambia, il browser non lo richiede.
- Debito: le due Action hanno quindi chiamanti reali, ma nessun test prova che le rotte siano raggiungibili quando il
  symlink manca; il ripiego è documentato, non dimostrato.

## Stato attuale

- La versione del 2026-11-24 di questo ADR diceva che nessuna rotta registrava le due Action. Era falso: `routes/web.php:15`
  registra `/themes/Sixteen/{path}` → `ServeThemeAssetAction::execute` e `routes/web.php:20` registra `/{lang}/assets/{path}`
  → `ServeDesignComuniAssetAction` (rotte presenti già nella cronologia di `routes/web.php` del 2026-09-28). Corretto qui.
- Il symlink esiste in questo checkout: `readlink public_html/themes/Sixteen` dà `../../laravel/Themes/Sixteen/public/`, con la
  barra finale. Il test di Xot confronta con `../../laravel/Themes/Sixteen/public` (senza barra): dal solo confronto delle due
  stringhe il caso Sixteen non passa su questo checkout. Non verificato con Pest (non eseguito in questa passata).
- `docs/wiki/concepts/public-html-themes-symlink.md` cita ancora `npm run copy`, che non esiste più in `package.json`; la
  regola di Xot `Modules/Xot/docs/wiki/rules/theme-public-symlink.md`, citata dal test e dalla versione precedente di questo
  ADR, non è presente nell'albero.

## Conferma

- `cd laravel && vendor/bin/pest Modules/Xot/tests/Unit/ThemePublicSymlinkTest.php`: ogni tema con `public/` ha il link
  relativo e `manifest.json` raggiungibile (test «ogni tema con build ha il symlink relativo»), e nessun `package.json` di
  tema contiene `"copy"` (test «nessun tema conserva lo script npm copy», righe 102-111).
- `cd laravel && vendor/bin/pest Themes/Sixteen/tests/Unit --group=SIXTEEN-ASSET-INV-1`: l'Action rifiuta `..` e il percorso
  vuoto (gira senza app).
- Controllo manuale equivalente al secondo test: `grep -n '"copy"' laravel/Themes/Sixteen/package.json` non deve trovare
  nulla; `readlink public_html/themes/Sixteen` deve dare un percorso relativo.
