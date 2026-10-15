---
id: sixteenth-design-comuni-parity-nine-core-pages
title: Parity delle nove pagine core Design Comuni
status: in-progress
source: visual-reference-catalog
type: story
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story bmad: parity delle nove pagine core sixteen"
---

# Story BMAD: parity delle nove pagine core

## Obiettivo

Come cittadino, voglio che le preview `/it/tests` riproducano la struttura e la gerarchia visuale delle pagine ufficiali Design Comuni, così da poter validare il tema Sixteen prima di collegarlo ai contenuti FixCity reali.

## Scope

Index, homepage, segnalazione-dettaglio, segnalazioni-elenco, segnalazione-area-personale e gli step segnalazione 01 privacy, 02 dati, 03 riepilogo, 04 conferma. Il contenuto resta nel JSON tenant; Sixteen resta l'unico tema responsabile del rendering.

## Contratto dati

- `tests.index.json`: id, slug, layout `test`, navigation, sezioni e pagine.
- `tests.segnalazione-*.json`: titolo, step, descrizioni, CTA, contatti, riepiloghi e stato.
- Non esiste un fallback runtime a `tests.catalog.json`: ogni pagina deve avere
  il proprio `tests.<slug>.json` ed essere renderizzata da `<x-page>`.
- URL sempre tramite route Laravel/Folio; mai path hardcoded nei contenuti.

## Blocchi da verificare

1. Shell header/footer da section CMS.
2. Breadcrumb e hero pagina.
3. Navigazione step con stato corrente e focus.
4. Contenuto specifico dello step (privacy, dati, riepilogo, conferma).
5. Mappa/lista e cards per elenco segnalazioni.
6. Area personale, stati pratica e contatti.

## Acceptance criteria

- [ ] HTTP 200 e zero errori console per tutti i nove URL.
- [ ] HTML strutturale ≥90% rispetto alla reference, misurato per viewport.
- [ ] Visual similarity ≥98% a 375, 768 e 1440 CSS px; colori, forme, spaziature e wrapping inclusi.
- [ ] Nessun overflow orizzontale o immagine mancante.
- [ ] WCAG 2.1 AA: contrasto testo 4.5:1, componenti 3:1, focus visibile, tastiera, nomi accessibili e target touch ≥44px.
- [ ] Nessun runtime Bootstrap Italia/CDN; solo TailwindCSS, Alpine.js, Lit, DaisyUI e Flowbite.
- [ ] Verifica con `bashscripts/design-comuni/verify-parity.mjs`, Puppeteer audit e screenshots archiviati nel report temporaneo.

## File posseduti

- `laravel/Themes/Sixteen/resources/views/components/blocks/`
- `laravel/Themes/Sixteen/resources/views/components/sections/`
- `laravel/Themes/Sixteen/resources/views/pages/tests/`
- `laravel/config/local/fixcity/database/content/pages/tests.*.json`
- `bashscripts/design-comuni/`

## Rischi e decisioni

La reference include asset e markup Bootstrap Italia, ma il progetto non deve importare Bootstrap: si replica il comportamento visuale con token Tailwind e markup semantico. Una similarity sotto soglia va trattata come lavoro aperto, non come pass.
