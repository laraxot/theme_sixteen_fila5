---
title: livewire alpine esm order (tema sixteen)
type: troubleshooting
confidence: high
created: 2026-05-22
updated: 2026-05-23
sources:
    - laravel/Themes/Sixteen/resources/views/components/layouts/main.blade.php
    - laravel/Themes/Sixteen/resources/views/partials/alpine-livewire-bootstrap-header.blade.php
    - laravel/Themes/Sixteen/resources/js/theme/header-mobile-nav-scope.js
related:
    - ../../../../../Modules/Fixcity/docs/wiki/concepts/segnalazione-runtime-asset-integrity.md
    - ../../../../../Modules/Geo/resources/js/filament/map-picker.js
    - ../../design-comuni/analysis/header-html-parity.md
    - ../../../../../../docs/wiki/memories/sixteen-vite-public-path-alpine-livewire-order.md
tags:
    - livewire
    - filament
    - alpine.js
    - vite
    - tema-sixteen
---

# ordinamento Livewire Alpine e bundle ESM tema Sixteen

## webroot Laravel dopo `vite build`

`public_path()` in questa base punta a **`public_html/`** (repo root `…/base_fixcity_fila5/public_html/`).  
Vite nel tema mette bundle e `manifest.json` in **`laravel/Themes/Sixteen/public/`**; Laravel legge **`public_html/themes/Sixteen/manifest.json`**.

Dopo **`npm run build`** dalla cart tema, pubblicare nel webroot usato dall’app:

```bash
npm run copy
```

Equivalente combinato:

```bash
npm run build:with-webroot
```

(`build:with-webroot` = `vite build && npm run copy`.)  

Altrimenti: `rsync` di `Themes/Sixteen/public/assets/` e copia di `manifest.json` verso `public_html/themes/Sixteen/`. Senza questo passaggio restano vecchi nomi tipo `app-BDB…`.

## problema

Messaggi tipo `Alpine Expression Error: headerMobileNav is not defined` su pagine Filament/Livewire (es. wizard segnalazione) **anche con** `Alpine.data('headerMobileNav', …)` nei sorgenti `resources/js/app.js`.

## causa

1. **`@vite(['resources/js/app.js'])`** emette uno script **`type="module"`** defer: viene eseguito **dopo** che il parsing del documento ha già incontrato **`@livewireScripts` / `@filamentScripts`**.
2. `@livewireScripts` avvia **Alpine bundled** in modo sincrono e attraversa il DOM (incluse le direttive `x-data` dell’header).
3. Anche un `document.addEventListener('alpine:init', …)` dentro `app.js` **non basta**, perché l’evento `alpine:init` viene emesso mentre il listener non è ancora stato registrato (il modulo non è ancora valutato).

## fix operativo (`headerMobileNav`)

Snippet Blade **inline e sincrono** incluso nella `<body>` **prima di** `@livewireScripts`:

- [`resources/views/partials/alpine-livewire-bootstrap-header.blade.php`](../../../resources/views/partials/alpine-livewire-bootstrap-header.blade.php)

Registra `Alpine.data('headerMobileNav', …)` su `alpine:init`. La factory canonica rimane anche in [`resources/js/theme/header-mobile-nav-scope.js`](../../../resources/js/theme/header-mobile-nav-scope.js), importata da `app.js` per evitare divergenza logica lato modulo differito (`Alpine.data` ridondante dopo il boot non danneggia).

## implicazioni per altri alpine data (`geoMapPickerField`, wizard, …)

Chiunque usi **`x-data` su markup presente allo start iniziale** e dipenda da `Alpine.data` definito nel bundle tema deve applicare uno di questi modelli:

- bootstrap inline Blade **prima** di `@livewireScripts` (**header** + shim sincrono **`window.geoMapPickerField`** per markup/bundle legacy), oppure
- asset non-defer caricati prima di Alpine (solo se progettati esplicitamente), oppure
- markup caricato dopo il bundle (morpha Livewire tardivo).

La mappa pubblica nei form Geo moderni usa **`x-data="{ … oggetto … }"`** sul wrapper e non deve dipendere da `geoMapPickerField`; se compare ancora quel nome nel runtime, cercare markup o asset **stale** (`npm run build` nel tema Sixteen + cache browser/view).

## riferimenti incrociati

- Header parity e uso `x-data="headerMobileNav"`: [header-html-parity.md](../../design-comuni/analysis/header-html-parity.md)
- Catena storica asset segnalazione / geo: [`segnalazione-runtime-asset-integrity.md`](../../../../../Modules/Fixcity/docs/wiki/concepts/segnalazione-runtime-asset-integrity.md)
- Binding Filament + Alpine: [`filament-custom-field-binding-modifiers-theme-boundary.md`](./filament-custom-field-binding-modifiers-theme-boundary.md)

## asset stale: come controllarsi prima di correggere il file sbagliato

Quando la console cita un hash specifico (`app-BDBkID6g.js`, `app-BIM-cnUB.js`, ecc.), quello e' il fatto primario. Non ragionare dal sorgente `resources/js/app.js` senza verificare quale bundle viene davvero referenziato dall'HTML.

Checklist minima:

```bash
curl -s http://127.0.0.1:8000/it/segnalazione-crea -o /tmp/seg-current.html
rg -n "assets/app-[A-Za-z0-9_-]+\.js|geoMapPickerField|headerMobileNav" /tmp/seg-current.html
jq -r '."resources/js/app.js".file' public_html/themes/Sixteen/manifest.json
jq -r '."resources/js/app.js".file' laravel/Themes/Sixteen/public/manifest.json
cd laravel && php artisan tinker --execute="dump(['public_path' => public_path(), 'vite_app' => json_decode(file_get_contents(public_path('themes/Sixteen/manifest.json')), true)['resources/js/app.js']['file'] ?? null]);"
```

Regola pratica:

- `public_path()` in questa app punta a `public_html`, quindi il manifest autorevole runtime e' `public_html/themes/Sixteen/manifest.json`.
- `laravel/public/themes/Sixteen/manifest.json` puo' essere storico/fuorviante: non usarlo come prova che la pagina stia servendo quel bundle.
- Il riferimento definitivo e' sempre l'HTML appena scaricato dalla URL esatta.
- Dopo `npm run build`, eseguire anche `npm run copy` dal tema Sixteen se l'app serve asset da `public_html`.

