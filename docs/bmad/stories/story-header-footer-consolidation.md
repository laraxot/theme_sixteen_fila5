---
type: story
title: Consolidate Header and Footer into Single Source of Truth
links:
  github_issue: "#55"
  discussion: "https://github.com/.../discussions"
status: draft
updated: 2026-10-11
tags: [docs, sixteen, bmad]
qmd: "story: header & footer consolidation sixteen"
---

# Story: Header & Footer Consolidation

## Status

**Implemented in Sixteen renderer; visual parity and content coverage remain a
continuous verification concern.** The section contract is documented in
`../header-footer-sections-contract.md`.

## Problem
Sixteen theme ha **duplicazione header/footer**:
- `header-comune.blade.php` + `footer-comune.blade.php` (static, hardcoded)
- `components/sections/header.blade.php` + `sections/footer-full.blade.php` (CMS-driven)
- `pub_theme::components.sections.header.v1` / `.tailwind` partials (nuova implementazione)
- Design-Comuni assets duplicati in `public/design-comuni/assets/`

Questa duplicazione causa:
- Inconsistenza visiva tra pagine
- Manutenzione doppia
- Ambiguità su quale header/footer usare

## Acceptance Criteria
1. **Unico header**: un componente `header` che supporta:
   - Logo + site name + tagline
   - Navigazione primaria (Design-Comuni: Amministrazione, Novità, Servizi, Vivere il Comune, Iscrizioni, Estate, Polizia Locale)
   - Navigazione secondaria (Elenco segnalazioni → `tickets.index`)
   - Language switcher (IT/DE/EN/ES)
   - Personal area (login/area personale dropdown per utenti autenticati)
   - Search trigger
   - Social icons (opzionale, da config)
   - Mobile overlay (Alpine.js)

2. **Unico footer**: un componente `footer` con template:
   - `full`: EU funding badge + 4 colonne (Comune, Servizi, Amministrazione, Contatti) + bottom bar (Privacy, Note legali, Accessibilità)
   - `slim`: solo bottom bar + credits

3. **Data source**: CMS `sections` JSON (`slug: "header"`, `slug: "footer"`), non hardcoded

4. **Stack**: Tailwind + Alpine (mobile/search), **NO Bootstrap**

## Tasks
- [x] Task 1: Mappa tutti gli elementi header/footer (investigation)
- [x] Task 2: Crea JSON CMS tenant per header e footer
- [x] Task 3: Renderer header unico, Tailwind/Alpine, blocchi JSON
- [x] Task 4: Renderer footer unico, Tailwind, blocchi JSON
- [x] Task 5: Rimuovi Bootstrap dal runtime dei renderer
- [ ] Task 6: Verifica parità visiva Design-Comuni per tutte le viewport

## Definition of Done
- `grep -r "header-comune\|footer-comune" resources/views` → 0 results (usati solo se necessario come fallback)
- `x-section slug="header"` / `x-section slug="footer"` funzionano con data CMS
- Tutte le pagine (`app`, `test`, `guest`) usano lo stesso header/footer
- Visual regression test passa
