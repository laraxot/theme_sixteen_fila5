---
id: dcp-08
title: "DCP-08: amministrazione a 90% HTML / 97% visual"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-08: amministrazione 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-08: Amministrazione (scelto casualmente dentro design-comuni-pagine-statiche)

## Scelta pagina riferimento
`https://italia.github.io/design-comuni-pagine-statiche/sito/amministrazione.html` (fetched + indexed); locale: `/it/tests/amministrazione` (JSON `tests.amministrazione.json` esistente, componente `governance/cards.blade.php` esistente con 90%+ HTML già verificato per homepage).

## Struttura riferimento (estratta con ctx_search / fetch)
- Header (logo + nav + search + language) — già nel layout `test.blade.php`
- Breadcrumb (`cmp-breadcrumbs`) — esiste in `tests.amministrazione.json`
- Hero (`#Amministrazione` + intro) — esiste nel JSON
- Sezione "In evidenza" (3 card: Sindaco, Turismo, Pianificazione) — card-grid esiste
- Sezione "Esplora l'amministrazione" (7 link: Aree amministrative, Documenti, Organi, Personale, Politici, Uffici) — MISSING in local (deve aggiungersi)
- Rating componente (`#rating`) — MISSING
- Contatti comune — MISSING
- Cerca nel sito — MISSING

## Componenti già presenti (rilevati)
- `components/blocks/governance/cards.blade.php` — 90%+ HTML, struttura card con immagine + descrizione + link
- `tests.amministrazione.json` — breadcrumb + hero + card-grid

## Correzioni richieste (BMAD + second brain D22)
1. Aggiungere sezione "Esplora l'amministrazione" con 7 link (Aree / Documenti / Organi / Personale / Politici / Uffici) nel JSON `content_blocks`
2. Aggiungere rating (`rating` object) nel JSON
3. Aggiungere contatti (`contacts`) nel JSON
4. Verificare button "Cerca" con `#007A52` (già corretto in `search-results.blade.php`; applicare anche qui se presente)
5. Screenshot 375 / 768 / 1440 con Playwright + `compare-screenshots.mjs`; target: parity ≥97% a 768/1440

## Decisional (second brain)
D22: Scelta pagina casuale (`amministrazione`) valida — JSON esistente, componente governance presente, pagina non ancora a 97% ma con base solida. Non creare nuovo componente se `cards.blade.php` è sufficiente.

## Stack (D4)
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament — NO Bootstrap Italia CDN. Token primario `#007A52`.
