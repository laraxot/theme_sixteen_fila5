---
type: story
epic: dc-adozione-linee-guida-design-pa
status: open
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "monitoraggio sito web 24/7 rilevazione errori uptime prestazioni pageload pageview CQ"
related: [dcp-101, dcp-102, dcp-104, dcp-141]
title: "DCP-164: monitoraggio dei servizi (Linee guida PA 4.4)"
tags: [docs, sixteen, bmad]
---
# DCP-164: monitoraggio dei servizi (Linee guida PA 4.4)

## Lacuna
Le Linee guida PA (sezione 4.4) richiedono:
- Monitoraggio continuo del sito web (uptime, performance, tempi di risposta)
- Rilevazione e correzione automatica dei problemi (24/7)
- Statistiche sull'uso (pageview, interazione, accessi)
- Comunicazione al responsabile del servizio (DCP-141)

## Stato attuale
- DCP-101: service flow consolidato per i principali servizi (segnalazione, prenotazioni, FAQ, prassi, comunicazioni, commissione)
- DCP-102: tickets (create, track, guest) e percorsi pubblici/vet BERT (DCP-70)
- DCP-104: pagine reali-elenco e dettagli segnare normale, ordine dati debole
- DCP-141: responsabile del procedimento è riuscito a comunicare con il sistema DPR (monitoraggio)

## Requisiti
1. Assicurare che la pagina di monitoraggio (`/monitoraggio` o equivalente) esista e sia accessibile
2. Rilevamento automatico di 503 e tempi di risposta >10s — trigger email (adottato per pipeline CI/CD)
3. Pageview KPI: `/it`, `/it/tickets`, `/it/segnalazione`, `/it/segnalazione-dettaglio`, `/it/eventi`
4. Effettuare il rilevamento automatico da server / middleware

## Criteri di accettazione
- [ ] Pagina `/monitoraggio` accessibile da una pagina di conoscenza del sito
- [ ] Fallback con tempi di risposta rapidi (<3s) e rilevamento dei minuti di attività
- [ ] Correzione automatica dei problemi (allarmi dev-port) integrata nella pipeline CI/CD
- [ ] Alert via email al responsabile del servizio (DCP-141) su avviso (>5%), uptime >99,9%
- [ ] Statistiche visibili con KPI rilevanti per ogni utente e responsabile del servizio

## Dipendenze
- DCP-101 (flusso di servizio consolidato)
- DCP-102 (gestione dei tickets)
- DCP-104 (pagine reali)
- DCP-141 (responsabile del servizio)