---
id: dcp-18
title: "DCP-18: servizi/accesso-servizio (pagina di accesso SPID, CIE, altre utenze)"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity accesso servizio spid cie access-page bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-18: accesso-servizio

## Richiesta
"fa https://italia.github.io/design-comuni-pagine-statiche/servizi/accesso-servizio.html" (cartella `servizi/`, non `sito/`).

## Baseline
Esisteva `tests.accesso-servizio.json` con 4 blocchi legacy. HTML body 74,14% (83,88% URL normalizzati); pixel 90,6 / 89,6 / 88,0 / 81,7 / 79,9% a 1920 / 1440 / 992 / 768 / 375 px; altezze 2167 contro 2235.

## Cosa e' stato fatto
- JSON `tests.accesso-servizio.json` (tenant e modulo): un solo blocco `access-page` (breadcrumb, titolo, tre metodi di accesso con `layout` single/row e pulsanti `variant` icon/outline, link, contatti variante `offset`).
- Blocco `components/blocks/access-page/design-comuni.blade.php`; icone `spid.svg` e `cie.svg` scaricate in `public/design-comuni/assets/images/`.
- Partial `dc-contacts` esteso con `contacts.layout = 'offset'` (wrapper `col-lg-6 offset-lg-3 p-contacts`, usato dalle pagine servizi) e gruppo "Problemi in citta'" opzionale.
- Pagina registrata in `scripts/design-comuni-pages.txt` (riga `servizi/accesso-servizio.html`).

## Risultato (misurato con `parity-gate.sh`)
- **Pixel 99,90 / 99,87 / 99,81 / 99,76 / 99,64%** a 1920 / 1440 / 992 / 768 / 375 px, **altezze identiche** (2167, 2215, 2258, 3079).
- **HTML body 85,54% rigoroso, 97,71% con URL normalizzati**: sotto il 90% rigoroso solo per i valori di `href`/`src` (le due immagini dei pulsanti hanno percorso relativo nel riferimento e assoluto da noi, piu' header e footer condivisi).
- Nota: il riferimento carica `bootstrap-italia.min.css` e `bootstrap-italia-comuni.css` (il secondo con attributi in ordine diverso nel tag `<link>`): lo stesso foglio delle altre pagine, quindi il chrome verde e' corretto.

## Come si controlla
```bash
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/servizi/accesso-servizio.html \
  http://192.168.1.40:8000/it/tests/accesso-servizio --fail-if-contains '|---LINE:'
```
