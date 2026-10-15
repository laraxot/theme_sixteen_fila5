---
id: dcp-15
title: "dcp-15: segnalazioni-elenco — Design Comuni parity"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-15 segnala-elenco"
links:
  github_issue: "#15"
  design_ref: "https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html"
tags: [docs, sixteen, bmad]
---

# DCP-15 — Segnalazioni elenco (tests.segnalazioni-elenco)

## Scope
Pagina `/it/tests/segnalazioni-elenco` — parità visiva Design Comuni (ref fetchato). Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament. **NO Bootstrap Italia**. Token verde PA `#007A52`.

## Blocchi richiesti (JSON `tests.segnalazioni-elenco.json`)
- [x] `breadcrumb` (dentro `report-list`) — presente
- [ ] `hero` — MANCANTE (aggiungere)
- [x] `ticket-list` / `report-list` (`items` con toggle/collapse, immagine) — presente
- [x] `search-form` (filtri categoria, #007A52) — presente (`filters`, `tabs` Mappa/Elenco)
- [x] `contacts` — presente (`contacts.layout: narrow`)

## Componenti Blade
- `pub_theme/components/blocks/report-list/` (design-comuni) — esistente
- `ticket-list.blade.php` / `ticket-card.blade.php` — NON esistenti; la lista è resa da `report-list.default.blade.php` con `summary` per item.

## Azioni
- Aggiungere blocco `hero` al JSON se richiesto dalla parità.
- Verificare token `#007A52` sui bottoni filtro / CTA.
- Audit WCAG 2.1 AA su contrasti testo/sfondo.
