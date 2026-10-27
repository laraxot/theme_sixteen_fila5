---
title: "Migrazione Fixcity users — convenzione XotBaseMigration"
status: completed
decision: D33
related_initiative: kp-174d15a58ff94901b2b0df0d86b8907a
type: story
updated: 2026-10-18
tags: [docs, sixteen, bmad]
qmd: "perché la migrazione non rispettava le convenzioni sixteen"
---

# Perché la migrazione non rispettava le convenzioni

- **Nome file**: `create_users_table_for_fixcity_model.php` non segue `create_<table>_table.php` (confuso dal suffisso `_model`)
- **Contratto XotBaseMigration**: la classe base richiede `Assert::classExists`; senza `protected ?string $model_class` la migrazione esplode con `Webmozart\Assert\InvalidArgumentException`
- **Correzione BMAD**: aggiunto `$model_class = \Modules\Fixcity\Models\User::class`, commento esplicito, nessuna operazione schema (dati sacri)
- **Boy Scout**: file ripristinato e migliorato rispetto alla versione precedente (mancava il modello, nome ambiguo)
