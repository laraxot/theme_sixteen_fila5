---
title: "Sixteen homepage JSON-driven epics"
type: epics
status: active
theme: Sixteen
created: 2026-10-09
updated: 2026-10-09
tags: [bmad, sixteen, homepage, epics]
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions"
qmd: "epics   homepage sixteen json-driven sixteen"
---

# Epics — Homepage Sixteen JSON-driven

## Epic 1 — Documentare il contratto homepage

**Goal:** chiarire che `home.json` deve replicare `index.blade.php.old`, non creare una landing generica.

Deliverable:

- product brief;
- PRD;
- architecture;
- UX spec;
- tech spec;
- decision log;
- coverage plan;
- story.

## Epic 2 — Estrarre i blocchi mancanti

**Goal:** spostare le sezioni del vecchio file in blocchi sotto `resources/views/components/blocks/`.

Blocchi richiesti:

- `home.hero-map`;
- `home.how-it-works`;
- riuso `quick-actions` se compatibile.

## Epic 3 — Correggere `home.json`

**Goal:** sostituire blocchi marketing errati con blocchi equivalenti al vecchio layout.

Deliverable:

- `content_blocks.it` completo;
- `content_blocks.en` coerente o esplicitamente vuoto se la lingua primaria resta IT;
- nessuna `data.view` inesistente;
- nessuna icona non risolta.

## Epic 4 — Verifica runtime

**Goal:** provare `/it` nel browser reale.

Deliverable:

- Playwright: pagina carica senza stack trace;
- Puppeteer: pagina carica senza stack trace;
- presenza hero, mappa, tre step e CTA tracking;
- nessun errore console bloccante.

## Epic 5 — Consolidamento documentale

**Goal:** mantenere il cluster BMAD come riferimento per modifiche future alla home.

Deliverable:

- link dai dossier Sixteen se richiesto;
- aggiornamento decision log con eventuali deviazioni;
- correzione second brain se una memoria risultasse stale.
