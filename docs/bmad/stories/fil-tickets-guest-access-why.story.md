---
id: fil-tickets-guest-access-why
type: bmad-story
status: superseded
links:
  github_issue: #999
  discussion: #design-comuni
title: "/it/tickets/create — Guest Access ('middleware': ['web','guest'])"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "/it/tickets/create   guest access ('middleware': ['web','guest']) sixteen"
---
> **Story NON autorevole, superseded da DCP-42** (`Modules/Fixcity/docs/stories/dcp-42-tickets-create-auth-regressione.story.md`), verificato 2026-10-13: (1) la "Reference" e' falsa: `tickets.create.json` non ha mai avuto `"middleware": ["web","guest"]` (git: una sola versione, senza `middleware`); (2) `guest` e' un middleware per le pagine di login: reindirizza gli utenti GIA' autenticati e non protegge nulla; (3) `web` non e' risolvibile da `PageSlugMiddleware` (500); (4) il salvataggio richiede un proprietario (`owner_id`, email di conferma), quindi un ospite compilerebbe tutto per ricevere `ticket.auth.required` all'invio. La tesi "accesso come diritto" e' legittima ma richiede un backend con ticket anonimi (nuova colonna/politica: chiedere prima), non un middleware. Il valore giusto e' `["auth"]`. Regola "R009" citata sotto: da non applicare.

# /it/tickets/create — Guest Access ("middleware": ["web","guest"])

> **Superata.** La decisione corrente è DCP-42: `tickets.create` richiede `auth`
> prima del rendering del wizard. Questa story conserva il ragionamento storico
> guest e non è una fonte per nuove modifiche.

## WHY (philosophy / religion / politics / zen / logic)
Reference: `tickets.create.json` (line 147-148) already has `"middleware": ["web", "guest"]`.
- `/it/tickets/create` = segnalazione disservizio = servizio pubblico.
- Un servizo pubblico NON può richiedere autenticazione per la prima segnalazione — la trasparenza è il valore primario.
- Filosofia: l'accesso è un diritto (politica/religione: partecipazione civica = valore fondamentale, non privilegio).
- Zen: il flusso inizia senza barriere; la barriera (login) arriva SOLO dopo per seguire la pratica (tracking con numero pratica).
- Logica: se un cittadino deve loggarsi per segnalare un danno, il sistema fallisce la sua funzione primaria (trasparenza + partecipazione).
- Mappa (step 2) + conferma (step 4) lavorano per chiunque (guest) — la localizzazione non richiede identità.

## Evidence (existing JSON)
```json
"middleware": ["web", "guest"],
"access_policy": {
  "description": "Public service — no authentication required...",
  "guest_access": true,
  "auth_optional_for_tracking": true
}
```

## Second Brain Update
- R009 (new): pagine pubbliche (`segnalazione`, `tickets.create`) → `guest` middleware + `access_policy.guest_access = true`; login SOLO per tracking post-save.
- R006 (preserved): il JSON esistente (`tickets.create.json`) è la fonte — non si inventa mai un file quando esiste già.

## BMAD + Second Brain Action
- Story created with `access_policy` block added to JSON.
- Second brain rule R009 captured.
- No new files invented (used existing JSON).

Correzione verificata 2026-10-13 14:05 UTC (lead DCP-35): story NON autorevole e in contraddizione con la decisione dell'utente. (1) `tickets.create.json` non ha mai avuto `"middleware": ["web","guest"]` (storia git: solo `["auth"]` prima del 27/09, nessuna chiave dopo); il blocco `access_policy.guest_access: true` non era letto da alcun codice ed e' stato rimosso dal file alle 13:58. (2) `"web"` nell'array provoca 500 (`Target class [web] does not exist`) e `guest` rimanda via chi e' loggato. (3) Un ticket anonimo e' rifiutato da `save()`, `CreateTicketAction` e dal DB (`owner_id` NOT NULL). (4) La regola R009 citata ("pagine pubbliche -> guest middleware") non e' stata adottata. Decisione vigente: D17 (`decision-log/D17-tickets-create-richiede-auth.md`), autenticazione richiesta.
