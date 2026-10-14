---
id: dcp-09
title: "DCP-09: evento-dettaglio a 90% HTML / 97% visual"
type: story
epic: dc-parity-v2
status: in-progress
priority: P0
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity dcp-09: evento-dettaglio 90% html 97% visual bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-09: Evento Dettaglio (scelto da design-comuni-pagine-statiche)

## Scelta pagina riferimento
`https://italia.github.io/design-comuni-pagine-statiche/sito/evento-dettaglio.html` (fetched + indexed, 33 sezioni); locale: `/it/tests/evento-dettaglio` (JSON `tests.evento-dettaglio.json` da creare).

## Struttura riferimento (estratta con ctx_search / fetch)
- Breadcrumb: Home → Vivere il Comune → Eventi → Evento Dettaglio
- Hero: Titolo "363^ Festa di Sant'Efisio", eyebrow "Festival", date "dal 01 maggio 2019 al 04 maggio 2019"
- Condividi: Facebook, Twitter, LinkedIn, WhatsApp
- Azioni: Stampa, Ascolta, Invia
- Argomenti: Cultura, Vivere la città
- Immagine principale + didascalia
- Sezione "Cos'è?" (descrizione lunga, più paragrafi)
- Parteciperanno (lista nomi)
- Galleria di immagini (6 thumbnail con caption)
- Video (con trascrizione)
- Footer contatti

## Componenti necessari (da creare/verificare)
- `components/blocks/event-detail.blade.php` — nuovo componente per dettaglio evento
- `components/blocks/share-actions.blade.php` — condividi + azioni
- `components/blocks/image-gallery.blade.php` — galleria thumbnails
- `components/blocks/video-player.blade.php` — video + trascrizione

## Correzioni richieste (BMAD + second brain)
1. Creare JSON `tests.evento-dettaglio.json` con struttura completa
2. Creare componenti Blade mancanti
3. Verificare button "Cerca" se presente con `#007A52`
4. Screenshot 375 / 768 / 1440 con Playwright + `compare-screenshots.mjs`; target: parity ≥97% a 768/1440

## Decisional (second brain)
D23: Nuova pagina evento-dettaglio — richiede componenti dedicati per gallery, video, share. Stack identico a dcp-08 (Tailwind+Alpine+Lit+DaisyUI+Flowbite+Filament, NO Bootstrap).

## Stack (D4)
TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite + Filament — NO Bootstrap Italia CDN. Token primario `#007A52`.