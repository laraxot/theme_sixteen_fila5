---
title: "Design Comuni — workboard completo"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "design comuni   workboard completo sixteen"
---
# Design Comuni — workboard completo

## Fonte

Il catalogo ufficiale contiene 38 route HTML (37 link `.html` più la homepage root). Il catalogo locale è il riferimento per gli slug e non autorizza pagine Blade dedicate: ogni pagina passa dalla route Folio generica e dal CMS JSON.

## Onde randomizzate

L'ordine è randomizzato solo tra storie con scope disgiunto; le dipendenze tecniche restano obbligatorie.

| Onda | Pagine | Scope |
|---|---|---|
| A | mappa-sito, servizio-dettaglio, assistenza-02-conferma | blocchi distinti e fixture proprie |
| B | lista-risorse, argomento, appuntamento-03-dettagli | blocchi editoriali/flow distinti |
| C | novita, lista-categorie, servizi-categoria | listing e categorie |
| D | appuntamento-01-ufficio, appuntamento-01-ufficio-luogo, appuntamento-04-richiedente | wizard |
| E | appuntamento-04-richiedente-autenticato, appuntamento-05-riepilogo, appuntamento-06-conferma | wizard finale |
| F | lista-risorse-categorie, servizi, servizi-index | catalogo servizi/risorse |
| G | appuntamento-02-data-orario, assistenza-01-dati, tutte le pagine già coperte | integrazione e gate finale |

Le storie di ogni pagina sono in `docs/bmad/stories/pages/`. Nessuna storia può modificare il file di un'altra pagina; i blocchi condivisi e header/footer sono serializzati in una storia di integrazione.

## Gate per ogni pagina

1. Fixture valida con `jq`, `id` e `slug` completi (`tests.<slug>`).
2. Nessuna view dichiarata nel JSON mancante.
3. HTTP 200, nessun errore console/request e asset caricati.
4. Nessun overflow a 375/768/1440 px.
5. Screenshot locale/reference e confronto DOM/pixel archiviati in `docs/bmad/evidence/<slug>/`.
6. WCAG: heading/label/focus/target size/contrasto verificati.
7. Solo dopo il gate la story passa a `done`.

## Stato iniziale rilevato

Fixture individuali presenti dopo questa onda: 23/38. Sono state implementate in ordine randomizzato `mappa-sito`, `servizio-dettaglio`, `novita`, `servizi` e `servizi-index`; restano 15 fixture individuali. Le storie dedicate esistono per tutte le pagine mancanti. `tests.catalog.json` non sostituisce le fixture CMS finali: è solo catalogo/preview.

## Stack bloccato

TailwindCSS + Alpine.js + Lit + DaisyUI + Flowbite. Bootstrap Italia non deve essere aggiunto come CDN, asset runtime o dipendenza della nuova implementazione.
