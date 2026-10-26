---
title: "BMAD — FixCity Front Office DesignComuni"
type: bmad-index
status: draft
tags: [bmad, design-comuni, front-office, wcag, tailwind, alpine, lit, daisyui, flowbite]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
updated: 2026-10-17
qmd: "fixcity front office   designcomuni sixteen"
---

# FixCity Front Office — DesignComuni

Questo workstream è separato dal piano enterprise generale in `bmad-output/` per
tenere isolato il redesign FO del tema Sixteen. È il contratto di riferimento per
implementare le pagine in piccoli incrementi, senza sovrascrivere il lavoro già
presente nel working tree.

## Ordine BMAD

1. `research.md` — studio delle fonti ufficiali e vincoli verificati.
2. `project-purpose.md` + `brainstorming-report.md` — scopo e ideazione strutturata.
3. `product-brief.md` — obiettivo, utenti, metriche e non-obiettivi.
4. `prd.md` — requisiti funzionali e non funzionali.
5. `architecture.md` — confini, stack e ADR.
6. `DESIGN.md` + `EXPERIENCE.md` — sistema visuale e flussi.
7. `accessibility-strategy.md` — WCAG/Mauve/axe evidence contract.
8. `epics.md` + `stories/` — backlog dev-ready a scope disgiunto.
9. `decision-log.md` — decisioni che restano nel Second Brain.

## Stack vincolato

Tailwind CSS, Alpine.js, Lit, DaisyUI, Flowbite e Filament. Bootstrap e Bootstrap
Italia non sono dipendenze o runtime del tema Sixteen. La struttura visuale e
l'information architecture DesignComuni vengono replicate, non il framework.

## Architettura non negoziabile

Front office: Folio/Volt/Blade + Actions. Nessun controller e nessun service layer.
Back office: Filament. Le mappe restano componenti Lit/Leaflet, non Three.js: una
scena 3D sarebbe decorativa e non deve competere con leggibilità, performance o
accessibilità del percorso di segnalazione.
