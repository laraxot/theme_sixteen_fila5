---
title: "Theme Geo JS Boundary"
type: concept
module: Sixteen
confidence: high
created: 2026-05-15
tags: [sixteen, geo, vite, map-controls, coordinate-picker]
related:
  - ../../../../Modules/Geo/docs/wiki/concepts/map-js-module-naming-rule.md
  - theme-owned-scripts-rule.md
  - coordinate-picker-design-comuni-parity-rule.md
---

# Boundary: JS mappa Geo nel tema Sixteen

## Scopo

Il tema Sixteen non ridefinisce la logica mappa: **consuma** il modulo Geo tramite alias Vite `@modules/...` (path assoluti verso `laravel/Modules/`). Evitare path relativi inventati tipo `./modules/Geo/...` se la cartella non esiste nel tema.

## Source of truth

| Cosa | Dove |
|------|------|
| Regola naming `map-*` vs `map-picker-*` | [map-js-module-naming-rule](../../../../Modules/Geo/docs/wiki/concepts/map-js-module-naming-rule.md) |
| Implementazione controlli / ricerca / stili | `laravel/Modules/Geo/resources/js/components/map/` (barrel `controls.js`; ricerca in `controls/search.js`) |
| Copie tema legacy | Preferire `@modules/Geo/resources/js/components/map/...` (es. `geo-map-lit-local.js`) invece di path `./modules/Geo/...` inesistenti |
| Entry Vite principali | `vite.config.js` → `@modules/Geo/...` e `resources/js/app.js` |

## Import in app.js (canonico)

- `coordinate-picker-field` -> `@modules/Geo/resources/js/components/coordinate-picker-field.js` (usa `coordinate-picker-lit` nel modulo Geo)
- `geo-map-lit` -> copia oppure wrapper in tema; se presente `geo-map-lit-local.js`, importare `renderSearch` e `searchUiHandlers` dal modulo Geo via `@modules/Geo/.../map/controls/search.js`

## Build obbligatoria

```bash
cd laravel/Themes/Sixteen
npm run build
npm run copy
```

Senza `copy`, `public_html/themes/Sixteen/` resta con asset vecchi.

## Collegamenti

- [map-js-module-naming-rule](../../../../Modules/Geo/docs/wiki/concepts/map-js-module-naming-rule.md)
- [theme-owned-scripts-rule](./theme-owned-scripts-rule.md)
