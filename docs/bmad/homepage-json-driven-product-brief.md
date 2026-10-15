---
title: "Sixteen homepage JSON-driven product brief"
type: product-brief
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, json, fixcity]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "sixteen homepage json-driven   product brief sixteen"
---

# Sixteen homepage JSON-driven — product brief

## Obiettivo

La homepage pubblica FixCity deve restare una pagina Folio minima e deve prendere i contenuti dal record CMS JSON `config/local/fixcity/database/content/pages/home.json`.

Il risultato atteso non è una landing generica: il JSON deve ricostruire la composizione di `resources/views/pages/index.blade.php.old` tramite blocchi `pub_theme::components.blocks.*`.

## Valore

- consente di modificare copy, ordine e CTA senza rimettere contenuto hardcoded nella pagina Folio;
- mantiene la home allineata al contratto Design Comuni già documentato;
- riduce il rischio di divergenza tra tema Sixteen, modulo Cms e dati FixCity;
- rende verificabile il flusso guest: crea segnalazione, accedi/registrati, guarda mappa, segui pratica.

## Confini

### In scope

- JSON tenant locale `home.json` con `content_blocks.{locale}`;
- blocchi Sixteen sotto `resources/views/components/blocks/`;
- composizione equivalente a `index.blade.php.old`:
  1. hero blu con copy, CTA e mappa;
  2. sezione “Come funziona” a tre card;
  3. banda tracking pratica.

### Out of scope

- controller HTTP;
- logica ticket o persistenza nel tema;
- nuovi servizi o service layer;
- inventare sezioni marketing non presenti nella vecchia homepage.

## Utenti

- cittadino guest che vuole segnalare un problema;
- cittadino guest che vuole autenticarsi o registrarsi;
- cittadino che vuole consultare segnalazioni su mappa;
- cittadino che vuole tracciare una pratica.

## Principio guida

Il JSON decide quali blocchi appaiono; i blocchi Blade decidono come renderizzarli; la pagina Folio rimane solo shell di rendering CMS.
