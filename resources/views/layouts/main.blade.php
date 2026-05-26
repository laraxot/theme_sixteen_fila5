<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{--
        {!! $_theme->metatags() !!}
        --}}

        {{-- [x-cloak]: resources/css/app.css --}}

        @filamentStyles
        @vite(['resources/css/app.css'], 'themes/Sixteen')
        {{-- Cookie consent: asset() perché Vite @import fallisce --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
        @stack('styles')

        {{--
            Alpine.data mobileMenu bootstrap — PRIMA di @livewireScripts.
            Vite app.js e' type="module" defer, arriva dopo Alpine.
            Questa registrazione su alpine:init garantisce che Alpine.data('mobileMenu')
            sia disponibile allo scan iniziale del DOM.

            La factory in app.js (components/mobile-menu.js) e' una seconda registrazione
            identica e innocua (Alpine.data e' idempotente).
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
    </head>
    <body>
        {{ $slot ?? '' }}
        @yield('body')

        @livewireScripts
        <livewire:toast />
        @livewire('notifications')
        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')
        @stack('scripts')
    </body>
</html>
