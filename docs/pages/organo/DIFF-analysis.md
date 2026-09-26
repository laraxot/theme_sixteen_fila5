# DIFF Analysis: organo

**Data**: 2026-04-06
**Parity strutturale**: 100%
**Status**: ✅

## URL
- Reference: **NON DISPONIBILE** (404 su https://italia.github.io/design-comuni-pagine-statiche/sito/organo.html)
- Local: http://127.0.0.1:8000/it/tests/organo

**IMPORTANTE**: Questa pagina non ha una controparte nel progetto Design Comuni di riferimento.
Il reference non include pagine per "organo", "organo di governo" o simili come pagine standalone.

## Struttura Reference (tag principali)
```
(404 - pagina non esistente nel reference)
```

## Struttura Local (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main data-page="organo">
<nav class="breadcrumb-container" aria-label="breadcrumb">
<section class="it-hero-wrapper bg-white align-items-start">
<h1 class="text-black" data-element="page-name">
<h2 class="title-xxlarge mb-4">
<h3 class="card-title t-primary title-xlarge">
<h3 class="card-title t-primary title-xlarge">
<h3 class="card-title t-primary title-xlarge">
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

**Nessun confronto diretto possibile** - reference non esiste.

### Struttura Local Analizzata
La pagina local usa:
- `cmp-breadcrumbs` + `breadcrumb-container`
- `it-hero-wrapper bg-white align-items-start`
- `h1.text-black`
- Sezione cards: `container py-5` + `row g-4`
- Card: `cmp-card-simple card-wrapper pb-0 rounded border border-light` + `card shadow-sm rounded`
- Card title: `h3.card-title t-primary title-xlarge`
- Card description: `p.text-secondary mb-0 description`
- Layout: `col-md-6 col-xl-4`

### Struttura simile a
La pagina `organo` ha la stessa struttura di `aree-amministrative` - una lista di membri/componenti dell'organo come card `cmp-card-simple`.

### Potenziali Issues
- [ ] Verificare se il reference ha pattern equivalenti in `amministrazione.html` per organi di governo
- [ ] La struttura `cmp-card-simple` è appropriata per questo tipo di contenuto?
- [ ] Manca sezione feedback/rating
- [ ] Verificare breakpoint (`col-xl-4` vs `col-lg-4`)

## Link
- [Indice pagine](../PAGES-INDEX.md)
- [Design Comuni docs](../../design-comuni/00-index.md)
