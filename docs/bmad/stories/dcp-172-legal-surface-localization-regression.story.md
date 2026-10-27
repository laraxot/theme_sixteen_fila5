---
id: dcp-172
title: "DCP-172: regressione superfici legali e localizzazione"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "legal links footer disclaimer cookie privacy terms localized regression it en de es"
related: [dcp-131, dcp-157, dcp-171, 6.10, 6.16, 6.17, 8.11]
tags: [docs, sixteen, bmad]
---

# DCP-172: regressione superfici legali e localizzazione

## Obiettivo

Dimostrare che le superfici legali pubbliche sono raggiungibili e coerenti in tutte
le lingue senza rompere il tema Sixteen o introdurre un sottosistema parallelo.

## Criteri di accettazione

- [ ] Un inventario it/en/de/es copre footer, cookiebar, cookie policy, privacy,
  termini/disclaimer, accessibilità, note legali, registrazione e invio segnalazione.
- [ ] Ogni link canonico restituisce lo status atteso, conserva il locale e non
  punta a `#`, path hard-coded, namespace errato o route di test.
- [ ] La verifica distingue contenuto tradotto, fallback tecnico e contenuto legale
  approvato; non considera una traduzione automatica prova di approvazione.
- [ ] Feature/browser test coprono desktop/mobile, menu footer, focus e apertura
  della policy dalla Cookiebar.

## Dipendenze e scope

Blocked by: 6.10, 6.16, 6.17, 8.11. Blocks: DCP-173.
Owned evidence: `docs/bmad/audits/legal-surface-localization-regression.md`.
Non modifica route o copy: eventuali fix passano alle story proprietarie.

## Strategia di verifica

Costruire una matrice route/locale, eseguire crawl autenticato e guest con dati
sintetici, verificare status/link/lingua e produrre evidenza dei casi mancanti.

## Dev Agent Record

_(empty — to be completed by the external dev tool)_
