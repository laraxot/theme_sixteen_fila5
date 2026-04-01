# Tests Routing Normalization

Date: 2026-03-30

## Scope

Normalize `Themes/Sixteen/resources/views/pages/tests` so each test page delegates rendering to CMS JSON through `<x-page>` instead of embedding page-specific HTML.

## Findings

- The Design Comuni source set under `Main_files/design-comuni-pagine-statiche/src/pages/sito` contains 38 pages.
- The tenant content set under `config/local/fixcity/database/content/pages/tests.*.json` already covers all 38 Design Comuni slugs.
- Therefore there are currently `0` missing `tests.*.json` slugs for the Design Comuni static corpus.
- The real gap was architectural drift: dedicated Folio pages had reintroduced hardcoded HTML and local data arrays, bypassing the JSON/block pipeline.

## Pages Normalized

The following dedicated pages were reduced to thin Folio + Volt wrappers:

- `tests/homepage.blade.php`
- `tests/servizi.blade.php`
- `tests/eventi.blade.php`
- `tests/appuntamento-01-ufficio.blade.php`

## Wrapper Contract

Each dedicated page must only:

- set the route name and middleware
- populate `pageSlug`
- optionally pass `data`
- delegate rendering to `<x-page side="content" :slug="$pageSlug" :data="$data" />`

## Why This Fix Matters

- Restores a single rendering path for `tests.*` pages.
- Prevents page-specific Blade files from diverging from JSON content.
- Keeps header/footer responsibility inside sections and page content inside CMS blocks.
- Avoids regressions such as multiple-root Volt components and wrong block/view coupling.

## Runtime Status

- `blade-icons` bootstrap was repaired by changing `config/blade-icons.php` icon-set paths to relative paths and ensuring `resources/svg/` exists.
- `php artisan optimize:clear` now completes successfully.
- `http://fixcity.local/it/tests/homepage` still times out at HTTP level, so the next blocker is runtime/render performance or a deeper rendering loop, not icon registration.

## Next Correction Path

1. Trace the homepage timeout with the now-clean bootstrap.
2. Capture a local screenshot only after the route responds.
3. Continue page-by-page parity work inside JSON blocks, not dedicated page templates.
