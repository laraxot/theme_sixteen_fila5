@php
    $isTestsRoute = request()->routeIs('tests.*');
    $testsSlug = (string) request()->route('slug', '');
    $usesFrontendLivewire = $isTestsRoute && in_array($testsSlug, [
        'segnalazione-crea',
    ], true);
    $renderRuntimeChrome = ! $isTestsRoute;
    $isHomepageParity = $isTestsRoute && request()->route('slug') === 'homepage';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- PHILOSOPHY: TailwindCSS + Alpine.js ONLY. NO Bootstrap Italia JS/CSS. --}}
        {{-- See: docs/architecture/tailwind-alpine-philosophy.md --}}

        {{-- Used to add dark mode right away, adding here prevents any flicker --}}
        <script>
            if (typeof(Storage) !== "undefined") {
                if (localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true') {
                    document.documentElement.classList.add('dark');
                }
            }
        </script>
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
        @if($isTestsRoute)
        <!-- Bootstrap Italia CSS for test routes -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.18.0/dist/css/bootstrap-italia.min.css">
        @endif
        @if(! $isTestsRoute)
            @filamentStyles
        @elseif($usesFrontendLivewire)
            @livewireStyles
            @filamentStyles
        @endif
        @if($isTestsRoute && ! $usesFrontendLivewire)
            @vite(['resources/css/app.css'], 'themes/Sixteen')
            <link rel="stylesheet" href="/themes/Sixteen/css/header-fix.css">
    <link rel="stylesheet" href="/themes/Sixteen/css/mobile-header-fix.css">
    <link rel="stylesheet" href="/themes/Sixteen/css/mobile-map-fix.css">
        @elseif($isTestsRoute)
            @vite(['resources/css/app.css'], 'themes/Sixteen')
            <link rel="stylesheet" href="/themes/Sixteen/css/header-fix.css">
    <link rel="stylesheet" href="/themes/Sixteen/css/mobile-header-fix.css">
    <link rel="stylesheet" href="/themes/Sixteen/css/mobile-map-fix.css">
        @else
            @vite(['resources/css/app.css'], 'themes/Sixteen')
            <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
        @endif
    </head>
    <body class="{{$isTestsRoute ? 'tests-route' : ''}}">
        {{ $slot }}
        @if($renderRuntimeChrome)
            <livewire:toast />
            @livewire('notifications')
            @filamentScripts
            @vite(['resources/js/app.js'], 'themes/Sixteen')
        @elseif($usesFrontendLivewire)
            {{-- Frontend Livewire with Filament Schema (Wizard) — needs Filament scripts too --}}
            @livewireScripts
            @filamentScripts
            @vite(['resources/js/app.js'], 'themes/Sixteen')
        @elseif($isTestsRoute)
            {{-- Test routes: load theme JS after Livewire/Volt boots Alpine --}}
            @vite(['resources/js/app.js'], 'themes/Sixteen')
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const darkModeToggle = document.getElementById('darkModeToggle');
                if (darkModeToggle) {
                    darkModeToggle.addEventListener('click', function() {
                        const html = document.documentElement;
                        const isDark = html.classList.contains('dark');
                        if (isDark) {
                            html.classList.remove('dark');
                            localStorage.setItem('dark_mode', 'false');
                        } else {
                            html.classList.add('dark');
                            localStorage.setItem('dark_mode', 'true');
                        }
                    });
                }
            });
        </script>
    </body>
</html>
