---
id: dcp-16
title: "DCP-16: segnalazione-01-privacy (estratta a caso, non iniziata)"
type: story
epic: dc-parity-v2
status: superseded
superseded_by: dcp-23
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity segnalazione 01 privacy wizard flusso bmad story baseline"
tags: [docs, sixteen, bmad]
---

# DCP-16: segnalazione-01-privacy

> Superata da [DCP-23](dcp-23-segnalazione.story.md): la pagina e le sei sorelle (passi 02-04, area personale, dettaglio, elenco) sono replicate col blocco `report-step` e gli altri della famiglia `report-*`. La baseline qui sotto resta come cronologia.

Seconda estrazione casuale dell'utente; sostituita su sua richiesta da `eventi` (DCP-15). Esiste gia' `tests.segnalazione-01-privacy.json` con il blocco `flow/segnalazione/01-privacy` (Tailwind, modificato da altri agenti).

## Baseline (misurata 2026-10-13)
HTML body 76,88% rigoroso (86,75% con URL normalizzati); pixel 94,15 / 92,94 / 91,51 / 90,01 / 89,19% a 1920 / 1440 / 992 / 768 / 375 px; altezze 1938-1956 (1920), 2051-2037 (768), 2925-2919 (375). Pagina piccola (`<main>` 5 KB, nessun `data-bs-*`).

## Da fare (metodo del wiki concept)
JSON + blocco `flow-step` da JSON (riusabile per `segnalazione-02/03/04`, passi fratelli), CSS generato (aggiungere la pagina a `regenerate-design-comuni-css.sh`), stati delle checkbox, gate. Attenzione: questo flusso e' del front office reale (`/it/tickets/create`): il blocco di prova non deve cambiare il flusso vero (`layouts/design-comuni` e' solo per `pages/tests/*`).
