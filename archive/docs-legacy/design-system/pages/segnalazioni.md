---
title: "Segnalazioni — page override"
type: design-system-page
status: active
updated: 2026-10-11
tags: [docs, sixteen, design-system]
qmd: "segnalazioni sixteen"
---

# Segnalazioni

Reading this as: a public-sector civic service for residents, with a trust-first,
calm DesignComuni language and progressive enhancement.

## Layout

- Preserve the official information order: breadcrumb → title/subtitle → filters →
  map/list tabs → content → contact block.
- Use a centered `max-w-7xl` shell and a two-column desktop grid. Collapse to one
  column below `lg`; filters become an Alpine dialog.
- Map and list are equivalent views. The map is never the only way to discover a
  report.

## Interaction contract

- Alpine owns tab state, filter dialog state and card disclosure state.
- Lit owns map/filter custom elements and receives the same JSON projection as the
  visible results.
- Every tab and disclosure has an accessible name, `aria-controls`, selected/expanded
  state and keyboard focus styling.
- The dialog closes with Escape and keeps a 44px close target.
- No `data-bs-*`, Bootstrap component classes or CDN runtime assets may be introduced.

## Visual tokens

- Page background: `#F8FAFC`.
- Content surface: `#FFFFFF` with `#E2E8F0` border.
- Primary action: `#075985`/`#0369A1` with white text.
- Body text: `#0F172A` and supporting text `#334155`/`#475569`.
- Focus: visible 4px sky ring with at least 3:1 contrast against the adjacent
  surface.

## Validation

Test at 320, 390, 768, 1024 and 1440px. Verify no horizontal overflow, keyboard tab
order, reduced motion, list alternative, empty state, loading state and map failure
state. Run the shared guest smoke and WCAG audit with the application running.
