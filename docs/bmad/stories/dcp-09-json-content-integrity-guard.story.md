---
id: dcp-09
title: "DCP-09: guardia sull'integrita' dei JSON di contenuto"
type: story
epic: dc-parity-v2
status: todo
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-09: guardia sull'integrita' dei json di contenuto bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-09: guardia sull'integrita' dei JSON di contenuto

## Evidenza
Il 2026-10-13 due pagine rispondevano 500 con `CMS content collision: matched 2 records for slug [...]`: nella stessa cartella `homepage.json` e
`tests.homepage.json` (poi `risultati-ricerca.json` e `tests.risultati-ricerca.json`) dichiaravano lo stesso `slug`. La stessa coppia tenant/modulo con lo
stesso slug e' invece un override voluto (il tenant vince).

## Da fare
1. Test Pest in `Modules/Cms` (owner di `Page`/Sushi): per ogni cartella `database/content/pages`, nessuno slug duplicato; nome file = `slug` per le pagine `tests.*`.
2. Messaggio d'errore con i due percorsi dei file in conflitto (oggi mostra solo `id` e `slug`).
3. Documentare in `Modules/Cms/docs` e `Modules/Fixcity/docs` la convenzione `tests.<slug>.json` e la regola tenant su modulo.

## Criteri di accettazione
- Il test fallisce se si ricrea `homepage.json` accanto a `tests.homepage.json`; passa sullo stato attuale.
