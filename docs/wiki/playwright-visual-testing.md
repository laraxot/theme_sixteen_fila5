---
title: Playwright — Visual Testing Tema Sixteen
description: Uso di Playwright MCP per screenshot e verifica visuale del tema Sixteen (Bootstrap Italia)
tags: [playwright, screenshot, sixteen, bootstrap-italia, visual-testing]
---

# Playwright — Visual Testing Tema Sixteen

Per verificare visualmente le pagine del tema Sixteen usare il Playwright MCP server (configurato in `laravel/.mcp.json`).

## Pagine principali

- `http://127.0.0.1:8000/it/` — homepage
- `http://127.0.0.1:8000/it/tests/segnalazione-crea` — wizard segnalazione (CMS `tests.*`, stesso header Bootstrap Italia)
- `http://127.0.0.1:8000/it/segnalazione/crea` — wizard segnalazione (alternativa, se configurata; map-picker, form steps)
- `http://127.0.0.1:8000/admin` — panel Filament

### Header guest vs autenticato (Design Comuni)

Sulla stessa URL (es. `/it/tests/segnalazione-crea`): catturare **due** screenshot dopo logout vs dopo login per verificare CTA «Accedi all'area personale» vs blocco utente (avatar + nickname + dropdown). Regola e percorsi: [header authenticated state](./concepts/header-authenticated-state.md).

## Workflow

```
1. ! php artisan serve    (nel terminale)
2. "fai uno screenshot di http://127.0.0.1:8000/it/segnalazione/crea"
3. Claude usa browser_navigate + browser_screenshot
```

Documentazione completa: `docs/wiki/concepts/playwright-mcp-screenshots.md` (root project)
