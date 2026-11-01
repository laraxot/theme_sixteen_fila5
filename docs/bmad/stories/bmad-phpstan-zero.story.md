---
id: laraxot-bmad-story-phpstan-zero
type: epic-story
status: open
priority: critical
tags: [phpstan, code-quality, zero-errors, pa, gdpr, sixtee]
github_issue: "#57"
discussion: "https://github.com/italia/design-comuni"
related_to: ["STORY-cookiebar-gdpr-compliance", "STORY-adozione-linee-guida-design-pa"]
title: "PHPStan Zero — Piano per 51 errori → 0"
updated: 2026-10-15
qmd: "phpstan zero   piano per 51 errori → 0 sixteen"
---

# PHPStan Zero — Piano per 51 errori → 0

## Stato attuale (da memoria + codice)

- 51 errori (SCRATCHPAD 2026-10-11): 1) Activity UserContract vs User, 2) Incentivi disableCreateAnother→createAnother, 3) rector.php EARLY_RETURN, 4) UI/LocationSelector Geo + mixed, 5) UI/Block GetCmsViewAction.
- `vendor/phpstan/phpstan/phpstan.phar` presente ma `php -l` / `analyse` timeout (60s+).
- Assenza `vendor/bin/phpstan` completa? No, c'è ma può essere corrotto.

## Piano passo passo (BMAD + second brain: `kp-phpstan-zero`)

1. **Ripristino vendor** (`composer install --no-dev` o `composer dump-autoload`) — recuperare bin/ corretto.
2. **Isolare il 51**: `phpstan analyse --error-format=table --memory-limit=2G Modules/Gdpr/ Modules/User/ Themes/Sixteen/app/` — catturare JSON.
3. **Fix per categoria**:
   - Type mismatch: `UserContract` vs `User` — aggiungere type-hint `UserContract` nel controller/API.
   - Rector: rimuovere `EARLY_RETURN` da `rector.php` o correggere logica.
   - Geo/LocationSelector — correggere `mixed` in `Geo` class (usare `array<string,float>` o `string`).
   - Block.php — correggere tipo di ritorno `GetCmsViewAction`.
4. **Verifica continua**: dopo ogni fix, `phpstan analyse` con `--no-progress`; bloccare se >0.
5. **Target**: 0 errori prima di qualsiasi rilascio PA.

## Regola pratica (per PA / design-comuni)

- Nessun commit se `phpstan` non passa.
- `phpstan.neon` autorizzato solo per `level: 8` o superiore.
- Documentare ogni fix in `docs/decision-log.md` + second brain `kp-phpstan-zero`.
