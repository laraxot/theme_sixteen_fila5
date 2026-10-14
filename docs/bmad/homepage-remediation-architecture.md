---
id: sixteen-bmad-homepage-remediation-architecture
slug: homepage-remediation-architecture
title: Architettura remediation homepage Sixteen
qmd: "BMAD architecture homepage header hero calendar rating contacts parity"
document_type: architecture
category: architecture
status: stable
source_of_truth: true
scope:
  - laravel/Themes/Sixteen/resources/views/components/blocks/homepage.blade.php
  - laravel/Themes/Sixteen/resources/views/components/sections/header/tailwind.blade.php
  - laravel/config/local/fixcity/database/content/pages/homepage.json
type: note
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Architettura BMAD: remediation homepage

## Contesto e causa radice

La precedente implementazione ha trattato la reference come un insieme di
sezioni generiche Tailwind. Questo ha conservato il tema ma perso il contratto
visuale dei componenti Design Comuni: SVG sostituiti da lettere, contenuti
editoriali incompleti, card senza media/CTA, calendario ridotto a lista, ricerca
senza icona/azione, rating con transizioni non equivalenti e contatti con una
griglia/spaziatura diversa. La causa non è Tailwind: è l'assenza di una mappa
reference → dati JSON → markup → screenshot.

## Decisioni ADR

### ADR-HP-001 — Il JSON è il contratto editoriale

Categoria, data, titolo, badge, immagini, colori, eventi, siti tematici e CTA
vivono nel JSON tenant. Blade fornisce solo struttura, fallback sicuri e
accessibilità. Un campo mancante è un gap dati tracciato, non un testo nascosto
hardcoded.

### ADR-HP-002 — Header/footer restano sezioni CMS

La shell usa esclusivamente `x-section`; Sixteen è il tema Design Comuni e non
si introduce un namespace o un blocco `design-comuni` duplicato.

### ADR-HP-003 — Parity in tre dimensioni

HTML/body ≥90%, visual pixel ≥97% e WCAG 2.1 AA sono gate indipendenti. Il tool
body esclude soltanto gli script; Playwright aggiunge screenshot/computed style;
axe/Mauve verifica accessibilità.

### ADR-HP-004 — Interazione progressiva esplicita

Hamburger, ricerca e rating hanno stato accessibile dichiarato. Ogni controllo
ha tastiera, focus, nome accessibile e stato visibile; nessuna interazione è
affidata a hover o a una label non associata.

## Mappa dei requisiti

| Difformità | Componente | Dato/markup | Verifica |
| --- | --- | --- | --- |
| social come lettere | header | SVG inline + aria-label | screenshot + DOM SVG |
| cerca/header e hamburger | header | label, button, breakpoint | 375/1440 + tastiera |
| notizia/titolo/badge | hero | category/date/heading/badge | DOM + font/color |
| immagini e CTA governo | government cards | image/image_alt/url | screenshot + asset |
| calendario | events | month/days/items | struttura e screenshot |
| evidence/geometria | topics | background + card padding | pixel diff |
| siti tematici | theme_sites | color/image/description | pixel diff + alt |
| ricerca | useful links | input icon + Invio | keyboard/form DOM |
| rating | feedback | state machine | keyboard/state screenshots |
| contatti | contacts | card, list, spacing | computed boxes + WCAG |

## Flusso

```text
homepage.json
  -> Page CMS / BlockData
  -> pub_theme::components.blocks.homepage
  -> x-layouts.test -> x-section header/footer
  -> browser states (mobile/tablet/desktop)
  -> body parity + screenshot + WCAG report
```

## Non-goal

Non si reintroduce Bootstrap Italia runtime, non si crea una seconda pagina
homepage, non si converte il contenuto in database relazionale e non si usa un
confronto che escluda shell o footer.
