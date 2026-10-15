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

        <script>
            // Flash messages (Laravel session `status`) → toast. Multilingua: la chiave e' nel namespace
            // del modulo che l'ha generata (es. account.delete.flash.account_deleted).
            @php
                $flash = session('status');
                $flashMessage = null;
                if (is_string($flash) && \Illuminate\Support\Str::contains($flash, '.')) {
                    [$ns, $key] = explode('.', $flash, 2);
                    $flashMessage = __($ns.'.'.$key);
                } elseif (is_string($flash)) {
                    $flashMessage = $flash;
                }
            @endphp
            @if ($flashMessage)
            <script>
                if (window.toast) {
                    window.toast(@json($flashMessage), { type: 'success' });
                }
            </script>
            @endif
        </script>

        {{-- Banner cookie: lo inietta CookieConsentMiddleware (vista Modules/Gdpr/resources/views/cookie-consent, DCP-153); nessun include qui. --}}
    </body>
</html>
