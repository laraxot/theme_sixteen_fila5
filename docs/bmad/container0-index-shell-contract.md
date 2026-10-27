---
title: "Contratto shell Folio container0.index"
type: contract
status: active
theme: Sixteen
created: 2026-10-16
updated: 2026-10-22
tags: [bmad, folio, volt, x-page, cms, dry, kiss, reusable]
qmd: "container0 index shell folio x-page layouts.app no native match resolve action"
related:
  - ./filament-blueprint.md
  - ./decision-log.md
  - ../wiki/rules/container0-index-folio-pattern.md
  - ../wiki/concepts/folio-page-shell-pattern.md
  - ../rules/reusable-components.md
  - ../folio-page-pattern.md
  - ../../../../Modules/Cms/docs/wiki/concepts/folio-page-shell-pattern.md
---

# Contratto — `[container0]/index` è solo shell

## Perché (business + religione)

Il tema **veste**. Il **dominio** (FAQ, servizi, elenco segnalazioni, mappa sito)
vive nei JSON CMS (`{container0}.index`) e nei blocchi/moduli owner.

Una Folio page con `match`/`@include`/`x-dynamic-component` sul layout:

- duplica routing e contenuto (seconda verità)
- spezza Filament way (lista = `.index`)
- rende impossibile parallelizzare BMAD (tema vs Cms vs Fixcity)

## Contratto runtime

| Layer | Responsabilità |
|-------|----------------|
| Folio `render` | Chiama `ResolveContainer0IndexAction` → Redirect 301/login o View |
| Action + Support | Alias IT→canonici, `area-personale`, abort 404 se manca CMS |
| Folio + Volt | `name('container0.index')`, `PageSlugMiddleware`, `mount` → `$pageSlug` + `$data` |
| `<x-layouts.app>` | Chrome FO unico (header/footer via `<x-section>`); `body-page` solo da segmento Folio (es. blog→`lista-risorse`), **mai** `$this` fuori `@volt` |
| `.page-content` | Sempre `data-dc` (Sixteen = Design Comuni CSS scope) |
| `<x-page>` | Carica blocchi JSON per slug `{container0}.index` |
| JSON tenant | Titoli, blocchi, view dei blocchi |
| Moduli | Actions / widget Filament montati dai blocchi |

## Codice canonico

Vedi `resources/views/pages/[container0]/index.blade.php`.

**Apertura e chiusura devono combaciare:** `<x-layouts.app>` … `</x-layouts.app>`.
Mai lasciare `</x-dynamic-component>` dopo un refactor.

## Vietato nella shell

- `nativePage` / `utilityPage` / `match ($container0)`
- mappa alias / `Auth::check` / `abort(404)` inline (usare Action + Support)
- creare una view Folio esplicita `pages/{container0}/index.blade.php` per una
  pagina già coperta da `[container0]/index.blade.php` (es. FAQ): sarebbe una
  route concorrente e bypasserebbe il contratto CMS
- `@include('pub_theme::components.pages.*')` nella Folio page
- `x-dynamic-component` per scegliere layout da JSON
- fetch CMS / titoli / meta nel `mount()` o in `@php` grasso
- `@props` / `@extends` / `@volt($pageSlug)`

## JSON minimi tenant (slug = path Folio)

| URL | Slug CMS |
|-----|----------|
| `/it/tickets` | `tickets.index` |
| `/it/blog` | `blog.index` |
| `/it/events` | `events.index` |
| `/it/domande-frequenti` | `domande-frequenti.index` — blocco `content-page`, accordion `source: faq`. Mai `pages/domande-frequenti/index.blade.php`: la cartella letterale precede la shell. [Perché](./knowledge/why-domande-frequenti-blade-php-must-not-exist.md) |
| `/it/mappa-sito` | `mappa-sito.index` |
| `/it/services` | `services.index` |
| `/it/services/{slug}` | `services.view` |
| `/it/area-personale/{voce}` | `area-personale.{voce}` |
| `/it/segnalazioni` | `segnalazioni.index` |
| `/it/lista-categorie` | `lista-categorie.index` |

## Filament blueprint

Il tema non ha Resource. I widget FO restano dei moduli; la shell li monta solo
se un blocco JSON lo richiede. Vedi [filament-blueprint.md](./filament-blueprint.md).

## Verifica

```bash
cd laravel && vendor/bin/pest Themes/Sixteen/tests/Unit/FolioPageMountContractTest.php
```

## Related

- Decision log: [decision-log.md](./decision-log.md) (D20)
- Pattern wiki: [folio-page-shell-pattern.md](../wiki/concepts/folio-page-shell-pattern.md)
- Cms: [folio-page-shell-pattern.md](../../../../Modules/Cms/docs/wiki/concepts/folio-page-shell-pattern.md)
