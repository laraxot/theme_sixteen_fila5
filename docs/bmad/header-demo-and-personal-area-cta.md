---
title: "Header Design Comuni: Demo e area personale"
type: decision
status: accepted
updated: 2026-10-26
tags: [bmad, second-brain, design-comuni, header, accessibility]
links:
  decision: ./decision-log.md#d35
  study: ./header-design-comuni-study.md
---

# Decisione D35 in breve

Dove il riferimento Design Comuni scrive "Nome della Regione", la fascia slim mostra **Demo**.

- **Dove vive**: `config/local/fixcity/database/content/sections/header.json`, `region.name` per lingua; `account.label` per il pulsante. La Blade `sections/header/v1.blade.php` non contiene testo.
- **Non e' un link**: senza URL la voce e' uno `span.navbar-brand`, senza `href`, `aria-label` o `title`.
- **Precedenza**: se l'ente fornisce `region_name` / `region_url` (`config('ente')`, GetEnteDataAction, DCP-289) vince l'ente e il nome accessibile del link lo segue (`RegionPortalLinkLabels::resolve`).
- **Avatar**: markup del riferimento (`btn btn-primary btn-icon btn-full`, `span.rounded-icon`, `svg.icon-primary` `#it-user`), cerchio bianco 24px, icona verde 18px, etichetta 16px/600 da lg; hover `#006342`. Solo CSS in `resources/css/app/22-header-shell.css`, nessun nuovo componente.
- **Come tornare indietro**: togliere `region.name` da header.json e ripristinare il divieto `region.(name|url) = .` in `NoFakeEnteDataInFrontOfficeContentTest`.

Studio, misure prima e dopo e filosofia del repository italia: [header-design-comuni-study.md](./header-design-comuni-study.md).

## Confine Filament

Questa e' chrome del front office CMS, non una Resource Filament: nessun dato o markup va nel pannello BO. Il Filament Blueprint resta rispettato.
