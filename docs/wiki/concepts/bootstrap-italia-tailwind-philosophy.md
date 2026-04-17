---
title: Bootstrap Italia + Tailwind CSS — Filosofia e Regole
type: concept
tags: [tailwind, bootstrap-italia, design-comuni, css, philosophy]
updated: 2026-04-15
---

# Bootstrap Italia class names → Tailwind @apply

## Filosofia Core

Il tema Sixteen segue le linee guida **Design Comuni Italia / Bootstrap Italia** (AGID) per la struttura HTML, ma **non include la libreria Bootstrap come dipendenza**. Tailwind CSS implementa le stesse classi tramite `@apply`.

```
HTML Blade          → class names Bootstrap Italia (.btn, .d-flex, .position-relative, ...)
CSS (style-apply.css) → @apply tailwind-utilities
Browser             → stili corretti, zero Bootstrap JS/CSS
```

## Regola Assoluta

| Contesto | Corretto | Sbagliato |
|----------|---------|-----------|
| HTML Blade | `class="btn btn-sm btn-light border shadow-sm"` | `class="text-xs px-2 py-1 rounded border"` |
| HTML Blade | `class="d-flex gap-1 mb-2"` | `class="flex gap-1 mb-2"` |
| HTML Blade | `class="position-relative rounded border border-light w-100"` | `class="relative rounded border w-full"` |
| CSS file | `.btn { @apply px-4 py-2 rounded ... }` | *(n/a)* |

## Perché

1. **Semantica PA**: `.btn`, `.d-flex`, `.container` sono vocabolario condiviso tra sviluppatori PA italiani — rinominarli rompe la leggibilità
2. **AGID compliance**: Le linee guida impongono l'uso del Design System nazionale; class names sono parte dello standard
3. **Migrazione graduale**: HTML stabile, implementazione CSS libera di evolvere da Bootstrap puro a Tailwind @apply senza toccare i template
4. **Riusabilità componenti**: Un componente con class names Bootstrap funziona in qualsiasi contesto PA

## File di Riferimento

- `laravel/Modules/Geo/resources/views/filament/forms/components/leaflet-marker-map-input.blade.php` — esempio canonico di blade con Bootstrap Italia class names
- `laravel/Themes/Sixteen/resources/css/style-apply.css` — implementazione Tailwind @apply delle classi Bootstrap
- `laravel/Themes/Sixteen/resources/css/components/bootstrap-italia-classes.css` — mapping completo classi BI

## Classi Bootstrap Italia Comuni

```
Layout:    .container .row .col-* .d-flex .d-none .d-block
Spacing:   .mb-0 .mb-2 .mt-2 .p-2 .ms-auto .gap-1
Position:  .position-relative .position-absolute .top-0 .end-0
Display:   .w-100 .h-100 .overflow-hidden
Buttons:   .btn .btn-sm .btn-lg .btn-light .btn-outline-secondary .active
Feedback:  .invalid-feedback .is-invalid .text-muted .small
Util:      .rounded .border .border-light .bg-white .shadow-sm
```

## Anti-pattern da Evitare

```html
<!-- ❌ SBAGLIATO: Tailwind raw in HTML -->
<div class="flex items-center gap-2 text-sm text-gray-500">

<!-- ✅ CORRETTO: Bootstrap Italia class names -->
<div class="d-flex align-items-center gap-2 text-muted small">
```

```css
/* In CSS: usa Tailwind @apply per implementare le classi Bootstrap */
.text-muted { @apply text-gray-500; }
.small { @apply text-sm; }
```
