# DIFF Analysis: persona

**Data**: 2026-04-06
**Parity strutturale**: 100%
**Status**: ✅

## URL
- Reference: **NON DISPONIBILE** (404 su https://italia.github.io/design-comuni-pagine-statiche/sito/persona.html)
- Local: http://127.0.0.1:8000/it/tests/persona

**IMPORTANTE**: Questa pagina non ha una controparte diretta nel progetto Design Comuni di riferimento.
La pagina "persona.html" nel reference non esiste. La pagina correlata più vicina è
`persona-dettaglio` che è presente separatamente.

## Struttura Reference (tag principali)
```
(404 - pagina non esistente nel reference diretto)
```

## Struttura Local (tag principali)
```
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
<nav aria-label="Principale">
<nav aria-label="Secondaria">
<main data-page="persona">
<nav class="breadcrumb-container" aria-label="breadcrumb">
<section class="it-hero-wrapper bg-white align-items-start">
<h1 class="text-black" data-element="page-name">
<h3 class="card-title t-primary title-xlarge">
<h3 class="title-medium-2-semi-bold mb-0">
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
- `cmp-breadcrumbs` + `breadcrumb-container` (con 3 livelli breadcrumb)
- `it-hero-wrapper bg-white align-items-start`
- `h1.text-black` + `div.hero-text > p` (intro)
- Sezione card persona: `container py-5` + `row` + `col-12 col-lg-8`
  - `cmp-card-simple card-wrapper pb-0 rounded border border-light` + `card shadow-sm rounded`
  - `h3.card-title t-primary title-xlarge`
  - `div.text-secondary mb-0 description > p`
- Sezione contatti: `div.cmp-contacts` + `card-wrapper` + `card bg-white shadow-sm`
  - `h3.title-medium-2-semi-bold mb-0`
  - Labels: `p.subtitle-small mb-1`
  - Links: `a.text-decoration-none t-primary`

### Struttura Unica
La pagina `persona` nel local ha una struttura interessante con:
1. Una card informativa principale (bio/ruolo)
2. Una sezione `cmp-contacts` con informazioni di contatto

### Potenziali Issues
- [ ] Verificare se il pattern `cmp-contacts` è corretto per Design Comuni
- [ ] La card principale usa `div.text-secondary` invece di `p.text-secondary` (possibile issue semantica)
- [ ] Verificare se mancano sezioni aggiuntive (deleghe, curriculum, ecc.)
- [ ] Manca sezione feedback/rating
- [ ] Confrontare con `persona-dettaglio` che è la pagina più simile nel reference

## Link
- [Indice pagine](../PAGES-INDEX.md)
- [Design Comuni docs](../../design-comuni/00-index.md)
- [Persona Dettaglio](../persona-dettaglio/DIFF-analysis.md) (pagina correlata nel reference)
