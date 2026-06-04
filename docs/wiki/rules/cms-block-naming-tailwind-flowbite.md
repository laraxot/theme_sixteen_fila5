---
title: "CMS Block naming — Tailwind UI / Flowbite (Sixteen)"
type: rule
confidence: high
created: 2026-06-01
updated: 2026-06-01
tags: [cms, blocks, naming-convention, tailwind, flowbite, views]
related:
  - rules/frontend-stack-canonical.md
  - rules/no-italian-component-names.md
---

# CMS Block naming — Tailwind UI / Flowbite

## Regola

> Le sottocartelle di `resources/views/components/blocks/` **devono** prendere i nomi da:
> - https://tailwindcss.com/plus/ui-blocks
> - https://flowbite.com/blocks/

Questa regola vale per il tema Sixteen e per tutti i moduli che definiscono blocchi CMS.

## Mapping

| Sottocartella | Reference |
|---------------|-----------|
| `hero/` | [Tailwind — Hero sections](https://tailwindcss.com/plus/ui-blocks/marketing/sections/heroes) |
| `grid/` | [Tailwind — Grids / Panels](https://tailwindcss.com/plus/ui-blocks/application-ui/layout/panels) |
| `cta/` | [Tailwind — CTA sections](https://tailwindcss.com/plus/ui-blocks/marketing/sections/cta-sections) |
| `rating/` | [Flowbite — Rating](https://flowbite.com/docs/components/rating/) |
| `vertical-navigation/` | [Tailwind — Vertical navigation](https://tailwindcss.com/plus/ui-blocks/application-ui/navigation/vertical-navigation) |
| `card/` | [Flowbite — Card](https://flowbite.com/docs/components/card/) |
| `navbar/` | [Flowbite — Navbar](https://flowbite.com/docs/components/navbar/) |
| `tabs/` | [Flowbite — Tabs](https://flowbite.com/docs/components/tabs/) |
| `modal/` | [Flowbite — Modal](https://flowbite.com/docs/components/modal/) |
| `breadcrumb/` | [Flowbite — Breadcrumb](https://flowbite.com/docs/components/breadcrumb/) |
| `pagination/` | [Flowbite — Pagination](https://flowbite.com/docs/components/pagination/) |
| `steps/` | [Flowbite — Stepper](https://flowbite.com/docs/components/stepper/) |
| `timeline/` | [Flowbite — Timeline](https://flowbite.com/docs/components/timeline/) |
| `accordion/` | [Flowbite — Accordion](https://flowbite.com/docs/components/accordion/) |
| `features/` | [Tailwind — Feature sections](https://tailwindcss.com/plus/ui-blocks/marketing/sections/feature-sections) |
| `testimonials/` | [Tailwind — Testimonials](https://tailwindcss.com/plus/ui-blocks/marketing/sections/testimonials) |
| `stats/` | [Tailwind — Stats](https://tailwindcss.com/plus/ui-blocks/marketing/sections/stats) |

## Anti-pattern

```
// ❌ SBAGLIATO — nomi di dominio
blocks/ticket-layout/
blocks/segnalazioni-elenco/
blocks/governance-calendario/

// ✅ CORRETTO — nomi Tailwind/Flowbite
blocks/hero/
blocks/grid/
blocks/vertical-navigation/
```

## Migrazione blocchi esistenti

I blocchi con nomi di dominio esistenti (`ticket-layout`, ecc.) rimangono per compatibilità ma non vanno usati per nuovi sviluppi. Nuovi blocchi usano sempre naming Tailwind/Flowbite.
