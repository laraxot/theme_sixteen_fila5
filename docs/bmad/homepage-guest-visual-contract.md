---
title: "homepage guest visual contract"
type: ux-spec
status: active
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, sixteen, homepage, design-comuni, visual-contract]
qmd: "sixteen homepage guest visual contract hero map cta"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/572"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/573"
related:
  - ./public-ticket-listing-visual-contract.md
  - ../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md
  - ../wiki/concepts/homepage-guest-visual-fix.md
  - ../wiki/concepts/bootstrap-italia-tailwind-philosophy.md
---

# Sixteen — contratto visuale homepage guest

Sixteen possiede chrome, CSS e composizione della home Folio
(`resources/views/pages/index.blade.php`). Fixcity possiede i dati pubblici della
mappa. Questo contratto traduce lo [stato atteso Fixcity](../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md)
in regole di implementazione tema.

## Composizione obbligatoria

1. Layout `x-pub_theme::layouts.app` (header/footer Design Comuni).
2. Hero `#head-section.bg-primary` con testo/CTA contrasto forzato via classi
   `btn-hero-*` (le utility `btn-primary` + `bg-white` producono testo invisibile).
3. CTA primaria per creare una segnalazione e link “Vai all’elenco” localizzato
   verso `/{locale}/tickets`; i link all’area personale restano distinguibili.
   Il link elenco ha contrasto testo ≥ 4.5:1, focus visibile e target minimo 44 px.
4. `map-lit` nella hero, non una seconda mappa a tutto schermo sotto senza caption.
5. Sezione “Come funziona” a tre card `col-md-4` senza `card-big`.
6. Banda CTA finale `bg-light`.
7. Copy solo `pub_theme::home.*` e `pub_theme::navigation.site_title`.

## Anti-pattern vietati

- Hero Tailwind custom (`bg-blue-950`, `rounded-3xl`) fuori dal sistema Design Comuni
- `config('app.name')` grezzo se vale `Laravel`
- `@push('styles')` prima del layout component (lo stack head è già reso)
- Doppio `<main>`
- CTA o link `#` per azioni operative

## Verifica tema

Puppeteer/Chromium: viewport 320/390/768/1024/1440, entrambe le lingue, click CTA,
contrasto, focus da tastiera, richieste e overflow. Screenshot temporanei in
`/tmp/fixcity-home-cta-audit/` (non committare PNG binari senza richiesta). Report nel
[confronto](../../../Modules/Fixcity/docs/bmad/ui-ux-public-guest-comparison-2026-09-27.md).
