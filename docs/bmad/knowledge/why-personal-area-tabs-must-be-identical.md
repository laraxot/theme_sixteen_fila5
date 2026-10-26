---
title: "why personal area tabs must be identical"
type: knowledge
tags: [bmad, sixteen, area-personale, anti-regression, agent-learning]
created: 2026-10-22
updated: 2026-10-22
qmd: "perche tab area personale identici agent error include vs render parity feature test"
related:
  - ../stories/dcp-110-area-personale-pratiche-e-seguite.story.md
  - ../stories/dcp-111-area-personale-notifiche-e-impostazioni.story.md
  - ../../wiki/concepts/personal-area-shared-nav-tabs-contract.md
  - ../filament-blueprint.md
status: draft
---

# Perché i tab dell'area personale devono essere identici (e perché l'agente non ci arrivò da solo)

## Religione

L'area personale è una **casa a quattro stanze**. I tab sono le porte. Una porta presente solo in una stanza è un bug di prodotto, non uno stile.

## Errore tipico dell'agente (causa radice)

1. **Assunzione sorgente = UX**: trovato `@include(...navigation)` in notifiche/impostazioni e concluso «parity OK» senza confrontare **HTML autenticato** delle quattro rotte affiancate.
2. **Test incompleti**: `PersonalAreaPagesTest` asseriva i quattro link solo su `pratiche` e `seguite`. Le settings avevano contenuto vero (DCP-111) ma nessuna guardia HTML sulla nav condivisa → regressione silenziosa di layout (nav dentro `col-lg-10` invece di `col-12 p-0`).
3. **Chrome duplicato**: DCP-111 reimplementò briciole+h1+nav inline invece di riusare l'heading di DCP-110 → due verità sul placement.
4. **Contratto file-only**: test unit che leggono `file_get_contents` sull'`@include` non vedono se la nav è nascosta, fuori posto o assente a runtime.

## Correzione strutturale

- Chrome unico: `personal-area/heading.blade.php` → `navigation.blade.php`.
- Notifiche e impostazioni usano lo stesso heading; niente secondo include della nav.
- Feature test: le quattro pagine devono elencare gli stessi href e un solo `aria-current="page"`.

## Checklist anti-regressione (prima di chiudere un task FO)

- [ ] Le pagine sorelle (stesso menu utente) condividono lo stesso partial di chrome?
- [ ] Esiste un test **authenticated HTML** su **tutte** le rotte del menu, non solo sulla prima implementata?
- [ ] Il placement CSS/markup coincide (stesse classi wrapper), non solo la presenza della stringa `cmp-nav-tab`?
