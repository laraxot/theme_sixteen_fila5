---
title: "composer go — impatto tema (Sixteen)"
type: concept
module: Sixteen
tags: [composer, filament, view-cache]
created: 2026-07-24
updated: 2026-07-24
related:
  - ../../../../../../bashscripts/docs/composer-go-agent-safe.md
  - ./filament5-schema-form-access-rule.md
---

# Sixteen — dopo `composer go`

`composer go` può wipeare `laravel/resources/views/vendor/`. Verificare sempre:

```bash
cd laravel && php artisan view:cache
```

Override form Filament schemas e asset Filament devono restare coerenti (Filament **v5.7.3** verificato post-update). Canon agent-safe: [composer-go-agent-safe](../../../../../../bashscripts/docs/composer-go-agent-safe.md).

Edit Blade tema → lock multi-agente + `view:cache`.
