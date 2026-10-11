---
title: "Sixteen front-office: tests page + DesignComuni argomenti parity"
type: task-story
status: todo
tags: [design-comuni, front-office, blade, jsong, folio, bmad]
github_issue: "https://github.com/italia/design-comuni-pagine-statiche"
github_discussion: "https://github.com/italia/design-comuni-pagine-statiche/discussions"
---

# STORY-702: Sixteen tests page — DesignComuni index + argomenti tab-parity

## Obiettivo
Creare/fixare `resources/views/pages/tests/index.blade.php` per renderizzare la
pagina indice del Design Comuni reference (https://italia.github.io/design-comuni-pagine-statiche/),
con contenuti dinamici caricati da JSON (`config/local/fixcity/database/content/pages/tests.json`
e `tests.argomenti.json`). I contenuti devono riflettere i **2 tab** del reference:
**Generali** (homepage, FAQ, ricerca, argomenti, etc.) e **Sito** (pagine sotto `sito/`).

## Contesto architetturale
- Il tema Sixteen usa **Folio + Volt** per le pagine front-office
- `[container0]/[slug0]/index.blade.php` → `container0.view` route → `PageSlugMiddleware`
- `pages/tests/[slug].blade.php` → `tests.view` route → `tests.{slug}` slug
- `pages/tests/index.blade.php` → `tests` slug (DA CREARE)
- I contenuti vengono caricati da `<x-page side="content" :slug="...">` → JSON in `config/local/{tenant}/database/content/pages/`
- Il pattern TwentyOne (`pages/index.blade.php`) usa `<x-cms::page side="content" slug="home" />` — Sixteen deve fare lo stesso ma con `<x-page>`

## Problemi correnti
1. `pages/tests/index.blade.php` — **non esiste**
2. `tests.json` — **non esiste**
3. `tests.argomenti.json` — **esiste come riferimento in CMS docs** ma file mancante
4. `home.json` — URL hardcoded (`/tickets/create`, `/tickets`) invece di `route('container0.view')`
5. `icon_sprite` nel JSON punta a Bootstrap Italia sprite — deve usare `@include('pub_theme::components.ui.icon')`
6. Migration `2026_09_27_*` / `2026_10_01_*` — violano le convenzioni (cast bigint→uuid)

## Soluzione
- [ ] Creare `config/local/fixcity/database/content/pages/tests.json` con struttura 2-tab
- [ ] Creare `config/local/fixcity/database/content/pages/tests.argomenti.json` con contenuti argomenti
- [ ] Creare `resources/views/pages/tests/index.blade.php` (Folio + Volt pattern)
- [ ] Fix `home.json` — sostituire URL hardcoded con `route()` calls
- [ ] Fix `icon_sprite` → usare icon components in Blade
- [ ] Investigare e documentare le migration errors

## Definition of Done
- `/it/tests/` renderizza l'indice DesignComuni con 2 tab (Generali / Sito)
- `/it/tests/argomenti` renderizza la pagina argomenti con contenuti dinamici
- Nessun URL hardcoded in JSON — tutti usano `route()`
- Nessun riferimento a `bootstrap-italia/dist/svg/sprites.svg` in Blade/JSON
- Migration test: `php artisan migrate` non fallisce
- WCAG 2.1 AA: verificato con `wcag-aa-check.mjs`

## Dependency
- `pub_theme::components.ui.icon` (creato)
- `motion-reveal.js` Alpine utility (creato)
- `docs/design-comuni/DESIGN-COMUNI-CANONICAL.md` (creato)
