# Homepage - Analisi Strutturale Dettagliata

**Data Analisi**: 2026-04-07  
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**Local**: http://127.0.0.1:8000/it/tests/homepage  

---

## 📊 Statistiche Strutturali

| Metrica | Reference | Local | Differenza |
|---------|-----------|-------|-----------|
| Elementi totali | 1634 | 2012 | +378 (+23%) |
| Tag aperti | 836 | 1026 | +190 |
| Nodi di testo | 242 | 285 | +43 |
| Sezioni principali | 22 | 20 | -2 |
| Classi uniche | 285 | 277 | -8 |

---

## ❌ SEZIONI MANCANTI IN LOCAL

### 1. `section#head-section` (CRITICA)

**Posizione**: Immediatamente dopo `<main>`

**Importanza**: 🔴 **CRITICA** - Questa sezione contiene la news card in evidenza

**Contenuto mancante**:
```html
<section id="head-section">
  <h2 class="visually-hidden">Contenuti in evidenza</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 order-2 order-lg-1">
        <div class="card mb-5">
          <div class="card-body pb-5 px-0">
            <!-- News card with image, title, excerpt -->
          </div>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2">
        <!-- Image or visual content -->
      </div>
    </div>
  </div>
</section>
```

**Cosa serve**:
- Riga `.row` con responsive layout (`order-2`, `order-lg-1`)
- Colonna `.col-lg-6` con news card
- Card body con spacing specifico (`pb-5 px-0`)
- H3 all'interno del card
- Chip con tag della news
- Link "read more" con icona

**File da modificare**:
- `resources/views/pages/tests/[slug].blade.php` - Aggiungere la sezione head
- `resources/views/components/blocks/hero/homepage.blade.php` - Verificare struttura

---

## ⚠️ ELEMENTI STRUTTURALI DIFFERENTI

### 2. Navbar Toggler Button (Responsive)

**Reference**:
```html
<button class="custom-navbar-toggler">
  <svg class="icon"><use></use></svg>
</button>
```

**Local (Current)**:
```html
<button class="custom-navbar-toggler d-lg-none me-3">
  <svg class="icon"><use></use></svg>
</button>
```

**Differenza**: Local aggiunge `d-lg-none` e `me-3` - potrebbero essere aggiunte extra per responsiveness

**Azione**: Verificare se le classi extra infrangono lo stile reference

---

### 3. Button Link Style (Hero Section)

**Reference**:
```html
<a class="btn btn-primary btn-icon btn-full">
  <span class="rounded-icon">
    <svg class="icon icon-primary"><use></use></svg>
  </span>
  <span class="d-none d-lg-block">Text</span>
</a>
```

**Local (Current)**:
```html
<a class="btn btn-outline-light btn-icon">
  <svg class="icon icon-white"><use></use></svg>
</a>
```

**Differenza**: 
- ❌ Mancano le classi: `btn-primary`, `btn-full`
- ❌ Manca il wrapper `span.rounded-icon`
- ❌ Manca lo span con `d-lg-block` (responsive text)
- ❌ Classe diversa: `btn-outline-light` invece di `btn-primary`

**Azione**: Correggere il template del button

---

## 📋 CLASSI CSS MANCANTI (33)

### Layout & Spacing
- `border-bottom` (10 occorrenze) - Border nel footer della card
- `mb-5` - Margine bottom sulla card
- `me-4` - Margine right
- `flex-column` - Flex direction
- `flex-lg-row` - Responsive flex direction
- `flex-nowrap` - Flex wrap disabled

### Typography
- `fw-bold` - Font weight bold
- `fw-normal` - Font weight normal

### Component-Specific
- `btn-full` - Full width button
- `btn-next` - Next button style
- `button-shadow` - Shadow on button
- `card-image-rounded` - Rounded card image
- `card-image-wrapper` - Card image container

### Form Components (Rating)
- `cmp-steps-rating` - Rating component
- `cmp-steps-rating__body` - Rating body
- `cmp-radio-list` - Radio list component
- `cmp-radio-list__item` - Radio item (10x)

### Others
- `align-items-lg-center` - Responsive alignment
- `drop-shadow` - Drop shadow effect
- `iscrizioni-header` - Header styling
- `col-lg-6` - Column layout (responsive grid)

---

## ➕ CLASSI CSS EXTRA IN LOCAL (25)

### Grid Layout
- `col-lg-4` (18x) - 4-column grid (dovrebbe essere col-lg-6)
- `col-sm-6` (9x) - Small screen columns
- `g-4` (4x) - Gap spacing (Bootstrap)

### Components
- `card-footer` (3x) - Card footer
- `form-check-input` (10x) - Form inputs
- `form-check-label` (10x) - Form labels
- `form-label` - Form label
- `it-grid-item-wrapper` (9x) - Grid item
- `it-grid-item-overlay` (6x) - Grid overlay

### Styling
- `bg-transparent` (3x) - Transparent background
- `btn-link` - Link-style button
- `btn-outline-light` - Light outline button
- `align-items-start` (3x) - Alignment
- `flex-shrink-0` (3x) - Flex shrink
- `d-lg-none` - Display none on large screens
- `h5` (9x) - Heading 5
- `icon-xs` (9x) - Extra small icon
- `ms-1`, `ms-2` - Margin start

### Evidence Section
- `evidence-section-header` - Evidence header

---

## 🔧 AZIONI CORRETTIVE NECESSARIE

### Priorità 1: CRITICA (Struttura)

#### ✅ Aggiungere `section#head-section`
**File**: `resources/views/pages/tests/[slug].blade.php`

Dopo `<main>`, prima della prima sezione di contenuto:

```php
@isset($contentBlocks['it'])
    @foreach($contentBlocks['it'] as $block)
        @if($block['id'] === 'block-hero')
            @include('pub_theme::components.blocks.hero.homepage', $block['data'])
        @endif
    @endforeach
@endisset
```

Dovrebbe diventare:

```php
<!-- HEAD SECTION con Hero e News Card -->
<section id="head-section">
    <h2 class="visually-hidden">{{ __('Contenuti in evidenza') }}</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">
                <!-- Hero news card -->
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <!-- Hero image -->
            </div>
        </div>
    </div>
</section>
```

#### ✅ Verifica Navbar Toggler
**File**: Header component

Assicurare che il button togglerdei della navbar abbia la struttura esatta della reference.

### Priorità 2: ALTA (Classi mancanti)

#### ✅ Aggiungere classi mancanti
- `border-bottom` su elementi di separazione
- `mb-5` su cards
- `fw-bold`, `fw-normal` per typography
- `flex-column`, `flex-lg-row` per layout
- `col-lg-6` per grid responsive

#### ❌ Rimuovere classi Bootstrap extra
- `col-lg-4` → `col-lg-6`
- `col-sm-6` → verificare necessità
- `g-4` → usare Tailwind spacing
- `form-check-*` → usare componenti custom

### Priorità 3: MEDIA (Stile)

#### ✅ Aggiungere componenti mancanti
- `cmp-steps-rating` - Componente rating
- `cmp-radio-list` - Componente radio

#### ✅ Verificare button style
- Primary button deve avere `btn-primary` non `btn-outline-light`
- Full width button deve avere `btn-full`

---

## 📝 Checklist di Correzione

- [ ] Aggiungere `section#head-section` nella blade
- [ ] Verificare struttura navbar toggler
- [ ] Aggiungere classi mancanti (border-bottom, mb-5, fw-*, flex-*)
- [ ] Rimuovere classi Bootstrap extra
- [ ] Corrigere grid layout (col-lg-4 → col-lg-6)
- [ ] Verificare button styling
- [ ] Aggiungere componenti rating/radio
- [ ] Testare responsive (desktop, tablet, mobile)
- [ ] Confrontare HTML finale ≥90% match

---

## 🔗 Riferimenti

- [REPLIKATE Protocol](../prompts/replikate.txt)
- [Reference Homepage](https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html)
- [Local Homepage](http://127.0.0.1:8000/it/tests/homepage)
- [Component Catalog](../COMPONENT_CATALOG.md)
