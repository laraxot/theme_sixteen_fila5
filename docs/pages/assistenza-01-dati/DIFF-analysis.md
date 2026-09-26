# DIFF Analysis: assistenza-01-dati

**Data**: 2026-04-06
**Parity strutturale**: 96%
**Status**: ✅

## URL
- Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/assistenza-01-dati.html
- Local: http://127.0.0.1:8000/it/tests/assistenza-01-dati

## Metriche HTML
| Metrica | Reference | Local |
|---------|-----------|-------|
| Righe HTML | 854 | 572 |
| Caratteri HTML | 43708 | 38397 |
| Parity strutturale | 100% | 96% |

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
<section class="it-hero-wrapper bg-white align-items-start">
<h1 class="text-black" data-element="page-name">
<nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INFORMAZIONI RICHIESTE" data-bs-navscroll="">
<form class="steppers-content" aria-live="polite" id="justValidateForm" novalidate="novalidate">
<section class="it-page-section" id="applicant">
<h2 class="title-xxlarge mb-0">
<section class="it-page-section" id="request">
<h2 class="title-xxlarge mb-0">
<nav class="steppers-nav" aria-label="Step">
<h2 class="title-medium-2-semi-bold">
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

## Struttura Local (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main data-page="assistenza-01-dati">
<nav class="breadcrumb-container" aria-label="breadcrumb">
<section class="section py-5">
<h2 class="mb-2">
<form action="#" method="POST" class="needs-validation" novalidate="">
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
