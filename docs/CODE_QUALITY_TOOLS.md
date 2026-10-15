---
title: "Sixteen — tool di qualità"
type: reference
status: stable
source_of_truth: true
theme: Sixteen
created: 2025-01-27
updated: 2026-10-15
tags: [quality, phpstan, theme, sixteen]
qmd: "sixteen code quality tools phpstan eslint prettier stylelint markdown gate"
related:
  - ./CODE_QUALITY_ANALYSIS.md
  - ./README.md
  - ../../../../bashscripts/docs/prompts/03-quality-gates.md
  - ../../../../bashscripts/docs/prompts/11-phpstan.md
  - ../../../../bashscripts/ai/wiki/memories/phpstan-quality-docs-bmad-standing-order.md
issues: []
discussions: []
---

# Sixteen: tool di qualità

## Scopo

Il tema Sixteen serve il front office (layout, componenti, asset). La qualità
qui significa: markup/CSS/JS coerenti col design system e nessun silenziatore
che nasconda errori statici nei moduli PHP che il tema consuma.

## Gate rilevanti

| Area | Dove | Prompt |
|------|------|--------|
| PHP (moduli usati dal tema) | `cd laravel && ./vendor/bin/phpstan analyse Modules` | [11-phpstan.md](../../../../bashscripts/docs/prompts/11-phpstan.md) |
| Gate sessione | perimetro toccato + lock | [03-quality-gates.md](../../../../bashscripts/docs/prompts/03-quality-gates.md) |
| Docs tema | questa cartella `docs/` | [44-module-docs-continuous.md](../../../../bashscripts/docs/prompts/44-module-docs-continuous.md) |

Standing order:
[phpstan-quality-docs-bmad-standing-order.md](../../../../bashscripts/ai/wiki/memories/phpstan-quality-docs-bmad-standing-order.md).

## Frontend (quando il task tocca asset del tema)

- Lint/format del tree del tema (ESLint, Prettier, Stylelint) solo se i binari
  e le config esistono nel tema; assenza binario = skip ambiente, non pass.
- Niente claim di "0 errori" senza output allegato della run.

## Docs

- Un canonico per argomento; nomi `.md` minuscoli kebab-case senza date
  (eccezione case: `README.md`). Prima di creare:
  `python3 -I bashscripts/tools/docs/md-filenames.py name <percorso>`.
- Analisi storica: [CODE_QUALITY_ANALYSIS.md](./CODE_QUALITY_ANALYSIS.md)
  (evidence; non sostituisce una rimisurazione).

## Divieti

Git forward-only; niente ignore/baseline PHPStan; niente nuove cartelle `docs/`.
