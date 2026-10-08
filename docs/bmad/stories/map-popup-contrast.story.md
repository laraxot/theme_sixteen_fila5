---
id: STORY-MAP-POPUP-CONTRAST-20261007
title: "Popup marker mappa leggibile e accessibile"
status: implemented-runtime-pending
owner: Sixteen
created: 2026-10-07
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/514"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/573"
---

# Popup marker mappa leggibile e accessibile

## Problema

Il popup aperto da un marker ereditava un foreground bianco su superficie
bianca. Il contenuto era quindi presente ma illeggibile.

## Correzione

Sixteen ora applica al popup dei ticket una superficie bianca esplicita, testo
navy ad alto contrasto, link blu sottolineato, focus visibile e chiusura con
target minimo 44px. Il markup del popup escapea i dati del ticket prima di
inserirli nell'HTML.

## Acceptance criteria

- [x] Titolo, indirizzo e link sono leggibili su desktop e mobile.
- [x] Il popup mantiene bordi, ombra e tipografia coerenti con la mappa.
- [x] Il link dettagli ha contrasto e focus visibile.
- [x] Titolo e indirizzo non possono introdurre markup nel popup.
- [ ] Verifica browser con click reale su un marker quando Playwright Chromium è disponibile.
