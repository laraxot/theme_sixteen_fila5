@props(['title' => null, 'description' => null, 'bodyPage' => ''])

@php
    $layoutAppName = trim((string) config('app.name', ''));
    if (in_array(mb_strtolower($layoutAppName), ['', 'laravel'], true)) {
        $layoutAppName = 'FixCity';
    }
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?: $layoutAppName }}</title>
        <meta name="description" content="{{ $description ?: $layoutAppName }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $layoutAppName }}">
        <meta property="og:title" content="{{ $title ?: $layoutAppName }}">
        <meta property="og:description" content="{{ $description ?: $layoutAppName }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title" content="{{ $title ?: $layoutAppName }}">
        <meta name="twitter:description" content="{{ $description ?: $layoutAppName }}">
        @if ($bodyPage === 'homepage')
            <script type="application/ld+json">
                {!! json_encode([
                    chr(64).'context' => 'https://schema.org',
                    '@type' => 'WebSite',
                    'name' => $layoutAppName,
                    'url' => url('/'.app()->getLocale()),
                    'inLanguage' => app()->getLocale(),
                    'description' => $description ?: $layoutAppName,
                ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
            </script>
        @endif
        <x-layouts.seo-links />

        {{-- PHILOSOPHY: TailwindCSS + Alpine.js ONLY. NO Bootstrap Italia JS/CSS. --}}
        {{-- See: docs/architecture/tailwind-alpine-philosophy.md --}}

        {{--
            Dark mode boot: MUST stay inline and run before first paint.
            Vite `app.js` is `type="module"` (deferred) → spostare qui dentro il bundle causerebbe FOUC.
            La chiave `dark_mode` è definita anche in resources/js/theme/dark-mode.js (DRY logico: tenerle allineate).
        --}}
        <script>
            if (typeof Storage !== 'undefined' && localStorage.getItem('dark_mode') === 'true') {
                document.documentElement.classList.add('dark');
            }
        </script>
        {{-- [x-cloak]: definito in resources/css/app.css --}}

        {{--
            Alpine component registration bootstrap.
            Vite app.js e' type="module" defer → arriva dopo Alpine.
            alpine:init si attiva durante il boot di Alpine (dentro @livewireScripts),
            quindi questo listener deve essere registrato PRIMA.
            Pattern: canonico Alpine, identico al dark-mode anti-FOUC sopra.
        --}}
        <script>
            document.addEventListener('alpine:init', function () {
                Alpine.data('mobileMenu', () => ({
                    isOpen: false,
                    isMobileBreakpoint: false,
                    init() {
                        this.checkBreakpoint();
                        window.addEventListener('resize', () => this.checkBreakpoint());
                    },
                    toggle() { this.isOpen = !this.isOpen; },
                    open() { this.isOpen = true; },
                    close() { this.isOpen = false; },
                    checkBreakpoint() {
                        this.isMobileBreakpoint = window.innerWidth < 768;
                        if (!this.isMobileBreakpoint && this.isOpen) this.close();
                    },
                    isMobile() { return this.isMobileBreakpoint; },
                    closeOnItemClick() { if (this.isMobileBreakpoint) this.close(); },
                }));
            });
        </script>

        @livewireStyles
        @filamentStyles
        @vite(['resources/css/app.css'], 'themes/Sixteen')
        {{-- Critical FOUC guard: Vite CSS ~1.4MB; senza questo #head-section resta trasparente 300–600ms --}}
        <style id="sixteen-critical-fouc">
            #head-section.bg-primary { background-color: #007a52 !important; }
            #head-section #welcome-heading,
            #head-section #fc-home-hero-heading,
            #head-section .lead,
            #head-section .title-xsmall-semi-bold,
            #head-section .title-xxxlarge { color: #ffffff !important; }
            #head-section .btn-hero-primary { background:#fff !important; color:#007a52 !important; border:0 !important; }
            #head-section .btn-hero-secondary { background:rgb(255 255 255 / 14%) !important; color:#fff !important; border:2px solid #fff !important; }
            [x-cloak] { display: none !important; }
        </style>
        @stack('styles')
    </head>
    <body @if($bodyPage !== '') data-page="{{ $bodyPage }}" @endif>

        {{ $slot }}
        @livewireScripts
        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')


    </body>
</html>
