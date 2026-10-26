---
title: "Brainstorming: Ticket dettaglio — commenti + passaggi (stati + mail tracciate)"
type: brainstorming
status: active
github_issue: "#ticket-commenti"
links: { design_comuni: "https://italia.github.io/design-comuni-pagine-statiche/" }
updated: 2026-10-17
tags: [docs, sixteen, bmad]
qmd: "ticket detail passaggi commenti.brainstorming sixteen"
---

## Scopo del sistema (compreso a pieno)
Cittadino fa una segnalazione → **visibile solo a lui finché è in attesa**.
Moderatore: approva / scarta (può aggiungere foto, contenuti, modificare).
Individuazione destinatario: ULSS, comune, vigili, etc.
Invio mail → **tracciare quando e a chi**.
Risposte → tracciare.
Commenti → visibili e scrivibili (Filament widget).

## Pattern Design Comuni (da 6 pagine servizio studiate)
- **Scheda servizio** (graduatoria-scheda-servizio, permessi-scheda-servizio, vantaggi-scheda-servizio):
  titolo, stato ("Servizio attivo"), descrizione, CTA "Richiedi online", social share, azioni (stampa/ascolta/invia).
- **Conferma** (graduatoria-conferma, permessi-conferma, vantaggi-conferma):
  "Richiesta inviata", email riepilogo, scarica ricevuta PDF, **Prossimi passi** con date e esiti.
- **Messaggio** (graduatoria-messaggio):
  Area personale, titolo, data ultima graduatoria, distinzione Ammessi/Esclusi.

## Cosa serve nel dettaglio ticket
1. **Commenti** — widget Filament (non Livewire) per inserire, visualizzare e rispondere ai commenti.
2. **Passaggi** (stati cronologici):
   - Segnalato il <data>
   - Approvato il <data> da <moderatore>
   - Mail inviata a <destinatario> il <data>
   - Risposta ricevuta il <data>
   - Chiuso il <data>
   Ogni passaggio: data, autore, azione, testo libero.
3. **Tracciamento mail**: tabella `mail_logs` (to, subject, sent_at, status, message_id, destinatario).
4. **Visibilità**: cittadino vede solo propri ticket; moderatore vede tutti.

## Fonti
- https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-scheda-servizio.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-conferma.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-messaggio.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/permessi-scheda-servizio.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/permessi-conferma.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/vantaggi-scheda-servizio.html
- https://italia.github.io/design-comuni-pagine-statiche/servizi/vantaggi-conferma.html
