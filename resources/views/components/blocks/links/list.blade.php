@props(['title' => '', 'links' => []])
@if(!empty($links))
<div class="space-y-2">
    @if($title)<h3 class="text-xl font-bold text-gray-900 mb-4">{{ $title }}</h3>@endif
    @foreach($links as $link)
        <a href="{{ $link['url'] ?? '#' }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
            <span class="font-medium text-blue-600">{{ $link['label'] ?? '' }}</span>
            <x-filament::icon icon="heroicon-o-arrow-right" class="w-4 h-4 text-gray-400" />
        </a>
    @endforeach
</div>
@endif
