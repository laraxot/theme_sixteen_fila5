---
title: "Header and footer visual parity report"
type: parity
tags: [design-comuni, header, footer, playwright, parity, wcag]
qmd: "Sixteen header footer visual parity 90 HTML 95 visual"
status: draft
updated: 2026-10-11
---

# Header/footer — parity verificata

## Metodo

- Reference: `https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html`
- Local: `http://192.168.1.40:8000/it/tests`
- Browser: Playwright Chromium, viewport desktop 1440×900 e smoke responsive
  375×900 / 768×900
- Runtime: TailwindCSS + Alpine.js + Flowbite; nessun asset Bootstrap Italia

## Risultati runtime

| Gate | Reference | Local | Esito |
|---|---:|---:|---|
| header desktop | 222px | 222px | PASS |
| footer desktop | 775px | 775px | PASS |
| HTTP status | 200 | 200 | PASS |
| errori JavaScript | 0 | 0 | PASS |
| overflow orizzontale | no | no | PASS |
| link `href="#"` in shell | non applicabile | 0 | PASS |
| asset Bootstrap Italia nel DOM | riferimento storico | 0 | PASS |

## Verifica della sorgente dati (2026-10-11)

Con Puppeteer sono state aperte `/it/tests` e `/it/tests/homepage`. Entrambe
rispondono `200`, hanno `#site-header` e `#footer`, nessun page error, nessun
overflow e nessun `href="#"` nella shell. Il testo osservato prova che il
renderer riceve il blocco JSON: `Nome del Comune`, `Nome della Regione`,
`Amministrazione`, `Categorie di servizio`, `Novità`, contatti, social e link
legali sono presenti nel DOM.

Il controllo diretto del renderer con un blocco sintetico conferma inoltre che
`header.v1` e `footer.v1` non sostituiscono più `blocks` con props vuoti: brand,
navigation, columns e copyright arrivano al markup dal blocco CMS.

## Responsive

Il menu mobile resta chiuso di default, si apre con Alpine e conserva focus,
`aria-expanded` e `aria-controls`. I test Playwright a 375 e 768 px hanno
restituito HTTP 200, nessun errore pagina e nessun overflow.

## Mappa dei dati

Il markup è generato dai blocchi localizzati in:

- `config/local/fixcity/database/content/sections/header.json`;
- `config/local/fixcity/database/content/sections/footer.json`.

Il renderer non contiene il contenuto tenant: usa solo fallback FixCity quando
viene renderizzato direttamente senza blocchi nei test.

## Limite del report

Questa verifica chiude il parity gate delle due shell globali. Non dichiara che
ogni blocco del body delle pagine FixCity sia già al 95% rispetto a ogni pagina
statica Design Comuni: quel risultato richiede screenshot diff per ciascuna
pagina e viewport, come previsto dal backlog BMAD.
