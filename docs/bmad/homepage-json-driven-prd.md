---
title: "Sixteen homepage JSON-driven PRD"
type: prd
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, prd, cms]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "prd   homepage sixteen json-driven sixteen"
---

# PRD — Homepage Sixteen JSON-driven

## Aggiornamento visuale 2026-10-09

La homepage deve avere una gerarchia civic-first: valore e CTA nel hero,
contesto operativo nella mappa, orientamento nei tre passaggi, recupero pratica
nella banda tracking. Sono vietati gradienti viola generici, 3D decorativo,
statistiche inventate e card ripetitive prive di gerarchia.

## Requisiti funzionali

### F1 — Shell Folio minima

`laravel/Themes/Sixteen/resources/views/pages/index.blade.php` deve registrare `name('home')` e renderizzare il CMS con:

```blade
<x-layouts.app>
     <x-cms::page side="content" slug="home" />
</x-layouts.app>
```

La pagina non deve contenere sezioni editoriali hardcoded.

### F2 — Record CMS locale

`laravel/config/local/fixcity/database/content/pages/home.json` deve usare lo stesso pattern dei file `tickets.*.json`:

- `id` stringa;
- `title` multilingua;
- `slug: "home"`;
- `content: null`;
- `content_blocks.it` e `content_blocks.en` come array;
- `sidebar_blocks` per le lingue supportate;
- `footer_blocks` coerente con gli altri JSON locali.

### F3 — Composizione uguale a `index.blade.php.old`

I blocchi devono rappresentare solo le tre sezioni originarie:

1. hero `#head-section` con copy, CTA auth-aware e `map-lit`;
2. how-it-works a tre card;
3. quick-actions/tracking con CTA verso `/tickets/track`.

Non devono comparire sezioni non presenti nel vecchio file: stats, categorie, testimonials, feature marketing generiche.

### F4 — View esistenti e compatibili

Ogni `data.view` deve puntare a una view Blade realmente esistente. `Modules\Cms\Datas\BlockData` lancia `RuntimeException` se la view non esiste.

Le view devono essere compatibili con include CMS: ricevono variabili dirette e `data` attraverso `@include($block->view, array_merge(...))`.

### F5 — Icone sicure

Il JSON non deve passare nomi icona incompleti come `map-pin`. Se una view usa `<x-filament::icon>`, il payload deve usare identificatori validi tipo `heroicon-o-map-pin` oppure omettere l’icona.

## Requisiti non funzionali

- nessun controller;
- nessun service layer;
- supporto almeno `it` e `en`;
- niente link operativi `#`;
- focus e contrasto coerenti con contratto homepage guest;
- mappa con `aria-label`;
- route `/it` verificata via browser.

## Acceptance criteria

- `/it` non genera eccezioni Laravel;
- nel body sono presenti il testo hero, la mappa, tre step e la CTA tracking;
- il JSON è valido;
- tutte le `data.view` esistono;
- Playwright e Puppeteer aprono `http://127.0.0.1:8000/it` senza pagina di errore.
