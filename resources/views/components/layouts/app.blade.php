{{--
<<<<<<< HEAD
    App Layout Component
    Design Comuni - Pure Tailwind CSS + Alpine.js
    NO Bootstrap Italia CDN - Using compiled assets
--}}
@props(['title' => ''])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $title ? $title . ' - ' : '' }}{{ config('app.name', 'Laravel') }}</title>
    
    {{-- Vite Assets - Compiled Tailwind CSS + Alpine.js --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    {{ $slot }}
</body>
</html>
=======
    App Layout - Public Frontend
    ════════════════════════════════════════════════════════════════
    
    EXTENDS: x-layouts.main (resources/views/components/layouts/main.blade.php)
    
    USAGE:
    ```blade
    <x-layouts.app title="Home">
        <x-section slug="header" />
        <main>{{ $slot }}</main>
        <x-section slug="footer" />
    </x-layouts.app>
    ```
    
    ARCHITECTURE:
    - x-layouts.main: Base HTML structure (DOCTYPE, head, body, scripts)
    - x-layouts.app: Public frontend wrapper with header/footer sections
    - x-layouts.guest: Authentication pages (login, register)
    - x-layouts.auth: Protected dashboard pages
    
    ════════════════════════════════════════════════════════════════
    WHY app.blade.php MUST extend main.blade.php
    ════════════════════════════════════════════════════════════════
    
    1. DRY (Don't Repeat Yourself)
       ❌ WRONG: HTML structure duplicata in ogni layout
       ✅ CORRECT: HTML structure definita UNA sola volta in main.blade.php
       
    2. KISS (Keep It Simple, Stupid)
       ❌ COMPLEX: Ogni layout gestisce scripts, styles, meta tags
       ✅ SIMPLE: main gestisce tutta la complessità, app aggiunge solo semantica
       
    3. Single Source of Truth
       - Dark mode logic: Definita in main, ereditata da tutti
       - Vite assets: Configurati in main, consistenti ovunque
       - Filament scripts: Caricati una volta, disponibili per tutti
       
    4. Maintainability
       | Change              | Before (4 files) | After (1 file) |
       |---------------------|------------------|----------------|
       | Add meta tag        | Update 4 times   | Update 1 time  |
       | Change Vite config  | Update 4 times   | Update 1 time  |
       | Fix dark mode bug   | Fix 4 times      | Fix 1 time     |
       
    5. Consistency
       ✅ Stesso HTML structure per tutte le pagine
       ✅ Stessi meta tags per tutte le pagine
       ✅ Stessi scripts per tutte le pagine
       ✅ Stessi styles per tutte le pagine
    
    DOCUMENTATION:
    → Layout Architecture: docs/layout-architecture.md#x-layoutsapp
    → Main Layout: docs/layout-architecture.md#x-layoutsmain
    → Theme Index: docs/README.md
    → LAYOUT_ARCHITECTURE_MAP.md (bidirectional links)
    
    EXTENDED BY:
    - Homepage
    - CMS pages
    - Blog listing
    - Public profiles
    
    RELATED COMPONENTS:
    → x-section: resources/views/components/section.blade.php
    → x-header: resources/views/components/header.blade.php
    → x-footer: resources/views/components/footer.blade.php
--}}
@props(['title' => ''])

<x-layouts.main>
    <x-section slug="header" />
    {{ $slot }}
    <x-section slug="footer" />
</x-layouts.main>
>>>>>>> 4a11dcf (.)
