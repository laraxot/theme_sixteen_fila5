---
title: "Architecture — FixCity DesignComuni front office"
type: architecture
status: draft
tags: [bmad, architecture, laravel, folio, actions, tailwind, alpine, lit]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "boundaries sixteen"
---

# Boundaries

## System Overview

FixCity is a municipal citizen-reporting front office. Sixteen is the existing
DesignComuni theme and owns the public shell, tokens and page composition; Fixcity,
User and Gdpr modules own domain queries, authentication, consent and persistence.
The redesign preserves the official DesignComuni information architecture while
replacing new Bootstrap runtime markup with Tailwind, Alpine, Lit, DaisyUI,
Flowbite and existing Filament widgets.

Folio pages and Blade components own presentation. Actions own business logic.
Alpine owns local disclosure/menu/form state. Lit owns reusable map and stepper
widgets. Leaflet remains the map renderer. DaisyUI and Flowbite provide classes and
interaction primitives only; they do not introduce a second page architecture.

# ADRs

## ADR-001 — Preserve DesignComuni information architecture

**Context:** The official municipal information architecture is the visual and
content contract, while the runtime must not introduce Bootstrap.

**Decision:** replicate the official page hierarchy and state vocabulary with
Tailwind markup, not Bootstrap markup or CSS. **Why:** parity is a visual/UX contract,
not a dependency contract. **Consequences:** page composition remains familiar to
citizens and must be maintained in Sixteen. **Trade-off:** more local component CSS,
less vendor lock-in.

## ADR-002 — Folio + Actions remains the FO boundary

**Context:** Existing FixCity pages already use Folio, Volt and module Actions.

**Decision:** no controllers and no service layer. **Why:** this is the repository
architecture and prevents duplicate HTTP/business boundaries. **Consequences:** page
mounts remain explicit and testable. **Trade-off:** page
mounts and Actions must be kept explicit.

## ADR-003 — Tailwind-first tokens with DaisyUI/Flowbite as restrained primitives

**Context:** The redesign needs one theme-owned token contract while retaining the
requested modern component libraries.

**Decision:** tokens live in theme CSS; repeated patterns use small Blade components;
DaisyUI/Flowbite classes are used only where they preserve the token contract.
**Consequences:** visual changes are made once in Sixteen and reviewed as theme
changes. **Trade-off:** do not copy vendor defaults into every page.

## ADR-004 — Alpine for local UI, Lit for reusable widgets

**Context:** Menus and disclosures need lightweight browser state; maps need a
reusable custom-element boundary.

**Decision:** Alpine handles menus, disclosure, dialogs and wizard view state; Lit
handles map/marker and complex reusable DOM. **Consequences:** interactions degrade
to readable server-rendered content when JavaScript is unavailable. **Trade-off:** no second Alpine instance,
and custom elements must expose keyboard/focus semantics.

## ADR-005 — No Bootstrap runtime

**Context:** Bootstrap markup and data attributes conflict with the requested
Tailwind/Alpine/Lit runtime direction.

**Decision:** remove Bootstrap and Bootstrap Italia from the Sixteen runtime and
replace `data-bs-*` behaviour with Alpine/Lit/Flowbite equivalents. **Consequences:**
legacy components require incremental migration before the imports can be removed.
Static DesignComuni
SVG assets may be retained only when they are copied as project-owned assets and do
not require the package. **Trade-off:** legacy compatibility components must be
migrated or retired story by story.

## Architectural pattern

The front office is a modular monolith with a server-rendered progressive-enhancement
boundary:

```text
Folio route/page -> Fixcity Action/ViewModel -> Blade in Sixteen
                                      |-> Alpine local state
                                      |-> Lit custom element (map/complex widget)
                                      |-> Tailwind tokens + DaisyUI/Flowbite primitives
```

Folio remains the HTTP entry point. `Modules/Fixcity` owns ticket queries,
authorization, validation and domain actions; `Themes/Sixteen` owns public
DesignComuni composition, tokens and components. Sixteen is already the
DesignComuni theme, so no parallel DesignComuni layout is allowed.

## Technology Stack

- TailwindCSS 4 is the only styling foundation.
- Alpine.js owns disclosure, navigation, dialogs, filtering and local wizard state.
- Lit owns reusable map/marker and other DOM-heavy widgets.
- DaisyUI and Flowbite are opt-in primitives themed through Sixteen tokens; they do
  not own routing or page structure.
- Filament remains an operator/back-office dependency and supplies existing wizard
  primitives where Fixcity already uses it.
- Bootstrap and Bootstrap Italia are not runtime dependencies for new front-office
  work. Legacy class names are migration debt and must not be copied into new pages.

## Domain and data model

| Entity | Owner | Public projection |
|---|---|---|
| Ticket/Segnalazione | Fixcity | civic `Pratica` with status, category, location and timeline |
| Category | Fixcity | filter taxonomy and report classification |
| TicketActivity | Fixcity | public timeline entries after visibility rules |
| User/Profile | Fixcity/identity | personal area and ownership checks |
| CMS Page/Service | CMS + Sixteen | DesignComuni service and content pages |

Public pages consume Actions/ViewModels rather than exposing models directly. Public
ticket details use the public query and visibility policy; authenticated lookups keep
the existing Gate authorization.

## Service and page contracts

- `GET /{locale}/tickets` — public report discovery/list/map.
- `GET /{locale}/tickets/{id}` — public report detail, 404 when not public.
- `GET /{locale}/tickets/track` — throttled tracking form and code lookup.
- `GET /{locale}/tickets/create` — authenticated report wizard entry.
- CMS Folio pages provide services, categories, auth, personal-area and legal views
  through the canonical `x-layouts.app` shell.

All forms retain CSRF, server validation, locale-aware labels and a no-JS readable
fallback. GeoJSON is an internal projection for the Lit map; it is never the only
way to access report information.

## Security, privacy and performance

- Keep CSRF, throttling, Gate/policy checks and server validation at trust boundaries.
- Never expose private activity, author data, coordinates or attachments publicly.
- FreeLLMAPI, external map CDNs and analytics are tooling only, never runtime gates.
- Reserve map/media space, lazy-load non-critical widgets and keep first paint useful
  before Alpine/Lit enhancement.

## Naming and conventions

Theme components use kebab-case Blade filenames and `pub_theme::` translation
namespaces; domain Actions use verb-noun names in their owning module. New front
office markup uses semantic HTML and Tailwind utilities, with Alpine `x-*` state
for local interactions and Lit custom-element names for reusable widgets.

## Responsive and accessibility contract

Targets are 320/390/768/1024/1440px with no horizontal overflow. Every interactive
control has a visible `:focus-visible` indicator, a 44px minimum touch target, an
accessible name and a keyboard path. Form errors are associated with fields and
announced; async state uses `aria-live="polite"`; maps always have a list alternative.
Motion respects `prefers-reduced-motion: reduce`.

# NFR / FR Coverage Matrix

| Requirement family | Components |
|---|---|
| FR-01 | canonical shell, header/footer, breadcrumbs and skip links |
| FR-02 | CMS/Folio services and categories with Sixteen components |
| FR-03 | public ticket query, filters and Lit map/list parity |
| FR-04 | public detail payload and timeline actions |
| FR-05 | authenticated create page, Filament wizard and stepper shell |
| FR-06 | personal-area pages and authenticated ticket query Actions |
| FR-07 | auth, privacy, accessibility and error views in same shell |
| FR-08 | Sixteen Blade primitives, Alpine registrations and Geo Lit elements |
| FR-09 | locale-aware Folio pages and module/theme translation namespaces |
| FR-10 | server-rendered content and form fallback before JS enhancement |
| NFR-01 | token CSS, semantic markup, focus/error contract and audits |
| NFR-02 | utility-first responsive rules and viewport smoke matrix |
| NFR-03 | Vite local assets, reserved media space and progressive enhancement |
| NFR-04 | CSRF, throttle, Gate/policies, Actions and privacy filtering |
| NFR-05 | module/theme boundary and no duplicate layout |
| NFR-06 | Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament only |
