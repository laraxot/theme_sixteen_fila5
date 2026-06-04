---
title: "Filament-first sul frontoffice Sixteen"
type: concept
status: active
created: 2026-05-28
tags: [filament, frontoffice, tabs, design-comuni]
related:
  - ../../../../../../docs/wiki/rules/filament-first-rule.md
  - ./no-standalone-livewire-frontoffice.md
  - ../../design-comuni/visual-comparison/it-vs-segnalazioni-elenco.md
  - ../../../../../Modules/Fixcity/docs/wiki/concepts/segnalazioni-elenco-map-architecture.md
---

# Filament-first sul frontoffice Sixteen

## Scopo

Il tema Sixteen pubblica pagine Design Comuni con **Tailwind + BI semantics**, ma per pattern UI già coperti da Filament 5 si usa il componente Blade ufficiale, con eventuale **skin CSS** per parity PA.

## Prerequisito runtime

`resources/views/layouts/main.blade.php` carica `@filamentStyles` e `@filamentScripts` — senza pannello admin i tag `<x-filament::*>` restano validi.

## Tab `/it` (segnalazioni-elenco)

- **Implementazione:** [segnalazioni-elenco-filament-tabs.md](./segnalazioni-elenco-filament-tabs.md) · story [STORY-065](../../../../../../docs/stories/STORY-065-it-segnalazioni-filament-tabs.md)
- **Docs Filament:** [Tabs](https://filamentphp.com/docs/5.x/components/tabs) — `alpine-active` + `x-on:click` sullo stesso `x-data` dei pannelli (`segnalazioniLayout`)
- **Skin:** classi su `.segnalazioni-elenco .fi-tabs` in `style-apply.css` (non sostituire con `ul.nav-tabs` nuovi)

## Boundary

| Consentito FO | Vietato FO |
|---------------|------------|
| `<x-filament::tabs>`, `::icon`, `::button` | `@livewire` modulo Fixcity standalone |
| `map-lit`, `map-filter-lit` (Lit Geo) | Duplicare logica tab in `app.js` se Filament basta |

## Collegamenti

- Regola root: [filament-first-rule.md](../../../../../../docs/wiki/rules/filament-first-rule.md)
- Modulo UI: [filament-components.md](../../../../../Modules/UI/docs/blade/filament-components.md)
