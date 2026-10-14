---
title: "Architecture — Homepage Sixteen JSON-driven"
type: bmad-architecture
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "architecture sixteen"
---

# Architecture

## System Overview

Sixteen è un tema di presentazione dentro il monolite Laravel modulare. Folio
fornisce la route, CMS il contratto e le view del tema il rendering.

## Architecture Pattern

Il pattern è un **monolite modulare, layered**: route/page shell → componente
CMS → data contract → block view. Non si introduce una nuova API REST o
un microservizio.

## Component Design

## Flusso runtime

```text
Folio index
  → x-layouts.app
  → x-cms::page(side=content, slug=home)
  → Cms Page::getBlocksBySlug()
  → HasBlocks::getBlocks()
  → content_blocks[locale]
  → BlockData(type, data, view)
  → cms::components.page
  → @include(data.view, data)
```

La Blade non apre file JSON. `SushiToJsons`/ `Page` forniscono il record e
`BlockData` verifica l'esistenza della view.

Gli URL del blocco mappa sono route nominate, non stringhe hardcoded:
`list_url` usa `route('container0.index', ['container0' => 'tickets'])`
per la lista Folio `[container0]/index`, mentre `report_url` usa
`route('container0.view', ['container0' => 'tickets', 'slug0' => 'create'])`.
La route generica `[container0]/[slug0]` mantiene il contratto JSON-driven del
tema: `PageSlugMiddleware` combina `tickets` e `create` e risolve lo slug CMS
`tickets.create` senza puntare direttamente alla route modulare `tickets.create`.

## Data Model

Il modello CMS è il record `Page` identificato da slug; il data schema è
`title`, `content_blocks[locale]`, `sidebar_blocks[locale]` e
`footer_blocks`. Le entità Ticket restano di proprietà del modulo Fixcity.

## API Specifications

Non viene aggiunto un endpoint. La sola interfaccia è il contratto CMS
`type/data.view`; la mappa usa l'endpoint esistente
`/api/tickets/geojson` già presente nella Blade legacy.

## Technology Stack

Laravel/Folio, Blade, componenti CMS, JSON locale tenant e Bootstrap Italia
del tema Sixteen. Questa scelta riusa lo stack installato e mantiene il
contratto esistente.

## ADR

### ADR-001 — Usare il contratto CMS esistente

**Contesto:** `tickets.confirmation.json` è già il riferimento con
`content_blocks[locale]`, `type` e `data.view`.

**Decisione:** `home.json` usa esattamente lo stesso schema, incluse chiavi
top-level e locali supportati.

**Conseguenze:** il resolver resta unico; non sono ammessi campi homepage
arbitrari.

### ADR-002 — Preservare esperienza, non markup

**Contesto:** `index.blade.php.old` contiene tre sezioni funzionali e markup
inline; il target è il page shell TwentyOne.

**Decisione:** trasferire significato e ordine in blocchi, non copiare markup
nella Folio page.

**Conseguenze:** le block view sono il solo punto di markup; ogni gap va
inventariato prima, non nascosto con fallback.

### ADR-003 — Riuso prima di nuova view

**Decisione:** cercare prima blocchi Sixteen esistenti e creare solo il minimo
blocco mancante. Nessun package o astrazione nuova.

## Matrice FR/NFR

| Requisito | Decisione/componente | Stato |
|---|---|---|
| FR-001 | ADR-001, Folio + Cms Page | coperto |
| FR-002 | ADR-001, JSON locale | coperto |
| FR-003 | ADR-002, tre blocchi homepage | da implementare |
| FR-004 | `BlockData`, Story 1.4 | coperto |
| FR-005 | cataloghi `Themes/Sixteen/lang` | da verificare |
| FR-006 | `container0.index` per la lista + `container0.view` con `slug0=create` per la CTA | coperto |
| NFR-001 | validazione JSON Story 1.5 | da verificare |
| NFR-002 | vincoli repository | coperto |
| NFR-003 | view existence + smoke | da verificare |
| NFR-004 | smoke locali/viewports | da verificare |
| NFR-005 | nessun URL ticket hardcoded nel JSON | coperto |

## Trade-off Analysis

Il riuso del resolver e delle view riduce codice e divergenze, ma vincola il
JSON allo schema CMS. Un nuovo blocco minimo è preferibile a una modifica
generica del CMS perché il cambiamento è locale e più facilmente verificabile.

## Security, Performance and Reliability

Il contenuto resta nel tenant locale e non introduce dati sensibili o nuove
autorizzazioni. La performance deriva dal percorso CMS esistente; la
reliability gate è l'errore esplicito di `BlockData` per view mancanti. La
manutenibilità è garantita dai confini modulo/tema e dal contratto documentato.

## Deployment and Future Considerations

Il deployment copia il JSON e le view del tema come gli altri contenuti CMS.
Se in futuro si aggiungerà un editor visuale, dovrà generare lo stesso schema,
senza cambiare il runtime.
