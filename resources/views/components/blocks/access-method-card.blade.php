@props(['data' => []])

<div class="mb-5">
    <h2 class="h4-semi-bold mb-3">Accesso ai servizi</h2>
    <div class="row g-3">
        @if($data['items'])
        @foreach($data['items'] as $item)
        <div class="col-md-6">
            <div class="card shadow-sm border-light h-100 p-4">
                @if($item['icon'])
                <div class="mb-3 text-primary">
                    <span>{{ $item['icon'] }}</span>
                </div>
                @endif
                <h3 class="h5-semi-bold mb-2">{{ $item['label'] ?? '' }}</h3>
                <p class="mb-3 small">{{ $item['description'] ?? '' }}</p>
                @if($item['url'])
                <a href="{{ $item['url'] }}" class="btn btn-primary" style="background-color:#007A52; border-color:#007A52;">{{ $item['label'] }}</a>
                @endif
                @if($item['link_text'] ?? false)
                <a href="{{ $item['link_url'] ?? '#' }}" class="mt-2 d-block small">{{ $item['link_text'] }}</a>
                @endif
                @if($item['items_sub'] ?? false)
                <div class="mt-2 border-top pt-2">
                    @foreach($item['items_sub'] as $sub)
                    <a href="{{ $sub['url'] ?? '#' }}" class="d-block text-decoration-none text-body">{{ $sub['label'] }}</a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>