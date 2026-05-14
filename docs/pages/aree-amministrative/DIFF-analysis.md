# DIFF Analysis: aree-amministrative

**Data**: 2026-04-06
**Parity strutturale**: 100%
**Status**: ✅

## URL
- Reference: **NON DISPONIBILE** (404 su https://italia.github.io/design-comuni-pagine-statiche/sito/aree-amministrative.html)
- Local: http://127.0.0.1:8000/it/tests/aree-amministrative

**IMPORTANTE**: Questa pagina non ha una controparte nel progetto Design Comuni di riferimento.
La pagina reference "aree-amministrative.html" restituisce 404. Le pagine disponibili nel reference sono
solo: `amministrazione.html` e `documenti-dati.html` nella sezione Amministrazione.

## Struttura Reference (tag principali)
```
(404 - pagina non esistente nel reference)
```

## Struttura Local (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main data-page="aree-amministrative">
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
La pagina local usa il pattern standard con:
- `cmp-breadcrumbs` + `breadcrumb-container`
- `it-hero-wrapper bg-white align-items-start` + `it-hero-text-wrapper`
- `h1.text-black`
- Sezione cards: `cmp-card-simple card-wrapper pb-0 rounded border border-light` + `card shadow-sm rounded`
- Card titles: `h3.card-title t-primary title-xlarge`
- Card description: `p.text-secondary mb-0 description`
- Layout griglia: `col-md-6 col-xl-4`

### Valutazione Qualità Local
La struttura local è coerente con il pattern `cmp-card-simple` usato in `lista-categorie` e `amministrazione`.
Si tratta di una lista di aree amministrative con card testuali.

**Possibile riferimento di design da usare**: La sezione "Aree amministrative" mostrata dentro `amministrazione.html`
nel reference Design Comuni usa `cmp-card-simple card-wrapper pb-0 rounded border border-light`.
Il local rispetta questo pattern.

### Potenziali Issues
- [ ] Verificare se il layout rispecchia il pattern di `amministrazione.html` sezione 2
- [ ] Confermare che `col-md-6 col-xl-4` sia il breakpoint corretto (reference usa `col-md-6 col-lg-4`)
- [ ] Verificare presenza sezione feedback (assente nel local)

## Link
- [Indice pagine](../PAGES-INDEX.md)
- [Design Comuni docs](../../design-comuni/00-index.md)
