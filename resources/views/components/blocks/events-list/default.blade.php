@props(['data' => []])
<section class="dc-events-list" aria-labelledby="all-events-title">
    <div class="dc-events-container"><h2 id="all-events-title">{{ $data['title'] ?? 'Tutti gli eventi' }}</h2>
        <div class="dc-events-grid">@foreach (($data['items'] ?? []) as $item)<article class="dc-event-list-card"><p class="dc-event-card__meta">{{ $item['date'] ?? '' }}</p><p class="dc-event-card__category">{{ $item['category'] ?? '' }}</p><h3><a href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p>{{ $item['description'] ?? '' }}</p></article>@endforeach</div>
    </div>
</section>
