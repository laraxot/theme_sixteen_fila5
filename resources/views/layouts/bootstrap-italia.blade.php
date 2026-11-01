<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Nome del Comune')</title>
    <meta name="description" content="">

    {{-- Design Comuni CSS (Bootstrap Italia class mappings) --}}
    <link href="{{ asset('themes/Sixteen/design-comuni.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    @yield('content')

    {{-- Splide JS for carousels --}}
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @stack('scripts')
</body>
</html>
