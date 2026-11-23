---
id: "issue-104-design-comuni-editorial-dry-wizard-parity"
type: "story"
title: "Issue #104 — Design Comuni, editorial DRY e wizard parity"
status: "in-progress"
theme: "Sixteen"
github_issue: "https://github.com/laraxot/theme_sixteen_fila5/issues/104"
tags: [design-comuni, editorial, dry, wizard, parity, documentation]
created: 2026-11-23
updated: 2026-11-23
---

# Issue #104 — audit documentale Sixteen

## Perimetro

Questo audit riguarda esclusivamente `Themes/Sixteen`. Non crea pagine Folio,
screenshot, fixture visuali o contenuti CMS non presenti nel repository.

## Decisioni applicate

- La presentazione Design Comuni resta nel tema; dati, URL, testo editoriale e
  autorizzazioni restano nei JSON CMS o nei moduli owner.
- I blocchi ripetuti devono restare riusabili e data-driven. Una differenza di
  contenuto non giustifica una seconda vista equivalente.
- Il wizard di segnalazione conserva i passi e i componenti condivisi nel tema;
  la parità viene verificata solo contro pagine, dati e test realmente presenti.
- Le shell Folio restano lineari: `mount()` costruisce il data bag e
  `PageSlugMiddleware` resta registrato per il contratto CMS.

## Verifica

- Le regole sono state aggiunte all’ADR di ownership della presentazione e al
  contratto operativo delle shell Folio.
- Il nome della story rispetta la convenzione dei nomi Markdown del progetto.
- Non sono stati aggiunti screenshot, pagine o fixture.

## Follow-up

- Collegare ogni futura dichiarazione di parità a dati e test esistenti.
- Eseguire il build asset del tema e i test mirati dal contesto `laravel` quando
  il lavoro viene integrato.
