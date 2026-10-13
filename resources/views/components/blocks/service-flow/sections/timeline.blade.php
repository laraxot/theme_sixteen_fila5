{{--
    Tempi e scadenze (calendario verticale). `section`: id, class, title, entries[] {year, day, month, label}, footer {text, link {label, url}, suffix, class}.
--}}
<section class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">
    <div class="cmp-timeline">
        <h2 class="title-xxlarge mb-3">{{ $section['title'] ?? '' }}</h2>
        <div class="calendar-vertical mb-3" data-element="service-calendar-list">
            @foreach ($section['entries'] ?? [] as $entry)
                <div class="calendar-date">
                    <h3 class="calendar-date-day">
                        <small class="calendar-date-day__year">{{ $entry['year'] ?? '' }}</small>
                        <span class="title-xxlarge-regular d-flex justify-content-center">{{ $entry['day'] ?? '' }}</span>
                        <small class="calendar-date-day__month">{{ $entry['month'] ?? '' }}</small>
                    </h3>
                    <div class="calendar-date-description rounded">
                        <div class="calendar-date-description-content"><h4 class="h5 mb-0">{{ $entry['label'] ?? '' }}</h4></div>
                    </div>
                </div>
            @endforeach
        </div>
        @if (filled($section['footer'] ?? null))
            <p class="{{ $section['footer']['class'] ?? 'mt-4 mt-lg-30 mb-10' }}"><a class="t-primary" href="{{ $section['footer']['link']['url'] ?? '#' }}">{{ $section['footer']['link']['label'] ?? '' }}</a> {{ $section['footer']['text'] ?? '' }}</p>
        @endif
    </div>
</section>
