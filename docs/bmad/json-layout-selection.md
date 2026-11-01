---
title: "BMAD decision: optional layout selection from CMS JSON"
type: note
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "bmad decision: optional layout selection from cms json sixteen"
---
# BMAD decision: optional layout selection from CMS JSON

## Context

Sixteen already owns the Design Comuni front office. Some public showcase and
service-list pages need its `layouts.test` shell, while ordinary FixCity pages
must keep `layouts.app`. Selecting the shell in each Blade page duplicated policy
and caused pages to drift.

## Contract

```json
{
  "id": "tickets-index",
  "slug": "tickets.index",
  "layout": "test"
}
```

- `layout` is optional.
- Missing, empty, or unknown values resolve to `layouts.app`.
- `test` resolves only to `layouts.test`.
- JSON remains content/configuration; it cannot select an arbitrary Blade view.

## Ownership and flow

`Modules/Cms/Models/Page` preserves the field through the Sushi JSON schema and
casts. Generic Folio wrappers read the resolved CMS page and map the allow-listed
value to a component name. The tests routes deliberately use explicit shells:
`tests/index.blade.php` uses `x-layouts.test`, while `tests/[slug].blade.php`
uses `x-layouts.app`. JSON-driven selection is reserved for generic containers.
The wrappers covered by the contract are:

- `pages/[container0]/index.blade.php`
- `pages/[container0]/[slug0]/index.blade.php`

The test shell reuses Sixteen's `components.layouts.main`, header, footer,
Tailwind/Vite assets and Alpine runtime. No Bootstrap Italia CSS/JS or duplicate
Design Comuni namespace is introduced.

## Verification

```bash
cd laravel
php artisan view:clear
php artisan view:cache
```

The cache build passes and `/it/tickets`, `/it/tickets/create` and
`/it/tickets/track` return HTTP 200 with the optional layout enabled on
`tickets.index.json`.
