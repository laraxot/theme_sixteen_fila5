# 🏠 Homepage Analysis & Implementation

**Date**: 2026-03-30  
**Reference**: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html  
**Target**: http://fixcity.local/it/tests/homepage  
**Status**: 🔴 **ANALYSIS COMPLETE - IMPLEMENTATION READY**

---

## 📊 Reference Homepage Structure

### Complete HTML Structure (Inside `<body>`)

```html
<body>
    <!-- Skip Links -->
    <a class="skiplinks" href="#main">Vai al contenuto principale</a>
    
    <!-- Header -->
    <header class="text-white" role="banner">
        <!-- Top Bar -->
        <div class="h-10 min-h-10 border-b" style="background-color: var(--agid-primary-dark);">
            <!-- Region link, dark mode, language, login -->
        </div>
        
        <!-- Main Header -->
        <div class="bg-white border-b">
            <!-- Logo, Navigation, Search -->
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="container" id="main">
        <!-- Hero Section -->
        <section class="hero-section py-12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="title-xxxlarge mb-4">Nome del Comune</h1>
                        <p class="lead">Benvenuto nel sito del Comune di...</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Featured Services (Quick Access) -->
        <section class="featured-services py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Servizi in evidenza</h2>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <svg class="icon">...</svg>
                                        Servizio 1
                                    </h3>
                                    <p class="card-text">Descrizione...</p>
                                    <a href="#" class="read-more">
                                        <span>Leggi di più</span>
                                        <svg class="icon">...</svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for 6 services -->
                </div>
            </div>
        </section>
        
        <!-- Latest News -->
        <section class="latest-news py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Ultime notizie</h2>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">15 Mar 2026</span>
                                    <h3 class="card-title">Titolo notizia</h3>
                                    <p class="card-text">Breve descrizione...</p>
                                    <a href="#" class="read-more">
                                        <span>Leggi di più</span>
                                        <svg class="icon">...</svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- Repeat for 3 news -->
                </div>
            </div>
        </section>
        
        <!-- Events Section -->
        <section class="events py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Eventi</h2>
                <div class="row g-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">20 Mar 2026</span>
                                    <h3 class="card-title">Nome evento</h3>
                                    <p class="card-text">Descrizione evento...</p>
                                    <a href="#" class="read-more">
                                        <span>Scopri di più</span>
                                        <svg class="icon">...</svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- Repeat for 3 events -->
                </div>
            </div>
        </section>
        
        <!-- Topics Grid -->
        <section class="topics py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Esplora per argomento</h2>
                <div class="row g-4">
                    <div class="col-12 col-md-6">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <svg class="icon">...</svg>
                                        Cultura
                                    </h3>
                                    <p class="card-text">Eventi e informazioni culturali</p>
                                    <a href="#" class="read-more">
                                        <span>Esplora</span>
                                        <svg class="icon">...</svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat for 8 topics -->
                </div>
            </div>
        </section>
    </main>
    
    <!-- Footer -->
    <footer class="it-footer" id="footer">
        <!-- Footer content (already implemented) -->
    </footer>
</body>
```

---

## 🎯 Key Sections Analysis

### 1. Hero Section

**Reference Structure**:
```html
<section class="hero-section py-12">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="title-xxxlarge mb-4">Nome del Comune</h1>
                <p class="lead">Benvenuto nel sito del Comune di...</p>
            </div>
        </div>
    </div>
</section>
```

**CSS Classes** (from style-apply.css):
- `.hero-section` → `@apply py-12`
- `.title-xxxlarge` → `@apply text-5xl font-bold leading-tight`
- `.lead` → `@apply text-xl text-gray-600`

### 2. Featured Services (6 cards)

**Reference Structure**:
```html
<section class="featured-services py-8">
    <div class="container">
        <h2 class="title-xxlarge mb-6">Servizi in evidenza</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card-wrapper card-space">
                    <div class="card card-bg">
                        <div class="card-body">
                            <h3 class="card-title">
                                <svg class="icon">...</svg>
                                Servizio 1
                            </h3>
                            <p class="card-text">Descrizione...</p>
                            <a href="#" class="read-more">
                                <span>Leggi di più</span>
                                <svg class="icon">...</svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

**CSS Classes**:
- `.featured-services` → `@apply py-8`
- `.card-wrapper` → `@apply mb-4`
- `.card-space` → `@apply mb-4`
- `.card-bg` → `@apply bg-white border border-gray-200`
- `.card-title` → `@apply text-lg font-semibold flex items-center gap-2`
- `.card-text` → `@apply text-gray-600 mt-2`
- `.read-more` → `@apply inline-flex items-center gap-1 text-primary font-semibold`

### 3. Latest News (3 cards)

**Reference Structure**:
```html
<section class="latest-news py-8">
    <div class="container">
        <h2 class="title-xxlarge mb-6">Ultime notizie</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6 col-lg-4">
                <article class="card-wrapper card-space">
                    <div class="card card-bg">
                        <div class="card-body">
                            <span class="card-date">15 Mar 2026</span>
                            <h3 class="card-title">Titolo notizia</h3>
                            <p class="card-text">Breve descrizione...</p>
                            <a href="#" class="read-more">
                                <span>Leggi di più</span>
                                <svg class="icon">...</svg>
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>
```

**CSS Classes**:
- `.card-date` → `@apply text-sm text-gray-500 block mb-2`

### 4. Events Section (3 cards)

Similar structure to news section.

### 5. Topics Grid (8 cards in 2 columns)

**Reference Structure**:
```html
<section class="topics py-8">
    <div class="container">
        <h2 class="title-xxlarge mb-6">Esplora per argomento</h2>
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="card-wrapper card-space">
                    <div class="card card-bg">
                        <div class="card-body">
                            <h3 class="card-title">
                                <svg class="icon">...</svg>
                                Cultura
                            </h3>
                            <p class="card-text">Eventi e informazioni culturali</p>
                            <a href="#" class="read-more">
                                <span>Esplora</span>
                                <svg class="icon">...</svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
```

---

## 🔧 Implementation

### File: `laravel/Themes/Sixteen/resources/views/pages/tests/homepage.blade.php`

```blade
<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.homepage');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'tests.homepage';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('tests.homepage')
    
    {{-- Skip Links --}}
    <a class="skiplinks" href="#main">Vai al contenuto principale</a>
    
    {{-- Header --}}
    <x-section slug="header" :data="$headerData ?? []" />
    
    {{-- Main Content --}}
    <main class="container" id="main">
        {{-- Hero Section --}}
        <section class="hero-section py-12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="title-xxxlarge mb-4">{{ $data['site_name'] ?? 'Nome del Comune' }}</h1>
                        <p class="lead">{{ $data['welcome_text'] ?? 'Benvenuto nel sito del Comune di...' }}</p>
                    </div>
                </div>
            </div>
        </section>
        
        {{-- Featured Services --}}
        <section class="featured-services py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Servizi in evidenza</h2>
                <div class="row g-4">
                    @foreach($data['featured_services'] ?? $this->getFeaturedServices() as $service)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <svg class="icon icon-primary" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#' . $service['icon']) }}"></use>
                                        </svg>
                                        {{ $service['title'] }}
                                    </h3>
                                    <p class="card-text">{{ $service['description'] }}</p>
                                    <a href="{{ $service['url'] }}" class="read-more">
                                        <span class="text">Leggi di più</span>
                                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#icon-arrow-right') }}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Latest News --}}
        <section class="latest-news py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Ultime notizie</h2>
                <div class="row g-4">
                    @foreach($data['latest_news'] ?? $this->getLatestNews() as $news)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">{{ $news['date'] }}</span>
                                    <h3 class="card-title">{{ $news['title'] }}</h3>
                                    <p class="card-text">{{ $news['excerpt'] }}</p>
                                    <a href="{{ $news['url'] }}" class="read-more">
                                        <span class="text">Leggi di più</span>
                                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#icon-arrow-right') }}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Events --}}
        <section class="events py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Eventi</h2>
                <div class="row g-4">
                    @foreach($data['events'] ?? $this->getEvents() as $event)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">{{ $event['date'] }}</span>
                                    <h3 class="card-title">{{ $event['title'] }}</h3>
                                    <p class="card-text">{{ $event['description'] }}</p>
                                    <a href="{{ $event['url'] }}" class="read-more">
                                        <span class="text">Scopri di più</span>
                                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#icon-arrow-right') }}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Topics Grid --}}
        <section class="topics py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Esplora per argomento</h2>
                <div class="row g-4">
                    @foreach($data['topics'] ?? $this->getTopics() as $topic)
                    <div class="col-12 col-md-6">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <svg class="icon icon-primary" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#' . $topic['icon']) }}"></use>
                                        </svg>
                                        {{ $topic['title'] }}
                                    </h3>
                                    <p class="card-text">{{ $topic['description'] }}</p>
                                    <a href="{{ $topic['url'] }}" class="read-more">
                                        <span class="text">Esplora</span>
                                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                            <use xlink:href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#icon-arrow-right') }}"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    
    {{-- Footer --}}
    <x-section slug="footer" :data="$footerData ?? []" tpl="full" />
    
    @endvolt
</x-layouts.app>
```

---

## 📊 Default Data Structure

```php
// In page or layout
$homepageData = [
    'site_name' => 'Nome del Comune',
    'welcome_text' => 'Benvenuto nel sito del Comune di Example',
    
    // 6 Featured Services
    'featured_services' => [
        ['title' => 'Anagrafe', 'description' => 'Servizi demografici', 'url' => '#', 'icon' => 'it-user'],
        ['title' => 'Cultura', 'description' => 'Eventi e biblioteche', 'url' => '#', 'icon' => 'it-camera'],
        ['title' => 'Servizi sociali', 'description' => 'Assistenza e sostegno', 'url' => '#', 'icon' => 'it-users'],
        ['title' => 'Mobilità', 'description' => 'Trasporti e traffico', 'url' => '#', 'icon' => 'it-bus'],
        ['title' => 'Ambiente', 'description' => 'Rifiuti e verde pubblico', 'url' => '#', 'icon' => 'it-leaf'],
        ['title' => 'Polizia locale', 'description' => 'Sicurezza e ordinanze', 'url' => '#', 'icon' => 'it-shield'],
    ],
    
    // 3 Latest News
    'latest_news' => [
        ['title' => 'Nuovo orario uffici', 'excerpt' => 'Dal 1 aprile...', 'date' => '15 Mar 2026', 'url' => '#'],
        ['title' => 'Bandi pubblicati', 'excerpt' => 'Disponibili i nuovi...', 'date' => '10 Mar 2026', 'url' => '#'],
        ['title' => 'Eventi primavera', 'excerpt' => 'Calendario completo...', 'date' => '5 Mar 2026', 'url' => '#'],
    ],
    
    // 3 Events
    'events' => [
        ['title' => 'Mercatino dell\'artigianato', 'description' => 'Piazza Roma...', 'date' => '20 Mar 2026', 'url' => '#'],
        ['title' => 'Concerto di primavera', 'description' => 'Teatro comunale...', 'date' => '25 Mar 2026', 'url' => '#'],
        ['title' => 'Mostra fotografica', 'description' => 'Galleria d\'arte...', 'date' => '30 Mar 2026', 'url' => '#'],
    ],
    
    // 8 Topics
    'topics' => [
        ['title' => 'Cultura', 'description' => 'Eventi e informazioni culturali', 'url' => '#', 'icon' => 'it-camera'],
        ['title' => 'Sport', 'description' => 'Impianti e attività sportive', 'url' => '#', 'icon' => 'it-bicycle'],
        ['title' => 'Famiglia', 'description' => 'Servizi educativi e sostegni', 'url' => '#', 'icon' => 'it-users'],
        ['title' => 'Lavoro', 'description' => 'Orientamento e opportunità', 'url' => '#', 'icon' => 'it-briefcase'],
        ['title' => 'Ambiente', 'description' => 'Qualità ambientale e monitoraggi', 'url' => '#', 'icon' => 'it-leaf'],
        ['title' => 'Mobilità', 'description' => 'Linee, orari e servizi', 'url' => '#', 'icon' => 'it-bus'],
        ['title' => 'Turismo', 'description' => 'Scopri il territorio', 'url' => '#', 'icon' => 'it-map'],
        ['title' => 'Salute', 'description' => 'Servizi sanitari e benessere', 'url' => '#', 'icon' => 'it-health'],
    ],
];
```

---

## 📋 Implementation Checklist

### Files to Create

- [ ] `pages/tests/homepage.blade.php`
- [ ] Update `sections/header.blade.php` (if needed)
- [ ] Update `sections/footer.blade.php` (already done)

### CSS (Already in style-apply.css)

- [x] `.hero-section`
- [x] `.title-xxxlarge`
- [x] `.title-xxlarge`
- [x] `.lead`
- [x] `.featured-services`
- [x] `.latest-news`
- [x] `.events`
- [x] `.topics`
- [x] `.card-wrapper`
- [x] `.card-space`
- [x] `.card-bg`
- [x] `.card-title`
- [x] `.card-text`
- [x] `.card-date`
- [x] `.read-more`

### Icons (Need to verify)

- [ ] `it-user` (Anagrafe)
- [ ] `it-camera` (Cultura)
- [ ] `it-users` (Servizi sociali)
- [ ] `it-bus` (Mobilità)
- [ ] `it-leaf` (Ambiente)
- [ ] `it-shield` (Polizia locale)
- [ ] `it-bicycle` (Sport)
- [ ] `it-briefcase` (Lavoro)
- [ ] `it-map` (Turismo)
- [ ] `it-health` (Salute)
- [ ] `it-arrow-right` (Read more)

### Build & Publish

```bash
cd laravel/Themes/Sixteen
npm run build
npm run copy
```

---

## 📊 Expected Result

After implementation:
- ✅ Same HTML structure as reference
- ✅ Same sections (Hero, Services, News, Events, Topics)
- ✅ Same card layouts
- ✅ Same icons
- ✅ Same CSS classes (Bootstrap Italia)
- ✅ Same visual appearance

---

## 📚 Related Documentation

| Document | Location |
|----------|----------|
| **Header Analysis** | `docs/design-comuni/screenshots/tests/header-analysis.md` |
| **Footer Analysis** | `docs/design-comuni/screenshots/tests/footer-analysis.md` |
| **Build Process** | `docs/BUILD_AND_PUBLISH_PROCESS.md` |
| **HTML Matching Plan** | `docs/design-comuni/HTML_MATCHING_PLAN.md` |
| **style-apply.css Analysis** | `docs/STYLE_APPLY_ANALYSIS.md` |

---

**Status**: ✅ **ANALYSIS COMPLETE - READY TO IMPLEMENT**  
**Next**: Create homepage.blade.php + test  
**ETA**: 4h

**Homepage analysis complete! 🏠**
