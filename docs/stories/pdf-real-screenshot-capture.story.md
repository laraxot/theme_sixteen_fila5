---
title: "PDF e screenshot reali del front office"
type: story
status: evidence-ready
tags: [pdf, screenshot, playwright, front-office]
---

# PDF e screenshot reali del front office

## Evidenza verificata

Playwright ha raggiunto:

- `http://127.0.0.1:8091/it/tests/homepage` — HTTP riuscito, titolo `Homepage - Modello Comuni | FixCity`.
- `http://192.168.1.40:8000/it/tests/homepage` — HTTP riuscito, stessa struttura FO.

Non usare per le catture:

- `http://127.0.0.1:8000/it/tests/homepage` — HTTP 500.
- `http://192.168.1.40:8001/it` — HTTP 500.

È stata catturata una schermata reale, non sintetica, con Playwright MCP:
`docs/screenshots/homepage/homepage-real-playwright.png` (1280×720 CSS px).
La cattura proviene da `http://192.168.1.40:8000/it/tests/homepage`.
La cattura full-page ha superato il timeout MCP; il viewport è quindi l'artefatto verificato.

## Strumenti e scelta tecnica

- Playwright MCP e gli script locali `take-screenshots-*.cjs`/`visual-compare-*.cjs` del tema
  coprono navigazione, snapshot accessibile, resize e screenshot.
- Il PDF applicativo passa da `Modules/Xot/app/Actions/Html/HtmlToPdfAction.php`, che usa
  `spipu/html2pdf`; `Modules/Notify/.../Pdf.php` lo invoca per gli allegati.
- Xot espone anche un adapter con `withBrowsershot`; Dompdf, Mpdf e Browsershot sono presenti
  nel lockfile come riferimenti opzionali, ma le loro classi non risultano installate nel
  vendor runtime corrente. Non introdurre dipendenze per questa verifica.

## Strategia di consegna

1. Per ogni pagina, registrare URL, status, titolo, snapshot e console prima di catturare.
2. Catturare viewport reali a 375, 768 e 1440 CSS px sul server raggiungibile; usare `fullPage`
   solo quando termina senza timeout.
3. Per il manuale web, usare Playwright `page.pdf()` solo dopo aver verificato la pagina reale
   e `emulateMedia({ media: 'print' })`. Per allegati di dominio, usare l'Action Xot già in uso.
4. Verificare dimensione e leggibilità di ogni PNG/PDF e conservare il percorso URL osservato.
5. Un endpoint 500 o un'immagine placeholder è un blocker, non un risultato documentabile.

## Vincoli

Non cambiare i server condivisi, non toccare modifiche concorrenti e non usare HTML mock o
screenshot sintetici.
