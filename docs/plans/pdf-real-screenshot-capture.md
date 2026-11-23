---
title: "PDF e screenshot reali del front office"
type: plan
status: evidence-ready
tags: [pdf, screenshot, playwright, front-office]
---

# PDF e screenshot reali del front office

## Evidenza verificata

Playwright ha raggiunto con successo:

- `http://127.0.0.1:8091/it/tests/homepage` — titolo `Homepage - Modello Comuni | FixCity`.
- `http://192.168.1.40:8000/it/tests/homepage` — stesso titolo e struttura FO.

Sono stati osservati come non utilizzabili per la cattura:

- `http://127.0.0.1:8000/it/tests/homepage` — HTTP 500.
- `http://192.168.1.40:8001/it` — HTTP 500.

Il primo screenshot reale è stato catturato con Playwright in viewport CSS e salvato in
`docs/screenshots/homepage/homepage-real-playwright.png`. L'immagine proviene dal DOM e
dai font caricati dalla pagina; non è una composizione sintetica. La cattura full-page ha
superato il timeout del backend MCP, quindi va eseguita solo dopo aver stabilizzato il
layout o con lo script locale dedicato.

## Strumenti disponibili

- Playwright MCP: navigazione, snapshot accessibile, resize e screenshot viewport/full-page.
- Playwright locale nel tema: `@playwright/test` e `playwright`; gli script `take-screenshots-*.cjs`
  e `visual-compare-*.cjs` sono già presenti.
- PDF applicativo: `Modules/Xot/app/Actions/Html/HtmlToPdfAction.php`, usato da
  `Modules/Notify/app/Actions/NotifyTheme/Attachment/Pdf.php`.
- Adapter PDF Xot: supporto a renderer HTML e a Browsershot; il lockfile contiene anche
  Dompdf/Mpdf e `spatie/browsershot`, ma le loro classi non risultano installate nel vendor
  runtime corrente. La scelta del renderer va verificata per il documento, senza introdurre
  una dipendenza nuova.

## Procedura proposta

1. Usare come base URL il listener realmente funzionante (`8091` per il test isolato oppure
   `192.168.1.40:8000` per il server FO condiviso); non usare gli endpoint con HTTP 500.
2. Prima della cattura, registrare URL, status HTTP, titolo, snapshot accessibile e console.
3. Catturare screenshot reali a 375, 768 e 1440 CSS px, mantenendo nomi stabili e indicando
   il percorso URL nella documentazione. Usare `fullPage` solo se la cattura termina senza
   timeout; altrimenti documentare il viewport e suddividere le pagine lunghe.
4. Per un PDF da pagina FO, usare Playwright `page.pdf()` dopo aver verificato il rendering
   reale e `page.emulateMedia({ media: 'print' })`. Per allegati applicativi, usare invece
   `HtmlToPdfAction` e il renderer già configurato nel modulo owner.
5. Dopo ogni cattura, verificare che il file esista, sia leggibile e corrisponda all'URL
   osservato; non accettare screenshot placeholder o generati senza una pagina raggiungibile.

## Vincoli

- Non cambiare i server condivisi né i file modificati da altri agenti.
- Non usare screenshot sintetici, mock HTML o dati inventati.
- Prima di produrre un manuale definitivo, ripetere la verifica su una sessione/fixture
  isolata e registrare eventuali pagine non raggiungibili come blocker, non come screenshot.
