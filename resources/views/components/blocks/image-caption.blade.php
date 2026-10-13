@props(['data' => []])

@if($data['image'])
<figure class="figure mb-4">
    <img src="{{ $data['image'] }}" alt="{{ $data['caption'] ?? '' }}" class="img-fluid rounded">
    @if($data['caption'])
    <figcaption class="figure-caption text-center mt-2">{{ $data['caption'] }}</figcaption>
    @endif
</figure>
@endif