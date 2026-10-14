---
title: "Sixteen homepage JSON-driven coverage plan"
type: coverage-plan
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, coverage, playwright, puppeteer]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "coverage plan   homepage json-driven sixteen"
---

# Coverage plan — Homepage JSON-driven

## Static checks

1. JSON valido:

```bash
php -r "json_decode(file_get_contents('config/local/fixcity/database/content/pages/home.json'), true, 512, JSON_THROW_ON_ERROR);"
```

2. View referenziate esistenti:

- estrarre tutte le chiavi `data.view`;
- verificare via Laravel `view()->exists($view)` oppure tramite mapping file `resources/views/components/blocks/**/*.blade.php`.

3. Diff hygiene:

```bash
git diff --check -- laravel/config/local/fixcity/database/content/pages/home.json laravel/Themes/Sixteen/resources/views/components/blocks laravel/Themes/Sixteen/docs/bmad
```

## Browser checks

### Playwright MCP

- aprire `http://127.0.0.1:8000/it`;
- verificare che non appaia “Internal Server Error”;
- verificare presenza di:
  - hero title;
  - `map-lit`;
  - tre card “Come funziona”;
  - CTA tracking.

### Puppeteer MCP

- aprire la stessa URL;
- leggere titolo/body;
- controllare console errors;
- opzionale screenshot temporaneo fuori repository.

## Manual visual acceptance

Viewport minimi:

- 320 px;
- 768 px;
- 1440 px.

Criteri:

- nessun overflow orizzontale;
- CTA leggibili;
- mappa contenuta nella hero;
- heading hierarchy coerente;
- focus visibile sui link.

## Regressioni da prevenire

- errore `Svg by name "map-pin" from set "default" not found`;
- `view not found` da `BlockData`;
- sezioni non presenti nel vecchio Blade;
- link `#` su azioni operative.
