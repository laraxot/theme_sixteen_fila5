@props(['data' => []])

<div class="mb-4">
    @if($data['title'])
    <h3 class="h5-semi-bold mb-3">{{ $data['title'] }}</h3>
    @endif
    <div class="row g-2">
        @foreach($data['items'] as $item)
        <div class="col-6 col-md-3">
            <a href="{{ $item['url'] ?? '#' }}" class="btn btn-outline-secondary btn-sm w-100 text-start d-flex align-items-center justify-content-between rounded">
                <span>{{ $item['label'] }}</span>
                <span>→</span>
            </a>
        </div>
        @endforeach
    </div>
</div>