@props(['data' => []])

<div class="mb-5">
    @if($data['title'])
    <h3 class="h5-semi-bold mb-3">{{ $data['title'] }}</h3>
    @endif
    <div class="row row-cols-2 row-cols-md-3 g-3">
        @foreach($data['items'] as $item)
        <div class="col">
            <figure class="figure m-0">
                <img src="{{ $item['image'] ?? '' }}" alt="{{ $item['caption'] ?? '' }}" class="img-fluid rounded">
                @if($item['caption'])
                <figcaption class="figure-caption text-center mt-1">{{ $item['caption'] }}</figcaption>
                @endif
            </figure>
        </div>
        @endforeach
    </div>
</div>