---
id: fil-tickets-create-wizard-step3-riepilogo-map
type: bmad-story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
title: "/it/tickets/create?step=form.riepilogo::data::wizard-step — Wizard Step 3 (Riepilogo) + Mappa di Verifica"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets/create?step=form.riepilogo::data::wizard-step   wizard step 3 (riepilogo) + mappa di verifica sixteen"
---
> Stato 2026-10-13: story NON autorevole. Contiene affermazioni non verificate (classi o percorsi inesistenti, ordine dei passi errato). Fonte attuale: DCP-35 (`Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md`).

# /it/tickets/create?step=form.riepilogo::data::wizard-step — Wizard Step 3 (Riepilogo) + Mappa di Verifica

## WHY (philosophy / religion / politics / zen)
Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-03-riepilogo.html`
- `segnalazione-03-riepilogo.html` = riepilogo dell'intera segnalazione prima dell'invio (tipo, descrizione, foto, privacy, KE — la mappa conferma DOVE il danno verrà riparato).
- Il riepilogo NON è un semplice riassunto testuale: è la VERIFICA che l'utente riconosca che il servizio verrà erogato nel luogo indicato dalla mappa (step 2).
- Senza la mappa nel riepilogo, l'utente invia senza confermare la localizzazione — il danno potrebbe essere riparato nel punto sbagliato.
- La mappa nel riepilogo = verifica della localizzazione, non decorazione (R007 applicata).

## Filter / Point of View
- Riepilogo (step 3): sintesi di tipo + descrizione + allegati + privacy + MAPPA (con lat/lng da step 2).
- Visual parity: alta con `segnalazione-03-riepilogo.html`
- Mappa: la stessa posizione da step 2, visualizzata in modo non-interattivo (conferma, non modifica) — l'utente può solo CONFERMARE che quel punto è corretto.

## Philosophy / Zen
"Il danno deve essere localizzabile" — nel riepilogo la mappa è la prova che il servizio verrà erogato dove l'utente indica. Senza questa conferma, il processo è incompleto.

## Implementation Requirements
- JSON (EXISTING, CORRECT): `tickets.create.json`
- Component (EXISTING, FIXED): `pub_theme/components/blocks/tests/ticket-crea/`
- Update: `default.blade.php` — add riepilogo section + non-interactive map (confirm-only) + summary fields + submit button
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament wizard + Leaflet/OSM (map tiles non-interattive per conferma)
- NO Bootstrap; token `.btn-primary` = `bg-primary-600`; `.map-confirm` = non-interactive (readonly)

## Acceptance Criteria
- HTTP 200 OK at `/it/tickets/create?step=form.riepilogo::data::wizard-step`
- Visual parity ≥97% vs `segnalazione-03-riepilogo.html`
- Riepilogo shows: tipo, descrizione, allegati count, privacy checkbox (confirmed), MAP (same lat/lng from step 2, readonly)
- Submit button visible with `bg-primary-600`
- Focus-visible on submit + map controls (readonly = still needs focus for accessibility)
- No new JSON invented; existing `tickets.create.json` used

Correzione verificata 2026-10-13 (DCP-35 S4): il componente reale del blocco è `Themes/Sixteen/resources/views/components/blocks/tests/ticket-crea.blade.php`; `pub_theme/components/blocks/tests/ticket-crea/` (cartella sotto `resources/views/pub_theme/`) non è raggiunta da nessuna view e non va aggiornata. Il riepilogo è lo step `form.riepilogo` (it) di `TicketForm::getSteps()`, con la mappa `review_map` in `TicketForm::getSummarySectionSchema()`; lavoro in corso in DCP-33.
