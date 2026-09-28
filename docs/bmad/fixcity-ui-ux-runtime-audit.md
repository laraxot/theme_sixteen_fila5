---
title: "FixCity UI/UX runtime audit — Sixteen"
type: audit
status: active
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, fixcity, sixteen, ui, ux, browser, accessibility]
qmd: "FixCity Sixteen runtime browser responsive tracking UI UX accessibility gap evidence"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - README.md
  - ../../../../Modules/Fixcity/docs/bmad/workflows/07-ui-ux.md
  - ../../../../Modules/Fixcity/docs/bmad/ui-ux-runtime-audit-2026-09-26.md
---

# FixCity UI/UX runtime audit — Sixteen

Questo report raccoglie solo evidenza osservata nel browser o nelle verifiche
automatiche. La logica ticket e la privacy restano di proprietà del modulo
Fixcity; Sixteen possiede layout e presentazione.

## Percorsi verificati

| Percorso | Evidenza | Limite |
|---|---|---|
| Lista pubblica `/it/segnalazioni` | Chromium a 320/360/768/1440 px; HTTP 200, titolo e CTA canonici, tab Mappa/Elenco, nessun overflow o errore JS | Dataset live senza ticket: marker e popup su segnalazione reale non osservati |
| Tracking guest con codice valido | SQLite effimero; 320/768/1440 px; titolo, ticket, stato e timeline localizzati; nessun overflow; codice capability non mostrato | Ambiente sintetico locale, non prova deploy/staging |
| Tracking owner tramite ID | Owner autenticato vede il proprio codice e stato; contesto guest separato riceve 403 | Non sostituisce test con account e dati staging |
| Tracking guest con codice non trovato | IT 320 px ed EN 1440 px; valore conservato, errore localizzato e `aria-invalid`; nessun overflow/error JS | Tastiera e screen reader non verificati end-to-end |
| Wizard autenticato IT/EN | Percorso canonico `/tickets/create`, title CMS e riepilogo localizzati a 320/768/1440; nessuna chiave grezza, overflow o errore JS; il flusso IT ha caricato un'immagine, inviato e raggiunto conferma con ticket/media su SQLite effimero | Tastiera/screen reader completa e smoke staging non verificati |
| Creazione via CTA guest | Il link canonico arriva al login locale | Upload, errori inline e conferma del flusso autenticato da verificare nel browser |
| Footer IT/EN | View attiva Sixteen con cataloghi distinti, marchio FixCity, URL localizzati a home, crea e traccia; rimossi dati comunali inventati e tutti gli `href="#"` | Chromium su `/it/auth/login` e `/en/auth/login`, 320/768/1440 px: testi e URL attesi, nessun overflow o errore JS. Pest mirato: 2 test / 16 asserzioni; suite Fixcity: 369 test / 1.570 asserzioni; `view:cache` passano con SQLite isolato. Recapiti, privacy, note legali e accessibilità restano mancanti (Fixcity G-26) |

La suite Fixcity più recente è passata: 369 test / 1.570 asserzioni su SQLite
isolato. PHPStan `analyse Modules`, Pint mirato, `view:cache`, `git diff --check`
e gate wiki sono passati; SQLite non sostituisce il test MySQL/staging.

## Lacune UX ancora aperte

- Completare verifica tastiera/screen reader del wizard; il submit, upload e
  conferma HTTP sono stati verificati solo nell'ambiente sintetico SQLite.
- Configurare recapiti e pagine istituzionali/legali verificati dell'ente (FixCity G-26); non pubblicare dati dimostrativi.
- Verificare rating nel dettaglio con tastiera, focus visibile e conferma.
- Verificare coda PA: filtri, assegnazione, transizione, feedback e responsive.
- Misurare contrasto e verificare screen reader; il controllo responsive non
  dimostra conformità accessibile.
- Ripetere i flussi con ticket geolocalizzati e account controllati su staging.

Il database usato per l'E2E tracking era SQLite in `/tmp`; non sono stati scritti
dati nel database condiviso e il server browser temporaneo è stato arrestato.
