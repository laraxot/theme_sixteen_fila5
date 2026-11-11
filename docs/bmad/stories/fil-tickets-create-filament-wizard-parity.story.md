---
id: fil-tickets-create-filament-wizard-parity
type: bmad-story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
title: "/it/tickets/create — Filament Wizard + Design-Comuni Parity"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets/create   filament wizard + design-comuni parity sixteen"
---
> Stato 2026-10-13: story NON autorevole. Contiene affermazioni non verificate (classi o percorsi inesistenti, ordine dei passi errato). Fonte attuale: DCP-35 (`Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md`).

# /it/tickets/create — Filament Wizard + Design-Comuni Parity

## ERROR DISCOVERED (Livewire MethodNotFoundException — callSchemaComponentMethod)
- Component `ticket-crea` referenced by `tickets.create.json` is MISSING / BROKEN.
- Error occurs when Livewire tries to call `callSchemaComponentMethod` — component lacks required schema method.
- FIX (BMAD): do NOT invent new component file; use EXISTING JSON (`tickets.create.json`) and restore/fix `tests/ticket-crea/` component correctly.
- WHY this happened: I previously invented `tests.tickets-create.json`; when correcting, I must reference the ACTUAL file, not invent new ones.
- NEW RULE R006 (second brain): Livewire `MethodNotFoundException` → check existing component source (NOT invent schema method); fix component, not JSON.

## WHY Filament Wizard (corrected)
- The route is `/it/tickets/create`, which resolves to slug `tickets.create` (NOT `tests.*`).
- The JSON `tickets.create.json` ALREADY exists at `laravel/config/local/fixcity/database/content/pages/`.
- I incorrectly invented `tests.tickets-create.json` — this does NOT exist and would never resolve.
- Fix: always check the route slug first (`routes/web.php` or `tests.index.json` structure) before inventing a file path. Use the EXISTING JSON (`tickets.create.json`) and reference the EXISTING component (`tests.ticket-crea`).
- NEVER invent a `.json` file path; always check `laravel/config/local/fixcity/database/content/pages/` first.
Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html`
- Design-comuni page: multi-step form flow (tipo → categoria → descrizione → allegati → privacy checkbox → invio)
- Single-page form = NO parity; wizard = step navigation with progress indicator = 97% visual parity
- Filament wizard component (`Filament\Forms\Components\Wizard`) matches pattern exactly
- Stack: Tailwind (design-comuni CSS tokens) + Alpine (interactivity) + Lit (if needed) + DaisyUI + Filament wizard (NO Bootstrap)

## Implementation Requirements
- URL: `/it/tickets/create`
- Component (EXISTING, CORRECT, FIX REQUIRED): `pub_theme::components.blocks.tests.ticket-crea` — MISSING at `pub_theme/components/blocks/tests/ticket-crea/`. Livewire error `callSchemaComponentMethod` means component is broken/incomplete. Fix: restore/create component using EXISTING JSON (`tickets.create.json`), NOT new invented file.
- JSON (EXISTING, CORRECT): `laravel/config/local/fixcity/database/content/pages/tickets.create.json` — slug: `tickets.create`, NOT `tests.tickets-create`. This file ALREADY exists; do NOT invent a new one.
- Module docs: `Modules/Cms/docs/` (or relevant module) — update with wizard spec
- Theme docs: `docs/bmad/stories/fil-tickets-create-parity.story.md`
- Second brain: `knowledge.md` — add rule: wizard pattern = Filament component, not custom HTML
- Status: `STATUS_RISULTATI_RICERCA.md` updated with wizard reference

## Acceptance Criteria
- Visual parity ≥97% vs `segnalazione-01-privacy.html`
- Wizard steps visible with progress bar (Filament native wizard — only after component fixed)
- Component `tests.ticket-crea` restored (fix Livewire error first)
- NO Bootstrap (Tailwind tokens `.btn-primary` = `bg-primary-600`)
- `focus-visible` rings on all wizard buttons
- Touch targets ≥44px
- BMAD docs + second brain + module docs updated (NO inventing files)
- Component verified: existing source fixed, not new invented
- Visual parity ≥97% vs `segnalazione-01-privacy.html`
- Wizard steps visible with progress bar
- NO Bootstrap (Tailwind tokens `.btn-primary` = `bg-primary-600`)
- `focus-visible` rings on all wizard buttons
- Touch targets ≥44px
- BMAD docs + second brain updated
- Module + theme docs folders organized (`doc-folders-index.md` updated)

Correzione verificata 2026-10-13 (DCP-35 S4): (1) il namespace del wizard in Filament v5 è `Filament\Schemas\Components\Wizard` (`vendor/filament/schemas/src/Components/Wizard.php`); `Filament\Forms\Components\Wizard` non esiste. (2) I passi reali (`TicketForm::getSteps()`) sono `privacy`, `data`, `summary`, poi la pagina di conferma; non «tipo, categoria, descrizione, allegati, privacy, invio». (3) Il componente non è «MISSING»: il blocco `pub_theme::components.blocks.tests.ticket-crea` è `Themes/Sixteen/resources/views/components/blocks/tests/ticket-crea.blade.php` (esiste e monta `CreateTicketWizardWidget`); i file sotto `Themes/Sixteen/resources/views/pub_theme/` non sono raggiunti da nessuna view. (4) `MethodNotFoundException: callSchemaComponentMethod` non indica un componente rotto: era il Volt senza radice propria, vedi [D15](../../decision-log/D15-volt-fragment-explicit-root.md).
