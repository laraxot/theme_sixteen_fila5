---
id: DC-A11Y-002
title: "Rendere accessibili i controlli condivisi dell'header"
status: in-progress
type: story
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "user story sixteen"
---

# User story

Come cittadino, voglio scegliere la lingua, cercare, aprire il menu e accedere
all'area personale con mouse o tastiera, così da usare il sito senza dipendere da
icone, colore o precisione motoria.

## Acceptance criteria

- il cambio lingua è un button con `aria-expanded`, menu nominato e `aria-current`;
- ogni opzione lingua ha almeno 44px di altezza e focus visibile;
- CTA personale, ricerca, menu mobile e social hanno label accessibili e target >=44px;
- i link non hanno underline decorativa permanente sulle icone;
- `Escape` e click-outside chiudono il menu lingua;
- axe non segnala problemi su desktop e mobile.

## Owned scope

`Themes/Sixteen/resources/views/components/sections/header/tailwind.blade.php`,
`config/local/fixcity/database/content/sections/header.json`, CSS shell e verifier.

## Verification

Playwright snapshot + tab traversal + computed bounding boxes + axe WCAG 2.1 AA.
