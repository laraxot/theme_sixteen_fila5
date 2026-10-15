---
id: dcp-105
title: "DCP-105: versione inglese delle 82 pagine di prova (oggi /en/tests/* risponde 200 ma senza contenuto)"
type: story
epic: dc-parity-v2
status: needs-decision
priority: P2
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "versione inglese en pagine di prova tests json content_blocks traduzione locale fallback lingua"
related: [dcp-00, dcp-19]
tags: [docs, sixteen, bmad]
---

# DCP-105: le pagine di prova non hanno l'inglese

## Misurato (2026-10-13)
`tests.*.json` nel tenant: 83 file; **82 hanno `content_blocks.it` pieno e `content_blocks.en` vuoto** (uno solo ha entrambe le lingue). `GET /en/tests/eventi`, `/en/tests/homepage`, `/en/tests/permessi-scheda-servizio` rispondono 200 con header e footer (che hanno l'inglese) ma **senza il `<h1>` e senza il contenuto**: il blocco della pagina non viene reso. Il riferimento (design-comuni-pagine-statiche) e' solo italiano: nessun obbligo di parity, ma una pagina vuota non e' accettabile come comportamento di lingua.

## Opzioni (nessuna applicata)
A. **Traduzione vera**: 82 file JSON, tradurre solo i valori visibili (non `view`, `url`, `icon`, `class`, `element`, `layout`), struttura identica a `it`; fattibile con 6 agenti in parallelo (~14 file ciascuno) e uno script di controllo che confronta le chiavi di `it` ed `en` (stessa struttura, nessuna stringa italiana rimasta, nessun URL toccato, tenant e modulo identici). Costo alto (centinaia di migliaia di caratteri di testo), rischio di traduzione imprecisa per i testi giuridici (privacy, termini).
B. **Ripiego esplicito**: se `en` e' vuoto la pagina usa i blocchi `it` con `lang="it"` sul contenuto (accessibilita': dichiara la lingua del testo). Una riga nella pagina Folio condivisa o in `Page::getBlocksBySlug` (modulo Cms, impatto su tutti i tenant: da valutare). Zero traduzioni, nessuna pagina vuota.
C. **Non servire `/en/tests/*`**: 404 per le pagine di prova (sono strumenti di sviluppo, non pagine pubbliche).

## Raccomandazione
B ora (poco costoso e onesto) e A come lavoro separato solo per le famiglie che andranno in produzione (le pagine reali del flusso segnalazione hanno gia' l'inglese: `tickets.create`, `tickets.confirmation`). Serve la decisione dell'utente; nel frattempo non cambia nulla.

## Guardia suggerita
Test solo filesystem: se un `tests.*.json` ha `en` non vuoto, ha le stesse chiavi di `it` (stessa struttura) e nessun testo uguale all'italiano tra le chiavi di testo.
