---
id: fil-tickets-create-confirmation-parity
type: bmad-story
status: open
links:
  github_issue: #999
  discussion: #design-comuni
title: "/it/tickets/create — Conferma dopo salvataggio (post-save confirmation) — Visual Parity con segnalazione-04-conferma.html"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets/create   conferma dopo salvataggio (post-save confirmation)   visual parity con segnalazione-04-conferma.html sixteen"
---
> Stato 2026-10-13: story NON autorevole (indica `/it/tickets/create/confirmation` e un blocco `tests/ticket-confirm/default` che non esistono). Fonte attuale: DCP-34 (`Modules/Fixcity/docs/stories/dcp-34-tickets-confirmation-design-comuni.story.md`): rotta reale `/it/tickets/confirmation`, JSON `tickets.confirmation.json`, blocco `blocks/ticket-confirmation/design-comuni`.

# /it/tickets/create — Conferma dopo salvataggio (post-save confirmation) — Visual Parity con segnalazione-04-conferma.html

## WHY (philosophy / religion / politics / zen)
Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-04-conferma.html` (48,108 bytes)
- `segnalazione-04-conferma.html` = pagina post-invio: "Segnalazione inviata" (h1 `title-xxxlarge`), numero pratica, ringraziamento, valutazione (`cmp-rating__card-first`).
- Dopo aver salvato il wizard (step 3 riepilogo con submit `bg-primary-600`), il ciclo non deve chiudersi su un form — deve chiudersi su una CONFERMA visiva che dice: "il tuo danno è stato registrato, verrà riparato dove hai indicato (mappa step 2)".
- Senza questa pagina, l'utente non sa se l'invio è avvenuto = mancanza di chiusura, mancanza di fiducia, mancanza di riferimento per il follow-up.
- Perché questa pagina esiste: il completamento del ciclo (segnalazione → registrazione → riparazione) richiede una conferma. È la chiusura della funzione.

## Perché la mappa non serve qui (ma il riferimento alla localizzazione sì)
- Il riepilogo (step 3) ha già confermato la posizione con `map-confirm` (readonly, lat/lng da step 2).
- In questa pagina, la mappa non è interattiva — ma il numero pratica + il riferimento alla posizione confermata (testo: "Il danno è stato registrato nella posizione indicata") chiude il ciclo.

## Filter / Point of View
- POST-save redirect (dopo `save()` del componente Volt): `/it/tickets/create/confirmation` o pagina dedicata
- Visual parity alta con `segnalazione-04-conferma.html`
- Component: `pub_theme/components/blocks/tests/ticket-confirm/default.blade.php` (nuovo, per pagina conferma)
- JSON: esistente `tickets.create.json` (non inventare) — aggiungere blocco di conferma se necessario
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite + Filament (NO Bootstrap)
- Token: `.btn-primary` = `bg-primary-600`; `.card` = card con shadow; `.cmp-rating__card-first` = componente valutazione con star/rating

## Acceptance Criteria
- HTTP 200 OK su pagina di conferma post-save
- Titolo "Segnalazione inviata" (h1 grande) + numero pratica visibile
- Ringraziamento testo + valutazione componente (rating stars)
- Referenza alla posizione confermata (testo, non mappa interattiva)
- Focus-visible + touch targets ≥44px
- No Bootstrap; token-only
- BMAD + second brain aggiornati

## Prevenzione (R006 / R007 esteso)
Non inventare una nuova pagina se non è richiesta dal flusso; usare il componente di conferma come parte del wizard o come redirect post-save.
