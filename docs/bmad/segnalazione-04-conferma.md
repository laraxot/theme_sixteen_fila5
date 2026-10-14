---
type: story
slug: segnalazione-04-conferma
status: aperto
obiettivo: pagina conferma dopo salvataggio wizard (visual parity alta)
riferimento: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-04-conferma.html
filosofia: la conferma è un atto di riconoscimento della responsabilità civica — il cittadino ha indicato un danno, l'amministrazione lo riconosce
logica: dopo submit wizard (step 3 riepilogo), la conferma mostra: codice segnalazione, riepilogo dati, mappa con pin (persistente dalla geo scelta), stato (in attesa/in lavorazione)
zen: non è "grazie" generico — è "abbiamo registrato il tuo atto di cura del bene comune"
religione: Design Comuni = servizio pubblico = trasparenza; conferma = prova pubblica dell'impegno
politica: docs nel tema (Sixteen/docs/, NON root design-system/); JSON `tests.index.json` / `tickets.create.json` governa; wizard con stato geo persistente; no duplicazioni file
stack: Tailwind + Alpine + componente conferma + mappa statica (o componente geo con pin salvato)
second-brain: kp-174d15a58ff94901b2b0df0d86b8907a (aperto, geo persistente tra step, conferma con mappa)
antierrore: `tests.tickets-create.json` NON esiste; `tickets.create.json` è il JSON corretto per /it/tickets/create — verificare con `ls` prima di assumere namespace
title: "Segnalazione 04 — Conferma"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "segnalazione 04   conferma sixteen"
---
# Segnalazione 04 — Conferma

Dopo il salvataggio (`form.riepilogo::data::wizard-step` → submit):
- Codice segnalazione (es. SEGN-2026-001)
- Riepilogo: luogo (mappa con pin dalla geo step 2), descrizione, data
- Stato: in attesa / in lavorazione
- Messaggio: riconoscimento dell'atto del cittadino

Perché mappa: la conferma deve mostrare il luogo del danno per trasparenza e tracciabilità — il cittadino verifica che la sua indicazione è registrata correttamente.
