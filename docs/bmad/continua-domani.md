---
id: continua-domani
title: Continuazione domani — loop aperto (97%)
document_type: continuation-log
date: 2026-10-13
source_of_truth: true
type: note
status: draft
updated: 2026-10-13
tags: [docs, sixteen, bmad]
qmd: "stato loop aperto (non chiuso) sixteen"
---

# Stato loop aperto (non chiuso)

**Gate 97% visual parity NON raggiunto** — loop rimane aperto per regola.

## Cosa è stato fatto (confermato)
- BMAD docs: docs/bmad/homepage-visual-parity-defects/ (ARCHITECTURE.md, defects-d01-d14.md, stories/ 14 file)
- Prompts: docs/prompts/homepage/index.md (correzione NO Bootstrap Italia)
- Componenti: event/, events/, search-results/, card/, accordion/, contact/, button/
- Contratti: NO design-system/; NO bootstrap-italia links (0 in layout-test.blade.php); NO homepage.blade.php duplicato; JSON tests.index.json governa
- Second brain: kp-174d15a58ff94901b2b0df0d86b8907a (stato APERTO)
- Pagine riferimento analizzate random: eventi, evento-dettaglio, accesso-servizio, index, risultati-ricerca, amministrazione, domande-frequenti, servizi, argomenti
- 70 storie BMAD confermate in docs/bmad/stories/ — nessuna creatura necessaria

## Per domani (ordine random, parallel con context-mode)
1. Screencapture Playwright/Puppeteer 375/768/1440 su: homepage / risultati-ricerca / evento-dettaglio / accesso-servizio
2. Correggere bottone Cerca (testo bianco su bianco) nel componente search-form
3. Completare tab groups Generali / Sito in tests.index.json
4. Installare Mauve / verificare WCAG 2.1 AA
5. Migliorare componenti card/accordion per evento-dettaglio (mancanti: card, accordion, rating, contacts)
6. Verificare che nessun bootstrap-italia.min.css compaia nel render (curl check)

## Vincoli (non negoziabili)
- AGENTS.md: no controllers, Folio+Actions, *Contract, forward-only git
- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite — NO Bootstrap Italia
- UX discipline: APCA contrast, token-only, full states, prefers-reduced-motion
- Loop: NON chiudere senza verifica visiva 97%
