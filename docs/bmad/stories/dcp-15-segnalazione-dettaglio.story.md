---
id: dcp-15
title: "dcp-15: Design Comuni page redesign"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-22
qmd: "design comuni parity dcp-15 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# dcp-15: Design Comuni redesign

## Scope
Page redesign for /it/tests/segnalazione-dettaglio. BMAD + second brain D21/D23.

## Stack
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament. NO Bootstrap Italia. Token #007A52.

## Avanzamento 2026-10-22

- Blocco `components/blocks/tests/segnalazione-dettaglio.blade.php`: breadcrumb
  accessibile, copy da `fixcity::ticket_detail.*`, `data-element` per parity
  test, lazy images, rating widget solo autenticati.
- HTML parity DI class names mantenuta (riferimento statico Design Comuni).
- Prossimo: pixel/WCAG su 375/768/1440 e allineamento al body reference ≥90%.
