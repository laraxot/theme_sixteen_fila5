---
id: dcp-173
title: "DCP-173: retest delle evidenze Linee guida di design"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "linee guida design cap 4 retest audit cookiebar disclaimer evidence release"
related: [dcp-163, dcp-170, dcp-171, dcp-172, 8.18]
tags: [docs, sixteen, bmad]
---

# DCP-173: retest delle evidenze Linee guida di design

## Obiettivo

Chiudere il ciclo tra implementazione, audit Cookiebar/disclaimer e matrice corrente
dei requisiti, mantenendo separati verifica tecnica, approvazione legale e sign-off.

## Criteri di accettazione

- [ ] La scansione della matrice corrente 4.1–4.8 viene rieseguita sul candidate
  identificato e ogni risultato ha comando, timestamp, commit, ambiente e owner.
- [ ] I risultati di DCP-170/171/172 sono collegati a righe della matrice con stato
  verificato, parziale, bloccato, non applicabile o accepted limitation.
- [ ] Nessuna percentuale di parity viene convertita in claim di conformità senza
  evidenza normativa e approvazione del titolare/DPO.
- [ ] Il report indica chiaramente ciò che non è verificato, ciò che richiede input
  legale e ciò che blocca 7.1/7.2.

## Dipendenze e scope

Blocked by: 8.1, 8.18, DCP-170, DCP-171, DCP-172. Blocks: 7.1.
Owned evidence: `docs/bmad/audits/design-guideline-evidence-retest.md`.

## Strategia di verifica

Eseguire il checker ufficiale previsto da DCP-163, controllare i link alle prove,
confrontare candidato precedente/attuale senza riscrivere la storia e sottoporre
le lacune legali al proprietario competente.

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
