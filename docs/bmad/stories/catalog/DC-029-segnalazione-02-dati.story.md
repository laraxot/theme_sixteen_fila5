---
id: DC-029
status: ready-for-dev
type: design-comuni-page-parity
reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-02-dati.html
local: http://192.168.1.40:8000/it/tests/segnalazione-02-dati
title: "DC-029 — segnalazione-02-dati"
updated: 2026-10-14
tags: [docs, sixteen, bmad]
qmd: "dc-029   segnalazione-02-dati sixteen"
---

# DC-029 — segnalazione-02-dati

> Nota di coordinamento 2026-10-13: questa catalog story copre la pagina statica JSON-driven di test. Per il flusso reale `/it/tickets/create` passo dati + mappa, usare DCP-35/DCP-43. Ogni interpretazione che renda HTTPS requisito del ticket e' superseded: la posizione automatica e' progressiva, la selezione manuale sulla mappa resta sempre valida, e il centro iniziale deve preferire coordinate del record/stato gia' presenti prima della posizione browser/utente e del fallback Comune/default Geo.

Implement the JSON-driven Sixteen page for the reference route and preserve the existing <x-section slug="header" /> / <x-section slug="footer" /> shell.

## Acceptance criteria

1. The JSON page has a stable id and slug, and every visible reference region maps to a reusable Sixteen block with documented input data.
2. The page uses TailwindCSS, Alpine.js, Lit, DaisyUI and Flowbite only; no Bootstrap Italia runtime/CDN is added.
3. Playwright/Puppeteer screenshots at 375, 768 and 1440 px show no missing assets, browser errors or horizontal overflow.
4. HTML similarity is at least 90% and visual similarity is at least 95% against the reference URL.

## Verification

Run node bashscripts/design-comuni/verify-parity.mjs; attach the row from /tmp/fixcity-parity/automated/report.json and the screenshots to this story before marking done.

