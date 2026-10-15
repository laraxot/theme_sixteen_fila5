---
title: "Story DCP — pagina Documenti e Dati JSON-driven"
type: story
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "story dcp   pagina documenti e dati json-driven sixteen"
---
# Story DCP — pagina Documenti e Dati JSON-driven

**Status:** in-review (implementazione locale eseguita; parity visuale ancora da certificare)

## Story

Come cittadino, voglio consultare documenti e dati del Comune in una pagina coerente con Design Comuni, così da trovare rapidamente documenti in evidenza, cercare per parola chiave ed esplorare le categorie.

## Acceptance criteria

1. `/it/tests/documenti-dati` risponde tramite la Folio page generica `[slug].blade.php` e non tramite una Blade page-specific; il wrapper usa `layouts.design-comuni`.
2. Il JSON contiene `id: tests.documenti-dati`, `slug: tests.documenti-dati` e `layout: test`.
3. Hero, evidenza, ricerca, documenti, categorie, rating e contatti sono alimentati dal JSON.
4. La ricerca Alpine aggiorna la visibilità delle card senza reload e mantiene label, focus e CTA accessibili.
5. A 375/768/1440 px la griglia passa rispettivamente a 1/2/3 colonne e non introduce scroll orizzontale.
6. Non vengono caricati Bootstrap Italia CSS/JS/CDN; il blocco usa Tailwind `@apply` e Alpine.

## Owned scope

- `laravel/config/local/fixcity/database/content/pages/tests.documenti-dati.json`
- `laravel/Themes/Sixteen/resources/views/components/blocks/documents-data.blade.php`
- `laravel/Themes/Sixteen/resources/css/app.css`
- `laravel/Themes/Sixteen/docs/bmad/brainstorm/documenti-dati.md`

## Testing strategy

- Render smoke test con `curl` e Laravel view cache pulita.
- Playwright screenshot e rect audit a 375, 768 e 1440 px.
- DOM check per `h1`, breadcrumb, `role=search`, label associata, CTA e assenza di errori console.
- WCAG: contrasto testo/CTA, focus visible, target minimo 44 px e heading hierarchy.

## Learnings

- Le pagine `/tests/*` attuali usano `layouts.design-comuni`; il reset `.dc-page` è sul `<main>`, mentre header/footer restano fuori dallo scope.
- Il PostCSS `isolate-legacy-important` riconosce lo scope canonico `body:has(.page-content[data-slug*="tests."])`. I selettori del nuovo blocco devono includere quel selettore per non ricevere il guard `:not(:where(...))` di Tailwind v4.
- La prima implementazione usava un’espressione Alpine con una stringa CSS quotata (`style*=...`) e produceva `missing ) after argument list`; ora il filtro usa `terms` JSON-driven e `matches`.
- La fixture deve seguire lo schema effettivo del blocco e non assumere che `filters` o `results` siano liste piatte.

## Evidence — 2026-10-13

Playwright ha verificato HTTP 200, nessun errore console e `scrollWidth === viewport` a 375, 768 e 1440 px. Le griglie rilevate sono 1/2/3 colonne; a 1440 px la griglia occupa x=72/w=1296, coerente con il container della reference; il pulsante `Invio` è rispettivamente circa 73/81/81 px × 42/40/40 px. Screenshot locali e reference sono stati catturati in `/tmp/sixteen-documenti-dati-parity/`.

La parity non è dichiarata conclusa: restano da misurare formalmente HTML body similarity, contrasto WCAG automatizzato e diff pixel con la stessa pipeline usata per le altre pagine.
