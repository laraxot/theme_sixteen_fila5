<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
        <title>{{ $title ?: config('app.name', 'FixCity') }}</title>
        <meta name="description" content="{{ $description ?: config('app.name', 'FixCity') }}">

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
        {{-- Cookie consent: NON in app.css — @import url(/vendor/...) fa fallire vite build (postcss-import filesystem). Solo asset() --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
        @stack('styles')
    </head>
    <body @if(!empty($bodyPage)) data-page="{{ $bodyPage }}" @endif>
        
        {{ $slot }}
        @livewireScripts
        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')
=======

        {{--  
        {!! $_theme->metatags() !!}
        --}}
        <!-- Used to add dark mode right away, adding here prevents any flicker -->
        <script>
            if (typeof(Storage) !== "undefined") {
                if(localStorage.getItem('dark_mode') && localStorage.getItem('dark_mode') == 'true'){
                    document.documentElement.classList.add('dark');
                }
            }
        </script>
        <style>
			[x-cloak] {
			display: none !important;
			}
		</style>
		@filamentStyles


        @vite([/*'resources/css/filament/theme.css',*/'resources/css/app.css'], 'themes/Sixteen')


    </head>
    <body class="min-h-screen antialiased bg-white dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900">
        {{ $slot }}
        <livewire:toast />
        @livewire('notifications')
		@filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')

        {{-- Dark Mode Toggle Script --}}
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
        <link rel="stylesheet" type="text/css" href="{{asset("vendor/cookie-consent/css/cookie-consent.css")}}">
>>>>>>> 6ed19256f (.)
    </body>
</html>
