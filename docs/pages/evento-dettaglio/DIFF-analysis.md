# DIFF Analysis: evento-dettaglio

**Data**: 2026-04-06
**Parity strutturale**: 51%
**Status**: ⚠️

## URL
- Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/evento-dettaglio.html
- Local: http://127.0.0.1:8000/it/tests/evento-dettaglio

## Metriche HTML
| Metrica | Reference | Local |
|---------|-----------|-------|
| Righe HTML | 1448 | 532 |
| Caratteri HTML | 80889 | 34108 |
| Parity strutturale | 100% | 51% |

## Screenshots
- ![REF desktop](./REF-desktop.png)
- ![LOCAL desktop](./LOCAL-desktop.png)
- ![REF mobile](./REF-mobile.png)
- ![LOCAL mobile](./LOCAL-mobile.png)

## Struttura Reference (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main>
<nav class="breadcrumb-container" aria-label="breadcrumb">
<h1 data-audio="">
<h2 class="h4 py-2" data-audio="">
<h6 class="text-secondary">
<aside class="col-lg-4">
<nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DELLA PAGINA" data-bs-navscroll="">
<section class="col-lg-8 it-page-sections-container border-light">
<article id="cos-e" class="it-page-section mb-5" data-audio="">
<h2 class="mb-3">
<h3 class="h4">
<h3 class="h4">
<h3 class="h4">
<article id="destinatari" class="it-page-section mb-5">
<h2 class="mb-3">
<article id="luogo" class="it-page-section mb-5">
<h2 class="mb-3">
<h3 class="card-title h5">
<article id="date-e-orari" class="it-page-section mb-5">
<h2 class="mb-3">
<h3 class="point-list-aside point-list-primary fw-normal">
<h3 class="card-title h5 m-0">
<h3 class="point-list-aside point-list-primary fw-normal">
<h3 class="card-title h5 m-0">
<article id="costi" class="it-page-section mb-5">
<h2 class="mb-3">
<h5>
```

## Struttura Local (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main data-page="evento-dettaglio">
<nav class="breadcrumb-container" aria-label="breadcrumb">
<section class="it-hero-wrapper bg-white align-items-start">
<h1 class="text-black" data-element="page-name">
<h2 class="title-xxlarge mb-4">
<form>
<h2>
<footer class="it-footer" id="footer">
<h2 class="no_toc">
<h4 class="footer-heading-title">
<h4 class="footer-heading-title">
<h4 class="footer-heading-title">
<h4 class="footer-heading-title">
<h4 class="footer-heading-title">
<h4 class="footer-heading-title">
```

## Differenze rilevate

Analisi visiva basata su screenshots. Vedere REF-desktop.png vs LOCAL-desktop.png.

Da verificare:
- [ ] Header/navbar identica
- [ ] Hero/breadcrumb identico
- [ ] Contenuto principale identico
- [ ] Footer identico
- [ ] Responsive mobile corretto


## Link
- [Indice pagine](../PAGES-INDEX.md)
- [Design Comuni docs](../../design-comuni/00-index.md)
