---
title: "Header Design Comuni color contract"
type: ux-contract
status: active
tags: [sixteen, design-comuni, header, accessibility]
---

# Header Design Comuni color contract

La slim bar che contiene cambio lingua e accesso all'area personale è una
fascia di servizio distinta dalle bande principali del brand. Deve restare
più scura (`#00402b`) rispetto al centro header e alla navigazione (`#007a52`):
la differenza crea gerarchia visiva e rende riconoscibili le funzioni di utilità.

Il contratto vive in `resources/css/app/22-header-shell.css`, non nel Blade e
non in uno stile inline. Il focus e l'hover del controllo lingua usano una
variante intermedia (`#005238`) mantenendo testo bianco e contrasto leggibile.
La regola è scope-ata alle pagine `data-dc`, così non altera altri layout.
