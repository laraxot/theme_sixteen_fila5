---
title: "Layout test (layout-test.blade.php) per pagine /tests — Design Comuni con Tailwind + Alpine + Lit + DaisyUI"
type: decision
status: active
links:
  github_issue: "#62"
  discussion: "https://github.com/fixcity/fila5/discussions/62"
tags: [layout, design-comuni, tailwind, alpine, lit, daisyui]
related:
  - "laravel/Themes/Sixteen/docs/bmad/decision-log.md"
  - "laravel/Themes/Sixteen/docs/bmad/investigation-tests-404-fix.md"
created: 2026-10-11
updated: 2026-10-11
---

# Decisione: layout-test.blade.php per pagine /tests

## Contesto
Le pagine sotto `/it/tests/*` (homepage, segnalazione-dettaglio, argomenti, ecc.) devono mostrare Design Comuni. L'attuale layout `app.blade.php` è generico; creare `layout-test.blade.php` dedicato permette di:
- Specificare meta/title Design Comuni
- Caricare CSS Tailwind + DaisyUI (no Bootstrap CDN)
- Aggiungere skip-links e tab navigation Design Comuni
- Definire un campo JSON `layout` in `tests.index.json` per scegliere il layout

## Scelta
- **Layout file**: `laravel/Themes/Sixteen/resources/views/layouts/layout-test.blade.php`
- **JSON campo**: `"layout": "test"` in `tests.index.json`; se assente, default `app`
- **Blade**: `tests/[slug].blade.php` legge `$layout = $data['layout'] ?? 'test';` e usa `<x-layouts.layout-test>` se popolato
- **Stack**: TailwindCSS @apply + Alpine.js (x-data per tab) + Lit (web components per card) + DaisyUI (button/card/button-group)
- **NO Bootstrap Italia CDN** — solo token design da `civic-design-theme.css`

## Regola (Second Brain)
- Non duplicare `pub_theme::components.blocks.tabs.design-comuni` (già deciso D11)
- I tab vengono renderizzati dal componente esistente `components/ui/tab.blade.php` o `components/blocks/template-index.blade.php`
- La pagina `/tests/homepage` usa il layout test se il JSON indica `layout: test`

## Verifica
- Per controllare che `/it/tests/homepage` sia uguale a `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`: fare `curl` + `grep` per elementi Design Comuni (tab, hero, link `route('tests.view', ...)`) e confrontare con `docs/html-parity-reports/`
