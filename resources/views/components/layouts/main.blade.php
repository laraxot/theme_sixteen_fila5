<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        @livewireStyles
        @filamentStyles
        @vite(['resources/css/app.css'], 'themes/Sixteen')
        {{-- Cookie consent: NON in app.css — @import url(/vendor/...) fa fallire vite build (postcss-import filesystem). Solo asset() --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
    </head>
    <body>
        {{ $slot }}
        @livewireScripts
        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')
    </body>
</html>
