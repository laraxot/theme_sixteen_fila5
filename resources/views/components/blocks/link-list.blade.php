@props(['data' => []])

<div class="card card-body border-0 mb-3" :class="{ 'bg-light': data.bg_light }">
    <h2 class="card-title h6-semi-bold mb-3">{{ data.heading ?? '' }}</h2>
    @if(data.items)
    <ul class="list-unstyled">
        @foreach(data.items as $item)
        <li class="d-flex justify-content-between align-items-center py-2 border-bottom border-light last:border-0">
            <a href="{{ $item['url'] ?? '#' }}" class="text-body fw-medium">{{ $item['title'] ?? '' }}</a>
            @if($item['icon'])
            <span class="text-muted small">{{ $item['icon'] }}</span>
            @endif>
        </li>
        @endforeach
    </ul>
    @endif
</div>