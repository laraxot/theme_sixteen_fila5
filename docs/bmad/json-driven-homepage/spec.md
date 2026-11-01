---
title: "SPEC — Homepage Sixteen da content JSON"
type: bmad-spec
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "spec sixteen"
---

# SPEC

## Problema

`home.json` non rispetta il contratto letto da `Modules/Cms`: usa chiavi
custom (`hero`, `map`, `how_it_works`, `quick_actions`, `layout`) che il
resolver non percorre. La homepage deve conservare la funzionalità della
vecchia `index.blade.php.old` usando lo stesso guscio CMS di TwentyOne.

## Capacità

- Caricare la pagina con slug `home` tramite `<x-cms::page side="content" ...>`.
- Rappresentare in ordine le tre sezioni effettive: hero con mappa e CTA,
  "Come funziona", tracking rapido.
- Localizzare i blocchi per IT/EN/DE/ES senza introdurre un loader nel tema.
- Riutilizzare view Sixteen esistenti; crearne una solo se nessuna copre una
  sezione.

## Vincoli

- Schema: `id`, `title`, `slug`, `content`, `content_blocks`,
  `sidebar_blocks`, `footer_blocks`.
- Ogni blocco ha `type` e `data.view` risolvibile da `BlockData`.
- I link ticket usano le Folio page generiche del tema: `container0.index` per
  la lista e `container0.view` con `container0=tickets`, `slug0=create` per la
  CTA di creazione/report.
- `tickets.confirmation.json` è il riferimento operativo dello schema.
- Nessun controller, service, modifica al resolver CMS o ignore PHPStan.
- Prima si documenta e si chiude la readiness; solo dopo si modifica `home.json`.

## Evidenza

- `Themes/TwentyOne/resources/views/pages/index.blade.php` è il page shell.
- `Themes/Sixteen/resources/views/pages/index.blade.php.old` definisce il
  contenuto funzionale da preservare.
- `config/local/fixcity/.../tickets.confirmation.json` dimostra il payload.
