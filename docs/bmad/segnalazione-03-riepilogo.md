---
type: story
slug: segnalazione-03-riepilogo-mappa
status: aperto
obiettivo: wizard riepilogo con mappa del danno (conferma visiva)
filosofia: riepilogo = 'ecco dove hai indicato il danno' — mappa = verifica prima conferma
logica: geo persistente tra step 2 (dati) e 3 (riepilogo)
zen: non si conferma ciò che non si è localizzato
stack: Tailwind + mappa componente + wizard state
riferimento: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-03-riepilogo.html
title: "Segnalazione 03 — Riepilogo + Mappa"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "segnalazione 03   riepilogo + mappa sixteen"
---
# Segnalazione 03 — Riepilogo + Mappa

Wizard step: `form.riepilogo::data::wizard-step`.
Contenuto: riepilogo dati + mappa con pin del danno (persistente da step 2).
Perché mappa: verifica visiva prima del submit finale — il cittadino vede il luogo prima di confermare.

## Estensione BMAD: esito dopo il salvataggio

Il click finale non deve restare nello step del wizard: `CreateTicketWizardWidget::save()` crea
il ticket, genera il codice di tracciamento, salva il flash bag e redirige a
`/it/tickets/confirmation?code=...`. Il parametro è un capability code già previsto dal flusso
pubblico e consente il recupero sicuro se il flash di sessione non è disponibile.

La pagina di conferma usa lo stesso blocco CMS `ticket_confirmation` e la view del tema Sixteen;
non si crea una Blade per l'URL. La view è Tailwind-only, con il check di successo, il codice,
il link di tracciamento, l'area personale e il contatto del Comune. La mappa resta nel riepilogo
prima dell'invio: la conferma certifica l'avvenuta registrazione, non modifica più la posizione.

### Acceptance criteria

- il salvataggio valido porta a una pagina di conferma con codice e stato leggibili;
- il riepilogo mostra la mappa `CoordinatePicker` in sola lettura e conserva `location`;
- il layout non usa Bootstrap Italia, sprite Bootstrap o classi di runtime Bootstrap;
- a 375, 768 e 1440 px non compare overflow orizzontale e i controlli restano raggiungibili da tastiera;
- il percorso con `?code=` ricostruisce la conferma anche senza flash di sessione;
- test unitari e feature coprono schema, redirect e rendering del codice.
