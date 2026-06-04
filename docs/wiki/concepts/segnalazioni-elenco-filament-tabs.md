---
title: "Segnalazioni elenco — tab Filament su /it"
type: concept
status: active
created: 2026-05-28
tags: [filament, tabs, segnalazioni-elenco]
related:
  - ./filament-first-frontoffice.md
  - ../../../../../../docs/stories/STORY-065-it-segnalazioni-filament-tabs.md
  - ../../../../../Modules/Fixcity/docs/wiki/concepts/segnalazioni-elenco-map-architecture.md
---

# Tab Filament su `/it`

## Implementazione

- Componente: `resources/views/components/blocks/segnalazioni/tabs.blade.php`
- Include da: `segnalazioni/layout.blade.php`
- Stato: `activeTab` su `segnalazioniLayout` (Alpine in `app.js`)
- Pannelli: `#data-ex-disservizio1` / `#data-ex-disservizio2` con `x-show`

## CSS

Skin Design Comuni in `style-apply.css` — selettore `.segnalazioni-elenco .segnalazioni-fi-tabs`.

## Riferimenti

- https://filamentphp.com/docs/5.x/components/tabs
- [filament-first-rule.md](../../../../../../docs/wiki/rules/filament-first-rule.md)
