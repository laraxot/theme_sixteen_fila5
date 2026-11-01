---
title: "Epics — Homepage Sixteen JSON-driven"
type: bmad-epics
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "epics e storie sixteen"
---

# Epics e storie

## Epic 1 — Contratto e composizione CMS

Obiettivo: portare la homepage al contratto reale CMS senza perdere il flusso
FixCity della vecchia Blade.

| Story | Risultato | Dipendenze |
|---|---|---|
| 1.1 | page shell Sixteen allineato a TwentyOne | nessuna |
| 1.2 | inventario e schema `home.json` | 1.1 |
| 1.3 | mapping delle tre sezioni a view esistenti/minime | 1.2 |
| 1.4 | verifica `BlockData`/namespace/view | 1.2, 1.3 |
| 1.5 | smoke, locali, parity e readiness | 1.4 |

## Regola di completamento

Un JSON formalmente valido non è pronto se una view non esiste o se la
homepage perde CTA, mappa, tre step o tracking della fonte legacy.
