---
title: "Migrazioni Fixcity non rispettano convenzioni (2026-09-26, 2026-09-27, 2026-10-01)"
type: investigation
status: open
links:
  github_issue: "#60"
  discussion: "https://github.com/fixcity/fila5/discussions/60"
tags: [migrations, conventions, fixcity]
related:
  - "docs/wiki/rules/migration-update-timestamps-only.md"
  - "laravel/Themes/Sixteen/docs/bmad/decision-log.md"
created: 2026-10-11
updated: 2026-10-11
---

# Investigazione: migrazioni Fixcity che violano convenzioni

## Convenzioni AGENTS.md

1. **"only update timestamps; never add new tables in existing migration files"**
2. **"N modelli → N migrazioni"** (un file per modello, nome coerente)
3. **Tipi colonna coerenti**: `user_id` deve essere sempre `uuid` (non `bigint unsigned`)

## Migrazioni violanti

| File | Violazione |
|------|-----------|
| `2026_09_26_200000_update_ticket_subscribers_user_id_to_uuid.php` | Nome file non standard; update di colonna in file non create-table |
| `2026_09_27_120000_align_ticket_relation_foreign_keys.php` | `alter table ticket_comments modify user_id uuid not null` fallisce: colonna è `bigint unsigned`, cast impossibile |
| `2026_10_01_180000_fix_profiles_id_auto_increment.php` | Violazione convenzione "N modelli → N migrazioni" |

## Stato attuale

- 13 modelli in `app/Models/` (Activity, Category, Profile, Ticket, TicketActivity, TicketComment, TicketHour, TicketRelation, TicketSubscriber, User, ecc.)
- 13 file migrazione (incl. update)
- Migration `2026_09_27_120000_align...` fallisce su `ticket_comments.user_id` perché tenta di cast `bigint unsigned` → `uuid`

## Azione raccomandata

1. Aggiornare `ticket_comments.user_id` a `uuid` prima della migrazione (o modificare la migrazione per usare `change()` con tipo corretto)
2. Rinominare migrazioni update per seguire convenzione `YYYYMMDDHHMMSS_<model>_<action>.php`
3. Aggiungere test migration in `laravel/Modules/Fixcity/tests/` per prevenire regressioni