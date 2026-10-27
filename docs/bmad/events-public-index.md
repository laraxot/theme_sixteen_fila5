---
title: "BMAD / Blueprint — indice pubblico eventi"
type: note
status: draft
updated: 2026-10-16
tags: [docs, sixteen, bmad]
qmd: "bmad / blueprint   indice pubblico eventi sixteen"
---
# BMAD / Blueprint — indice pubblico eventi

## Intento

La pagina `/it/events` è la superficie pubblica per gli appuntamenti futuri:
deve aiutare una persona a capire rapidamente cosa succede, quando e dove
approfondire. Il JSON CMS decide contenuti, labels e lingua; Blade applica il
vestito Design Comuni.

## Contratto dati

Linked from: [inbound-fo-events.md](./blueprints/inbound-fo-events.md),
[inbound-fo-index.md](./inbound-fo-index.md). Supersedes: nessuna story; aggiorna
il contratto runtime corrente (featured+explore). User: «devi sempre correggere
quello che trovi da correggere, … non ti serve la mia conferma !».

`Article` è il modello condiviso. Un evento è un Article con
`content_type=event`, pubblicato e con data iniziale futura. La query pubblica
è centralizzata nel Blog (`ThemeComposer::featuredEvents` + `paginatedEvents`),
mentre il tema monta il vestito e non replica la logica editoriale.

### Shell + blocco

- Folio `pages/[container0]/index.blade.php`: shell sottile, `data-dc`,
  `body-page=eventi` quando `container0=events`.
- CMS `events.index` → `pub_theme::components.blocks.events.index`.
- Il blocco costruisce sezioni **evidenza** (featured, esclusi dall'explore) +
  **tutti gli eventi** (paginator) + luoghi opzionali da
  `config('sixteen.events.parity')`, poi include
  `events-page/design-comuni` (hero img solo se file presente; empty state;
  pulsante sezione solo se `button.label` valorizzato).

## UI e accessibilità

- breadcrumb con `aria-label` e pagina corrente;
- un solo `h1`, poi `h2` per la raccolta e `h3` per le card;
- immagini con alt derivato dal titolo;
- date leggibili e rese disponibili come `<time>` quando il componente lo
  consente; parsing Carbon esplicito per dati legacy/stringa;
- link con nome comprensibile e stato vuoto in `role=status`;
- paginazione nativa, focus visibile e supporto alle traduzioni.

## Decisioni

- Nessun modulo `Event` finché il dominio non richiede workflow o relazioni
  diversi dal contenuto editoriale.
- Nessun nuovo componente UI: card e chrome riusano Design Comuni.
- Header e footer restano JSON-driven tramite le sezioni `header` e `footer`.
- Il dettaglio riusa il blocco blog e cambia solo percorso, etichette e
  breadcrumb in base a `container0=events`.

## Verifica di rilascio

```text
GET /it/events                                      200
GET /it/events/passeggiata-quartiere-senza-ostacoli 200
phpstan analyse Modules                              OK
git diff --check                                     OK
```

Il contenuto di test deve restare realistico, localizzato e senza commenti in
attesa pubblicati accidentalmente.

## Dettaglio e `data-dc`

Come le novità: il dettaglio evento forza `layouts.app` + `data-dc` anche senza
CMS `events.view`. Hub: [inbound-fo-index.md](./inbound-fo-index.md).
