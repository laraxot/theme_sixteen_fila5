---
type: decision
slug: tickets-index-production
status: applicato
filosofia: il servizio pubblico mostra le segnalazioni dell'utente con trasparenza — non anonimo, ma responsabile; il cittadino vede il proprio atto di cura del bene comune
scopo: /it/tickets (produzione, NON tests) — elenco segnalazioni dell'utente autenticato, con stato, data, luogo (geo persistente da wizard), descrizione breve
funzionalita: card per ogni segnalazione (stato badge, data, luogo, descrizione troncata); link a dettaglio completo; filtro per stato; multilingua it/en; mobile-responsive
norme-legislative: trasparenza amm. (D.Lgs. 33/2013 — dati aperti); accessibilità (L. 4/2004 — WCAG 2.1 AA); privacy (GDPR 2016/679 — solo dati dell'utente autenticato, nessun accesso a segnalazioni altrui); dichiarazione valore pubblico (già in wizard JSON callout)
zen: il cittadino non è un numero — ogni segnalazione è un atto nominativo; l'elenco riflette la responsabilità
second-brain: kp-174d15a58ff94901b2b0df0d86b8907a (aperto, auth-state, mappa geo persistente, multilingua, mobile, accessibilità, anticorpo)
antierrore: ls prima di slug; tickets.index.json (produzione) NON tests.index; design-system/ NON creato; docs in Sixteen/docs/
title: "/it/tickets — Segnalazioni Elenco (Produzione)"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets   segnalazioni elenco (produzione) sixteen"
---
# /it/tickets — Segnalazioni Elenco (Produzione)

JSON: `laravel/config/local/fixcity/database/content/pages/tickets.index.json` — produzione, NON `tests.tickets-index`.
Login richiesto (auth) — solo segnalazioni dell'utente (`marco.sottana@gmail.com`).
Riferimento visual parity: `https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html`.
Componente card: stato badge (in attesa / lavorazione / completata), data, luogo (mappa statica geo persistente dal wizard step 2), descrizione breve.
Mobilità: grid responsive 1 colonna su mobile, 2-3 su tablet/desktop.
Multilingua: `content_blocks` it/en in JSON.
