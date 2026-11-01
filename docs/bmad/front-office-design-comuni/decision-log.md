---
title: "Decision log — FixCity DesignComuni front office"
type: decision-log
tags: [bmad, decisions, second-brain, design-comuni]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
status: draft
updated: 2026-10-17
qmd: "2026-10-11 sixteen"
---

# 2026-10-11

- Scope correction: the visual parity target is the complete DesignComuni public
  catalogue, not only `homepage` and `segnalazione-dettaglio`. Added
  `route-catalog.md` as the BMAD source of truth for family coverage and evidence.
- The homepage/detail vertical slice remains the reference implementation while
  the remaining Sito, Servizi, Segnalazione, Appuntamenti and Assistenza routes are
  migrated through the same JSON-to-block contract.
- Naming correction: Sixteen already owns the DesignComuni visual identity, so the
  homepage block is now `pub_theme::components.blocks.homepage` and lives at
  `Themes/Sixteen/resources/views/components/blocks/homepage.blade.php`. The
  redundant `homepage.design-comuni` view identifier was removed.
- Template-preview shell correction: test routes now use the same green institutional
  header treatment as the official reference while normal FixCity routes retain the
  tenant shell. This is a route-state presentation change, not a second theme.

- Installed `ui-ux-pro-max` from `nextlevelbuilder/ui-ux-pro-max-skill`.
- Installed the ten CloudAI-X Three.js skills into the Codex skill directory.
- Persisted the UI Pro Max DesignComuni master system under
  `laravel/Themes/Sixteen/docs/design-system/` because visual rules belong to
  the Sixteen theme owner, not to the repository root.
- Locked the runtime stack to Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament.
- Locked Bootstrap and Bootstrap Italia out of the Sixteen runtime; migration is
  incremental because legacy active imports and icon references still exist.
- Treated official DesignComuni pages and repository as the visual/information
  architecture source of truth.
- Studied UI Kit Italia v3, Designers Italia Comuni, design tokens, Bootstrap Italia
  reference material and the official web-service design guidelines. Their visual,
  semantic and accessibility decisions feed the Tailwind token contract; Bootstrap
  remains reference-only and is not installed in the Sixteen runtime.
- Installed the CFLW-AI `wcag-audit` skill and added a WCAG 2.1/Mauve/axe evidence
  contract; WCAG 2.2 checks are treated as hardening.
- Installed FreeLLMAPI under `tools/freellmapi/` as localhost-only agent tooling;
  it is explicitly outside Laravel, the Fixcity citizen runtime and Sixteen’s
  visual ownership. Provider keys and unified keys stay untracked.
- Studied the official Designers Italia ODS v2.0 information architecture and
  added the mapping of Fixcity services, practices, places, contact points,
  messages and public documents to the module/theme contracts. “Segnalazione”
  remains a Fixcity domain extension presented as a civic practice, not a new
  official ODS content type.
- Confirmed the Sixteen theme identity: Sixteen is already the DesignComuni
  theme. Removed the duplicate `resources/views/layouts/design-comuni.blade.php`
  and component variant; all public pages use `layouts/app.blade.php` over the
  shared `components/layouts/main.blade.php` shell.

## 2026-10-11 — Auth recovery and registration vertical slice

- `/auth/register` now resolves natively through a Sixteen page component and
  mounts the GDPR-owned registration widget. The widget keeps registration
  rules and persistence in `Modules/Gdpr`, while Sixteen owns the Tailwind form
  presentation, labels, consent grouping and password disclosure.
- `/auth/password/reset` now has a Sixteen-owned DesignComuni shell and mounts
  the existing User reset-link widget. Its widget view is selected from the
  theme so the module keeps orchestration while Sixteen owns presentation.
- A route smoke check confirmed HTTP 200 and rendered inputs for Italian
  registration and password-reset pages after view-cache refresh.
- Token reset now has a dedicated Sixteen Folio page; the User reset schema
  carries the route token as a hidden field before calling Laravel's password
  broker. The active personal-area settings, practices and services shells were
  also moved to Tailwind utility markup while their domain queries and auth
  redirects remain in the User module.
- UI Pro Max guidance selected the public-sector accessible direction: single
  column forms, high contrast navy/blue, visible focus, 44px targets and
  reduced visual noise. The stack guidance confirms Alpine for local state and
  Tailwind/Vite for styling.
## 2026-10-11 — Segnalazioni moved to Tailwind/Alpine presentation

The active Segnalazioni block now uses Sixteen-owned Tailwind markup with Alpine for
tabs, disclosures and the mobile filter dialog. The existing Fixcity query and Lit
map/filter contracts are retained. Bootstrap `data-bs-*` interactions were removed
from this active block; legacy files remain migration debt and are not copied into
new work.

## 2026-10-11 — Segnalazioni translation ownership and Folio/Volt boundary

- Elenco Segnalazioni copy belongs to `Themes/Sixteen/lang/{it,en}/segnalazione.php`,
  so the active component uses `pub_theme::segnalazione`; Fixcity keeps domain-owned
  strings.
- Native `services` and `segnalazioni` pages render their Sixteen components outside
  the Volt fragment. The Volt wrapper remains around the CMS fallback, avoiding an
  empty native fragment while preserving CMS behavior.
- The guest HTTP smoke checks `Reports List` and all eight guest routes pass after
  the boundary correction.

## 2026-10-11 — CMS tabs block namespace correction

- `/it/tests` was failing because the module content source still selected the
  non-existent `pub_theme::components.blocks.tabs.design-comuni` view.
- The canonical Sixteen implementation is the generic
  `pub_theme::components.blocks.tabs.default`; `pub_theme` already resolves to
  Sixteen, so no DesignComuni wrapper or duplicate view is allowed.
- The source was corrected in
  `laravel/Modules/Fixcity/config/database/content/pages/tests.json`.
- The tabs Blade block also contained an invalid `@json($tabs)|>` token; it was
  removed so the Tailwind/Alpine block can compile.
- Runtime verification: `php artisan view:cache` succeeded and
  `GET /it/tests` returned HTTP 200 with both `Generali` and `Sito` tabs.

## 2026-10-11 — Folio tests detail undefined layout variable

- `tests/[slug].blade.php` passed `:body-page="$bodyPage"` without declaring
  `$bodyPage` in its Volt component.
- The detail page does not require a special body modifier, so the undefined
  prop was removed and the layout now uses its default value.

## 2026-10-11 — Optional JSON-selected front-office layout

- CMS page JSON may declare an optional `layout` value. Missing or empty means
  `layouts.app`; `"test"` means the Sixteen `layouts.test` Design Comuni shell.
- The contract is applied consistently to tests pages and generic Folio container
  pages, including the native `/it/tickets` route.
- `tickets.index.json` declares `"layout": "test"` because the public report list
  is part of the Design Comuni showcase/front-office surface; auth and live
  transactional pages remain on the default app shell unless their JSON opts in.
- The Page model schema/casts now preserve `layout`; the value is mapped through
  an allow-list (`test` or fallback `app`) and never treated as an arbitrary view.
- Verification: Blade cache succeeds and `/it/tickets`, `/it/tickets/create`,
  and `/it/tickets/track` return HTTP 200.

## 2026-10-11 — Explicit layouts for tests routes

- `tests/index.blade.php` is the fixed Design Comuni showcase entry point and
  uses `<x-layouts.test>` directly; CMS layout lookup is unnecessary there.
- `tests/[slug].blade.php` is the generic CMS detail route and uses
  `<x-layouts.app>` directly.
- JSON-driven layout selection remains for generic public containers, such as
  `tickets.index.json` selecting `layouts.test`.
