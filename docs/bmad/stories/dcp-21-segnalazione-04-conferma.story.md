---
id: dcp-21
title: "dcp-21: Design Comuni page redesign"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-21 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# dcp-21: Design Comuni redesign

## Scope
Page redesign for /it/tests/segnalazione-04-conferma. BMAD + second brain D21/D23.

## Stack
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament. NO Bootstrap Italia. Token #007A52.

## BMAD architecture

- **Domain:** Fixcity owns ticket creation, code allocation and confirmation payload.
- **Form state:** Filament Wizard remains the single state machine; no page-specific Livewire
  component or URL-specific Blade is introduced.
- **CMS boundary:** `tickets.confirmation.json` selects the `ticket_confirmation` block; Sixteen
  owns only its visual rendering.
- **Geo boundary:** Geo owns `CoordinatePicker` and Lit map behavior; Fixcity only persists the
  `location` state and exposes the same state read-only in the summary step.
- **Recovery:** the redirect appends the generated capability code; the confirmation page already
  supports query lookup through `GetPublicTicketByCodeAction`.

## Brainstorm / 5 Whys

1. Why did the final screen need explicit work? The previous view retained reference-only
   Bootstrap classes and sprite dependencies, so the Tailwind runtime could not guarantee the
   intended visual contract.
2. Why preserve a query code? A session-only flash is transient and can disappear after a
   Livewire redirect or refresh.
3. Why keep the map before confirmation? The citizen must verify the exact damage location before
   submitting; after creation the page is an immutable receipt.
4. Why no URL-specific page? The project contract is JSON/CMS-driven blocks, which keeps all
   ticket flows composable and prevents duplicated pages.

## Acceptance criteria

- `save()` redirects to localized confirmation with `code` and the session payload remains the
  preferred source;
- confirmation renders the Design Comuni hierarchy with Tailwind utilities only;
- summary contains a disabled `CoordinatePicker` and the data step contains the editable map;
- Italian and English copy remain localized;
- unit/feature tests assert the nested schema and the confirmation flow.

## Evidence and next check

The UI guidance used for this change requires visible success feedback, submit feedback, associated
labels, accessible names and no horizontal scrolling. Final parity still requires Playwright
screenshots at 375×900, 768×1000 and 1440×1200 against the upstream confirmation reference.
