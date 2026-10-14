---
id: dcp-91
title: "DCP-91: wizard sulle pagine data-dc: CSS legacy isolato, passi 1-2 senza shell, regola dei passi inattivi"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "wizard filament css legacy fi-sc-wizard data-dc passi inattivi footer steppers isolate-legacy-important"
related: [dcp-32, dcp-33, dcp-35]
tags: [docs, sixteen, bmad]
---

# DCP-91: cosa e' cambiato per il wizard quando le pagine reali passano a `data-dc`

## Perche' e' una story
Attivare `"layout": "design-comuni"` in `tickets.create.json` (13:5x) fa scattare lo scope `data-dc` su tutti e tre i passi. Il bundle del tema contiene il vecchio shell del wizard in regole legacy (`.fi-sc-wizard ...`, `.fi-sc-wizard-footer{display:flex!important}`, `.wizard-dc-form-shell ...`) che il plugin PostCSS ora isola come ogni altra regola legacy. Il CSS vero di Filament arriva da `@filamentStyles` solo per i componenti base: nel bundle **non** ci sono le regole dei passi.

## Fatti verificati
- Provata e scartata l'esenzione `.fi-*` nel plugin: dipingeva di verde ogni pulsante del wizard (`.fi-sc-wizard button{background:#007a52}`) e teneva visibile il footer Filament sull'ultimo passo. Rimossa (vedi correzione in DCP-32).
- Senza le regole legacy i passi non attivi risultavano tutti visibili (impilati sopra il riepilogo). Regola minima aggiunta in `resources/css/design-comuni/overrides.css`: `body:has(.page-content[data-dc]) .fi-sc-wizard-step:not(.fi-active){display:none}`.
- Footer Filament: `components/wizard.blade.php` lo mostra solo se `! isLastStep()` (`x-show`); l'ultimo passo ha la propria navigazione (`wizard/summary-step` con `steps-nav`).
- Barra dei passi: `components/wizard/stepper.blade.php` riscritta con le classi del riferimento (`<ul><li class="confirmed|active">`, icona `steppers-success`, testi `visually-hidden`), stato da Alpine (`<template x-if>`).

## Impatto dichiarato sui passi 1-2
Sulla pagina reale i passi 1 e 2 non hanno piu' lo shell legacy: campi Filament con lo stile base e testi grezzi (`fixcity::ticket_form.sections.*`) finche' non arrivano le viste `dc-*` della sessione sul wizard (DCP-35 modulo: P2-A/B/C, "non cablate"). Misurato prima: passo 1 pixel 71-76%, passo 2 52-53%, quindi nessun passo indietro rispetto a un livello gia' basso, ma e' una regressione visiva da chiudere.

## Acceptance criteria
1. Passi 1 e 2 con altissima parity (DCP-35 modulo / DCP-32 e DCP-33 wizard-step) senza ripristinare regole legacy `.fi-*`.
2. Nessuna regola per slug; nessuna classe sul `<body>`.
3. Quando i passi 1-2 sono cablati, la regola dei passi inattivi in `overrides.css` si rimuove o si conferma con la motivazione.
4. Sentinelle ogni volta: `/it` identica a `home-before.png`, `/it/tickets` invariata, 4 pagine di prova a campione.

## Navigazione dei passi 1-2 (14:35, sessione tema): footer di ripiego Design Comuni
Il footer Filament (`Annulla / Successivo / Salva`) senza lo shell legacy era testo grezzo. `components/wizard.blade.php`: le azioni canoniche di Filament restano nel DOM ma nascoste (`hidden`, `x-show="false"`, servono a `$wire.save()` e ai test), e c'e' una navigazione Design Comuni visibile sui passi non finali: **passo 1** = solo "Avanti" (`btn btn-primary mobile-full`, come il riferimento `segnalazione-01-privacy`); **passi intermedi** = `cmp-nav-steps` con Indietro / Avanti (sprite dell'helper `DesignComuniAssets`). Niente "Salva richiesta": nel wizard `save()` CREA il ticket (il pulsante omonimo del riferimento e' una bozza che non esiste). Testi da `nav.next_step` / `nav.back` / `nav.aria_label` nel JSON di `tickets.create` (it/en, 3 copie).
**Contratto per le viste dei passi** (DCP-43 passo 2, DCP-46 passo 1): se la vostra vista ha la propria navigazione, mettete l'attributo `data-wizard-nav` sul suo contenitore: il ripiego si nasconde da solo (`overrides.css`: `.fi-sc-wizard:has(.fi-sc-wizard-step.fi-active [data-wizard-nav]) .dc-wizard-footer{display:none}`). Senza l'attributo non si duplica ma nemmeno si nasconde: non rimuovete il ripiego prima di avere la navigazione in vista.
Provato in browser con l'account di prova (DCP-98), 0 errori: passo 1 mostra solo "Avanti"; senza consenso non avanza; con il consenso arriva al passo 2 (barra dei passi: 1 confermato con icona, 2 attivo), dove compaiono Indietro e Avanti; Indietro torna al passo 1.
