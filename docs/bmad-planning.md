---
title: "BMAD Planning — Sixteen"
type: bmad-planning
status: active
theme: Sixteen
track: bmad-method
created: 2026-10-16
updated: 2026-10-16
tags: [bmad, planning, second-brain, filament-blueprint, sixteen]
qmd: "bmad planning sixteen scopo onde filament"
related:
  - ./bmad/ticket-detail-planning.md
  - ./bmad/content-detail-planning.md
  - ./bmad/brainstorming.md
  - ./bmad/README.md
  - ./bmad-brainstorming.md
  - ./bmad/filament-blueprint.md
---

# Obiettivo

Presentazione FO FixCity allineata a Design Comuni: renderizza dati modulo, non possiede regole Ticket.

## Perché questo owner

- **Utenti:** guest, cittadino autenticato, redazione (solo consumo)
- **Track BMAD:** `bmad-method`
- **Religione:** Actions + Folio/Volt/Filament `XotBase*`; mai Controllers; docs solo in questo `docs/` (mai `bmad-output/`).

## Scope

### In
- Folio/Volt pages
- blocchi homepage/header/footer
- dettaglio ticket/blog/eventi UI
- WCAG/responsive

### Out
- Actions/policy/schema Ticket
- TimelineStep store
- Bootstrap come stack target

## Onde di delivery

| Wave | Deliverable | Owner |
|---|---|---|
| 1 | Homepage JSON-driven + header/footer | Sixteen |
| 2 | Dettaglio segnalazione timeline/commenti UI | Sixteen + Fixcity + Comment |
| 3 | Blog/eventi listing/detail parity | Sixteen + Blog |
| 4 | WCAG 2.1 AA gate | Sixteen |

## Filament blueprint

Resource/widget di competenza:

- mount widget moduli (CommentsWidget, ecc.) — nessuna Resource nel tema
- FO lista container: shell `container0.index` (D20) — [container0-index-shell-contract.md](./bmad/container0-index-shell-contract.md)

Dettaglio contratto: [filament-blueprint.md](./bmad/filament-blueprint.md).

## Second brain

- Costituzione sintetica: questo file + brainstorming gemello.
- Decisioni durature -> `docs/bmad/decision-log.md` (o dossier topic se gia esiste).
- QMD: indicizzare titoli/qmd; ownership resta nel modulo/tema.

## Definition of Done (planning)

- [ ] Scope in/out condiviso e non contraddetto dal codice owner
- [ ] Onde senza dipendenze circolari cross-owner
- [ ] Blueprint Filament aggiornato (o esplicitamente N/A)
- [ ] Link bidirezionali ai dossier/topic gia esistenti
- [ ] Nessun artefatto in `bmad-output/`
