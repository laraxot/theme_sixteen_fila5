---
title: "Readiness report — Homepage Sixteen JSON-driven"
type: bmad-readiness
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "readiness gate sixteen"
---

# Readiness gate

## Verdetto: CONCERNS — documentazione riallineata, implementazione sospesa

Il dossier è ora coerente con `tickets.confirmation.json` e
`index.blade.php.old`. Non autorizza ancora il cutover di `home.json):
manca l'inventario conclusivo delle view che rendono le tre sezioni.

## Gate

- [x] Problema e perimetro definiti.
- [x] Contratto JSON CMS definito sul file confirmation.
- [x] Funzionalità legacy elencate senza aggiunte marketing.
- [x] FR/NFR e ADR tracciati.
- [x] `list_url` usa `container0.index` e `report_url` usa
  `container0.view` con `container0=tickets` e `slug0=create`.
- [x] Mapping hero/mappa/CTA, how-it-works e tracking a view reali.
- [x] Payload finale `home.json` scritto, JSON valido e route dinamiche compilate.
- [ ] Browser smoke `/it` con Playwright/Puppeteer.

## Handoff

Implementare in ordine 1.2 → 1.3 → 1.4 → 1.5. Se manca una view, creare solo
quella minima sotto `components/blocks`; non modificare CMS per adattarlo al
JSON errato.
