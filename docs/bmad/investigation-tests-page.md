---
title: "Test page `/it/tests` → 404 (Folio non risolve test/index + JSON mancante)"
type: investigation
status: open
links:
  github_issue: "#61"
  discussion: "https://github.com/fixcity/fila5/discussions/61"
tags: [routing, folio, tests, design-comuni]
related:
  - "laravel/Themes/Sixteen/docs/bmad/folio-page-pattern.md"
  - "laravel/Themes/Sixteen/docs/bmad/design-comuni-information-architecture.md"
  - "laravel/Themes/Sixteen/docs/bmad/investigation-migrations-violations.md"
created: 2026-10-11
updated: 2026-10-11
qmd: "investigazione: `http://localhost:8000/it/tests` restituisce 404 sixteen"
---

# Investigazione: `http://localhost:8000/it/tests` restituisce 404

## Aggiornamento: errore runtime del blocco tabs risolto

La successiva richiesta `/it/tests` non era più un 404: il CMS caricava il
contenuto, ma una sorgente del modulo conteneva ancora
`pub_theme::components.blocks.tabs.design-comuni`. Quel namespace non deve
generare una replica: `pub_theme` è già Sixteen e il blocco canonico è
`pub_theme::components.blocks.tabs.default`.

Correzioni applicate:

- `laravel/Modules/Fixcity/config/database/content/pages/tests.json` ora usa il
  blocco `tabs.default`;
- `laravel/Themes/Sixteen/resources/views/components/blocks/tabs/default.blade.php`
  non contiene più il token Blade invalido `@json($tabs)|>`;
- `laravel/config/local/fixcity/database/content/pages/tests.index.json` resta la
  sorgente locale con `id` e `slug` uguali a `tests.index`.

Evidenza verificata: `php artisan view:cache` riuscito e `GET /it/tests` ha
restituito HTTP 200 mostrando entrambe le tab `Generali` e `Sito`.

## Osservazione (evidenza)

`curl -s http://192.168.1.40:8000/it/tests` → **404 Not Found** (Laravel default page).

## Root cause

1. **La view Folio esiste**: `laravel/Themes/Sixteen/resources/views/pages/tests/index.blade.php`
   - `name('tests.index')` → route `tests.index`
   - middleware: `PageSlugMiddleware::class`
   - Monta `<x-page side="content" slug="$pageSlug" :data="$data" />` con `$pageSlug = 'tests'`

2. **Nessun JSON per `tests`**: non esistono file `tests.json` o `tests.index.json` in
   `laravel/config/local/fixcity/database/content/pages/`.
   Il `x-page` componente CMS cerca il JSON → non trova → il contenuto è vuoto.

3. **PageSlugMiddleware non risolve slug `tests`**: lo slug `tests` non corrisponde a nessuna
   voce CMS pubblicata → la pagina viene restituita ma senza contenuto.

4. **Il route del tema è `name('comune.homepage')`**, non `tests.index` → `/it/tests` non è
   mappato esplicitamente in `laravel/routes/web.php`.

## Obiettivo: `http://localhost:8000/it/tests` deve replicare
`https://italia.github.io/design-comuni-pagine-statiche/` (homepage Design Comuni: tab
"Generali" / "Sito", card gruppi, footer Design Comuni, skip links).

## Soluzione

### 1. Creare JSON contenuto (source of truth dinamico)
`laravel/config/local/fixcity/database/content/pages/tests.json`:

```json
{
  "id": "tests",
  "title": { "it": "FixCity", "en": "FixCity" },
  "slug": "tests",
  "content_blocks": {
    "it": [
      {
        "type": "home.hero",
        "data": {
          "eyebrow": "SERVIZI DIGITALI DEL COMUNE",
          "heading": "Segnalazioni e servizi per la tua comunità",
          "intro": "Racconta cosa non funziona, indica dove e segui gli aggiornamenti.",
          "primary_label": "Invia una segnalazione",
          "primary_url": "{{ route('container0.view',['container0'=>'tickets','slug0'=>'create']) }}",
          "secondary_label": "Vedi le segnalazioni",
          "secondary_url": "{{ route('container0.index',['container0'=>'tickets']) }}"
        }
      },
      {
        "type": "argomenti.groups",
        "data": {
          "groups": [
            {
              "id": "generali",
              "name": "Generali",
              "tab": "Sito",
              "items": [
                { "slug": "amministrazione", "title": "Amministrazione", "icon": "it-building", "url": "/amministrazione" },
                { "slug": "servizi", "title": "Servizi", "icon": "it-card", "url": "/servizi" }
              ]
            },
            {
              "id": "amministrazione",
              "name": "Amministrazione",
              "tab": "Amministrazione",
              "items": [ ... ]
            }
          ]
        }
      }
    ]
  }
}
```

Note:
- `list_url` e `report_url` DEVO essere `route('container0.view', ['container0'=>'tickets','slug0'=>'create'])` e
  `route('container0.index', ['container0'=>'tickets'])` — mai `route('tickets.create')` o path
  hardcodato (`/tickets/create`) perché la CTA deve passare dalla Folio generica
  `[container0]/[slug0]` con `name('container0.view')`; `PageSlugMiddleware` risolve poi lo
  slug CMS `tickets.create`.
- I gruppi servono per i due tab: ogni oggetto `groups[]` ha `tab` (es. `"Sito"` / `"Generali" /
  `"Amministrazione"`) → il componente `argomenti.groups` raggruppa per `tab` e mostra i tab
  orizzontali Design Comuni.

### 2. Creare componente blade del gruppo/tab (block)
`laravel/Themes/Sixteen/resources/views/components/blocks/argomenti/groups.blade.php`:
- Renderizza tab bar orizzontale con classi Design Comuni (`btn-group` / DaisyUI)
- Per ogni tab, renderizza card in griglia 3 colonne (Design Comuni grid)
- Icone: SVG sprite Bootstrap Italia (solo assets locali, no CDN) o icon set DaisyUI

### 3. Componente `x-page` CMS deve caricare il JSON
Verificare che il blocco JSON-driven (`home.json` è già funzionante) venga esteso per `tests`.
`home.json` usa `pub_theme::components.blocks.home.hero` → il CMS risolve `type` → `view`.
Aggiungere `tests` alla lista dei content blocks caricati (se esiste una whitelist).

### 4. Route (opzionale ma raccomandato)
Aggiungere in `laravel/Themes/Sixteen/routes/web.php`:
```php
Route::get('/tests', [ComuneController::class, 'tests'])
    ->name('comune.tests');
```
oppure lasciare che Folio gestisca `name('tests.index')` tramite il registration del tema
(service provider o route discovery).

### 5. Verifica con Playwright + Puppeteer
- Cattura screenshot del ref: `https://italia.github.io/design-comuni-pagine-statiche/`
- Cattura screenshot locale: `http://192.168.1.40:8000/it/tests`
- Confronto visivo: layout, tab, card, footer, skip links
- WCAG 2.1 AA: axe-core (Puppeteer) su entrambe le pagine
- Responsive: 320 / 768 / 1024 / 1440

## Strumenti da installare/configurare

- **Puppeteer** (già installato: v24.43.1) ✅
- **Playwright** (già installato: v1.63.0) ✅ — ma mancano i browser installati
  (`npx playwright install` fallito per dipendenze) → installare browser Chromium
- **Mauve**: `mauve not in PATH` → installare via `npm i -g @mauve/axe` o `npx mauve`
  (audit WCAG 2.1 AA programmato, APCA contrast)

## Documentazione creata
- `laravel/Themes/Sixteen/docs/bmad/investigation-tests-page.md` (questo file)

## Aggiornamento: dettaglio `[slug]` e variabile non dichiarata

La navigazione da `/it/tests` verso `/it/tests/homepage` passava
`:body-page="$bodyPage"` a `x-layouts.app`, ma il componente Volt non dichiarava
`$bodyPage`. Il prop non era necessario: è stato rimosso da
`resources/views/pages/tests/[slug].blade.php`, lasciando al layout Sixteen il
suo valore predefinito.
