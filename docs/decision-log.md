---
title: "Decision log — Front Office redesign with DesignComuni"
type: decision-log
tags: [design-comuni, front-office, bmad]
links:
  story: docs/stories/front-office-design-comuni-rebuild.story.md
  investigation: docs/investigation/front-office-design-comuni.md
---

# Decision log — Front Office Redesign with DesignComuni

## Decisione 1 — Design system unificato
- **Scelta**: `design-comuni-pagine-statiche` v2.4.0 per tutte le pagine front office.
- **Motivazione**: standard istituzionale italiano; coerenza UX/accessibilità.
- **Fonte**: `https://github.com/italia/design-comuni-pagine-statiche`

## Decisione 2 — Componenti header/footer
- **Scelta**: header `it-header-wrapper`, footer `it-footer` con skip links.
- **Motivazione**: obbligatorio per conformità DesignComuni.
- **Status**: documentato; da implementare per ogni pagina FO.

## Decisione 3 — Pattern di contenuto
- **Scelta**: layout hero + sezioni (mappa, come funziona, quick actions) basato su `homepage.html`.
- **Motivazione**: mantiene funzionalità esistente rispettando il design system.
- **Status**: prototipo in `index.blade.php.old` (da estendere).

## Decisione 4 — Flusso segnalazione
- **Scelta**: applicare il flusso 4-step (privacy, dati, riepilogo, conferma) alle pagine ticket.
- **Fonte**: template `segnalazione-*.html`.
- **Status**: da creare come nuove pagine Blade sotto `tickets/`.

## Decisione 5 — Pagine di errore e accessibilità
- **Scelta**: `404.blade.php` segue pattern `risultati-ricerca.html`; `accessibility.blade.php` usa gli stessi componenti.
- **Motivazione**: uniformità e accessibilità.

## Open
- Implementare header/footer in tutte le pagine FO.
- Creare pagine segnalazione step 1-4.
- Correggere componente Blade `quick-actions.blade.php` (errore 500).

## Second brain
- `memory/` e `daily/` aggiornati con riferimenti DesignComuni e regola operativa BMAD.