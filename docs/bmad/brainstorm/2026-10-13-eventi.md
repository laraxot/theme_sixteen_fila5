---
title: "BMAD Brainstorm — `eventi`"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad brainstorm   `eventi` sixteen"
---
# BMAD Brainstorm — `eventi`

## Obiettivo

Replicare `sito/eventi.html` sulla route generica `/it/tests/eventi`, mantenendo la composizione JSON-driven e senza creare una Blade page-specific sotto `pages/tests`.

## 5 Whys

1. Perché la pagina appariva diversa? Il desktop mostrava due colonne invece di tre.
2. Perché? Il markup usava `col-xl-4`, ma il CSS estratto per le pagine già trattate non conteneva quella utility.
3. Perché non era stato rilevato prima? Il controllo iniziale contava le card ma non verificava la larghezza computata per breakpoint.
4. Perché il problema non era nel JSON? La fixture conteneva già sei eventi e sei luoghi, con hero e metadati dinamici.
5. Qual è il guardrail? Per ogni pagina misurare `getBoundingClientRect()` di una card, numero di colonne, `scrollWidth` e risposte di rete a 375/768/1440 px.

## Mappa della soluzione

`Folio [slug]` → `tests.eventi` → `tests.eventi.json` → `events-page/design-comuni.blade.php` → CSS scoped Design Comuni → partial rating/contacts → sections header/footer.

## Decisioni

- La fixture attiva è `laravel/config/local/fixcity/database/content/pages/tests.eventi.json`.
- Il blocco unico `events-page` riceve hero, sezioni, immagini, calendario card, CTA e testo dal JSON.
- La correzione responsive vive in `design-comuni/overrides.css`, scoped a `tests.eventi`.
- Si usa Tailwind/Vite e il CSS locale già estratto; non si aggiunge Bootstrap Italia runtime/CDN.
- La differenza visiva va misurata con screenshot e diff, non inferita dal solo conteggio DOM.

## Verifica eseguita

- Playwright: `375`, `768`, `1440` px.
- HTTP locale: `200`.
- Console locale: nessun errore.
- Risposte locali `>=400`: nessuna.
- Overflow orizzontale: assente (`scrollWidth == innerWidth`).
- Card: `13` totali, con tre colonne a `1440` px.

## Rischi aperti

- La percentuale html/pixel non è ancora certificata da uno script di diff normalizzato.
- Un eventuale PHP Debugbar locale può contaminare gli screenshot di sviluppo; va escluso dal confronto o disabilitato nell'ambiente di misura.
