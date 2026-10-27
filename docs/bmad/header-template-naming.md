---
title: Header template naming and ownership
description: Decision record for the canonical Sixteen Design Comuni header view.
---

# Header and footer template naming and ownership

## Decision

`Themes/Sixteen` is the Design Comuni theme. Its runtime header owner is therefore:

```text
Themes/Sixteen/resources/views/components/sections/header/v1.blade.php
Themes/Sixteen/resources/views/components/sections/footer/v1.blade.php
```

The `v1` suffix identifies the section-template contract used by `x-section` and by the CMS `sections/{header,footer}.json` blocks. `design-comuni` is a product/theme name, not a variant of either section, so using it as a sibling view name duplicates ownership and makes future themes or versions ambiguous.

## Why this matters

The CMS stores the view name (`pub_theme::components.sections.header.v1`) and the theme resolves it. The name is consequently part of a runtime contract, not merely a filename. A change to the filename without updating the JSON source, tests and documentation can silently fall back to a different header skin.

## Rules

- Keep the Design Comuni header and footer markup owned by `header/v1.blade.php` and `footer/v1.blade.php`.
- Keep reusable fragments under `sections/header/partials/`.
- Keep `header/tailwind.blade.php` as the shared presentation fragment only; it is not the CMS section owner.
- New header variants must use an explicit version or semantic variant name and must be registered in the owning theme's CMS contract before use.
- Historical BMAD notes may retain old paths as evidence, but new code, tests and docs must use `header/v1.blade.php`.

## Verification

```bash
cd laravel
php artisan test Themes/Sixteen/tests/Feature/Components/HeaderTenantFallbackTest.php
php artisan test Themes/Sixteen/tests/Unit/HeaderV1SlimDropdownContractTest.php
```
