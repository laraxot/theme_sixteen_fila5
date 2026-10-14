---
id: dcp-defects-d01-d14
title: "Dossier dei 14 difetti segnalati sulla homepage (audit 2026-10-13)"
type: report
status: in-progress
epic: dc-parity-v2
created: 2026-10-13
qmd: "difetti homepage design comuni causa prevenzione fix verifica d01 d14"
updated: 2026-10-13
tags: [docs, sixteen, bmad]
---

# I 14 difetti: causa, prevenzione, fix, controllo

Causa comune: il blocco era stato riscritto "a memoria" in Tailwind con classi arbitrarie invece di seguire il markup del riferimento, senza
un gate che misurasse. "Verificato" = riscontrato nel codice precedente (git HEAD del blocco `homepage.blade.php`) o con strumenti oggi;
"da verificare" = non ri-controllato alla fonte, rimandato alla story indicata.

| # | Difetto segnalato | Causa | Come non ripeterlo | Stato del fix | Controllo |
|---|---|---|---|---|---|
| D01 | "Seguici su": lettere nere, non SVG bianchi | da verificare in DCP-05 (template header Tailwind; il riferimento usa `svg.icon.icon-white > use` dallo sprite) | icone solo da sprite SVG, mai testo/font | DCP-05 | `--selector .it-socials` |
| D02 | Lente non attaccata al box, manca "Cerca" | da verificare in DCP-05 (riferimento: `.it-search-wrapper` con `span` "Cerca" `d-none d-md-block`) | copiare la struttura, non l'aspetto | DCP-05 | `--selector .it-search-wrapper` |
| D03 | Hamburger non appare quando serve | da verificare in DCP-05; il controller JS cerca `.custom-navbar-toggler` | testare con `--click` a 375 px | DCP-05 | `--width 375 --click .custom-navbar-toggler` |
| D04 | Tutti i link sottolineati | da verificare in DCP-05/DCP-03 (regole globali `a`) | usare `explain-style.mjs ... text-decoration-line` | DCP-03/05 | `explain-style.mjs` |
| D05 | Manca "Notizie 18 mag 2022"; font e colore del titolo sbagliati | verificato: il vecchio hero usava `font-serif` e `text-[#17324d]` invece di Titillium bold verde e `category-top` | markup del riferimento + font self-hosted | markup fatto (DCP-04); visual dopo DCP-03 | `--selector '#head-section'` |
| D06 | Titolo "Parte l'estate..." font/colore | idem D05 | idem | idem | idem |
| D07 | Manca il badge "Estate in citta'" | verificato: link testuale senza `chip chip-simple` | JSON `hero.badge` + classi del riferimento | fatto in JSON e blocco | `--selector '#head-section a.chip'` |
| D08 | Organi di governo senza immagine e senza "Vai alla pagina" | verificato: il vecchio template ignorava `image` e non emetteva `read-more` | il template legge tutti i campi del JSON | fatto (cicli da `government.items`) | `--selector .card-teaser-wrapper` |
| D09 | Calendario sbagliato | verificato: griglia a 4 colonne senza carosello Splide | Alpine `dcCalendar` con le opzioni misurate | fatto; visual dopo DCP-03 | `--selector '#calendario'` |
| D10 | Argomenti in evidenza: sfondo geometrico, padding | verificato: `evidenza-header.png` era 0 byte, azzerato da `npm run copy` (sorgente vuota) | test asset senza 0 byte (DCP-08) | asset ripristinati alla fonte | `--selector .evidence-section` |
| D11 | Siti tematici senza colori e immagini | verificato: il template ignorava `image` e `color` del JSON | `card-bg-{tone}` da `theme_sites.items[].tone` | fatto | `--selector .evidence-section` |
| D12 | "Cerca una parola chiave" senza lente e invio | verificato: `input` + bottone testuale senza `autocomplete-icon` | struttura `cmp-input-search` del riferimento | fatto | `--selector .useful-links-section` |
| D13 | Rating: comportamento sbagliato | verificato: Alpine con stelle gialle al passaggio; il riferimento e' a passi con radio e step | `dcRating` riproduce i passi (voto > 3 positivo) | fatto; verificare con `--click` | `--click 'label[for=star4a]' --selector '#rating'` |
| D14 | "Contatta il comune": spaziature | da verificare (struttura `cmp-contacts` e `contact-list` non ancora allineata al CSS) | stesso metodo: markup + CSS generato | DCP-04 | `--selector .bg-grey-card` |

## Stato a fine giornata 2026-10-13
D05-D14 (tutto il `<main>`): verificati con i pixel, sezione per sezione, a 1440/768/375 px: 99,2% - 100%, altezze identiche. D01-D04 (header) e il footer
restano da fare (DCP-05/06): header 92% a 1440, 72% a 992, 65% a 375.
Il difetto "pulsante Cerca bianco con testo bianco, verde solo in hover" della pagina risultati-ricerca aveva due cause: la regola legacy
`p, span, body { color: #1a1a1a !important }` e toppe `!important` a mano; ora lo stile e' quello del riferimento (`#007a52`, hover `#006342`).

## Controllo d'insieme
```bash
bash laravel/Themes/Sixteen/scripts/homepage-parity-defects.sh
```
Ogni riga stampa la parity del singolo elemento (soglia 97). Oggi le righe del `<main>` restano sotto soglia per DCP-03.
