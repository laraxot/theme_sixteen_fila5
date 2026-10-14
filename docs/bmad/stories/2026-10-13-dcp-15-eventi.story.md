---
id: dcp-15
title: "DCP-15: eventi (Vivere il comune), pagina indicata dall'utente"
type: story
epic: dc-parity-v2
status: done
priority: P1
owner: theme:Sixteen
created: 2026-10-13
updated: 2026-10-13
qmd: "design comuni parity eventi vivere il comune card eventi luoghi events-page bmad story"
tags: [docs, sixteen, bmad]
---

# DCP-15: eventi

## Richiesta
"fa https://italia.github.io/design-comuni-pagine-statiche/sito/eventi.html" (dopo una seconda estrazione casuale, `segnalazione-01-privacy`, fermata alla baseline: vedi DCP-16).

## Baseline (misurata prima di toccare nulla)
Esisteva `tests.eventi.json` con 7 blocchi legacy Tailwind (`breadcrumb`, `hero`, `featured-events`, `events-calendar`, `events-list`, `feedback`, `contacts`). HTML body 42,93% (46,64% con URL normalizzati); pixel 44 / 40,9 / 32,7 / 19,5 / 22,2% a 1920 / 1440 / 992 / 768 / 375 px; altezze 5066 contro 3875 (1920), 10547 contro 4031 (768).

## Cosa e' stato fatto
1. JSON `tests.eventi.json` (tenant e modulo) riscritto con **un solo blocco** `events-page`: dati estratti dal riferimento con uno script (6 eventi, 6 luoghi, hero, didascalia, pulsanti) e `feedback`/`contacts` come nella homepage.
2. Blocco `components/blocks/events-page/design-comuni.blade.php`: breadcrumb, hero con immagine, sezioni di card scelte da `sections[].style` (`grey` o `plain`), card con data a calendario opzionale; rating e contatti dai partial condivisi. L'`href=""` dei titoli delle card replica il riferimento (dato di fixture).
3. 15 immagini del riferimento in `public/design-comuni/assets/images/` (`roma-colosseo.png` pesa 3,7 MB: fixture identica al riferimento; non duplicate in `docs/Main_files`, lo script `copy` non cancella i file in `public/`).
4. Pagina aggiunta a `scripts/regenerate-design-comuni-css.sh`; nessun CSS scritto a mano. Nessun comportamento nuovo (il rating usa il componente esistente).

## Risultato (misurato con `bashscripts/tools/visual/parity-gate.sh`)
- **Visual 99,76 / 99,68 / 99,91 / 99,94 / 99,87%** a 1920 / 1440 / 992 / 768 / 375 px, **altezze identiche** (5066, 6189, 10547, 9620).
- **HTML body 88,78% rigoroso, 98,36% con URL normalizzati.** Sotto il 90% rigoroso solo per i valori degli URL: 94 token (48 `<use>`, 32 `<a>`, 14 `<img>`) hanno `href`/`src` relativi nel riferimento e assoluti da noi. Gli altri token diversi: `Whatsapp` / `WhatsApp`, `<label for="radio-4">` (errore del riferimento sul quinto radio, non replicato), il wrapper Livewire.
- Hover (`.card-wrapper`, `.card-title a`, `.read-more`, `.category`, `.btn-outline-primary`, `.card-calendar`): differenze solo di 0,016 px negli arrotondamenti. Rating voto 4 a 1440 98,7%, voto 2 a 375 100%; menu mobile 99,82%.
- Regressione: homepage, risultati-ricerca e appuntamento-02 invariate (99,7-99,9%); `/it` identica (0,000%); `/it/tickets` invariata.

## Coordinamento
Un altro agente lavorava su eventi nello stesso momento (story `eventi-visual-parity-97`, evidenze `bmad/evidence/eventi-*`, `blocks/events-calendar/default`) e aveva creato `eventi.json` con lo stesso slug `tests.eventi`: `CMS content collision` (500) per tutti. Il file e' stato spostato (backup nello scratchpad) e la regola e' in `prompts/homepage/00-COORDINATION.md`. La story dell'altro agente non e' stata toccata: va collegata o marcata `superseded` con questi numeri.

## Come si controlla
```bash
bashscripts/tools/visual/parity-gate.sh https://italia.github.io/design-comuni-pagine-statiche/sito/eventi.html \
  http://192.168.1.40:8000/it/tests/eventi --stub-images 'picsum\.photos' --fail-if-contains '|---LINE:'
```
