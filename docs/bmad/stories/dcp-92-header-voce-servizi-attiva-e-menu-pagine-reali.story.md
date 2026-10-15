---
id: dcp-92
title: "DCP-92: header Design Comuni: voce 'Servizi' attiva sulle pagine dei servizi e delle segnalazioni"
type: story
epic: dc-parity-v2
status: in-review
priority: P2
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "header design comuni voce servizi attiva active nav-link data-element all-services pagine servizi segnalazione"
related: [dcp-14, dcp-21, dcp-34]
tags: [docs, sixteen, bmad]
---

# DCP-92: la voce "Servizi" attiva nell'header

## Difetto noto
Nel riferimento le pagine della famiglia `servizi/*` e i passi delle segnalazioni mostrano la voce di menu **Servizi** attiva (sottolineata, `nav-link active`, `data-element="all-services"`); il nostro header non la attiva mai. Visibile in tutte le schermate di confronto (es. conferma reale a 1440 px). Costa 1-2 token di HTML e una piccola banda di pixel nella barra del menu; era gia' emerso in DCP-14 e DCP-21.

## Approccio (zero codice per pagina)
Un solo dato nel JSON della pagina (per esempio `header.active: "all-services"`) letto da `sections/header/design-comuni.blade.php`, oppure derivato dalla sezione del menu che contiene l'URL corrente. Il layout `design-comuni*` passa il dato alla vista come fa gia' per `dcSignedIn`. Va deciso se il dato sta nel JSON della pagina (esplicito) o si deduce dal percorso (implicito): preferire l'esplicito.

## Acceptance criteria
1. `permessi-scheda-servizio` (e le altre `servizi/*` che nel riferimento hanno la voce attiva) e `segnalazione-0N` mostrano `nav-link active` solo dove la ha il riferimento (verificare con `curl` sul riferimento prima di impostare il dato).
2. Pixel e HTML delle pagine gia' misurate non peggiorano (sweep sulle 37 pagine delle onde 1-2 e sentinelle).
3. Nessuna regola legacy riattivata.

## Fatto (2026-10-13, sessione tema)
Scansione del riferimento (81 pagine del manifest, `<header>` di ciascuna): voce attiva **Servizi** su 52, **Novita'** su 6, **Amministrazione** su 2, **Vivere il Comune** su 1, **nessuna** su 20 (home, accessi, aree personali di alcune famiglie). Dato nel JSON: `header_active` (valore = `data-element` della voce: `all-services`, `news`, `management`, `live`) nel primo blocco di ciascuna pagina; 128 JSON aggiornati (tenant e modulo) piu' `tickets.create` e `tickets.confirmation` (`all-services`, come `segnalazione-03/04`). Le pagine Folio leggono `$page->content_blocks[0]->data->header_active` (le chiavi nuove a livello pagina non sono leggibili: `Page` ha uno schema fisso, provato con `access_policy`), lo passano al layout (`headerActive`) che lo condivide come `dcHeaderActive`; `sections/header/design-comuni` mette `active` sulla voce corrispondente. Misure dopo: `permessi-scheda-servizio` HTML 90,08 / 98,16 (era 97,95), pixel 99,69; `evento-dettaglio` 90,15 / 97,85, pixel 98,81 (era 98,82); `segnalazione-03-riepilogo` 93,31 / 97,94, pixel 99,72. Stato: in revisione (resta lo sweep completo a fine giornata).
