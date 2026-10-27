---
id: dcp-175
title: "DCP-175: ricerca con utenti e test di usabilità (Linee guida design 4.3.3–4.3.6)"
type: story
epic: dc-parity-v2
status: needs-data
priority: P1
owner: theme:Sixteen
module: Sixteen
created: 2026-10-14
updated: 2026-10-14
qmd: "test usabilita ricerca utenti linee guida design 4.3.3 4.3.4 4.3.5 4.3.6 semplicita d uso"
related: [dcp-163, dcp-169, dcp-173]
tags: [docs, sixteen, bmad]
---

# DCP-175: ricerca con utenti e test di usabilità (Linee guida design 4.3.3–4.3.6)

## Lacuna e prova
La story DCP-163 («semplicità, consulenza ed esperienza d'uso») descrive il requisito ma non prevede
evidenze. Le Linee guida 4.3 prescrivono che i servizi siano progettati con ricerca sugli utenti e
verificati con test di usabilità. Nel repository compaiono solo riferimenti (DCP-49, DCP-55, DCP-123, DCP-09),
non un piano di ricerca, né registrazioni di sessioni con utenti reali. Il valore «SI DEVE» del cap. 4.3
rende l'assenza un gap, non un suggerimento.

## Norma
Linee guida di design per i servizi web della PA, cap. 4.3 «Semplicità d'uso» (4.3.3 ricerca con utenti,
4.3.4–4.3.6 test di usabilità e miglioramenti), versione corrente su `docs.italia.it`.
CAD art. 7 (qualità dei servizi).

## Requisiti
1. Piano di ricerca: obiettivi, profili (cittadino, operatore comunale), numero di partecipanti, compiti
   (segnalare un disservizio, seguire una segnalazione, trovare un'informazione legale).
2. Test eseguito su almeno un ciclo con utenti reali o rappresentativi, con report datato.
3. Ogni problema emerso è collegato a una story o marcato come accettato con motivazione.
4. Dati dei partecipanti trattati secondo l'informativa e senza registrazione audio/video senza consenso
   (coordinamento con il modulo Gdpr).

## Criteri di accettazione
- [ ] Piano di ricerca in `Themes/Sixteen/docs/compliance/` con data, responsabile e consenso dei partecipanti.
- [ ] Report del test con compiti, esito e problemi, collegato a DCP-163 e DCP-169.
- [ ] Ogni problema critico ha una story di correzione.
- [ ] La prova è citata in DCP-173 per i requisiti 4.3.3–4.3.6.

## Dipendenze e priorità
Dati necessari: numero di partecipanti disponibili, profili, periodo e responsabile (needs-data, owner: ente).
Dipende da DCP-163 e DCP-169. P1.

## Dev Agent Record
_(vuoto — da completare dallo sviluppatore)_
