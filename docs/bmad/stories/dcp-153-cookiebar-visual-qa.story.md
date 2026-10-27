---
name: "DCP-137 Cookiebar Visual QA"
title: "Cookiebar Visual Quality Assurance — Token Compliance & States"
description: "Fix hardcoded tokens, add focus/disabled states, remove ad-hoc shadows, ensure prefers-reduced-motion."
status: "ready-for-dev"
module: "Sixteen"
epic: "Front Office Redesign"
created: "2026-10-14"
updated: "2026-10-14"
github:
  repository: "https://github.com/your-org/your-repo"
  issue: "https://github.com/your-org/your-repo/issues/XXX"
  discussion: "https://github.com/your-org/your-repo/discussions/XXX"
links:
  github_issue: "https://github.com/your-org/your-repo/issues/XXX"
type: story
tags: [docs, sixteen, bmad]
qmd: "dcp 153 cookiebar visual qa.story sixteen"
---

## Obiettivo
Aggiustare il cookiebar (`cookiebar.blade.php`) per superare l'audit `ux_audit` e i requisiti di Design Italia.

## Problemi risolti
1. **Tokens**: 80+ hardcoded hex → variabili CSS
2. **States**: `:focus-visible` / `:disabled` aggiunti
3. **Shadows**: ad-hoc `box-shadow` → `--cookiebar-shadow`
4. **Motion**: `prefers-reduced-motion` fallback aggiunto

## Files modificati
- `resources/css/components/cookiebar-tokens.css` (creato)
- `resources/css/app.css` (import aggiunto)
- `components/bootstrap-italia/cookiebar.blade.php` (token refatto)

## Verifica
- `ux_audit` su `app.css` deve superare Tokens + States
- Nessun `--cookiebar-*` hardcoded in cookiebar.blade.php

## Acceptance Criteria
- [x] Token CSS centralizzati in `:root`
- [x] `:focus-visible` presente
- [x] `:disabled` presente
- [x] `prefers-reduced-motion` applicato
- [x] Nessun `box-shadow` inline
- [ ] `ux_audit` passa