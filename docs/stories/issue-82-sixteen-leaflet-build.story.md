---
type: story
tags: [bugfix, build, leaflet, vite]
issues: [82]
scope: theme:Sixteen
status: ready-for-review
title: "Build Sixteen: Leaflet risolvibile in CI"
---

# Build Sixteen: Leaflet risolvibile in CI

## Contesto

Il job Theme Build dell’issue #82 non riusciva a risolvere l’import `leaflet`
proveniente da `Modules/Geo/resources/js/components/map-lit.js`. Il tema include
Leaflet nel bundle Vite e nei fogli CSS, quindi non è una dipendenza esclusiva
degli strumenti di sviluppo.

## Causa radice

`leaflet` era dichiarato in `devDependencies`, mentre il codice compilato del
tema e i relativi asset CSS lo consumano come dipendenza del front office. In
un’installazione CI che omette le devDependencies il resolver non trova il
pacchetto.

## Correzione

- spostato `leaflet` in `dependencies` in `package.json`;
- riallineato il package root di `package-lock.json`;
- mantenute invariate le regole Vite e i moduli Geo fuori dallo scope dell’issue.

## Verifica

- `npm run build` eseguito da `laravel/Themes/Sixteen`;
- il build produce `vendor-map-*.js`, i CSS Leaflet e le immagini marker;
- da ripetere in CI con `npm ci` sul tema e `npm run build`.
