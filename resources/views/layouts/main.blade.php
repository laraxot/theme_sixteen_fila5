<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{--  
        {!! $_theme->metatags() !!}
        --}}
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
        @filamentStyles
        @vite(['resources/css/app.css'], 'themes/Sixteen')
        <!-- Bootstrap Italia CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.18.0/dist/css/bootstrap-italia.min.css">
        @stack('styles')
    </head>
    <body class="min-h-screen antialiased bg-white dark:bg-gradient-to-b dark:from-gray-950 dark:to-gray-900">
        {{ $slot ?? '' }}
        @yield('body')

        <livewire:toast />
        @livewire('notifications')
        @filamentScripts
        @vite(['resources/js/app.js'], 'themes/Sixteen')
        @stack('scripts')

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
        <link rel="stylesheet" type="text/css" href="{{ asset('vendor/cookie-consent/css/cookie-consent.css') }}">
    </body>
</html>
