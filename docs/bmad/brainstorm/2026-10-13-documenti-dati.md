---
title: "BMAD Brainstorm — `documenti-dati`"
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "bmad brainstorm   `documenti-dati` sixteen"
---
# BMAD Brainstorm — `documenti-dati`

## Obiettivo

Replicare `sito/documenti-dati.html` sulla route generica `/it/tests/documenti-dati` senza creare una Blade nella cartella `pages/tests`. La composizione deve rimanere JSON-driven e riusare il layout/section condiviso del tema Sixteen.

## Tecniche applicate

- **5 Whys:** la pagina non esisteva perché mancava la fixture `tests.documenti-dati.json`; la fixture da sola non basta perché la struttura della reference (hero, evidenza, ricerca, categorie) non era coperta da un blocco unico.
- **Mind map:** route Folio generica → slug CMS → JSON tenant → blocco `documents-data` → CSS scoped → Alpine per filtro locale → rating/contatti condivisi.
- **Reverse brainstorming:** evitare Blade page-specific, testi hardcoded, URL assoluti, namespace `design-comuni` duplicati e CSS Bootstrap Italia runtime.

## Decisioni convergenti

1. Il blocco vive nel tema Sixteen come `components/blocks/documents-data.blade.php`.
2. Il contenuto vive in `database/content/pages/tests.documenti-dati.json` con `id` e `slug` completi.
3. La route usa `layouts.design-comuni`; `.dc-page` è confinato a `<main>`, mentre header e footer restano section condivise fuori dallo scope.
4. La ricerca è un comportamento Alpine progressivo: non inventa dati server-side e filtra solo gli elementi consegnati dal JSON.
5. Gli stili sono Tailwind con `@apply` più selettori CSS espliciti nello scope canonico `body:has(.page-content[data-slug*="tests."])`; nessun CSS/JS Bootstrap Italia viene aggiunto.

## Verifica prevista

- HTTP 200 e nessun `view not found` su `/it/tests/documenti-dati`.
- Snapshot a 375, 768 e 1440 px: breadcrumb, hero, griglia 1/2/3 colonne, input con icona e CTA, rating e contatti.
- Controllo tastiera: input, Invio, link e focus visibile.
- Confronto screenshot con `documenti-dati.html`; eventuali differenze residue devono essere annotate nella story prima di dichiarare la parity raggiunta.

## Retrospective

- **Errore:** applicare `.dc-page` come se fosse sul body e usare selettori `body.dc-page` quando il layout effettivo era `layouts.design-comuni`.
- **Causa:** non verificare il DOM runtime e il contratto del plugin PostCSS prima del primo screenshot.
- **Guardrail:** ogni nuovo blocco deve verificare `main.className`, `body.className`, il selector canonico di isolamento e almeno un `getComputedStyle` per ogni regione critica.
