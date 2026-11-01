---
type: decision
slug: header-auth-logic-area-personale
status: applicato
filosofia: il servizio pubblico richiede responsabilità; l'area personale non è anonima ma nominativa (nome reale dell'utente autenticato)
scopo: "mostrare stato (guest / auth) con chiarezza; non 'Mario Rossi' ma identità reale dell'utente (account di test fornito fuori repo: variabili DC_EMAIL e DC_PASS)"
funzionalita: non loggato → link 'Accedi all'area personale' (route login); loggato → mostra dati utente reale + link pagine area personale
norme-legislative: multilingua (it/en), mobile responsive, accessibilità (aria-label, focus-visible), GDPR (autenticazione richiesta per dati personali), dichiarazione valore pubblico (callout wizard)
zen: passo invisibile = identità verificata; poi accesso all'area personale con trasparenza e responsabilità
second-brain: kp-174d15a58ff94901b2b0df0d86b8907a (aperto, auth-state, multilingua, mobile, accessibilità)
antierrore: verificare file con ls/find (tests.tickets-create NON esiste; tickets.create.json corretto); no design-system/ root; docs in Sixteen/docs/
title: "Header — Logica Autenticazione Area Personale"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "header   logica autenticazione area personale sixteen"
---
# Header — Logica Autenticazione Area Personale

Comportamento basato su stato autenticazione (`auth()->check()`):
- Guest: link "Accedi all'area personale" → `route('login')` (multilingua it/en)
- Autenticato: mostra nome reale dell'utente (non fittizio; letto dal DB utente); link alle pagine area personale (segnalazione, graduatoria, permessi, vantaggi, pagamenti)

Perché non anonimo: l'area personale gestisce dati sensibili; la responsabilità richiede identità.
