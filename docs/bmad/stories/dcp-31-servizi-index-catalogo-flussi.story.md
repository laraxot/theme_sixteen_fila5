---
id: dcp-31
title: "DCP-31: catalogo dei flussi di servizio (servizi/index.html)"
type: story
epic: dc-parity-v2
status: done
priority: P2
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni servizi index catalogo flussi di servizio tests-index design-comuni-bare layout json page"
supersedes: catalog/DC-002-servizi-index.story.md
tags: [docs, sixteen, bmad]
---

# DCP-31: catalogo dei flussi di servizio

## Richiesta
`https://italia.github.io/design-comuni-pagine-statiche/servizi/index.html` come `http://192.168.1.40:8000/it/tests/servizi-index`: HTML body >= 90%, pixel >= 97% a 1920/1440/992/768/375 con altezze uguali. Era l'unica pagina del riferimento fuori dalle famiglie di DCP-19 (le altre 46 di `servizi/` stanno in DCP-21, 26..30).

## Baseline
`tests.servizi-index.json` esisteva (altra sessione, 10:31, solo tenant) con un blocco `catalog-page` e testi inventati: HTML 19,33% / 19,41% normalizzato. La story DC-002 (`catalog/`) puntava allo stesso riferimento: marcata `superseded` da questa.

## Come e' fatta (zero pagine Blade dedicate)
- Stesso blocco del catalogo `index`: `blocks/tests-index/design-comuni.blade.php`. Nel riferimento il pannello commentato e' "Sito" (`tab1`), quello visibile e' "Flussi di servizio" (`tab2`): il JSON ora indica `pane_id` (`tab1` | `tab2`) e, per sezione, `intro` e `note` (riga in grassetto "Esempio realizzato: ...").
- Layout dal JSON: il riferimento non ha header, footer ne' modale, come il catalogo. `pages/tests/[slug].blade.php` sceglie il layout con `Page::findUniqueBySlug('tests.<slug>')->layout`: `design-comuni-bare` se il JSON lo dichiara, altrimenti `design-comuni` (nessun cambio per le altre pagine). Niente file Folio per pagina.
- `tests.servizi-index.json` (tenant e modulo, identici) generato dal riferimento con uno script: 7 voci d'indice, 7 sezioni, 44 pagine elencate, link `/it/tests/<slug>`.
- `tests.index.json`: la scheda "Flussi di servizio" puntava a `/it/tests/servizi`, che e' `sito/servizi.html`; ora punta a `/it/tests/servizi-index` (la voce "Servizi" dell'elenco resta `/it/tests/servizi`).
- Manifest: riga `servizi/index.html` in coda a `scripts/design-comuni-pages.txt` (il CSS usato e' gia' quello del catalogo; rigenerazione al prossimo giro).

## Misure (parity-gate.sh, 2026-10-13)
| Pagina | HTML rigorosa / url-norm. | Pixel 1920 / 1440 / 992 / 768 / 375 | Altezze |
|---|---|---|---|
| servizi-index | 89,54 / 98,69 | 99,88 / 99,84 / 100 / 99,75 / 100 | 5630, 5630, 6119, 6670, 7659 (uguali) |
| tests (catalogo, dopo la modifica al blocco) | 89,32 / 98,4 | 99,9 / 99,87 / 100 / 99,78 / 100 | 4155, 4155, 4398, 4764, 5379 (uguali) |

Sentinelle: homepage 91,16 / 98,57 e servizi 90,81 / 98,24 invariate; `/it`, `/it/tickets`, `/it/tests/eventi` rispondono 200.

## Aperto
- HTML rigoroso 89,54 < 90 solo per il valore degli URL (nel riferimento `href="accesso-servizio.html"`, qui `/it/tests/accesso-servizio`): stessa decisione aperta dell'epic (alias di rotta vs gate normalizzato).
- Backup della fixture precedente fuori dal repo (scratchpad `dcp0-backup/`).

## Verifica dell'orchestratore (parity-sweep.sh, 2026-10-13, dopo rigenerazione CSS a 81 pagine)
Rimisurato io, non dall'agente. HTML rigorosa / normalizzata (pixel minimo, altezze): servizi-index 89.54 / 98.69 (pixel min 99.75, altezze uguali).
Stato: done con riserva: pixel >= 99,6% con altezze uguali su tutte le pagine; HTML rigoroso >= 90 su 0 di 1 (il resto per valori di `href`/`src`; le `*-area-personale` ora con header autenticato, `layouts/design-comuni-authenticated`).
