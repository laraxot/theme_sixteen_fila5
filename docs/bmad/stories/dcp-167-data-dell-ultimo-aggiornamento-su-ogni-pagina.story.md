---
id: dcp-167
title: "DCP-167: data dell'ultimo aggiornamento su ogni pagina"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "data ultimo aggiornamento pagina design comuni last update linee guida design 4.3.10 verifica contenuti"
related: [dcp-163, dcp-162]
tags: [docs, sixteen, bmad]
---

# DCP-167: data dell'ultimo aggiornamento su ogni pagina

## Lacuna e prova (2026-10-14)
Requisito 4.3.10 (Linee guida di design della PA, capitolo 4 «Requisiti» (versione corrente, letto il 2026-10-14), DOVREBBE): su ogni pagina la data dell'ultimo aggiornamento o verifica. Misura: assente in 41 combinazioni su 48; nelle 7 che contengono la dicitura e' un campo da compilare (dichiarazione di accessibilita', note legali).

## Norma
Linee guida di design 4.3.10 (raccomandazione). Il modello Design Comuni prevede «Ultimo aggiornamento» nel piede del contenuto.

## Requisiti
1. Componente unico `Ultimo aggiornamento: <data>` nel layout delle pagine di contenuto, con la data da `updated_at` del contenuto (JSON/CMS) o, per le pagine legali, dalla data fornita dall'ente.
2. Formato per lingua, `<time datetime>`.
3. Non per le pagine dinamiche (elenco, mappa, accesso), dove la data non ha senso: l'elenco delle pagine incluse sta nella story.

## Criteri di accettazione
- [ ] `lg-design-scan.py`: «senza data ultimo aggiornamento» scende da 41/48 al numero delle sole pagine escluse, elencate.
- [ ] Test: la data compare in 4 lingue con formato locale e `<time datetime>` valido.

## Dipendenze e priorita'
Raccomandazione (DOVREBBE), P2.
