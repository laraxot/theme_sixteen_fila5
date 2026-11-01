---
id: fil-tickets-create-wizard-step2-map
type: bmad-story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
title: "/it/tickets/create?step=form.dati-di-segnalazione — Wizard Step 2 + Mappa (Visual Parity con segnalazione-02-dati.html)"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "/it/tickets/create?step=form.dati-di-segnalazione   wizard step 2 + mappa (visual parity con segnalazione-02-dati.html) sixteen"
---
> Stato 2026-10-13: story NON autorevole. Contiene affermazioni non verificate (classi o percorsi inesistenti, ordine dei passi errato). Fonte attuale: DCP-35 (`Modules/Fixcity/docs/stories/dcp-35-tickets-create-privacy-dati-coordinamento.story.md`). Aggiornamento: ogni richiesta/implicazione di HTTPS come prerequisito del ticket e' superseded; la mappa deve partire da coordinate esistenti del record quando presenti, altrimenti dalla posizione browser/utente se disponibile, altrimenti da fallback Comune/default Geo con selezione manuale sempre possibile.

# /it/tickets/create?step=form.dati-di-segnalazione — Wizard Step 2 + Mappa (Visual Parity con segnalazione-02-dati.html)

## WHY (philosophy / raison d'être)
Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html`
- `segnalazione-02-dati.html` = form dati (tipo, descrizione, luogo, foto) INTEGRATO con mappa per geolocalizzare il danno.
- La mappa NON è decorazione — è parte della funzione: senza la posizione esatta, il danno non può essere riparato.
- Wizard step 2 (`form.dati-di-segnalazione`) = dati + mappa = stesso pattern di design-comuni.
- Filament wizard step navigation (`wizard-step`) permette: Step 1 (tipo), Step 2 (dati + mappa), Step 3 (privacy/invio).

## Stack
Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament Wizard (NO Bootstrap Italia)
Token: `.btn-primary` = `bg-primary-600`; mappa usa Leaflet/OpenStreetMap (non Bootstrap)

## Implementation Requirements (map-gated)
- Component: `pub_theme/components/blocks/tests/ticket-crea/default.blade.php` (updated with wizard step 2 + map block)
- JSON (EXISTING, CORRECT): `tickets.create.json`
- Map integration: embedded Leaflet/OpenStreetMap for damage location selection (click = set lat/lng)
- Visual parity: ≥97% vs `segnalazione-02-dati.html`
- Focus-visible on map control buttons (zoom, locate, submit)
- Touch targets ≥44px
- No hardcoded hex (map tiles from CDN, UI from Tailwind tokens)

## WHY MAP IS REQUIRED (zen / function)
Without location, a damage report is useless. The map IS the data input for the repair crew — not an illustration.

## Acceptance Criteria
- HTTP 200 OK at `/it/tickets/create?step=form.dati-di-segnalazione::data::wizard-step`
- Wizard shows Step 2 with form fields + interactive map
- Map allows click-to-set-location (lat/lng saved to `form`)
- Visual parity ≥97% with `segnalazione-02-dati.html`
- No Bootstrap, token-only colors, accessibility verified
- BMAD + second brain updated
- Module docs + theme docs organized

Correzione verificata 2026-10-13 (DCP-35 S4): i passi del wizard sono privacy (`form.autorizzazioni-e-condizioni`), dati con mappa (`form.dati-di-segnalazione`), riepilogo (`form.riepilogo`), poi la conferma; non «Step 1 (tipo), Step 3 (privacy/invio)». Il componente `pub_theme/components/blocks/tests/ticket-crea/default.blade.php` non è raggiunto da nessuna view: il blocco reale è `Themes/Sixteen/resources/views/components/blocks/tests/ticket-crea.blade.php`, che monta `CreateTicketWizardWidget` (schema in `TicketForm`).
