@props(['data' => []])
<section class="dc-events-calendar" aria-labelledby="events-calendar-title">
    <div class="dc-events-container">
        <h2 id="events-calendar-title">{{ $data['title'] ?? 'Calendario eventi' }}</h2>
        <div class="dc-calendar-grid">
            @foreach (($data['months'] ?? []) as $month)
                <div class="dc-calendar-month"><h3>{{ $month['month'] ?? '' }}</h3>
                    <ul>@foreach (($month['events'] ?? []) as $event)<li><time>{{ $event['date'] ?? '' }}</time><a href="{{ $event['url'] ?? '#' }}">{{ $event['title'] ?? '' }}</a></li>@endforeach</ul>
                </div>
            @endforeach
        </div>
    </div>
</section>
