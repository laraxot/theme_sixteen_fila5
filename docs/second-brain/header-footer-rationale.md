---
title: "Header/footer rationale"
type: decision
tags: [second-brain, header, footer, sections, json, sixteen]
qmd: "why header footer sections JSON Sixteen theme ownership"
status: draft
updated: 2026-10-11
---

# Perché header e footer sono sections JSON

La section CMS è il confine corretto: l'identità del Comune e i suoi link
variano per tenant, mentre il tema deve garantire la stessa struttura visuale
Design Comuni per tutte le installazioni. Per questo il JSON contiene dati,
non markup, e Sixteen contiene un solo renderer canonico.

L'errore più rischioso è trattare `x-section` come una semplice inclusione
Blade: `Section` passa `BlockData` a `v1`. Se `v1` ricrea sempre un blocco dai
props vuoti, la configurazione JSON viene silenziosamente ignorata. Il
contratto quindi impone la propagazione di `blocks` e mantiene i props soltanto
per i test diretti e la compatibilità.

Questa scelta evita tre duplicazioni: un layout `design-comuni`, un namespace
`pub_theme` alternativo e contenuto tenant copiato nei componenti. Le differenze
tra comuni restano nei file `sections/header.json` e `sections/footer.json`,
mentre UI, responsive e WCAG restano verificabili in un solo punto.
