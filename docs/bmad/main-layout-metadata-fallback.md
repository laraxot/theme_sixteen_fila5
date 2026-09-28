---
title: "Sixteen main layout metadata fallback"
type: story
status: done
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, sixteen, folio, layout, ui-ux]
qmd: "Sixteen main layout Folio title undefined metadata fallback service page parse error"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../../tests/Feature/Pages/MainLayoutMetadataFallbackTest.php
  - ../../resources/views/components/layouts/main.blade.php
---

# Sixteen main layout metadata fallback

## Problema e correzione

Il layout `main` usava `$title` e `$description` senza dichiarare i prop del
component. Le Folio page prive di metadata causavano HTTP 500. Inoltre la pagina
servizi non chiudeva il layout e falliva con un errore Blade.

- [x] Dichiarati `title` e `description` nullable nel layout component.
- [x] Chiusa correttamente la pagina servizi e rimosso il commento Blade malformato.
- [x] Pest verifica HTTP 200 e metadata su reset password, amministrazione,
  novità e servizi (4 percorsi).
- [x] Click smoke verifica CTA registrazione/reset: route raggiunte a 200/200.

I contenuti demo specifici della pagina Servizi (recapiti e servizi non configurati)
richiedono una revisione tenant separata; questa story corregge il rendering e non
certifica quei dati come ufficiali.
