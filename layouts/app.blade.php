<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Comune di ' . config('comune.nome', 'Nome Comune'))</title>
    
    <!-- Bootstrap Italia CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.0.0/dist/css/bootstrap-italia.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ theme_asset('css/design-comuni.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/comune-custom.css') }}" rel="stylesheet">
    
    @stack('styles')
</head>
<body>
    @include('sixteen::components.header-comune')
    
    <main>
        @yield('content')
    </main>
    
    @include('sixteen::components.footer-comune')
    
    <!-- Bootstrap Italia JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-italia@2.0.0/dist/js/bootstrap-italia.bundle.min.js"></script>
    
    <!-- Leaflet JS per le mappe -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    
    <!-- Custom JS -->
    <script src="{{ theme_asset('js/design-comuni.js') }}"></script>
    <script src="{{ theme_asset('js/comune-functions.js') }}"></script>
    
    @stack('scripts')
</body>
</html>


