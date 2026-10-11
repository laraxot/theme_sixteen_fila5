@props(['blocks' => []])

@php
    $headerData = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $headerData = array_merge($headerData, $blockData);
        }
    }
    $brand = $headerData['brand'] ?? ['name' => '', 'tagline' => '', 'logo' => ''];
    $region = $headerData['region'] ?? ['name' => '', 'url' => ''];
    $utilityLinks = $headerData['utility_links'] ?? [];
    $account = $headerData['account'] ?? ['label' => '', 'url' => ''];
    $navigation = $headerData['navigation'] ?? [];
    $secondaryNavigation = $headerData['secondary_navigation'] ?? [];
    $social = $headerData['social'] ?? [];
    $brandLogo = (string) ($brand['logo'] ?? '');
    if ($brandLogo !== '' && ! str_starts_with($brandLogo, '/') && ! str_starts_with($brandLogo, 'http://') && ! str_starts_with($brandLogo, 'https://')) {
        $brandLogo = asset($brandLogo);
    }
@endphp

<header class="bg-base-100 border-b border-base-200">
    <div class="container mx-auto px-4">
        <!-- Top bar -->
        <div class="flex items-center justify-between py-2">
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" class="flex items-center space-x-2">
                    <img src="{{ $brandLogo }}" alt="{{ $brand['name'] }}" class="h-10">
                    <div>
                        <div class="font-bold text-lg">{{ $brand['name'] }}</div>
                        <div class="text-sm text-base-600">{{ $brand['tagline'] }}</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ $region['url'] }}" class="text-sm text-base-700 hover:underline">{{ $region['name'] }}</a>
                @foreach($utilityLinks as $link)
                    <a href="{{ $link['url'] }}" class="text-sm text-base-700 hover:underline">{{ $link['label'] }}</a>
                @endforeach
                <a href="{{ $account['url'] }}" class="text-sm font-medium text-primary hover:underline">{{ $account['label'] }}</a>
            </div>
        </div>
        <!-- Primary navigation -->
        <nav class="flex items-center space-x-6 py-3 border-t border-base-200">
            @foreach($navigation as $item)
                <a href="{{ $item['url'] }}" class="text-base font-medium text-base-800 hover:text-primary">{{ $item['label'] }}</a>
            @endforeach
        </nav>
    </div>
</header>
