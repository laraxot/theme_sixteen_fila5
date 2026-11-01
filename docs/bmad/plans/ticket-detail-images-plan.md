---
type: plan
status: draft
updated: 2026-10-27
tags: [ticket-detail, images, public-detail, ux, design-comuni, bmad]
qmd: "ticket detail images public detail bmad"
related:
  - ../stories/camera-upload-mobile-fix.story.md
  - ../docs/wiki/concepts/ticket-detail-page-ux.md
---

# Ticket detail images — BMAD fix plan

## Intent
Fix la pagina pubblico `/it/tickets/{id}`: sezione foto (`td-images`) è vuota perché `BuildPublicTicketDetailAction` esclude `images`; utente vede solo nome file rotto invece della foto. Posizione già corretta (sotto mappa).

## Evidence
- `design-comuni.blade.php`: sez. `td-images` presente (riga 110), usa `$detail['images']` → griglia `cmp-card`
- `BuildPublicTicketDetailAction.php`: `images` mancante nel return array (linee 38-56, commento linea 26)
- Design-comuni ref (`segnalazione-dettaglio.html`): allegati con anteprima richiesti

## Plan (Ponytail — minimale)

Step 1 — Documentazione BMAD (questa story + claim nella story camera-upload)
Step 2 — Aggiungere `images` a `BuildPublicTicketDetailAction` (array di URL `getFullUrl()` da relazione `media` / `images`)
Step 3 — Verificare che `design-comuni.blade.php` renderizzi correttamente (già corretto — solo dati mancanti)
Step 4 — Test `TicketPublicDetailPageTest` / `BuildTicketPublicDetailsPayloadActionTest`
Step 5 — Commit, verif, update Hindsight

## Technical decisions
- Pubblico: immagini sono già visibili nel geojson/API (`api/ticket-details`); aggiungerle al dettaglio è coerente con design
- Nessun controller, solo Action + Blade già esistente
- Traduzioni già presenti (`ticket_detail.php` con `images`, `image_alt`)
- Se il file mostra solo il nome (grcpCsC...), è perché l'URL media non risolve; `getFullUrl()` risolve
