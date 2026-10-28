---
title: "Dati sacri — regola inviolabile (D35)"
status: active
decision: D35
related_initiative: kp-174d15a58ff94901b2b0df0d86b8907a
type: story
updated: 2026-10-18
tags: [docs, sixteen, bmad]
qmd: "regola d35   i dati sono sacri, mai si toccano sixteen"
---

# Regola D35 — i dati sono sacri, mai si toccano

## Comando vietato (sempre, anche in dev/test)
`migrate:fresh`, `migrate --force`, `migrate:refresh`, `RefreshDatabase` trait nei test.

## Perché
`fixcity_data` contiene segnalazioni civiche, commenti, utenti reali. Un reset cancellerebbe dati irreversibili.

## Come ricordarlo per sempre
- Documento primario: `Modules/Fixcity/docs/REGOLA_DATI_SACRI.md`
- Second Brain: `docs/second-brain/knowledge.md` (aggiunta regola D35)
- BMAD: questo file
- Nei test: se serve isolamento, usare `DatabaseTransactions` o factory con rollback, mai `RefreshDatabase`
- Quando si scrive una migrazione: commento in cima con `@note Dati sacri — non cancellare tabella esistente`
