---
id: dcp-13
title: "DCP-13: pagina Documenti e dati (documenti-dati)"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-13 documenti e dati"
links:
  github_issue: "#14"
decisions:
  - "D21: blocco listing/search-form riutilizzato da dcp-07"
  - "D23: bottone ricerca #007A52; stack Tailwind+Alpine+Lit+DaisyUI+Flowbite; NO Bootstrap Italia"
tags: [docs, sixteen, bmad]
---

# DCP-13 — Documenti e dati

## Contesto
Pagina Design Comuni `sito/documenti-dati.html` — sotto-sezione Amministrazione.

## Componenti
- Breadcrumb: `Home → Documenti e dati`
- Hero: eyebrow DOCUMENTI / heading / intro
- Document list (6 elementi: Bandi, Avvisi, Graduatorie, Statistiche, Verbali, Delibere)
- Search form (bottone #007A52)
- Footer contacts

## Second brain
D13: Componenti `listing/search-results` (dcp-07) e `search-form` riutilizzati; bottone `#007A52`; no Bootstrap.
