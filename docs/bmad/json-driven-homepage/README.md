---
title: "Sixteen JSON-driven homepage — BMAD package"
type: bmad-index
theme: Sixteen
status: planning
created: 2026-10-09
updated: 2026-10-09
qmd: "Sixteen TwentyOne JSON driven CMS homepage blocks BMAD"
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
tags: [docs, sixteen, bmad]
---

# Sixteen JSON-driven homepage

Questo dossier documenta la ristrutturazione richiesta per rendere Sixteen
coerente con il pattern già usato da TwentyOne:

```blade
<x-layouts.app>
    <x-cms::page side="content" slug="home" />
</x-layouts.app>
```

La pagina Folio resta un guscio. Il contenuto vive nei JSON CMS e ogni blocco
viene reso da una view in `resources/views/components/blocks/`. Il precedente
`home.json` è stato giudicato errato perché non usava `content_blocks`; questo
dossier descrive la correzione prima di qualsiasi nuovo payload.

## Artefatti

1. [spec](spec.md) — kernel a cinque campi;
2. [product brief](product-brief.md) — obiettivi, utenti e vincoli;
3. [prd](prd.md) — requisiti funzionali e non funzionali;
4. [architecture](architecture.md) — flusso JSON → CMS → block view;
5. [epics](epics.md) — epiche e tracciabilità;
6. [stories](./) — cinque storie implementabili;
7. [readiness report](readiness-report.md) — gate prima del codice;
8. [sprint status](sprint-status.yaml) — sequenza e dipendenze;
9. [decision log](decision-log.md) — decisioni append-only.

## Evidenza studiata

- riferimento: `Themes/TwentyOne/resources/views/pages/index.blade.php`;
- target: `Themes/Sixteen/resources/views/pages/index.blade.php`;
- renderer: `Modules/Cms` (`x-cms::page`, `Page`, `BlockData`);
- storage JSON: `config/<environment>/<tenant>/database/content/pages/*.json`;
- blocchi Sixteen: `Themes/Sixteen/resources/views/components/blocks/`.

## Perimetro corrente

La fonte JSON locale esiste ma non è ancora accettata come implementazione:
restano da chiudere l'inventario delle block view, il payload e la verifica
browser. Restano fuori provider, route, Action, CSS e modifiche al resolver CMS.

## Routing applicativo

Il blocco mappa non usa URL ticket letterali: `list_url` usa
`route('container0.index', ['container0' => 'tickets'])` e `report_url`
usa `route('container0.view', ['container0' => 'tickets', 'slug0' => 'create'])`.
La prima è la lista Folio dinamica `[container0]/index`, la seconda è la
pagina generica `[container0]/[slug0]` con `name('container0.view')`; con
`container0=tickets` e `slug0=create`, `PageSlugMiddleware` risolve lo slug CMS
`tickets.create`. Non usare `container0.create`, `container0.store`,
`tickets.create` o path hardcoded per questo campo JSON.
