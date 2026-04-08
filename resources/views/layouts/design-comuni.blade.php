<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Design Comuni' }}</title>
    <meta name="description" content="{{ $metaDescription ?? '' }}">

    <!-- Design Comuni: Bootstrap Italia classes replicated with Tailwind @apply -->
    <link href="{{ asset('themes/Sixteen/design-comuni.css') }}" rel="stylesheet">

    @vite(['resources/css/app.css'], 'themes/Sixteen')

    <style>
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>
<body>
    {{ $slot }}

    @vite(['resources/js/app.js'], 'themes/Sixteen')
    @stack('scripts')
</body>
</html>
