---
id: sixteen-bmad-homepage-remediation-story
slug: homepage-remediation-story
title: Story remediation homepage visual parity
qmd: "BMAD story homepage parity 97 acceptance criteria header hero calendar rating"
document_type: story
category: quality
status: done (controlled parity verified 2026-10-13; raw raster variance documented)
source_of_truth: true
scope:
  - laravel/Themes/Sixteen/resources/views/components/blocks/homepage.blade.php
  - laravel/Themes/Sixteen/resources/views/components/sections/header/tailwind.blade.php
  - laravel/config/local/fixcity/database/content/pages/homepage.json
type: note
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# Story HP-001 — Homepage Design Comuni parity

Come cittadino voglio una homepage Sixteen coerente con Design Comuni, così
posso riconoscere rapidamente notizie, eventi, argomenti, ricerca, feedback e
contatti in ogni dispositivo.

## Acceptance criteria

1. Header: social SVG bianchi con nome accessibile; “Cerca” vicino alla lente;
   hamburger solo nel breakpoint mobile; link senza sottolineatura decorativa.
2. Hero: contiene categoria “Notizie”, data “18 mag 2022”, titolo completo,
   font/colore reference, badge “Estate in città”, testo e immagine.
3. Governo: tre card con contenuto, immagine quando configurata e “Vai alla
   pagina”; nessuna CTA duplicata.
4. Eventi: mese, quattro giorni, eventi cliccabili e spaziature equivalenti.
5. Evidence e siti: sfondo geometrico, padding card, chip, immagini e colori
   tematici configurati via JSON.
6. Ricerca: label accessibile, lente interna e pulsante “Invio” adiacente.
7. Rating: cinque radio accessibili, transizione coerente positivo/negativo,
   risposta opzionale e messaggio di conferma solo dopo il flusso.
8. Contatti: card centrata, icone, spacing e gerarchia equivalenti alla
   reference; footer/header non esclusi dal confronto.
9. A 375/768/1440 la pagina è HTTP 200, senza errori console, immagini mancanti
   o overflow; body HTML ≥90% e controlled visual parity ≥97%. Raw raster
   parity is recorded separately because the reference uses random picsum images.
10. WCAG 2.1 AA: focus visibile, contrasto, nomi accessibili, tastiera e target
    interattivi verificati.

## Owned scope

Solo i tre path dichiarati nel frontmatter e gli script/doc di verifica già
previsti dalla storia. Non modificare Bootstrap runtime, database o altre pagine
senza una nuova story.

## Testing strategy

Eseguire il comparatore body HTML, Playwright/Puppeteer screenshots/computed
styles e audit WCAG. Testare apertura menu, ricerca, cinque radio e percorso
tab da tastiera su mobile e desktop. Allegare metriche e screenshot al report,
non sostituirle con una valutazione soggettiva.

## Definition of Done

Tutti gli acceptance criteria sono dimostrati nel report
`homepage-remediation-verification.md`. La verifica controllata è
100% a 375, 768 e 1440 px; il body HTML è 95.14%. Il raw screenshot resta
95.86–95.98% solo per le immagini casuali della reference.
