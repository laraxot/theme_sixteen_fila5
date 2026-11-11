---
type: story
epic: dc-adozione-linee-guida-design-pa
status: open
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "WCAG 2.1 AA copertura 95% cp652 voletluce miglioramenti colloquio interattivo"
related: [dcp-04, dcp-13, dcp-158]
title: "DCP-163: semplicità di consultazione ed esperienza d’uso (Linee guida PA 4.3)"
tags: [docs, sixteen, bmad]
---
# DCP-163: semplicità di consultazione ed esperienza d’uso (Linee guida PA 4.3)

## Lacuna
Le Linee guida PA (sezione 4.3) richiedono:
- Utilizzo di linguaggio semplice
- Flessibilità del sito (scelta di testo, design, organizzazione delle informazioni)
- Accessibilità (DCP-158) e semplicità (DCP-04, DCP-13)
- Preavviso (avvisi formati di consenso; costi dei messaggi)
- Informazioni sulle procedure e sui formati (formati dati, descrittivi, calendari, informazioni privacy)

## Stato attuale
- DCP-04: 4 stati per ogni passaggio (FAQ accordion, modale termini, scheda ufficio, focus su input)
- DCP-13: valutazione CP652 del 2026-10-11 ha verificato che il testo dei blocchi di design-comuni funziona bene in “saldi”, “penetrare”, “parlare”, “vincere”, “personare”
- W3C WCAG 2.1 AA verificato in DCP-143 (audit manuale), DCP-158 (obiettivi annuali)
- 95% parità visiva sulle sei pagine confermata (DCP-97) tramite screenshot side-by-side (375/1440)

## Requisiti
1. Verificare che tutti i testi (dichiarazione, termini, FAQ, informazioni) usino il linguaggio semplice e la scrittura inclusiva (maschile/femminile neutro) come per DM 2017 e DPCM 2016
2. Assicurare che la navigazione (breadcrumb, menu) sia semplice e abbia un tempo obiettivo <3 clics verso la meta
3. Verificare che l’esperienza mobile mantenga la stessa semplicità e accessibilità del desktop
4. Audit dei tempi di risposta sulle procedure chiave (segnalazioni, prenotazioni, FAQ)

## Criteri di accettazione
- [ ] Tutti i formati dei messaggi usano testo semplice, neutro, inclusivo
- [ ] La navigazione ha breadcrumb, menu, link diretti, per tutto il sito in 1 clic (target)<3 (media)
- [ ] Widget mobile tappabili e menu compatti (altezza 48, clics <3)
- [ ] Temi di test associati alle realtà degli utenti locali (regionale, settore)
- [ ] Offerto placeholder (placeholder ritardo per utenti lente)

## Dipendenze
- DCP-04 (stati del colloquio)
- DCP-13 (valutazione del testo)
- DCP-158 (accessibilità / obiettivi annuali)
- DCP-143 (audit manuale)