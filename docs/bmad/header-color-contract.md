---
title: "Header Design Comuni color contract"
type: ux-contract
status: active
tags: [sixteen, design-comuni, header, accessibility]
updated: 2026-10-23
qmd: "header design comuni color contract sixteen"
---

# Header Design Comuni color contract

La slim bar (cambio lingua + Accedi) è la fascia di servizio Design Comuni:
deve restare **più scura** (`#00402b`) rispetto a center/nav (`#007a52`).
È il gioco di colori del chrome a tre livelli.

Su quella fascia scura, «Accedi» è **`btn-primary` `#007a52` con testo
bianco** — come su `fixcity.eu`. Il gioco cromatico è slim scura ≠
center/nav; Accedi è il CTA sulla slim, non un pill bianco (regressione
locale respinta dall'utente).

Il contratto vive in `resources/css/app/22-header-shell.css`, non nel Blade e
non in uno stile inline. Il focus e l'hover del controllo lingua usano una
variante intermedia (`#005238`) mantenendo testo bianco e contrasto leggibile.
La regola è scope-ata alle pagine `data-dc`, così non altera altri layout.

Sotto `data-dc`, Bootstrap Italia forza `.cmp-breadcrumbs { margin-top: 1.5rem/2rem }`:
quella striscia bianca sotto la navbar non è parte del chrome header. Il
contratto FO la azzera (`margin-top: 0`) nello stesso sheet, perché le
correzioni `ticket-parity` (`mt: 0`) sono isolate e non applicano.

Su mobile, `08-layout` + BI + `mobile-header-fix` spingono
`.it-header-navbar-wrapper` (`translateY(-50%)`, `margin-top:-22px`, sfondo
bianco) sulla slim e nascondono lingua/Accedi. Il contratto azzera
transform/margin, rende lo slot hamburger trasparente nel center e restaura
il background primario su Accedi. Dettaglio:
[fo-header-white-band.md](../../../../../docs/second-brain/fo-header-white-band.md).

Aggiornato: gioco slim scura + Accedi bianco (lingua); fascia bianca hamburger;
link da filament-blueprint + second-brain.
