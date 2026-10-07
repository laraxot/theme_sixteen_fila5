---
title: "Sixteen — contratto presentazione flusso cittadino"
type: bmad-ux-contract
status: active
module: Sixteen
created: 2026-10-07
updated: 2026-10-07
tags: [bmad, ux, citizen, navigation, accessibility, folio]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/572"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/573"
related:
  - ./homepage-taste-contract-2026-10-07.md
  - ../../../Modules/Fixcity/docs/bmad/citizen-journey-audit-2026-10-07.md
---

# Contratto di presentazione dei flussi

## Ownership

Sixteen non decide persistenza, policy o stato del ticket. Presenta e collega i flussi
del cittadino: homepage, auth, lista/mappa, dettaglio, creazione, conferma, tracking e
area personale.

## Regole di continuità

- ogni URL pubblica mantiene il prefisso locale;
- le CTA usano `LaravelLocalization::localizeURL` o il contratto Folio equivalente;
- il guest vede una spiegazione e una recovery action, non una pagina bianca;
- il redirect a login conserva la destinazione richiesta;
- il tema non mostra capability code, stati interni o dati di altri utenti;
- ogni pagina ha landmark, heading, focus visibile e stato vuoto/errore comprensibile.

## Superfici da verificare

| Superficie | View attiva | Dipendenza |
|---|---|---|
| Homepage | `resources/views/pages/index.blade.php` | Fixcity GeoJSON |
| Login/register | `resources/views/pages/auth/*.blade.php` | User widgets |
| Lista | `resources/views/pages/tickets/index.blade.php` | Cms/Fixcity |
| Creazione | modulo Fixcity `resources/views/pages/tickets/create.blade.php` | Geo/Media/Gdpr |
| Conferma/tracking | modulo Fixcity `confirmation.blade.php`, `track.blade.php` | Ticket/Activity |
| Area personale | `resources/views/pages/area-personale/*.blade.php` | User/Fixcity/Notify |

Il contratto si considera verificato solo con browser multilingua, viewport responsive,
account isolati e console senza errori.
