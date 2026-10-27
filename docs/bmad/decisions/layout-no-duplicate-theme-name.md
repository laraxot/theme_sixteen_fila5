---
title: "Regola layout — non duplicare nome tema"
date: "2026-10-26"
status: decision-adopted
owner: theme-sixteen
related: layout-ssot.md, design-comuni-header-structure-delta.md, footer-v1-ssot-no-design-comuni.md
---

## Perché `design-comuni.blade.php` era sbagliato

Il tema **Sixteen** è già il tema Design Comuni. Creare un layout `design-comuni.blade.php` che duplicava `app.blade.php` era ridondante: il nome del layout deve descrivere il ruolo (layout app), non ripetere il nome del tema. Componente `app.blade.php` = SSoT; `design-comuni.blade.php` = rimosso. I JSON CMS (`layout: design-comuni`) ora puntano a `layouts.app` via `layoutComponent`.

### Regola (evita errori simili — header/footer/layout)
- **Header**: `v1.blade.php` (SSoT) + `design-comuni.blade.php` (chrome specifico, `tpl="design-comuni"`) — OK, contratti diversi.
- **Footer**: solo `v1.blade.php`; `design-comuni.blade.php` NON esisteva — OK.
- **Layout**: solo `app.blade.php`; `design-comuni.blade.php` rimosso — CORREGGITO.
- **Mai** duplicare un componente con nome tema quando il componente ha lo stesso scopo.

### Errori simili corretti in questa sessione
- Header `design-comuni.blade.php` merge risolto, naming discusso in prompt 04.md
- Footer `.lock` rimosso, `v1.blade.php` confermato SSoT
- Layout `design-comuni.blade.php` rimosso, `app.blade.php` confermato SSoT
