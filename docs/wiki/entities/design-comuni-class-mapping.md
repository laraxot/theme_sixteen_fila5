---
type: entity
created: 2026-05-04
tags: [design-comuni, bootstrap, tailwind, mapping]
---

# CSS Class Mapping: Design Comuni (Bootstrap) to Sixteen (Tailwind)

This table maps original Bootstrap Italia / Design Comuni classes to our custom Tailwind implementation in the Sixteen theme.

| Design Comuni (Bootstrap) | Sixteen (Tailwind / Custom CSS) | Purpose |
|---------------------------|----------------------------------|---------|
| `.it-header-slim-wrapper` | `.it-header-slim-wrapper` | Top bar background & height |
| `.btn-full` (dark green)  | `.btn-full` (via `header-footer-colors.css`) | Login CTA styling |
| `.navbar-nav .nav-link`   | `.nav-link` (with `font-bold`)   | Navigation item weight |
| `.it-brand-wrapper`       | `.it-brand-wrapper`              | Logo container spacing |
| `.it-header-center-wrapper`| `.it-header-center-wrapper`      | Main header padding |
| `.nav-link.active`        | `.nav-link.active` (with `border-b-3`) | Current page indicator |

## Implementation Strategy
- We keep the semantic class names from Bootstrap Italia to ensure easy migration and automated analysis.
- The actual styling is provided by **Tailwind @apply** rules inside `resources/css/components/*.css`.
- **Constraint**: No Bootstrap Italia JS is used; interactivity is handled by Alpine.js.

---
*Reference: Story 7-105 & 7-107.*
