<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-cms::head />

    <body>
        @yield('body')

        @filamentScripts

    </body>
</html>
