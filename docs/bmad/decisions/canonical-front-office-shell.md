---
title: "Sixteen canonical front-office shell"
type: decision
status: accepted
tags: [bmad, sixteen, design-comuni, folio, shell]
---

# Sixteen canonical front-office shell

Sixteen is the Design Comuni theme; `components/layouts/app.blade.php` is
therefore the application shell for real front-office routes, including CMS,
blog, events and ticket detail/track pages. The name of the visual system must
not create a second layout family inside the theme.

`components/layouts/design-comuni.blade.php` does not exist. Persisted CMS
values such as `layout: design-comuni` are interpreted by the resolver as the
canonical `app` shell; they are content values, not view names. The same rule
applies to the sections: the canonical renderers are `header/v1.blade.php` and
`footer/v1.blade.php`; a section named `design-comuni` must not be introduced
as a duplicate renderer.

Parity-only `/tests/*` shells may retain their explicit test layout because
they reproduce reference fixtures; that exception does not authorize real
front-office pages to select the legacy alias.

## Verification contract

- `x-section slug="header"` resolves to `header/v1`.
- `x-section slug="footer"` resolves to `footer/v1` for the real shell.
- `[container0]/[slug0]` selects `layouts.app` for every real page.
- No `components/layouts/design-comuni.blade.php` exists.
- No real front-office page selects `layouts.design-comuni`.
