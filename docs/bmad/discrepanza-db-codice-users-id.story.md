---
title: "Discrepanza DB-codice — users.id int vs UUID (D36)"
status: superseded
decision: D36
updated: 2026-10-18
tags: [bmad, second-brain, dati-sacri, users, uuid, filament-user]
related:
  - ../../../../Modules/Fixcity/docs/bmad/filament-user-uuid-connection-audit.md
type: story
qmd: "superseded   ownership su connessione `user` sixteen"
---

# Superseded — ownership su connessione `user`

Questa story aveva diagnosticato `make:filament-user` → `Data truncated for
column 'id'` come mismatch `int` vs UUID su `fixcity_data.users`.

La causa radice corretta è **ownership**: `Modules\Fixcity\Models\User` non
deve sovrascrivere la connessione a `fixcity`. Deve ereditare `user` da
`BaseUser` e scrivere su `fixcity_user.users` (`varchar(36)`).

Non migrare `fixcity.users.id`. Non usare `migrate:fresh` (D35).

## Canonico

- [filament-user-uuid-connection-audit.md](../../../../Modules/Fixcity/docs/bmad/filament-user-uuid-connection-audit.md)
- [model-migration-parity.md](../../../../Modules/Fixcity/docs/bmad/model-migration-parity.md)
