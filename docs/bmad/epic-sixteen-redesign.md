---
type: epic
title: Sixteen Redesign — Design Comuni Visual Parity
links:
  github_issue: "#54"
  discussion: "https://github.com/italia/design-comuni-pagine-statiche/discussions"
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "sixteen redesign   design comuni visual parity sixteen"
---

# Sixteen Redesign — Design Comuni Visual Parity

## Obiettivo
Far coincidere `/it/tests/homepage` e `/it/tests/segnalazione-dettaglio` con i riferimenti Design Comuni (`italia.github.io/design-comuni-pagine-statiche/sito/`), minimo 90% HTML e 95% visuale.

## Stack (obbligatorio)
- TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite
- **NO Bootstrap** (Bootstrap Italia è solo riferimento visivo)

## Regole applicate
1. **Layout JSON** — ogni pagina ha `"layout": "test"` → `<x-layouts.test>` diretto
2. **No riferimento ridondante** — `pub_theme::components.blocks.homepage.design-comuni` → `components.blocks.homepage` (Sixteen è già Design Comuni)
3. **Nessun `<x-dynamic-component>`** — layout fisso

## Storie
- `docs/bmad/stories/story-homepage-parity.md`
- `docs/bmad/stories/story-segnalazione-dettaglio-parity.md`
- `docs/bmad/stories/story-layout-json-dinamico.md`