---
qmd: "segnalazioni elenco filament tabs"
issues: ["#139", "#151", "#155"]
discussions: []
title: "Segnalazioni elenco — tab Filament 5 su /it"
type: concept
status: active
created: 2026-05-28
updated: 2026-11-23
tags: [filament, tabs, ticket-list, design-comuni, alpine, segnalazioni-elenco]
related:
  - ../../../../../../docs/stories/STORY-065-it-segnalazioni-filament-tabs.md
  - ../../../../../Modules/Fixcity/docs/wiki/concepts/ticket-list-map-architecture.md
---

# Tab Filament 5 su `/it`

## Contratto

La navigazione Mappa/Elenco usa `x-filament::tabs` e `x-filament::tabs.item`.
Non usare `ul.nav.nav-tabs`, `data-bs-toggle="tab"` o un secondo gestore Bootstrap
per questi due tab. Mappe, filtri, GeoJSON e pannelli lista restano invariati.

## Implementazione

- Componente: `resources/views/components/blocks/ticket-list/design-comuni.blade.php`
- Interattività: `selectTab()` nello scope Alpine del blocco, con `alpine-active` di Filament.
- Pannelli: `x-show`, `x-bind:class` con `active show`.
- La mappa viene aggiornata quando Mappa torna visibile.

## CSS

Gli override CSS restano limitati allo scope `#segnalazioni-elenco-root .segnalazioni-tabs`.

## Riferimenti

- https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
- [STORY-065](../../../../../../docs/stories/STORY-065-it-segnalazioni-filament-tabs.md)
- [filament-first-rule.md](../../../../../../docs/rules/filament-first-rule.md)
- `tailwindcss + alpinejs + lit + daisyui + filament`
