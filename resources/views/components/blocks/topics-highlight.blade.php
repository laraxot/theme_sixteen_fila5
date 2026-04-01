@props(['data' => []])

{{-- 
    Topics Highlight Component - Design Comuni Style
    Usage: <x-blocks.topics-highlight :data="$topicsData" />
--}}

@php
    $title = $data['title'] ?? 'ARGOMENTI IN EVIDENZA';
    $items = $data['items'] ?? [];
    $showAllUrl = $data['show_all_url'] ?? '';
@endphp

<section class="topics-highlight py-8 bg-gray-50">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="title-xxlarge mb-0">{{ $title }}</h2>
            </div>
        </div>
        
        <div class="row g-4">
            @foreach($items as $item)
            <div class="col-12 col-md-6 col-lg-3">
                <a href="{{ $item['url'] ?? '#' }}" class="block p-6 bg-white border border-gray-200 rounded-lg hover:border-primary hover:shadow-md transition-all text-center">
                    @if(isset($item['icon']))
                    <div class="mb-3">
                        @php
                            $iconName = $item['icon'];
                            if (!str_contains($iconName, '-')) {
                                $iconMap = [
                                    'truck' => 'heroicon-o-truck',
                                    'heart' => 'heroicon-o-heart',
                                    'trophy' => 'heroicon-o-trophy',
                                    'tree' => 'heroicon-o-tree',
                                ];
                                $iconName = $iconMap[$iconName] ?? 'heroicon-o-truck';
                            } elseif (!str_starts_with($iconName, 'heroicon-')) {
                                $iconName = 'heroicon-o-' . $iconName;
                            }
                        @endphp
                        <x-filament::icon :icon="$iconName" class="w-12 h-12 text-primary mx-auto" />
                    </div>
                    @endif
                    
                    <h3 class="h5 font-bold mb-0">{{ $item['title'] }}</h3>
                </a>
            </div>
            @endforeach
        </div>
        
        @if($showAllUrl)
        <div class="row mt-4">
            <div class="col-12 text-end">
                <a href="{{ $showAllUrl }}" class="btn btn-outline-primary">
                    Altri argomenti
                    <x-filament::icon icon="heroicon-m-arrow-right" class="w-4 h-4 inline ms-1" />
                </a>
            </div>
        </div>
        @endif
    </div>
</section>
