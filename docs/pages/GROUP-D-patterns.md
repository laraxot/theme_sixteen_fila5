# GROUP D - Pattern CSS Comuni (Appuntamenti e Segnalazioni)

**Data analisi**: 2026-04-06
**Agente**: GROUP-D Analysis Agent
**Pagine analizzate**: 20 pagine (8 appuntamento + 5 segnalazione + 2 assistenza + 5 generali)

---

## PATTERN 1: Steppers Component (CRITICO - presente in 13/20 pagine)

### Struttura HTML di riferimento (Bootstrap Italia)

```html
<div class="container">
  <div class="steppers">
    <div class="steppers-header">
      <ul>
        <li class="active">
          Luogo
          <span class="visually-hidden">Attivo</span>
        </li>
        <li class="confirmed">
          Data e orario
          <svg class="icon steppers-success" aria-hidden="true">
            <use href="...#it-check"></use>
          </svg>
          <span class="visually-hidden">Confermato</span>
        </li>
        <li class="">
          Dettagli appuntamento
        </li>
      </ul>
      <span class="steppers-index" aria-hidden="true">1/5</span>
    </div>
  </div>
  <p class="title-xsmall d-lg-none my-5">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>
</div>
```

### CSS necessario in app.css (da `bootstrap-italia` node_modules)

Il CSS per `.steppers` esiste in `node_modules/bootstrap-italia/dist/css/bootstrap-italia.min.css` ma NON è incluso nel build locale. Occorre aggiungere:

```css
/* === STEPPERS COMPONENT === */
.steppers .steppers-index {
  margin-left: auto;
  font-size: .875rem;
  font-weight: 600;
  flex-shrink: 0;
  display: none; /* mobile: show on desktop */
}
.steppers .steppers-header {
  padding: 0 24px;
  height: 64px;
  background: #fff;
  box-shadow: 0 8px 20px rgba(0,0,0,.1);
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 1rem;
}
.steppers .steppers-header ul {
  display: flex;
  width: 100%;
  padding: 0;
  margin: 0;
}
.steppers .steppers-header ul li {
  display: flex;
  font-size: 1.125rem;
  font-weight: 600;
  color: hsl(210, 17%, 44%);
  list-style-type: none;
}
/* Mobile: solo active visibile */
.steppers .steppers-header ul li:not(.active) {
  clip: rect(1px, 1px, 1px, 1px);
  height: 0;
  position: absolute;
  display: block;
}
.steppers .steppers-header ul li.active,
.steppers .steppers-header ul li.confirmed {
  color: #06c;
}
.steppers .steppers-nav {
  display: flex;
  height: 64px;
  padding: 0 24px;
  box-shadow: 0 -8px 20px rgba(0,0,0,.1);
  background: #fff;
  align-items: center;
  justify-content: space-between;
  margin-top: .889rem;
}
/* Desktop: tutti gli step visibili */
@media (min-width: 992px) {
  .steppers .steppers-header ul li:not(.active) {
    clip: auto;
    height: auto;
    position: static;
  }
  .steppers .steppers-index {
    display: block;
  }
}
```

### Step state variants

| Classe li | Stato | Aspetto |
|-----------|-------|---------|
| (nessuna) | futuro | testo grigio |
| `.active` | corrente | testo blu #06c |
| `.confirmed` | completato | testo blu + icona it-check |

---

## PATTERN 2: Layout a 3 colonne con Navscroll (presente in 11/20 pagine)

### Struttura HTML

```html
<div class="container">
  <div class="row">
    <!-- Sidebar navscroll (3 col, solo desktop) -->
    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
      <div class="cmp-navscroll sticky-top">
        <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
          <div class="navbar-custom">
            <div class="menu-wrapper">
              <div class="link-list-wrapper">
                <div class="accordion">
                  <div class="accordion-item">
                    <span class="accordion-header">
                      <button class="accordion-button pb-10 px-3">
                        INFORMAZIONI RICHIESTE
                        <svg class="icon icon-xs right">...</svg>
                      </button>
                    </span>
                    <div class="progress">
                      <div class="progress-bar it-navscroll-progressbar" role="progressbar"></div>
                    </div>
                    <div class="accordion-collapse collapse show">
                      <div class="accordion-body">
                        <ul class="link-list" data-element="page-index">
                          <li class="nav-item">
                            <a class="nav-link" href="#section-id">
                              <span>Nome sezione</span>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
    
    <!-- Contenuto principale (8 col + offset 1) -->
    <div class="col-12 col-lg-8 offset-lg-1">
      <div class="steppers-content" aria-live="polite">
        <div class="it-page-sections-container">
          <section class="it-page-section" id="section-id">
            <!-- Content -->
          </section>
        </div>
        <!-- Navigation CTA -->
        <div class="cmp-nav-steps">
          <nav class="steppers-nav" aria-label="Step">
            <button type="button" class="btn btn-sm steppers-btn-prev p-0">...</button>
            <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm">
              <span class="text-button-sm">Avanti</span>
            </button>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
```

### CSS necessario

```css
/* === NAVSCROLL PROGRESSBAR === */
.it-navscroll-wrapper .progress {
  height: 2px;
  margin: 0;
  border-radius: 0;
}
.it-navscroll-wrapper .it-navscroll-progressbar {
  background-color: #06c;
  height: 2px;
}

/* === STEPPERS CONTENT === */
.steppers-content {
  outline: none;
}

/* === PAGE SECTIONS === */
.it-page-sections-container .it-page-section {
  scroll-margin-top: 80px;
}
```

---

## PATTERN 3: Card con has-bkg-grey (presente in 10/20 pagine)

### Struttura HTML

```html
<div class="cmp-card mb-40">
  <div class="card has-bkg-grey shadow-sm p-big">
    <div class="card-header border-0 p-0 mb-lg-20">
      <div class="d-flex">
        <h2 class="title-xxlarge mb-0">Titolo sezione</h2>
      </div>
      <p class="subtitle-small mb-0">Sottotitolo descrittivo</p>
    </div>
    <div class="card-body p-0">
      <!-- Form content -->
    </div>
  </div>
</div>
```

### CSS esistente (da style-apply.css)

`card.has-bkg-grey` è già definito. Verificare `p-big` e `mb-40`:

```css
/* Da aggiungere se mancanti */
.p-big { padding: 2rem; }
.mb-40 { margin-bottom: 2.5rem; }
.mb-50 { margin-bottom: 3.125rem; }
.mb-lg-20 { } /* bootstrap margin utility */
.p-lg-4 { } /* bootstrap padding utility */
```

---

## PATTERN 4: Form Fields Bootstrap Italia (presente in 8/20 pagine)

### Input standard

```html
<div class="form-group cmp-input mb-0">
  <label class="cmp-input__label" for="name">Nome*</label>
  <input type="text" class="form-control mt-4" id="name" name="name" required>
</div>
```

### Select con select-wrapper

```html
<div class="select-wrapper p-0 select-partials">
  <label for="office-option" class="visually-hidden">Tipo di ufficio</label>
  <select id="office-option" class="">
    <option value="">Seleziona opzione</option>
    <!-- options -->
  </select>
</div>
```

### Form wrapper

```html
<div class="form-wrapper bg-white p-4">
  <!-- form fields -->
</div>
```

### CSS necessario

```css
/* === SELECT WRAPPER === */
.select-wrapper {
  position: relative;
}
.select-wrapper select {
  appearance: none;
  -webkit-appearance: none;
  background-image: url("data:image/svg+xml,...chevron...");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  padding-right: 2.5rem;
  border: 1px solid #5b6f82;
  border-radius: 0;
  width: 100%;
  padding: .375rem .75rem;
}

/* === CMP INPUT === */
.cmp-input .form-control {
  border: none;
  border-bottom: 2px solid #5b6f82;
  border-radius: 0;
  padding: .375rem 0;
  background: transparent;
}
.cmp-input .form-control:focus {
  border-bottom-color: #06c;
  box-shadow: none;
  outline: none;
}

/* === FORM WRAPPER === */
.form-wrapper {
  border: 1px solid #e3e7eb;
}
```

---

## PATTERN 5: Confirmation/Success Hero (presente in 3/20 pagine)

Usato da: `appuntamento-06-conferma`, `segnalazione-04-conferma`, `assistenza-02-conferma`

### Struttura HTML

```html
<div class="cmp-heading p-0">
  <div class="categoryicon-top d-flex">
    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
      <use href="...#it-check-circle"></use>
    </svg>
    <h1 class="title-xxxlarge">Segnalazione inviata</h1>
  </div>
  <p class="subtitle-small">Grazie, abbiamo ricevuto la tua <strong>segnalazione AN4059281.</strong></p>
</div>
```

### CSS necessario

```css
.categoryicon-top {
  align-items: center;
  margin-bottom: 1rem;
}
.icon-success {
  fill: #008758; /* verde successo */
}
.mr-10 {
  margin-right: 0.625rem;
}
```

---

## PATTERN 6: Contatti/Supporto Section (presente in 15/20 pagine)

### Struttura HTML

```html
<div class="bg-grey-card shadow-contacts">
  <div class="container">
    <div class="row d-flex justify-content-center p-contacts">
      <div class="col-12 col-lg-6">
        <div class="cmp-contacts">
          <div class="card w-100">
            <div class="card-body">
              <h2 class="title-medium-2-semi-bold">Contatta il comune</h2>
              <ul class="contact-list p-0">
                <li>
                  <a class="list-item" href="#">
                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                      <use href="...#it-help-circle"></use>
                    </svg>
                    <span>Leggi le domande frequenti</span>
                  </a>
                </li>
                <!-- altri link -->
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

### CSS esistente (già in app.css)

`.p-contacts`, `.cmp-contacts`, `.shadow-contacts` sono già implementati nella homepage parity. Verificare che funzionino fuori dal contesto `.dc-homepage-parity`.

**Problema**: Il CSS attuale è scoped a `.dc-homepage-parity`. Serve CSS globale per questi pattern.

---

## PATTERN 7: Rating Component (presente in 3/20 pagine)

Usato nella pagina di conferma (confirmation pages): `segnalazione-04-conferma`, `appuntamento-06-conferma`.

### Struttura HTML

```html
<div class="bg-primary">
  <div class="container">
    <div class="row d-flex justify-content-center bg-primary">
      <div class="col-12 col-lg-6 p-lg-0 px-4">
        <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
          <div class="card shadow card-wrapper" data-element="feedback">
            <div class="cmp-rating__card-first">
              <div class="card-header border-0">
                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">
                  Quanto è stato facile usare questo servizio?
                </h2>
              </div>
              <div class="card-body">
                <fieldset class="rating">
                  <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                  <input type="radio" id="star5a" name="ratingA" value="5">
                  <label class="full rating-star active" for="star5a">
                    <!-- SVG star -->
                  </label>
                  <!-- ... più stelle ... -->
                </fieldset>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

### CSS esistente (già in app.css)

`.cmp-rating` è già implementato. Verificare funzionamento fuori dal contesto `.dc-homepage-parity`.

---

## PATTERN 8: Tab Navigation personale (segnalazione-area-personale)

### Struttura HTML

```html
<div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
  <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap">
    <li class="nav-item w-100" role="tab">
      <a class="nav-link justify-content-start text-tab active" href="#tab1" 
         data-bs-toggle="tab" role="button">
        <svg class="icon me-1 mr-lg-10">
          <use href="...#it-pa"></use>
        </svg>
        Scrivania
      </a>
    </li>
    <!-- altre tab -->
  </ul>
</div>
```

### CSS necessario

```css
.nav-tabs-icon-text .nav-link {
  display: flex;
  align-items: center;
  font-size: 0.875rem;
  font-weight: 600;
  padding: 0.75rem 1rem;
  border-bottom: 2px solid transparent;
  color: #5b6f82;
}
.nav-tabs-icon-text .nav-link.active {
  color: #06c;
  border-bottom-color: #06c;
}
```

---

## PATTERN 9: Alert Success in-line (presente nei form multi-step)

```html
<div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
  <span class="d-inline-block text-uppercase cmp-disclaimer__message">
    Richiesta salvata con successo
  </span>
</div>
```

---

## PATTERN 10: Card Radio List per timeslot (appuntamento-02-data-orario)

```html
<div class="cmp-card-radio-list mt-4">
  <div class="card p-3">
    <div class="card-body p-0">
      <div class="form-check m-0">
        <fieldset>
          <legend class="visually-hidden">Seleziona un giorno e orario</legend>
          <input type="radio" id="time-1" name="time" value="...">
          <label for="time-1" class="...">
            <span>Giovedì 11 Marzo 2022 ore 10:00</span>
          </label>
        </fieldset>
      </div>
    </div>
  </div>
</div>
```

---

## Riepilogo CSS Mancante Critico

| Pattern | Classi CSS mancanti | Impatto |
|---------|---------------------|---------|
| Steppers | `.steppers`, `.steppers-header`, `.steppers-nav`, `.steppers-content`, `.steppers-btn-prev`, `.steppers-btn-confirm`, `.steppers-success`, `.steppers-index` | ALTO - 13 pagine |
| Select wrapper | `.select-wrapper`, `.select-partials` | ALTO - 8 pagine |
| Form wrapper | `.form-wrapper`, `.cmp-input`, `.cmp-input__label` | ALTO - 8 pagine |
| p-big/mb-40/mb-50 | `.p-big`, `.mb-40`, `.mb-50`, `.mb-lg-20` | MEDIO - 10 pagine |
| Navscroll progress | `.it-navscroll-progressbar` | MEDIO - 11 pagine |
| categoryicon-top | `.categoryicon-top`, `.icon-success`, `.mr-10` | BASSO - 3 pagine |
| cmp-contacts global | rimuovere scope `.dc-homepage-parity` | MEDIO - 15 pagine |
| cmp-rating global | rimuovere scope `.dc-homepage-parity` | MEDIO - 3 pagine |

---

## Note sulla struttura locale

I file JSON delle pagine del Gruppo D usano 3 tipi di struttura:

1. **Placeholder (tests blocchi)**: `segnalazione-01-privacy` e altri usano ancora i vecchi blocchi `tests.intro`, `tests.body`, `tests.governance-note` - struttura MOLTO diversa dal reference
2. **Flow components**: `appuntamento-01-ufficio`, `appuntamento-02-data-orario` ecc. usano `flow.stepper` + `flow.appuntamento.XX` - struttura parzialmente simile ma con bug nell'`x-stepper` component (htmlspecialchars error su array)
3. **Custom blocks**: `prenotazione-appuntamento`, `assistenza-01-dati`, `segnalazione-area-personale` usano blocchi generici (breadcrumb, hero, form, card-list) - struttura DIVERSA dal reference
