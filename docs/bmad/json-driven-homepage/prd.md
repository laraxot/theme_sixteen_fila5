---
title: "PRD — Homepage Sixteen JSON-driven"
type: bmad-prd
track: Quick Flow
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "prd sixteen"
---

# PRD

## Executive Summary

Portare la homepage Sixteen al contratto CMS JSON reale, preservando il flusso
FixCity della Blade legacy e allineando il guscio a TwentyOne.

## Project Overview

Il progetto è un monolite Laravel modulare: Folio espone la pagina, CMS risolve
il record JSON e Sixteen fornisce le block view di presentazione.

## Functional Requirements

| ID | Priorità | Requisito | Accettazione |
|---|---|---|---|
| FR-001 | MUST | La homepage usa il page shell CMS con slug `home`. | La route Folio delega a `x-cms::page`; non contiene markup editoriale. |
| FR-002 | MUST | Il JSON usa `content_blocks` localizzati. | IT/EN/DE/ES hanno lo stesso ordine e blocchi validi. |
| FR-003 | MUST | Il contenuto riproduce la vecchia homepage. | Hero/mappa/CTA, tre step "Come funziona" e tracking sono presenti. |
| FR-004 | MUST | Ogni blocco indica una view CMS esistente. | `BlockData` costruisce ogni blocco senza `view not found`. |
| FR-005 | SHOULD | Le stringhe restano coerenti con le traduzioni Sixteen. | Nessuna chiave `pub_theme::home.*` è persa senza mappatura. |
| FR-006 | MUST | I link ticket rispettano i contratti FO del tema. | `list_url` usa `container0.index`; `report_url` usa `container0.view` con `container0=tickets` e `slug0=create`. |

## Non-Functional Requirements

| ID | Priorità | Requisito misurabile |
|---|---|---|
| NFR-001 | MUST | Il file è JSON valido. |
| NFR-002 | MUST | Nessuna modifica a CMS, `phpstan.neon`, controller o service. |
| NFR-003 | MUST | Le view referenziate esistono e la homepage rende senza eccezioni. |
| NFR-004 | SHOULD | La verifica copre quattro locali e mobile/desktop. |
| NFR-005 | MUST | Nessun URL ticket è hardcoded quando esiste una route nominata. |

## Success Metrics

- Un solo record CMS per slug `home`, JSON parseable e nessun errore di view.
- Tre sezioni legacy presenti nello stesso ordine in quattro locali.
- Folio index senza markup editoriale.

## Assumptions and Dependencies

- Il resolver `Page`, `HasBlocks` e `BlockData` esistenti restano invariati.
- Le route e le traduzioni già usate dalla Blade legacy restano disponibili.
- La verifica browser può dipendere da un server locale funzionante.

## Out of Scope

Nuove funzionalità marketing, statistiche, testimonials, categorie aggiuntive,
nuovi endpoint, redesign CSS e correzioni PHPStan non necessarie al payload.

## Decisione sui contenuti

Il JSON è la fonte della composizione e dei dati del blocco. Le view possono
usare chiavi di traduzione, come già avviene in `tickets.confirmation.json`;
non si duplicano testi nel JSON se il blocco esistente possiede già il catalogo.
La scelta per ogni blocco è registrata nel decision log dopo l'inventario.

## Epics and User Stories

Epic 1 contiene le storie 1.1–1.5 del dossier; ogni story ha criteri Given/When
operativi e un link Issue/Discussion.

## Traceability

FR-001 → Story 1.1; FR-002 → 1.2; FR-003 → 1.3; FR-004 → 1.4;
FR-005/NFR-001..004 → 1.5.
