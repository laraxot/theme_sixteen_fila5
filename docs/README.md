<<<<<<< HEAD
---
title: "Sixteen Module Documentation"
type: documentation
tags: [module, documentation]
created: 2026-06-05
updated: 2026-06-05
---

# Sixteen Theme Documentation

> 🇮🇹 [Biglietto da visita (IT)](../README.md) · 🇬🇧 [Business card (EN)](./readme-en.md)

## Overview
The Sixteen theme is the primary frontend theme for the Fixcity application, built on top of Bootstrap Italia (Design Comuni) framework. It provides a modern, accessible, and responsive interface for all application features.

## Architecture

### Theme Structure

```
Themes/Sixteen/
├── resources/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── views/
│       ├── components/
│       │   ├── blocks/
│       │   │   └── tests/
│       │   │       └── segnalazione-crea.blade.php
│       │   ├── pub_theme/
│       │   │   └── components/
│       │   │       ├── wizard/
│       │   │       │   └── wizard.blade.php
│       │   │       └── sidebar.blade.php
│       │   └── filament/
│       │       └── widgets/
│       │           └── create-ticket-wizard.blade.php
│       └── pages/
│           └── tests/
│               └── [slug].blade.php
├── package.json
├── vite.config.js
└── tailwind.config.js
```

### Key Features

#### 1. Design Comuni Integration
- **Bootstrap Italia**: Complete Bootstrap Italia framework integration
- **Design System**: Consistent design language across all components
- **Accessibility**: WCAG 2.1 compliant design
- **Responsive**: Mobile-first responsive design

#### 2. Asset Management
- **Vite**: Modern build tool for asset compilation
- **Tailwind CSS**: Utility-first CSS framework
- **Asset Pipeline**: Efficient asset bundling and optimization
- **Version Control**: Automatic cache busting

#### 3. Component Architecture
- **Reusable Components**: Modular component system
- **Theme Components**: Custom Design Comuni components
- **Filament Integration**: Seamless Filament widget integration
- **Layout Templates**: Consistent page layouts

## Development Guidelines

### 1. Asset Development

#### CSS Development
```scss
// Use SCSS for component styles
.segnalazione-wizard-container {
    @extend .container;
    
    .wizard-step {
        @extend .card;
        @extend .mb-3;
=======
# Tema Sixteen - Bootstrap Italia per Laravel/Tailwind

## 📌 Policy documentazione (importante)

Questa cartella contiene sia documenti canonici sia documenti legacy.

- **Naming**: i file in `docs/` devono essere in **lowercase**, con unica eccezione `README.md`.
- **No date**: evitare date nei nomi dei file `.md`.
- **Link**: usare sempre link **relativi** (mai path assoluti tipo `/var/www/...`).

I file storici con nomi **MAIUSCOLI** o con **date** nel filename sono considerati legacy e verranno migrati in modo controllato (rinomini + aggiornamento riferimenti) per evitare rotture di link.

## 🎯 Panoramica del Progetto

Il tema Sixteen è un'implementazione completa delle **Linee Guida AGID per il Design della PA Italiana** utilizzando **Laravel**, **Filament** e **Tailwind CSS**. Il tema fornisce una migrazione moderna da Bootstrap Italia, mantenendo la piena conformità alle specifiche AGID con un'architettura più flessibile e performante.

## 📊 Stato Implementazione AGID

### 📈 Compliance Generale
- **Componenti Bootstrap Italia**: 16/54+ implementati (30%)
- **Accessibilità**: WCAG 2.1 AA parziale
- **Design System**: Colori e tipografia base
- **Requisiti Legali**: In implementazione

### 📋 Documentazione Aggiornata
- **[Analisi Compliance AGID](agid-compliance-analysis.md)** - Analisi completa requisiti
- **[Roadmap Componenti Mancanti](missing-components-roadmap.md)** - Piano implementazione 38+ componenti
- **[Stato Componenti](components-status.md)** - Stato dettagliato implementazione

## 🏛️ Conformità PA Italiana

### Requisiti AGID Soddisfatti
- ✅ **Design System**: Colori, tipografia, spaziature conformi
- ✅ **Accessibilità**: WCAG 2.1 AA con skiplinks e navigation
- ✅ **Responsive**: Mobile-first, touch-friendly
- ✅ **Multilingual**: Supporto italiano/inglese
- ✅ **Performance**: Ottimizzato per dispositivi PA

### Requisiti AGID Mancanti  
- ❌ **SPID Authentication**: Componente login SPID
- ❌ **PagoPA Payments**: Integrazione pagamenti PA
- ❌ **Complete Forms**: Date/time pickers, validazione avanzata
- ❌ **Icon System**: Libreria completa SVG Bootstrap Italia

## 🚀 Avvio Rapido

### Installazione
```bash
# Clone del tema
cd themes/
git clone [repository-url] Sixteen

# Installazione dipendenze
cd Sixteen
npm install
composer install

# Build assets
npm run build
```

### Configurazione Laravel
```php
// config/app.php
'providers' => [
    Themes\Sixteen\Providers\SixteenServiceProvider::class,
],
```

### Configurazione Filament
```php
// app/Providers/AdminPanelProvider.php
public function panel(Panel $panel): Panel
{
    return $panel
        ->viteTheme('themes/sixteen/resources/css/app.css')
        ->theme('sixteen');
}
```

## 📁 Struttura del Progetto

```
Themes/Sixteen/
├── docs/                           # 📚 Documentazione completa
│   ├── agid-bootstrap-italia-gap-analysis.md  # Gap analysis AGID
│   ├── bootstrap-italia-compliance-analysis.md # Stato compliance
│   ├── components-status.md        # Stato componenti
│   ├── filament-4-login-widget-implementation.md # ✅ Login Widget Guide
│   └── index.md                    # Indice documentazione
├── resources/views/components/
│   └── bootstrap-italia/           # 🎨 Componenti AGID
│       ├── alert.blade.php         # ✅ Messaggi di stato
│       ├── badge.blade.php         # ✅ Indicatori stato
│       ├── breadcrumb.blade.php    # ✅ Navigazione breadcrumb
│       ├── button.blade.php        # ✅ Pulsanti PA-compliant
│       ├── card.blade.php          # ✅ Contenitori contenuto
│       ├── carousel.blade.php      # ✅ Slider contenuti
│       ├── cookiebar.blade.php     # ✅ GDPR compliance
│       ├── footer.blade.php        # ✅ Piè di pagina PA
│       ├── header-main.blade.php   # ✅ Header principale
│       ├── header-slim.blade.php   # ✅ Barra istituzionale
│       ├── hero.blade.php          # ✅ Sezioni hero
│       ├── megamenu.blade.php      # ✅ Menu complessi
│       ├── notification.blade.php  # ✅ Notifiche toast
│       ├── progress.blade.php      # ✅ Barre progresso
│       ├── radio.blade.php         # ✅ Radio button
│       ├── rating.blade.php        # ✅ Sistema valutazioni
│       ├── select.blade.php        # ✅ Dropdown selezione
│       ├── sidebar.blade.php       # ✅ Navigazione laterale
│       ├── skiplinks.blade.php     # ✅ Accessibilità WCAG
│       ├── tabs.blade.php          # ✅ Interfacce a schede
│       ├── toggle.blade.php        # ✅ Switch controlli
│       └── upload.blade.php        # ✅ Caricamento file
├── tailwind.config.js              # 🎨 Configurazione Tailwind
├── vite.config.js                  # ⚡ Build configuration
└── package.json                    # 📦 Dipendenze NPM
```

## 🎨 Sistema di Design

### Colori AGID Bootstrap Italia
```javascript
// Palette colori PA Italiana implementata in Tailwind
colors: {
    'italia-blue': {
        50: '#E3F2FD',
        500: '#0066CC',  // Primary PA blue
        900: '#003D7A'
    },
    'italia-green': {
        50: '#E8F5E8', 
        500: '#00B373', // Success green
        900: '#007A4F'
    },
    'italia-red': {
        50: '#FFEBEE',
        500: '#D9364F', // Error red  
        900: '#B71C1C'
# Tema Sixteen - Documentazione Completa

## Panoramica

Il tema Sixteen è un tema moderno per Laravel che implementa le **Linee Guida di Design per i Servizi Digitali della Pubblica Amministrazione** utilizzando **Tailwind CSS** invece di Bootstrap Italia. Il tema è progettato per garantire accessibilità, usabilità e coerenza visiva in conformità con gli standard italiani, fornendo una migrazione completa da Bootstrap Italia a Tailwind CSS.

## 🚀 Bootstrap Italia to Tailwind Migration

Questa documentazione include una **guida completa alla migrazione** da Bootstrap Italia a Tailwind CSS, con esempi pratici e implementazioni conformi alle linee guida PA:

- **[Guida alla Migrazione Bootstrap Italia → Tailwind](bootstrap-italia-to-tailwind.md)** - Mappatura completa dei componenti
- **[Esempi Pratici Bootstrap Italia](bootstrap-italia-examples.md)** - Implementazioni reali con codice
- **[Componenti Form](components/form-components.md)** - Input, validazione, accessibilità
- **[Componenti Navigazione](components/navigation-components.md)** - Header, breadcrumb, sidebar, footer
- **[Componenti Layout](components/layout-components.md)** - Grid, card, hero, modal, alert

## Caratteristiche Principali

### 🎨 Design System Compliant
- Conformità alle **Linee Guida di Design** della PA italiana
- Implementazione con **Tailwind CSS** per massima flessibilità
- Palette colori semantica e accessibile
- Tipografia ottimizzata per la leggibilità

### 🔧 Tecnologie
- **Tailwind CSS** per lo styling
- **DaisyUI** per componenti avanzati
- **Inter** come font principale
- **Heroicons** per le icone
- **Alpine.js** per interazioni dinamiche

### 📱 Responsive Design
- Mobile-first approach
- Breakpoint ottimizzati per dispositivi PA
- Touch-friendly per tablet e smartphone
- Accessibilità WCAG 2.1 AA

## Struttura del Tema

```
Themes/Sixteen/
├── docs/                    # Documentazione
├── lang/                    # Traduzioni
├── resources/
│   ├── views/              # Template Blade
│   │   ├── auth/           # Pagine autenticazione
│   │   ├── components/     # Componenti riutilizzabili
│   │   ├── filament/       # Componenti Filament
│   │   ├── layouts/        # Layout principali
│   │   └── pages/          # Pagine specifiche
│   ├── css/                # Stili personalizzati
│   └── js/                 # Script JavaScript
├── tailwind.config.js      # Configurazione Tailwind
├── vite.config.js          # Configurazione build
└── theme.json              # Metadati tema
```

## Configurazione Tailwind

Il tema utilizza una configurazione Tailwind avanzata con:

### Colori Semantici
```javascript
colors: {
    primary: colors.blue,      // Azioni principali
    secondary: colors.gray,    // Elementi secondari
    success: colors.green,     // Operazioni positive
    warning: colors.yellow,    // Avvisi
    danger: colors.red,        // Errori e pericoli
    info: colors.blue,         // Informazioni
}
```

### Font System
```javascript
fontFamily: {
    sans: ['Inter var', ...defaultTheme.fontFamily.sans],
}
```

### Dark Mode
```javascript
darkMode: 'class', // Abilitazione dark mode
```

## Componenti Principali

### 1. Layout Base
```blade
<x-sixteen::layout.app>
    <x-slot name="header">
        <!-- Header content -->
    </x-slot>
    
    <x-slot name="sidebar">
        <!-- Sidebar content -->
    </x-slot>
    
    <!-- Main content -->
</x-sixteen::layout.app>
```

### 2. Form Components
```blade
<x-sixteen::form.input
    name="email"
    type="email"
    label="Indirizzo Email"
    placeholder="Inserisci la tua email"
    required
/>

<x-sixteen::form.select
    name="provincia"
    label="Provincia"
    :options="$province"
    placeholder="Seleziona una provincia"
/>
```

### 3. Alert Components
```blade
<x-sixteen::alert.success>
    Operazione completata con successo
</x-sixteen::alert.success>

<x-sixteen::alert.warning>
    Attenzione: alcuni dati potrebbero essere incompleti
</x-sixteen::alert.warning>

<x-sixteen::alert.error>
    Si è verificato un errore durante l'operazione
</x-sixteen::alert.error>
```

### 4. Button Components
```blade
<x-sixteen::button.primary>
    Conferma Operazione
</x-sixteen::button.primary>

<x-sixteen::button.secondary>
    Annulla
</x-sixteen::button.secondary>

<x-sixteen::button.danger>
    Elimina
</x-sixteen::button.danger>
```

## Integrazione con Filament 4.x e Design System AGID

### Configurazione Stili Filament 4.x

Il tema Sixteen è completamente compatibile con Filament 4.x e conforme al design system AGID:

- **[Configurazione Stili Filament 4.x](filament-4x-styles-configuration.md)** - Guida completa alla configurazione
- **[Integrazione AGID Completa](agid-filament-4x-integration.md)** - Conformità design system italiano
- **[Guida Comandi di Build](build-commands-guide.md)** - Comandi NPM e Composer per il tema
- **[Regole Critiche](critical-rules.md)** - Regole fondamentali per l'integrazione
- **[Configurazione Vite](vite-configuration-rules.md)** - Regole per la configurazione Vite

### Design System AGID
- **Colori ufficiali**: Utilizzo dei colori primari AGID (#0066CC, #00B373, #D9364F, #F5A623)
- **Bootstrap Italia**: Integrazione completa del framework CSS ufficiale
- **Accessibilità**: Conformità alle linee guida AGID per l'accessibilità
- **Riferimento**: [Design System AGID](https://italia.github.io/design-comuni-pagine-statiche/)

### Admin Panel Provider
```php
use Modules\Xot\Providers\Filament\XotBaseMainPanelProvider;
use Filament\Panel;

class AdminPanelProvider extends XotBaseMainPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#0066CC', // Italia Blue
                'success' => '#00B373', // Italia Green
                'warning' => '#FFB400', // Italia Yellow
                'danger' => '#D9364F',  // Italia Red
            ])
            ->font('Inter')
            ->favicon(asset('themes/Sixteen/favicon.ico'))
            ->brandName('TechPlanner')
            ->brandLogo(asset('themes/Sixteen/logo.svg'))
            ->brandLogoHeight('2rem')
            ->viteTheme('themes/Sixteen');
>>>>>>> 6ed19256f (.)
    }
}
```

<<<<<<< HEAD
#### JavaScript Development
```javascript
// Use modules for JavaScript functionality
import { initializeMap } from './modules/map';
import { initializeWizard } from './modules/wizard';

document.addEventListener('DOMContentLoaded', () => {
    initializeMap();
    initializeWizard();
});
```

### 2. Component Development

#### Blade Components
```blade
{{-- Use Design Comuni components --}}
@component('pub_theme::components.wizard.sidebar', [
    'steps' => $steps,
    'currentStep' => $currentStep
])
@endcomponent

{{-- Use Bootstrap Italia components --}}
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <p class="card-text">{{ $content }}</p>
    </div>
</div>
```

#### View Structure
```blade
{{-- Main page template --}}
@extends('pub_theme::layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('pub_theme::partials.header')
                
                <main class="py-4">
                    {{ $slot }}
                </main>
                
                @include('pub_theme::partials.footer')
            </div>
        </div>
    </div>
@endsection
```

### 3. Build Process

#### Development Build
```bash
# Install dependencies
npm install

# Development build with watch
npm run dev

# Production build
npm run build

# Copy assets to public directory
npm run copy
```

#### Asset Optimization
- **Minification**: Automatic CSS/JS minification
- **Tree Shaking**: Remove unused code
- **Image Optimization**: Automatic image compression
- **Code Splitting**: Lazy loading of chunks

### 4. Theme Configuration

#### Vite Configuration
```javascript
// vite.config.js
export default {
    build: {
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    vendor: ['vue', 'alpine'],
                    bootstrap: ['bootstrap-italia']
                }
            }
        }
    }
}
```

#### Tailwind Configuration
```javascript
// tailwind.config.js
module.exports = {
    content: [
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './src/**/*.php',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#0077b6',
                secondary: '#00b4d8',
            }
        }
    }
}
```

### 5. Design System

#### Color Palette
- **Primary**: #0077b6 (Bootstrap Italia Primary)
- **Secondary**: #00b4d8 (Bootstrap Italia Info)
- **Success**: #28a745 (Bootstrap Italia Success)
- **Danger**: #dc3545 (Bootstrap Italia Danger)

#### Typography
- **Headings**: Bootstrap Italia typography scale
- **Body**: Bootstrap Italia default font
- **Code**: Bootstrap Italia code styling

#### Spacing
- **Padding**: Bootstrap Italia spacing scale
- **Margin**: Bootstrap Italia spacing scale
- **Grid**: Bootstrap Italia grid system

### 6. Integration Patterns

#### With Filament
```blade
{{-- Filament widget integration --}}
<x-filament-widgets::widget>
    {{ $this->form }}
</x-filament-widgets::widget>
```

#### With Laravel
```blade
{{-- Route-based page templates --}}
@php
    $page = request()->route()->parameter('slug');
@endphp

@extends("pages.tests.{$page}")
```

#### With Bootstrap Italia
```blade
{{-- Bootstrap Italia components --}}
<div class="card mb-3">
    <div class="card-header">
        <h5 class="mb-0">{{ $title }}</h5>
    </div>
    <div class="card-body">
        {{ $content }}
    </div>
</div>
```

### 7. Performance Optimization

#### Asset Loading
- **Lazy Loading**: Non-critical assets loaded asynchronously
- **Caching**: Proper cache headers and ETags
- **CDN**: Static assets served from CDN
- **Compression**: Gzip/Brotli compression

#### JavaScript Optimization
- **Debouncing**: Event debouncing for scroll/resize events
- **Throttling**: Function throttling for performance
- **Virtual Scrolling**: Efficient large list rendering
- **Intersection Observer**: Lazy loading of off-screen content

### 8. Testing

#### Browser Testing
- **Cross-browser**: Chrome, Firefox, Safari, Edge
- **Responsive**: Mobile, tablet, desktop views
- **Accessibility**: Keyboard navigation, screen readers
- **Performance**: Loading speed, rendering performance

#### Automated Testing
```javascript
// Example test with Playwright
test('wizard step navigation', async ({ page }) => {
    await page.goto('/it/tests/segnalazione-crea');
    
    // Test step 1
    await page.click('text=Next');
    
    // Test step 2
    await page.fill('[name="data.name"]', 'Test Name');
    await page.click('text=Submit');
    
    // Test success
    await page.waitForSelector('text=Success');
});
```

### 9. Deployment

#### Build Process
```bash
# Production build
npm run build

# Copy assets
npm run copy

# Clear cache
php artisan view:clear
php artisan route:clear
```

#### Environment Configuration
```env
# Asset optimization
NODE_ENV=production

# Cache configuration
APP_ENV=production
APP_DEBUG=false
```

### 10. Troubleshooting

#### Common Issues
1. **Asset Not Loading**: Check Vite manifest and build process
2. **CSS Conflicts**: Use proper specificity and BEM naming
3. **JavaScript Errors**: Check console for errors and debug
4. **Rendering Issues**: Verify component lifecycle and state

#### Debugging Tools
- **Browser DevTools**: Inspect elements and network requests
- **Laravel DebugBar**: Debug Laravel application
- **Vite Dev Server**: Development server with hot reload
- **Webpack Bundle Analyzer**: Analyze bundle composition

### 11. Future Enhancements

#### Planned Features
1. **Dark Mode**: Bootstrap Italia dark theme support
2. **Internationalization**: Multi-language support
3. **PWA Support**: Progressive Web App capabilities
4. **Advanced Animations**: Smooth transitions and micro-interactions

#### Technical Improvements
1. **Component Library**: Comprehensive component documentation
2. **Storybook**: Component development and testing
3. **Automated Testing**: End-to-end testing integration
4. **Performance Monitoring**: Real user monitoring (RUM)

### 12. Architettura Laraxot (cross-cutting)

I temi **non** contano modelli/migrazioni, ma gli agenti che toccano Fixcity/User devono rispettare:

- [Parità modulo N=N](../../../../docs/wiki/bmad/architecture-module-model-artifact-parity.md) — audit: `bashscripts/tools/audit-module-artifact-parity.sh Fixcity`
- [Dati sacri](../../../../docs/wiki/rules/data-sacred-no-destructive-db.md) — solo `php artisan migrate`
- Wiki tema: [docs/wiki/](./wiki/) · ingest: `bashscripts/docs/llm-wiki-qmd.sh update`

---

*Last Updated: June 2026*  
*Version: 1.0.0*
=======
### Tipografia PA Compliant
```css
/* Font system conformi alle linee guida */
font-family: {
    'sans': ['Inter var', 'system-ui', 'sans-serif'],
    'serif': ['Lora', 'Georgia', 'serif'],
    'mono': ['Roboto Mono', 'monospace']
}
```

## 🔧 Utilizzo Componenti

### Header PA Standard
```blade
<x-bootstrap-italia.header-slim
    :institution="'Comune di Roma'"
    :links="[
        ['url' => '#', 'text' => 'Amministrazione Trasparente'],
        ['url' => '#', 'text' => 'URP']
    ]"
/>

<x-bootstrap-italia.header-main
    :site-name="'Sito Comunale'"
    :tagline="'Servizi digitali per i cittadini'"
    :navigation="$mainNavigation"
    show-search
/>
```

### Form PA Compliant
```blade
<form class="space-y-6">
    <x-bootstrap-italia.select
        name="provincia"
        label="Provincia di residenza"
        :options="$province"
        placeholder="Seleziona provincia"
        required
    />
    
    <x-bootstrap-italia.radio
        name="servizio"
        label="Tipo di servizio richiesto"
        :options="[
            'certificati' => 'Certificati anagrafici',
            'tributi' => 'Tributi e pagamenti',
            'pratiche' => 'Pratiche edilizie'
        ]"
        required
    />
    
    <x-bootstrap-italia.upload
        name="documenti"
        label="Documenti allegati"
        accept=".pdf,.doc,.docx"
        multiple
    />
</form>
```

### Notifiche e Feedback
```blade
{{-- Notifica successo --}}
<x-bootstrap-italia.notification
    type="success"
    title="Richiesta inviata"
    message="La tua richiesta è stata inviata correttamente"
    dismissible
/>

{{-- Progress indicator per processi lunghi --}}
<x-bootstrap-italia.progress-indicators
    :steps="[
        'Compilazione dati',
        'Verifica documenti', 
        'Pagamento',
        'Conferma'
    ]"
    :current-step="2"
/>
```

### Accessibilità Built-in
```blade
{{-- Skiplinks per navigazione da tastiera --}}
<x-bootstrap-italia.skiplinks
    :links="[
        '#main-content' => 'Vai al contenuto principale',
        '#main-navigation' => 'Vai al menu principale',
        '#footer' => 'Vai al footer'
    ]"
/>
```

## ♿ Accessibilità WCAG 2.1 AA

### Funzionalità Implementate
- ✅ **Skiplinks**: Navigazione rapida da tastiera
- ✅ **Contrasto Colori**: Rapporto ≥ 4.5:1 per testo normale
- ✅ **Focus Visibile**: Indicatori focus chiari su tutti gli elementi interattivi  
- ✅ **Markup Semantico**: Struttura HTML corretta con landmark ARIA
- ✅ **Label Accessibili**: Tutti i form field hanno label associate
- ✅ **ARIA Attributes**: Supporto completo per screen reader

### Test di Accessibilità
```bash
# Test automatici con axe-core
npm run test:a11y

# Audit manuale con screen reader
# - NVDA (Windows)
# - VoiceOver (macOS)  
# - Orca (Linux)
```

## 📈 Roadmap Sviluppo

### 🚨 Priorità CRITICA (Prossime 2-3 settimane)
1. **Dropdown Component** - Essenziale per navigazione e form
2. **Pagination Component** - Richiesto per dataset PA
3. **SPID Integration** - Obbligatorio per autenticazione PA
4. **Form completi** - Date/time picker, autocomplete

### 🔥 Priorità ALTA (1-2 mesi)  
1. **PagoPA Integration** - Pagamenti PA
2. **Tooltip/Popover** - UX e accessibilità
3. **Steppers** - Processi multi-step
4. **Complete Icon System** - Libreria SVG Bootstrap Italia

### 📈 Priorità MEDIA (2-3 mesi)
1. **Timeline Component** - Visualizzazione processi
2. **Advanced UX** - Callout, Collapse, Avatar
3. **Performance Optimization** - Bundle size, lazy loading
4. **Documentation** - Guide complete utilizzo

## 🧪 Testing e Qualità

### Test Automatici
```bash
# Test componenti Laravel
php artisan test --filter=SixteenTheme

# Test accessibilità  
npm run test:a11y

# Test performance
npm run lighthouse
```

### Metriche Qualità Target
- **Accessibilità**: 100% WCAG 2.1 AA
- **Performance**: Lighthouse Score > 90
- **Bundle Size**: CSS < 300KB, JS < 200KB
- **Coverage**: Test coverage > 80%

## 📚 Documentazione Completa

### Guide Specializzate
- **[📊 Stato Componenti](components-status.md)** - Inventario completo implementazione
- **[🔍 Gap Analysis AGID](agid-bootstrap-italia-gap-analysis.md)** - Analisi conformità PA
- **[🔧 Bootstrap Italia → Tailwind](bootstrap-italia-to-tailwind.md)** - Guida migrazione
- **[📋 Indice Completo](index.md)** - Navigazione documentazione

### Risorse Esterne
- [Bootstrap Italia Documentation](https://italia.github.io/bootstrap-italia/docs/)
- [AGID Design Guidelines](https://www.agid.gov.it/it/argomenti/linee-guida-design-pa)  
- [Design Comuni Documentation](https://docs.italia.it/italia/designers-italia/design-comuni-docs/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

## 🤝 Contribuire

### Come Contribuire
1. **Fork** del repository
2. **Create feature branch** (`git checkout -b feature/nuovo-componente`)
3. **Implementa** seguendo le linee guida AGID
4. **Testa** accessibilità e performance
5. **Documenta** le modificare
6. **Submit Pull Request**

### Guidelines Sviluppo
- Seguire convenzioni nomenclatura esistenti
- Implementare test automatici per nuovi componenti
- Verificare conformità WCAG 2.1 AA
- Documentare API e utilizzo componenti
- Ottimizzare per performance

---

## 🏅 Status Badge

![AGID Compliance](https://img.shields.io/badge/AGID-48%25%20Compliant-yellow)
![WCAG 2.1](https://img.shields.io/badge/WCAG%202.1-AA-green)
![Laravel](https://img.shields.io/badge/Laravel-12+-red)
![Tailwind](https://img.shields.io/badge/Tailwind-3.4+-blue)

**Versione**: 2.0.0  
**Ultimo aggiornamento**: Settembre 1, 2025  
**Mantenuto da**: Team Bootstrap Italia Migration  
**Licenza**: MIT
### Custom Components
```php
use Filament\Forms\Components\Section;

Section::make('Dati Personali')
    ->schema([
        // Form fields
    ])
    ->columns(2)
    ->collapsible();
```

## Accessibilità

### WCAG 2.1 AA Compliance
- Contrasto colori ≥ 4.5:1 per testo normale
- Contrasto colori ≥ 3:1 per testo grande
- Focus visibile su tutti gli elementi interattivi
- Navigazione da tastiera completa
- Testo alternativo per immagini
- Struttura semantica corretta

### Componenti di Accessibilità e UI
- **[Componenti di Accessibilità](accessibility-components.md)** - Contrast toggle, font size controls, skip links, notifiche, cookiebar, hero, tab, accordion, bottom-nav, agid.service-card
- **Toggle Component**: Switch on/off con supporto completo per accessibilità
- **Notifiche Component**: Sistema di notifiche con supporto per diversi tipi
- **Cookiebar Component**: Gestione consenso cookie conforme GDPR
- **Hero Component**: Sezioni principali con supporto per immagini e video
- **Tab Component**: Navigazione a tab con supporto orizzontale e verticale
- **Accordion Component**: Contenuti espandibili con navigazione da tastiera
- **Bottom Navigation Component**: Navigazione mobile-friendly in fondo alla pagina
- **AGID Service Card Component**: Card di servizi conformi al design system AGID
- **Alto contrasto**: Toggle per attivare/disattivare l'alto contrasto
- **Controlli font**: Regolazione della dimensione del testo
- **Skip links**: Navigazione rapida per screen reader
- **Dichiarazione accessibilità**: Conformità WCAG 2.1 AA

### Screen Reader Support
```blade
<!-- Esempio di label accessibile -->
<label for="email" class="sr-only">
    Indirizzo Email
</label>
<input 
    id="email"
    type="email"
    aria-describedby="email-help"
    aria-required="true"
/>
<div id="email-help" class="text-sm text-gray-600">
    Inserisci un indirizzo email valido
</div>
```

## Best Practices

### 1. Naming Convention
- Utilizzare nomi descrittivi per le classi
- Seguire la convenzione BEM per CSS custom
- Mantenere coerenza nei nomi dei componenti

### 2. Performance
- Utilizzare Tailwind JIT per build ottimizzate
- Minimizzare CSS custom
- Lazy loading per componenti pesanti

### 3. Responsive Design
```blade
<!-- Mobile-first approach -->
<div class="w-full md:w-1/2 lg:w-1/3">
    <!-- Content -->
</div>

<!-- Touch-friendly buttons -->
<button class="min-h-[44px] px-4 py-2">
    <!-- Button content -->
</button>
```

### 4. Internationalization
```blade
<!-- Utilizzare sempre le traduzioni -->
<h1>{{ __('sixteen::pages.home.title') }}</h1>
<p>{{ __('sixteen::pages.home.description') }}</p>
```

## Personalizzazione

### Variabili CSS Custom
### Tipografia PA Compliant
```css
:root {
    --sixteen-primary: #0066cc;
    --sixteen-secondary: #666666;
    --sixteen-success: #28a745;
    --sixteen-warning: #ffc107;
    --sixteen-danger: #dc3545;
}
```

### Override Componenti
```blade
{{-- Override di un componente --}}
@component('sixteen::components.button', ['variant' => 'custom'])
    Testo Personalizzato
@endcomponent
```

## Testing

### Test Visivi
```php
// Test per componenti del tema
public function test_button_component_renders_correctly()
{
    $this->blade('<x-sixteen::button.primary>Test</x-sixteen::button.primary>')
        ->assertSee('Test')
        ->assertSee('bg-blue-600');
}
```

### Test di Accessibilità
```php
// Test per compliance WCAG
public function test_form_has_proper_labels()
{
    $this->get('/contact')
        ->assertSee('for="email"')
        ->assertSee('aria-required="true"');
}
```

## Deployment

### Build Process per Filament 4.x

Il tema Sixteen richiede una configurazione specifica per Filament 4.x. Per una guida completa, consultare la **[Guida Comandi di Build](build-commands-guide.md)**.

#### Comandi Essenziali

```bash
# Nella cartella del tema Sixteen
cd laravel/Themes/Sixteen

# Installazione dipendenze NPM
npm install

# Installazione dipendenze Composer (se necessario)
composer install

# Build per sviluppo
npm run dev

# Build per produzione
npm run build

# Build con analisi
npm run build:analyze

# Build per produzione ottimizzato
npm run build:production

# Pubblicazione asset compilati
npm run copy
```

#### Workflow Completo

1. **Preparazione**: `npm install` + `composer install`
2. **Build**: `npm run build`
3. **Pubblicazione**: `npm run copy`
4. **Verifica**: Controllare che gli asset siano stati copiati correttamente

### Configurazione Vite per Filament 4.x

Il tema utilizza una configurazione Vite ottimizzata per Filament 4.x:

```javascript
// vite.config.js
export default defineConfig({
    build: {
        outDir: './public',
        emptyOutDir: false,
        manifest: 'manifest.json',
    },
    plugins: [
        laravel({
            publicDirectory: '../../../public_html/',
            input: [
                __dirname + '/resources/css/app.css',
                __dirname + '/resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
});
```

### Direttiva @vite Corretta

**IMPORTANTE**: Utilizzare sempre il secondo parametro per il tema:

```blade
{{-- ✅ CORRETTO - Con tema specificato --}}
@vite(['resources/css/app.css', 'resources/js/app.js'], 'themes/Sixteen')

{{-- ❌ ERRATO - Senza tema specificato --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
```

### Configurazione Server
```nginx
# Nginx configuration per asset statici
location /themes/sixteen {
    alias /path/to/themes/sixteen/public;
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

## Troubleshooting

### Problemi Comuni

1. **Stili non caricati**
   - Verificare che Vite sia configurato correttamente
   - Controllare i path degli asset

2. **Componenti non trovati**
   - Verificare il namespace del tema
   - Controllare la registrazione nel service provider

3. **Dark mode non funziona**
   - Verificare la classe 'dark' sul tag html
   - Controllare la configurazione Tailwind

### Debug
```bash
# Verificare build Tailwind
npx tailwindcss --config tailwind.config.js --input input.css --output output.css

# Analizzare bundle
npm run build -- --analyze
```

## Contribuire

### Guidelines per Contributi
1. Seguire le convenzioni di coding
2. Aggiungere test per nuove funzionalità
3. Documentare le modifiche
4. Verificare accessibilità

### Struttura Pull Request
- Descrizione chiara delle modifiche
- Screenshot per cambiamenti visivi
- Test unitari e di integrazione
- Documentazione aggiornata

## Riferimenti

- [Linee Guida Design PA](https://designers.italia.it/)
- [Bootstrap Italia](https://italia.github.io/bootstrap-italia/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

---

**Versione**: 1.0.0  
**Ultimo aggiornamento**: Gennaio 2025  
**Compatibilità**: Laravel 10+, Filament 4.x, Tailwind CSS 3.x, Vite 6.x 
>>>>>>> 6ed19256f (.)
