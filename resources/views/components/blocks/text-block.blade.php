@props(['data' => []])

<div class="mb-5">
    <h2 class="h4-semi-bold mb-3">{{ $data['title'] ?? 'Cos\'è?' }}</h2>
    <div class="content">
        {!! $data['content'] ?? '' !!}
    </div>
</div>