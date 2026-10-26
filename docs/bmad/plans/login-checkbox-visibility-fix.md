---
title: "BMAD / Filament Blueprint — Login checkbox visibility"
type: note
status: draft
updated: 2026-10-20
tags: [docs, sixteen, bmad]
qmd: "bmad / filament blueprint   login checkbox visibility sixteen"
---
# BMAD / Filament Blueprint — Login checkbox visibility

## Symptom

On `/it/auth/login`, the Filament `remember` checkbox is present and bound to
`data.remember`, but its visual control is invisible.

## Evidence and root cause

- The public HTML contains `input#form.remember.fi-checkbox-input`.
- Design Comuni applies `body:has(.page-content[data-dc]) input { appearance: none !important; }`.
- The login checkbox does not render a separate custom indicator, so the reset
  removes its native visual appearance.

## Minimal implementation

Keep the Filament `Checkbox::make('remember')` schema and Livewire binding
unchanged. Restore the native checkbox appearance with
`appearance: auto !important` in:

1. `components/pages/auth-login.blade.php` (inline — sheet FO non dipinge in data-dc)
2. `resources/css/app/20-dc-components.css` (scoped `.page-content[data-dc]`, sopravvive a isolate-legacy)

Poi `npm run build` in `Themes/Sixteen`. Decisione: D26 in [decision-log.md](../decision-log.md).

## Acceptance checks

- The checkbox is visible and clickable at 375px, 768px, and 1440px.
- Checking it updates `data.remember` and preserves the existing login flow.
- No backoffice Filament checkbox or unrelated Design Comuni toggle changes.
- Sixteen assets build successfully from `laravel/Themes/Sixteen`.
