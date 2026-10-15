@props(['blocks' => []])

@php
    $headerData = [];
    foreach ($blocks as $block) {
        if (isset($block['data']) && is_array($block['data'])) {
            $headerData = array_merge($headerData, $block['data']);
        }
    }
    $brand = $headerData['brand'] ?? ['name' => '', 'tagline' => '', 'logo' => ''];
    $region = $headerData['region'] ?? ['name' => '', 'url' => ''];
    $utilityLinks = $headerData['utility_links'] ?? [];
    $account = $headerData['account'] ?? ['label' => '', 'url' => ''];
    $navigation = $headerData['navigation'] ?? [];
    $secondaryNavigation = $headerData['secondary_navigation'] ?? [];
    $social = $headerData['social'] ?? [];
@endphp

<header class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <!-- Top bar -->
        <div class="flex items-center justify-between py-2">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="{{ $brand['logo'] }}" alt="{{ $brand['name'] }}" class="h-10">
                    <div>
                        <div class="font-bold text-lg">{{ $brand['name'] }}</div>
                        <div class="text-sm text-gray-600">{{ $brand['tagline'] }}</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ $region['url'] }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50">{{ $region['name'] }}</a>
                @foreach($utilityLinks as $link)
                    <a href="{{ $link['url'] }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50">{{ $link['label'] }}</a>
                @endforeach
                <a href="{{ auth()->check() ? url('/area-personale') : route('login') }}" class="inline-flex items-center px-3 py-2 text-sm font-medium {{ auth()->check() ? 'text-green-700 bg-green-50' : 'text-primary' }} hover:text-primary/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50" aria-label="{{ auth()->check() ? 'Area personale - accesso servizio' : 'Accedi all\'area personale - autenticazione richiesta' }}">
                    {{ auth()->check() ? ($account['label_authenticated'] ?? 'Area personale') : $account['label'] }}
                </a>
            </div>
        </div>
        <!-- Primary navigation -->
        <nav class="flex items-center space-x-6 py-3 border-t border-gray-200">
            @foreach($navigation as $item)
                <a href="{{ $item['url'] }}" class="inline-flex items-center px-3 py-2 text-base font-medium text-gray-800 hover:text-primary focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary/50">{{ $item['label'] }}</a>
            @endforeach
        </nav>
    </div>
</header>