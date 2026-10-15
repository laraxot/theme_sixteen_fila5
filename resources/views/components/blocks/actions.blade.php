@props(['data' => []])

<div class="flex flex-wrap gap-2 mb-4">
    @foreach($data['items'] as $item)
    <a href="{{ $item['url'] ?? '#' }}" class="flex items-center px-3 py-2 border border-gray-300 rounded text-sm font-medium hover:bg-gray-50 transition-colors">
        @if($item['icon'])
        <span class="mr-2">{{ $item['icon'] }}</span>
        @endif
        <span>{{ $item['label'] }}</span>
    </a>
    @endforeach
</div>