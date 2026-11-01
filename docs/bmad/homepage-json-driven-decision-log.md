---
title: "Sixteen homepage JSON-driven decision log"
type: decision-log
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, decisions]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "decision log   homepage json-driven sixteen"
---

# Decision log — Homepage JSON-driven

## 2026-10-09 — La home JSON deve rispecchiare `index.blade.php.old`

**Decisione:** `home.json` non deve essere una landing generica con features, stats, categorie e testimonials. Deve rappresentare le sezioni esistenti nel vecchio file Blade.

**Motivo:** la richiesta di ristrutturazione Sixteen è migrare contenuto hardcoded in JSON/CMS, non ridisegnare la homepage.

**Implicazione:** ogni sezione del vecchio Blade deve avere un blocco CMS corrispondente o un blocco esistente compatibile.

## 2026-10-09 — Pattern JSON da `tickets.confirmation.json`

**Decisione:** usare il pattern già adottato da `tickets.confirmation.json`: array localizzati `content_blocks.it/en`, ogni entry con `type` e `data.view`.

**Motivo:** è il pattern locale più semplice e già funzionante nel tenant FixCity.

## 2026-10-09 — View esistente obbligatoria

**Decisione:** nessun blocco può puntare a view inesistenti o non compatibili con include CMS.

**Motivo:** `BlockData` fallisce subito con `RuntimeException('view not found')`.

## 2026-10-09 — Evitare feature grid per la home old-style

**Decisione:** non usare `features.grid` per rappresentare “Come funziona”.

**Motivo:** è semanticamente diversa dalla sezione a tre step del vecchio file e può rompere il runtime se riceve icone non risolte.

## 2026-10-09 — Folio resta solo shell

**Decisione:** `index.blade.php` deve restare simile a TwentyOne: layout + `<x-cms::page side="content" slug="home" />`.

**Motivo:** la filosofia Sixteen JSON-driven vuole che la pagina non decida più i blocchi.
