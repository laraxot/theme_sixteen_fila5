@props(['data' => []])

<div class="mb-4">
    @if($data['title'])
    <h3 class="h5-semi-bold mb-2">{{ $data['title'] }}</h3>
    @endif
    <a href="#" class="d-block p-3 bg-primary text-white rounded text-decoration-none fw-medium">{{ $data['button_label'] ?? 'Contattaci' }}</a>
</div>