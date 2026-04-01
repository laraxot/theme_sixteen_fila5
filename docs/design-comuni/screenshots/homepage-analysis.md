# 📸 Homepage Analysis - Design Comuni

**Data**: 2026-03-30  
**Originale**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**FixCity**: http://fixcity.local/it/tests/homepage  
**Stato**: 📝 **ANALISI COMPLETATA**

## 🏗️ Struttura Homepage Originale

### Body Length: 1331 righe HTML

### Sezioni Principali

```
Homepage Bootstrap Italia
├── 1. Skip Links (skiplink)
├── 2. Header (it-header-wrapper) - 3 livelli
├── 3. Main Content
│   ├── Hero Section (head-section)
│   │   ├── News Card (col-lg-6)
│   │   └── Hero Image (col-lg-6)
│   ├── Services Section (servizi)
│   ├── Administration Section (amministrazione)
│   ├── News Section (novita)
│   └── Events Section (vivere-comune)
└── 4. Footer (it-footer)
```

## 📋 Analisi Dettagliata

### 1. Skip Links
```html
<div class="skiplink">
  <a href="#main-container">Vai ai contenuti</a>
  <a href="#footer">Vai al footer</a>
</div>
```

### 2. Header (Già Implementato ✅)
- 3 livelli: Slim, Center, Navbar
- Regione, Lingua, Login
- Logo, Social, Search
- Menu navigazione

### 3. Main Content

#### Hero Section
```html
<section id="head-section">
  <div class="container">
    <div class="row">
      <!-- News Card -->
      <div class="col-lg-6 order-2 order-lg-1">
        <div class="card mb-5">
          <div class="category-top">
            <svg class="icon icon-sm"><use href="#it-calendar"></use></svg>
            <span class="title-xsmall-semi-bold fw-semibold">Notizie</span>
            <span class="data fw-normal">18 mag 2022</span>
          </div>
          <a href="#" class="text-decoration-none">
            <h3 class="card-title">Titolo notizia</h3>
          </a>
          <p class="mb-4 pt-3 lora">Contenuto notizia...</p>
          <a class="chip chip-simple" href="#">
            <span class="chip-label">Categoria</span>
          </a>
          <a class="read-more pb-3" href="#">
            <span class="text">Tutte le novità</span>
            <svg class="icon"><use href="#it-arrow-right"></use></svg>
          </a>
        </div>
      </div>
      
      <!-- Hero Image -->
      <div class="col-lg-6 order-1 order-lg-2 px-0 px-lg-3">
        <img src="https://picsum.photos/800/600" class="img-fluid">
      </div>
    </div>
  </div>
</section>
```

#### Services Section
```html
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <h2 class="title-xxlarge mb-4">Servizi</h2>
      <div class="row g-4">
        <!-- Service Cards -->
        <div class="col-sm-6 col-lg-4">
          <div class="it-grid-item-wrapper">
            <a href="#" class="text-decoration-none">
              <div class="card card-bg card-teaser shadow">
                <div class="card-body">
                  <h3 class="card-title h5">Servizio 1</h3>
                  <p class="card-text">Descrizione</p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

#### Administration Section
```html
<div class="container">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-10">
      <h2 class="title-xxlarge mb-4">Amministrazione</h2>
      <div class="row g-4">
        <!-- Admin Cards -->
      </div>
    </div>
  </div>
</div>
```

## 🎨 Classi CSS Principali

### Layout
```css
.container
.row
.col-lg-6
.col-lg-10
.col-12
.col-sm-6
.order-1
.order-2
.order-lg-1
.order-lg-2
.g-4
```

### Cards
```css
.card
.card-body
.card-bg
.card-teaser
.card-title
.card-text
.shadow
```

### Typography
```css
.title-xxlarge
.title-xsmall-semi-bold
.fw-semibold
.fw-normal
.lora
```

### Components
```css
.chip
.chip-simple
.chip-label
.read-more
.category-top
.img-fluid
```

## 🔧 Come Replicare

### 1. Creare Template Blade
**File**: `resources/views/design-comuni/pages/homepage.blade.php`

```blade
@extends('pub_theme::layouts.bootstrap-italia')

@section('content')
{{-- Skip Links --}}
<div class="skiplink">
    <a href="#main-container">Vai ai contenuti</a>
    <a href="#footer">Vai al footer</a>
</div>

{{-- Header --}}
<x-section slug="header" />

{{-- Main --}}
<main>
    <h1 class="visually-hidden" id="main-container">Il mio Comune</h1>
    
    {{-- Hero Section --}}
    <section id="head-section">
        {{-- Hero content --}}
    </section>
    
    {{-- Services Section --}}
    <div class="container">
        {{-- Services --}}
    </div>
    
    {{-- Administration Section --}}
    <div class="container">
        {{-- Admin --}}
    </div>
</main>

{{-- Footer --}}
<x-section slug="footer" />
@endsection
```

### 2. CSS Necessario

Il CSS è già in `design-comuni.css` (1740 righe):
- ✅ Grid system
- ✅ Cards
- ✅ Typography
- ✅ Components (chip, read-more, etc.)

### 3. JavaScript

Il JS è già in `design-comuni.js`:
- ✅ Alpine.js initialization
- ✅ Header interactions
- ✅ Mobile menu

## 📊 Differenze con FixCity Attuale

### FixCity Attuale (❌)
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laravel</title>
    <!-- Tailwind CSS only -->
</head>
<body>
    <!-- Laravel default page -->
</body>
</html>
```

### Homepage Richiesta (✅)
```html
<!doctype html>
<html lang="it">
<head>
    <title>Nome del Comune</title>
    <!-- Bootstrap Italia CSS -->
</head>
<body>
    <!-- Skip links -->
    <!-- Header Bootstrap Italia -->
    <!-- Main content (1331 righe) -->
    <!-- Footer Bootstrap Italia -->
</body>
</html>
```

## 📋 Checklist Implementazione

- [x] Analizzare HTML originale (1331 righe)
- [x] Identificare sezioni principali
- [x] Documentare classi CSS
- [ ] Creare template homepage.blade.php
- [ ] Implementare Hero section
- [ ] Implementare Services section
- [ ] Implementare Administration section
- [ ] Implementare News section
- [ ] Implementare Events section
- [ ] Testare responsive
- [ ] Testare accessibilità

## 🎯 Prossimi Step

### Immediati
1. ✅ Analisi completata
2. ⏳ Creare template homepage.blade.php
3. ⏳ Implementare tutte le sezioni
4. ⏳ Testare rendering

### Build Commands
```bash
cd laravel/Themes/Sixteen

# Modificare CSS/JS se necessario
nvim resources/css/design-comuni.css

# Compilare
npm run build

# Pubblicare
npm run copy

# Testare
# http://fixcity.local/it/tests/homepage
```

---

**Stato**: 📝 **ANALISI COMPLETATA**  
**Prossimo**: 🔨 Implementazione template
