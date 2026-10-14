---
title: "Decision: Layout 'test' via JSON `layout` field (D12)"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "decision: layout 'test' via json `layout` field (d12) sixteen"
---
# Decision: Layout "test" via JSON `layout` field (D12)

## Context

The route file `pages/tests/[slug].blade.php` previously contained a `mount()`
that read `tests.catalog.json`, set `catalogFallback`, and included slug‑specific
blocks (`eventi`, `novita`, `servizi`, `assistenza‑02‑conferma`, …). This
violated the architecture: every page must be defined by its own
`tests.<slug>.json`, and new markup must live in a reusable theme block.

## Decision

`mount()` builds only `tests.<slug>` and passes the context to `<x‑page>`.
No `catalogFallback`, no `tests.catalog.json` read, no `in_array` slug checks.
The Blade is:

```php
<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('tests.view');
middleware(PageSlugMiddleware::class);

new class extends Component
{
    public string $slug = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $slug = ''): void
    {
        $this->slug = $slug;
        $this->pageSlug = $slug ? 'tests.'.$slug : 'tests.index';
        $this->data = ['slug' => $slug];
    }
};
?>

<x-layouts.app>
    @volt('tests.view')
    <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>
```

## Why this is correct

1. **Single source of truth** — every page is `tests.<slug>.json` in
   `database/content/pages/`. The route file does not duplicate content.
2. **No fallback branching** — `catalogFallback` and `in_array` checks are
   removed. If a page JSON is missing, the CMS renders its default fallback;
   that is the CMS's job, not the route file's.
3. **Reusable blocks** — new markup goes in a theme block
   (`pub_theme::components.blocks.*`), not in a slug‑specific `@include`.
4. **Layout choice** — the `layout` field in the page JSON (`"test"` or absent)
   is resolved by the layout component, not by the route file.

## Files changed

- `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php`
  — removed `catalogFallback`, `tests.catalog.json` read, slug‑specific
  `@include` branches; now delegates entirely to `<x‑page>`.

## Verification

```bash
curl -sS http://192.168.1.40:8000/it/tests/homepage | rg -i
"catalogFallback|tests.catalog"  # must return 0
curl -sS http://192.168.1.40:8000/it/tests/assistenza-02-conferma | rg -i
"catalogFallback|tests.catalog"  # must return 0
```

## Second brain

- Decision D12 recorded in `MEMORY.md`.
- Related: D10 (`pub_theme` IS Sixteen IS Design Comuni — no duplicate
  `design‑comuni` namespace), D11 (layout `test` via JSON field).
