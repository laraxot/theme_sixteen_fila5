<?php
use Laravel\Folio\{title, middleware, name};
?>
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
        <link rel="stylesheet" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
        @stack('styles')
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
