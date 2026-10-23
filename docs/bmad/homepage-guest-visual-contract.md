---
title: "homepage guest visual contract"
type: ux-spec
status: active
module: Sixteen
created: 2026-09-27
updated: 2026-10-23
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
2. Hero CMS `#head-section.fc-home-head.bg-primary` (studio pages_old → avanti):
   copia a sinistra (eyebrow, H1 Lora, intro concreta, trust, CTA Segnala /
   Vedi / Crea account guest) e **mappa viva** a destra in card elevata.
   Gutter `--fc-home-gutter`. Vietato charcoal `fc-home-hero` e pannello
   marketing al posto della mappa.

3. CTA primaria per creare una segnalazione e secondaria per vedere l’elenco,
   entrambe provenienti da `home.json`, con contrasto, focus visibile e target
   minimo 44 px.
4. Blocco `ticket.map-preview` autonomo: la mappa è la prova concreta del
   servizio e non compete con la prima azione. Caption, heading, legenda e URL
   restano dati CMS; nessun testo o URL hardcoded nella Folio page.
5. Sezione “Come funziona”: tre `.fc-how-card` numerate, interamente data-driven.
6. Banda CTA `.fc-track-section`: eyebrow, h2, body e due CTA in dati CMS, con
   wrapping responsive e target WCAG.
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

Il chrome mantiene il gioco cromatico Design Comuni / `fixcity.eu`: slim
utility `#00402b`, brand/nav `#007a52`, Accedi `btn-primary` verde con
testo bianco sulla slim. Le due bande non vanno uniformate.

## Anti-pattern vietati

- Creare `pages/home.blade.php` o `pages/homepage.blade.php`: l’entry point è
  `pages/index.blade.php` e i contenuti vivono in `config/local/fixcity/.../home.json`.
- Duplicare hero, mappa o copy nella Folio page invece di usare i blocchi CMS
- Bottoni `fc-button--sun` con SVG *fluidi non boundati* (diventano cerchi da 200px); sun con icona `h-5 w-5` boundata è il pattern `.eu` e resta consentito
- `config('app.name')` grezzo se vale `Laravel`
- `@push('styles')` prima del layout component (lo stack head è già reso)
- Doppio `<main>`
- CTA o link `#` per azioni operative

## SSOT e Folio

Contenuto: `laravel/config/local/fixcity/database/content/pages/home.json`.
Guscio: `pages/index.blade.php` → `<x-page slug="home" />`.
Vietato: `pages/home.blade.php`, `pages/homepage.blade.php`
([why](./knowledge/why-home-blade-must-not-exist.md)).

## Nota isolate CSS

Il plugin di isolamento non deve spegnere chrome Design Comuni né
`#head-section.fc-home-head` / `.fc-how-section` / `.fc-track-section`.
Il charcoal `.fc-home-hero` senza mappa è anti-pattern di desiderabilità
(studio pages_old → avanti), non il contratto runtime.

## Verifica tema

Puppeteer/Chromium: viewport 320/390/768/1024/1440, entrambe le lingue, click CTA,
contrasto, focus da tastiera, richieste e overflow. Screenshot temporanei in
`/tmp/fixcity-home-cta-audit/` (non committare PNG binari senza richiesta). Report nel
[confronto](../../../../Modules/Fixcity/docs/bmad/ui-ux-public-guest-comparison.md).
