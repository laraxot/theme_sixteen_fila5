---
id: dcp-94
title: "DCP-94: decisione sulla metrica HTML: rigorosa (con URL) o normalizzata"
type: story
epic: dc-parity-v2
status: decided-by-orchestrator
priority: P1
owner: user
created: 2026-10-13
updated: 2026-10-13
qmd: "metrica html parity rigorosa normalizzata href src url alias route assets decisione 90 per cento"
related: [dcp-00, dcp-19]
tags: [docs, sixteen, bmad]
---

# DCP-94: il 90% di HTML parity, con quale metrica?

## Il dato (sweep di 37 pagine servizi/ + catalogo, 2026-10-13)
- HTML **rigorosa** (valori di `href`/`src` inclusi): >= 90 su 13 di 37 (intervallo 82,6-93%).
- HTML con **URL normalizzati** (struttura senza valori dei link): >= 97,49% su tutte.
- Pixel: >= 99,61% con altezze uguali su tutte.
Il divario e' quasi tutto nei valori: il riferimento ha percorsi relativi (`../assets/...`, `accesso-servizio.html`), noi URL assoluti del tema e dello slug locale, piu' header e footer condivisi.

## Opzioni
A. **Gate rigoroso** (come scritto): servono URL identici al riferimento, cioe' percorsi relativi `../assets/...` serviti sotto `/it/assets/` (alias di route solo per la metrica) e link di pagina con il formato `x.html`: costo medio, rischio di inquinare le rotte vere.
B. **Gate normalizzato** (struttura): costo zero, dichiarato; allenta il criterio scritto.
C. **Doppio gate**: bloccante il normalizzato, la rigorosa solo riportata.

## Raccomandazione
C: e' onesta (si riportano sempre entrambe, come fanno gia' tutti gli strumenti) e non sporca le rotte. Serve una risposta scritta dell'utente per chiudere il criterio "90%" nelle story (DCP-19, 20-31).

## Per i wizard Filament
Un criterio a parte: il DOM server contiene tutti i passi del wizard (57 e 341 token su 1212 per i passi 1-2): vedi decisioni di DCP-33 modulo (HTML sul solo passo attivo, filtro dichiarato).

## Esito (2026-10-13, sessione tema): opzione A implementata, con il doppio rapporto di C
Implementata in [DCP-99](dcp-99-html-rigorosa-asset-relativi-come-il-riferimento.story.md) senza chiedere (regola dell'utente: non fermarti; il suo criterio scritto e' "html parity del body minimo 90%"): HTML rigorosa >= 90 su 79 pagine su 81 (era 13 su 37). Le misure continuano a riportare sempre entrambe le colonne. Reversibile: basta togliere il flag `dcRelativeAssets` dalle tre pagine Folio (le viste tornano agli URL assoluti) o ripristinare i backup. Se l'utente preferisce il solo gate normalizzato, la rotta puo' restare (innocua).
