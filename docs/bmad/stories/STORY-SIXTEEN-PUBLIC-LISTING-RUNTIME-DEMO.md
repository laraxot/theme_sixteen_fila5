---
title: "Sixteen — runtime asset delivery for the public listing demo"
type: story
status: in_progress
module: Sixteen
created: 2026-09-27
updated: 2026-09-27
tags: [bmad, fixcity, sixteen, guest, vite, i18n, ui-ux]
qmd: "FixCity public listing unstyled 8001 stale Vite hot missing CSS mobile overflow"
issues:
  - "https://github.com/laraxot/base_fixcity_fila5/issues/383"
discussions:
  - "https://github.com/laraxot/base_fixcity_fila5/discussions/392"
related:
  - ../public-ticket-listing-visual-contract.md
  - ../../../../Modules/Fixcity/docs/bmad/public-ticket-listing-experience.md
---

# Public listing demo: problema osservato e piano di correzione

## Confronto con il contratto UX

Prima di intervenire sono stati acquisiti screenshot guest di `/it` e `/en` a
320, 390, 768, 1024 e 1440 px. La risposta HTTP era 200, ma il risultato visivo
era privo del CSS del tema: il browser tentava di caricare CSS/JS da
`127.0.0.1:5173`, con `ERR_CONNECTION_REFUSED`. A 320 px il body arrivava a 348 px;
icone e SVG risultavano immagini rotte. Le prove sono temporanee in
`/tmp/fixcity-ui-audit/port8001-*.png` e non sono artefatti permanenti.

Il menu inglese mostrava inoltre alcune etichette italiane provenienti dal JSON
tenant. Gli asset statici Sixteen sono presenti nel manifest/pubblicazione, ma il
server Vite non è attivo quando il file `public_html/hot` dichiara una sessione HMR.

## Interventi ed evidenze

- [x] La home mostra contenuto FixCity localizzato e CTA Folio localizzate; il
  riferimento non valido al controller storico è stato rimosso nel lavoro
  condiviso. Il flusso pubblico è Folio + Volt; il back office resta Filament.
- [x] Corretti contrasto titolo/testo e contrasto CTA nella hero contro gli
  override globali `!important`, con padding orizzontale mobile e link senza
  sottolineatura. Modifica: `resources/css/civic-design-visual-fix.css`.
- [x] Allineato l'overline della route Folio `/it` al brand FixCity; rimosso il
  riferimento visibile al default `Laravel`.
- [x] Corretto il breadcrumb dell'elenco: `pub_theme::ui.home` non esisteva e
  stampava la chiave grezza; ora riusa `pub_theme::footer.home`, presente nei
  cataloghi IT/EN.
- [x] Build theme `npm run build` completata; manifest e asset pubblicati.
- [x] Browser guest IT/EN: nessun errore JS o request failure; CSS, JS e SVG
  caricati con risposta 200. A 320/390/768/1024/1440 px non c'è overflow.
- [x] Browser sui percorsi `/it/tickets`, `/it/tickets/create`, login e
  registrazione: lista Folio 200; creazione mantiene il locale e chiede login;
  le pagine di accesso e iscrizione rispondono 200 senza errori JS.
- [x] Migliorata l'evidenza visiva: screenshot pre/post conservati solo sotto
  `/tmp/fixcity-ui-audit/`.

## Piano residuo

- [ ] Correggere e verificare `php artisan dev`: nel run isolato Vite ha
  terminato con `ELOOP` su `Modules/Seo/.agents/skills/qmd`, mentre il processo
  log fallisce perché `pail` non è registrato. Gli asset compilati pubblicati
  continuano a funzionare senza HMR.
- [ ] Verificare destinazioni e flussi di lista, mappa e CTA end-to-end con
  sessione Playwright persistente.

## Criteri di chiusura

Asset CSS/JS 200, nessuna eccezione o overflow, nessuna etichetta italiana nella
UI inglese, CTA e link menu con destinazione corretta, `php artisan dev` stabile
e screenshot post-fix in entrambi i locale. La policy privacy non approvata
resta un gate distinto.
