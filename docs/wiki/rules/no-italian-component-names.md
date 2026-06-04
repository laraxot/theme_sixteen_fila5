---
title: "No Italian Component Names"
type: rule
confidence: high
created: 2026-05-29
updated: 2026-05-29
tags: [naming, components, i18n, dry]
related:
  - ../../../../../docs/wiki/rules/no-italian-folder-names-in-code.md
  - ../concepts/ticket-component-architecture.md
---

# Regola: Nomi Componenti Solo in Inglese

## Principio

I nomi dei componenti Blade devono essere sempre in **inglese**, mai in italiano.

## Errore Corretto

| ❌ Prima | ✅ Dopo |
|----------|---------|
| `components/blocks/segnalazioni/` | `components/blocks/ticket/` |

## Perché

1. **DRY**: La traduzione italiana (`segnalazione`) è già nei file `lang/it/`
2. **Consistenza**: Tutto il codebase usa inglese (Models: `Ticket`, non `Segnalazione`)
3. **Internazionalizzazione**: Il codice deve essere language-agnostic
4. **Clarity**: `ticket` è il concetto dominio, `segnalazione` è solo la label UI

## Pattern Corretto

```
components/blocks/
├── ticket/              ✅
│   ├── layout.blade.php
│   ├── filters-sidebar.blade.php
│   └── tabs.blade.php
├── news/                ✅
├── event/               ✅
└── service/             ✅
```

## Modulo Geo (JS)

Stessa regola per **filename** sotto `Modules/Geo/resources/js/`:

| ❌ | ✅ |
|----|-----|
| `map/popup-segnalazione.js` | `map/popup-ticket.js` |

Vedi [js-file-english-naming-rule.md](../../../../../Modules/Geo/docs/wiki/rules/js-file-english-naming-rule.md) · [STORY-132](../../../../../docs/stories/STORY-132-rename-popup-segnalazione-js-english.md).

## Eccezioni

SOLO nei file di traduzione:
- `lang/it/ticket.php` → chiave `'segnalazione'` ✅
- Commenti che referenziano URL Design Comuni ✅

## Checklist Pre-Creazione

- [ ] Il nome è in inglese?
- [ ] Corrisponde al nome del Model/Enum (es. `Ticket`)?
- [ ] Non è una traduzione italiana?

## Verifica

```bash
# Cerca cartelle italiane (errore)
find . -type d -name "segnalazi*" -o -name "pratic*" -o -name "servizi*" | grep -v lang

# Deve restituire nulla
```
