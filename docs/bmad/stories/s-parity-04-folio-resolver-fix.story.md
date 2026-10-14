---
title: "STORY-REF-FIX-FOLIO-RESOLVER — Semplificazione Folio Resolver"
type: story
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story-ref-fix-folio-resolver   semplificazione folio resolver sixteen"
---
# STORY-REF-FIX-FOLIO-RESOLVER — Semplificazione Folio Resolver

## Analisi
Il file `laravel/Themes/Sixteen/resources/views/pages/tests/[slug].blade.php` contiene logica hardcoded per il fallback del catalogo (`in_array(..., ['eventi', ...])`), violando il principio di delega CMS.

## Azioni
1. Rimuovere la logica hardcoded da `[slug].blade.php`.
2. Assicurarsi che `tests.<slug>.json` definisca correttamente il componente di rendering o che `PageSlugMiddleware` risolva il pageSlug dinamico affidandosi esclusivamente a `x-page`.
3. Aggiornare `tests.homepage.json` se necessario.

## Acceptance Criteria
- `[slug].blade.php` è semplificato e utilizza `x-page`.
- La homepage e le altre pagine caricano correttamente i blocchi dal JSON di configurazione senza `catalogFallback`.
