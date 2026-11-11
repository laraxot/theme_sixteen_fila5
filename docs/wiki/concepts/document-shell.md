---
title: "Document shell: modello autonomo"
type: decision
confidence: high
created: 2026-11-09
updated: 2026-11-09
tags: [shell, head, foot, document, layout]
related:
  - ../../../../Modules/Cms/docs/foot-component-architecture.md
  - ../../../../Modules/Cms/docs/seo-head-architecture.md
  - ../../TwentyOne/docs/manuale-uso-front-office.md
---

# Document shell in Sixteen

Sixteen **non usa** `<x-cms::head />` / `<x-cms::foot />`: è un tema autonomo con document shell proprio.

## Modello

- Ogni layout (`layouts/main`, `layouts/base`, `layouts/guest`, `layouts/bootstrap-italia*`, `components/layouts/*`) possiede l'intero documento: apre `<html>/<head>/<body>` e chiude `</body></html>` in fondo.
- Assets registrati localmente con `@vite([...], 'themes/Sixteen')` e `@filamentScripts` (con `withCore: true` dove serve Alpine/auth).
- Nessun componente di coda emette tag di chiusura per elementi non aperti — coerente con la regola CMS Foot/TwentyOne.

## Differenza da TwentyOne

TwentyOne delega `<head>` a `cms::head` e la coda a `cms::foot` (layout chiude il documento). Sixteen è self-contained: se in futuro si volesse uniformare, il candidato è `layouts/main.blade.php` + `components/layouts/main.blade.php`, non i layout `bootstrap-italia*` (fixture di studio).

## Regola condivisa

Qualunque tema: un componente non deve mai emettere `</body>`/`</html>` se non ha aperto lui stesso quei tag. Vedi [CMS foot architecture](../../../../Modules/Cms/docs/foot-component-architecture.md).
