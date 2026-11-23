---
title: "ADR — Sixteen compila gli asset con Vite e pubblica tramite symlink"
type: decision
status: accepted
theme: Sixteen
created: 2026-11-23
updated: 2026-11-23
issues:
  - "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
---

# Sixteen compila gli asset con Vite e pubblica tramite symlink

## Contesto

Sixteen è il tema front office attivo. Il package dichiara una pipeline `prepare:static-assets` → `vite build` →
`prune:assets`; il webroot del workspace tratta `public_html/themes/Sixteen` come collegamento alla `public/` del tema.

## Decisione

La build supportata è `npm run build` eseguita da `laravel/Themes/Sixteen`. Il deploy mantiene il symlink verso `public/`;
non si introduce uno script `copy` né si documenta una copia manuale come requisito.

## Alternative scartate

- Copiare gli asset nel webroot dopo ogni build.
- Mantenere una seconda pipeline Vite fuori dal tema.
- Usare la presenza di asset già compilati come prova di una build corrente.

## Conseguenze

La directory `public/` e il manifest sono l'output verificabile. La pipeline può rimuovere asset orfani; una build fallita
lascia l'output non verificato. La decisione non attribuisce al tema responsabilità su dati, routing o dominio.

## Conferma

Verificare `package.json`, `vite.config.js`, il symlink del webroot e l'uscita di `npm run build` nello stesso contesto.
