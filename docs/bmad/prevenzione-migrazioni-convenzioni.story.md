---
title: "Prevenzione — convenzioni migrazione XotBaseMigration"
status: active
decision: D34
related_initiative: kp-174d15a58ff94901b2b0df0d86b8907a
type: story
updated: 2026-10-18
tags: [docs, sixteen, bmad]
qmd: "come non commettere più errori nelle migrazioni fixcity sixteen"
---

# Come non commettere più errori nelle migrazioni Fixcity

## Violazioni trovate e corrette
1. `create_users_table_for_fixcity_model.php` — nome non standard, `$model_class` assente
2. `update_ticket_subscribers_user_id_to_uuid.php` — commento BMAD mancante, nessuna nota convenzione

## Regole da ricordare (Second Brain / BMAD)
- Ogni migrazione `XotBaseMigration` → `protected ?string $model_class = ...::class;`
- Nome file → `create_<table>_table.php` o `update_<table>_...` chiaro; mai `_for_fixcity_model`
- Commento in cima con `@note` sulla convenzione, dati sacri, Boy Scout
- Se `up()` vuota o `tableUpdate`, documentare perché
- Non creare controller; migrazioni usano solo Eloquent / Schema

## Azione preventiva
- Verifica automatica: `grep -L 'model_class' Modules/*/database/migrations/*.php` → deve restituire vuoto per quelle che estendono XotBaseMigration
