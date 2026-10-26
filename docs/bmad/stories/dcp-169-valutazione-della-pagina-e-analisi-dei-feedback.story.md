---
id: dcp-169
title: "DCP-169: valutazione della pagina («Quanto sono chiare le informazioni?») e analisi periodica dei feedback"
type: story
epic: dc-parity-v2
status: ready-for-dev
priority: P2
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "valutazione pagina feedback soddisfazione quanto sono chiare le informazioni design comuni rating cad articolo 7 linee guida design 4.4.4 4.4.5"
related: [dcp-157, dcp-163, 8.8]
tags: [docs, sixteen, bmad]
---

# DCP-169: valutazione della pagina («Quanto sono chiare le informazioni?») e analisi periodica dei feedback

## Lacuna e prova (2026-10-14)
Requisiti 4.4.4-4.4.5 (Linee guida di design della PA, capitolo 4 «Requisiti» (versione corrente, letto il 2026-10-14)): gli utenti devono poter comunicare soddisfazione e difficolta' (DEVE) e i feedback vanno raccolti, analizzati e valutati (DEVONO). Misura: la valutazione della pagina e' presente in 4 combinazioni su 48; esiste la valutazione del ticket risolto (modulo Rating) e il modulo di feedback sull'accessibilita' (DCP-132), ma nessuna analisi periodica.

## Norma
Linee guida di design 4.4.4-4.4.5; CAD art. 7 c. 3 (soddisfazione dell'utente), gia' in DCP-157.

## Requisiti
1. Componente Design Comuni «Quanto sono chiare le informazioni su questa pagina?» (valutazione da 1 a 5 e, se bassa, motivo) in fondo alle pagine di contenuto, in 4 lingue, accessibile da tastiera.
2. Salvataggio senza dati personali (pagina, lingua, voto, data, nessun IP in chiaro), con freno agli abusi.
3. Vista per gli operatori con la media per pagina e periodo, e rapporto periodico (mensile) che alimenta il gate 8.8.
4. DCP-157 pubblica gli aggregati del servizio: qui si raccolgono quelli delle pagine.

## Criteri di accettazione
- [ ] La valutazione compare su tutte le pagine di contenuto e non sulle pagine dinamiche elencate.
- [ ] Test: il voto si salva senza IP, il freno scatta, la vista aggrega.
- [ ] axe senza violazioni sul componente in 4 lingue.

## Dipendenze e priorita'
Collegata a DCP-157 e al modulo Rating. P2.
