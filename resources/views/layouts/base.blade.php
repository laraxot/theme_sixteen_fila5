<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('title')
            <title>@yield('title') - {{ config('app.name') }}</title>
        @else
            <title>{{ config('app.name') }}</title>
        @endif

        <!-- Favicon -->
		<link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

        {{-- Bootstrap Italia CSS - CDN (EXACT match with Design Comuni reference) --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.8.8/dist/css/bootstrap-italia.min.css" />

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>
        @yield('body')

        {{-- Bootstrap Italia JS - CDN --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.8.8/dist/js/bootstrap-italia.bundle.min.js"></script>
    </body>
</html>
