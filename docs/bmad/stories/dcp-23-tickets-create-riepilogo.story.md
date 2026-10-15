---
id: dcp-23
title: "DCP-23: tickets/create riepilogo + mappa (conferma) — design-comuni parity"
type: story
epic: dc-parity-v2
status: archived
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-23 tickets create confirmation 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-23: tickets/create — Riepilogo / Conferma (step 3/3) con mappa — archivio

> **Non autorevole.** Il contratto corrente è suddiviso nelle story DCP-32,
> DCP-33, DCP-34 e DCP-35 nell’indice `00-INDEX.md`. Questo documento conserva
> soltanto il contesto storico e non deve guidare nuove modifiche.

## Perché (logica / filosofia / politica / zen)
Il wizard Filament a 3 passaggi (privacy → dati → riepilogo) deve terminare con una pagina di CONFERMA che mostra ESATTAMENTE i dati inseriti (indirizzo, tipo disservizio, titolo, dettagli, immagini, autore, contatti) + la MAPPA (luogo del danno). La politica dell'istituzione = trasparenza assoluta: il cittadino vede che il danno è stato registrato con precisione. Lo zen: nessun elemento superfluo, solo i dati, ripetuti con cura.

## Riferimento Design Comuni
`segnalazione-03-riepilogo.html` (11 sezioni fetchate):
- Header con breadcrumb (1/3 confermato / 3/3 attivo)
- Sezione "Segnalazione" (indirizzo, tipo, titolo, dettagli, immagini)
- Sezione "Dati Generali" (autore, CF, contatti)
- Stato "Richiesta salvata con successo"
- Contatti comune + Cerca
- Note: la mappa NON è nel riferimento ma è RICHIESTA dall'utente per definire il luogo del danno.

## Struttura richiesta per /it/tickets/create?step=form.riepilogo
- Wizard step 3 attivo (`#007A52`)
- Sezione riepilogo con dati (indirizzo + mappa interattiva + foto)
- Messaggio di conferma chiaro (`Richiesta salvata con successo`)
- Link a termini e condizioni + conferma/invia
- Contatti + Cerca

## Componenti necessari (BMAD + second brain D21/D23)
- `confirmation.blade.php` (nuovo — riepilogo con dati + stato)
- `map-location.blade.php` (nuovo — già creato per dcp-22, riutilizzabile)
- Aggiornare `tests.tickets.create.json` (se necessario per block riepilogo)
- Verificare `form-wizard/default.blade.php` (step 3 attivo con `#007A52`)

## Stack / Correzioni registrate
- Stack: Tailwind+Alpine+Lit+DaisyUI+Flowbite+Filament (NO Bootstrap Italia, D10).
- Token: `#007A52` su step attivo, bottone conferma, marker mappa.
- Correzione precedente (`correction-dcp-22-json-file.md`): `tickets.create.json` corretto (non `tests.tickets.create.json`).
- Bug Livewire (`callSchemaComponentMethod`) registrato — bug modulo Fixcity (`CreateTicketWizardWidget.php`), NON tema Sixteen.

## Stato
- Componenti creati/migliorati: `map-location.blade.php` (dcp-22), `confirmation.blade.php` (creare ora).
- Playwright 375/768/1440: PENDENTE (ambiente 192.168.1.40:8000) — ma architettura completa.
- Second brain: `batch-designcomuni-6-pagine`, `correction-dcp-22-json-file-naming...`, `docs-org` — tutti aggiornati.

Correzione verificata 2026-10-13 (DCP-35 S4): (1) il JSON di `/it/tickets/create` è `tickets.create.json`; `tests.tickets.create.json` non esiste e non va creato né aggiornato. (2) L'errore `callSchemaComponentMethod` non era un bug di `CreateTicketWizardWidget.php`: il metodo è già `public` in `InteractsWithSchemas`; la causa era il Volt della pagina generica del tema senza radice propria, vedi [D15](../../decision-log/D15-volt-fragment-explicit-root.md).
