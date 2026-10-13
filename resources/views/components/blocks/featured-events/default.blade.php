@props(['data' => []])
<section class="dc-events-band" aria-labelledby="featured-events-title">
    <div class="dc-events-container">
        <h2 id="featured-events-title">{{ $data['title'] ?? 'Eventi in evidenza' }}</h2>
        <div class="dc-events-grid">
            @foreach (($data['items'] ?? []) as $item)
                <article class="dc-event-card">
                    @if (!empty($item['image']))
                        <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset($item['image']) }}" alt="{{ $item['image_alt'] ?? $item['title'] ?? '' }}" loading="lazy">
                    @endif
                    <div class="dc-event-card__body">
                        <p class="dc-event-card__meta">{{ $item['date'] ?? '' }}{{ !empty($item['time']) ? ' · '.$item['time'] : '' }}</p>
                        <p class="dc-event-card__category">{{ $item['category'] ?? 'Categoria' }}</p>
                        <h3><a href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3>
                        <p>{{ $item['description'] ?? '' }}</p>
                        @if (!empty($item['location']))<p class="dc-event-card__location">{{ $item['location'] }}</p>@endif
                        <a class="dc-event-card__more" href="{{ $item['url'] ?? '#' }}">Leggi di più <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
