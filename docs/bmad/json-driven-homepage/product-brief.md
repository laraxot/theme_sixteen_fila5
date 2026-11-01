---
title: "Product brief — Homepage FixCity Sixteen"
type: bmad-product-brief
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
issues:
  - https://github.com/laraxot/base_fixcity_fila5/issues/383
discussions:
  - https://github.com/laraxot/base_fixcity_fila5/discussions/392
status: draft
tags: [docs, sixteen, bmad]
qmd: "product brief sixteen"
---

# Product brief

## Obiettivo

Rendere la homepage Sixteen una pagina Folio minimale, allineata a TwentyOne,
con contenuti governati dal CMS JSON e con la stessa esperienza FixCity già
definita dalla vecchia Blade.

## Utenti e valore

- **Cittadino guest:** comprende il servizio, apre una segnalazione, accede o
  crea un account e consulta la mappa pubblica.
- **Cittadino autenticato:** raggiunge l'area personale e segue una pratica.
- **Editor/manutentore:** cambia ordine e dati dei blocchi nel JSON senza
  duplicare markup nella Folio page.

## Successo misurabile

- `home.json` è parseable e conforme allo schema delle pagine CMS.
- Le tre sezioni della vecchia homepage compaiono in ordine in tutti i locali.
- Ogni `data.view` esiste e viene risolto da `BlockData`.
- La Folio page contiene solo route name, layout e componente CMS.

## Fuori scope

Nuove funzionalità marketing, statistiche, testimonials, categorie aggiuntive,
nuovi endpoint, redesign CSS e correzioni PHPStan non necessari al payload.
