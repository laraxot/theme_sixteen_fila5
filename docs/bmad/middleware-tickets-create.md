---
type: decision
slug: middleware-tickets-create
status: applicato
title: "Middleware /it/tickets/create (m00962)"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "middleware /it/tickets/create (m00962) sixteen"
---
# Middleware /it/tickets/create (m00962)

Logica: il wizard segnalazione è un atto pubblico con responsabilità → richiede autenticazione (non anonimo).
Filosofia: Design Comuni = servizio trasparente ma con identità (patto cittadino-istituzione).
Zen: passo 0 invisibile = verifica identità; solo dopo: dati (step 2), mappa (2/3), riepilogo (3), conferma (4).
Politica: middleware dichiarativo in `tickets.create.json` (NON codice PHP); docs BMAD; second brain `kp-174d...`.
Anticorpo: `ls laravel/.../pages/` prima di assumere slug; `tests.tickets-create.json` NON esiste; `tickets.create.json` è il file corretto.
Stack: Tailwind + wizard Filament (Volt) + componente geo; NO Bootstrap; NO design-system/ root.
Loop: APERTO — 97% visual parity con segnalazione-04-conferma (mappa) non ancora verificata.
