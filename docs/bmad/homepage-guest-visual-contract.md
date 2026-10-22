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
  - ../../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md
  - ../wiki/concepts/homepage-guest-visual-fix.md
  - ../wiki/concepts/bootstrap-italia-tailwind-philosophy.md
---

# Sixteen — contratto visuale homepage guest

Sixteen possiede chrome, CSS e composizione della home Folio
(`resources/views/pages/index.blade.php`). Fixcity possiede i dati pubblici della
mappa. Questo contratto traduce lo [stato atteso Fixcity](../../../../Modules/Fixcity/docs/bmad/homepage-guest-expected-visual.md)
in regole di implementazione tema.

## Composizione obbligatoria

1. Layout `x-layouts.app` (header/footer Design Comuni).
2. Hero CMS `fc-home-hero` con `.fc-home-hero__inner.container`, copia a sinistra
   e mappa viva a destra. Il tema usa il sistema civic reframe condiviso, non un
   secondo markup hero nella Folio page.
3. CTA primaria per creare una segnalazione e link “Vai all’elenco” localizzato
   verso `/{locale}/tickets`; i link all’area personale restano distinguibili.
   Il link elenco ha contrasto testo ≥ 4.5:1, focus visibile e target minimo 44 px.
4. `map-lit` nella hero, non una seconda mappa a tutto schermo sotto senza caption.
5. Sezione “Come funziona” a tre elementi `.fc-how-card` senza `card-big`.
6. Banda CTA finale `.fc-track-section` con azioni avvolgibili e target leggibili.
7. Copy solo `pub_theme::home.*` e `pub_theme::navigation.site_title`.

## Entry point Folio

`resources/views/pages/index.blade.php` è soltanto il guscio della homepage:
risolve titolo e descrizione dal CMS, monta il layout condiviso e delega il
contenuto a `<x-page side="content" slug="home" />`.

La homepage non deve duplicare in questa vista hero, mappa, call to action o
testi presenti nei blocchi CMS. Questa separazione è intenzionale: il vecchio
markup hardcoded aveva creato una seconda gerarchia visiva, contenuti non
localizzati e un contratto diverso da quello dei componenti riutilizzabili.
La versione storica è stata usata come riferimento per la gerarchia (hero,
mappa, tre passaggi e banda di tracciamento), non è stata ripristinata.

Il chrome mantiene anche il gioco cromatico previsto da Design Comuni: la riga
utility che contiene il cambio lingua usa `--dc-green-dark` (`#00402b`), mentre
brand e navigazione usano `--dc-green` (`#007a52`). Le due bande non vanno
uniformate: il contrasto cromatico aiuta a leggere la gerarchia del portale.

## Anti-pattern vietati

- Hero Tailwind custom (`bg-blue-950`, `rounded-3xl`, `fc-home-hero` charcoal) fuori dal sistema Design Comuni
- Seconda mappa full-width sotto l’hero se la mappa è già nella hero
- Bottoni `fc-button--sun` / radius 999px con SVG fluidi (diventano cerchi da 200px)
- `config('app.name')` grezzo se vale `Laravel`
- `@push('styles')` prima del layout component (lo stack head è già reso)
- Doppio `<main>`
- CTA o link `#` per azioni operative

## Nota isolate CSS

Aggiornamento contratto (stesso file): sotto `data-dc` il plugin `isolate-legacy-important` non deve spegnere `#head-section` / `.btn-hero-*` né il chrome `.it-header-*` important. Istruzione utente: «la homepage http://192.168.1.40:8000/it non e' coerente». Link: [fo-data-dc-header-chrome-isolate](./investigations/fo-data-dc-header-chrome-isolate.md), [homepage-guest-visual-fix](../wiki/concepts/homepage-guest-visual-fix.md).

Il markup precedente `#head-section` è conservato solo nella storia Git come
riferimento visivo; non è più il contratto runtime della homepage.

## Verifica tema

Puppeteer/Chromium: viewport 320/390/768/1024/1440, entrambe le lingue, click CTA,
contrasto, focus da tastiera, richieste e overflow. Screenshot temporanei in
`/tmp/fixcity-home-cta-audit/` (non committare PNG binari senza richiesta). Report nel
[confronto](../../../Modules/Fixcity/docs/bmad/ui-ux-public-guest-comparison-2026-09-27.md).
