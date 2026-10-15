{{--
    Tempi e scadenze (calendario verticale). `section`: id, class, title, intro (paragrafo introduttivo sopra il calendario), bare (true = senza `<section>`, solo `.cmp-timeline`),
    entries[] {year, day, month, label, info (riga di dettaglio sotto il titolo), info_class (default `info-text mt-1 mb-0`)}, footer {text, link {label, url}, suffix, class}.
--}}
@unless ($section['bare'] ?? false)<section class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">@endunless
    <div class="cmp-timeline">
        <h2 class="title-xxlarge mb-3">{{ $section['title'] ?? '' }}</h2>
        @if (filled($section['intro'] ?? null))<div class="richtext-wrapper" data-element="service-calendar-text"><p>{{ $section['intro'] }}</p></div>@endif
        <div class="calendar-vertical mb-3" data-element="service-calendar-list">
            @foreach ($section['entries'] ?? [] as $entry)
                <div class="calendar-date">
                    <h3 class="calendar-date-day">
                        <small class="calendar-date-day__year">{{ $entry['year'] ?? '' }}</small>
                        <span class="title-xxlarge-regular d-flex justify-content-center">{{ $entry['day'] ?? '' }}</span>
                        <small class="calendar-date-day__month">{{ $entry['month'] ?? '' }}</small>
                    </h3>
                    <div class="calendar-date-description rounded">
                        <div class="calendar-date-description-content"><h4 class="h5 mb-0">{{ $entry['label'] ?? '' }}</h4>
                            @if (filled($entry['info'] ?? null))<p class="{{ $entry['info_class'] ?? 'info-text mt-1 mb-0' }}">{{ $entry['info'] }}</p>@endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if (filled($section['footer'] ?? null))
            <p class="{{ $section['footer']['class'] ?? 'mt-4 mt-lg-30 mb-10' }}"><a class="t-primary" href="{{ $section['footer']['link']['url'] ?? '#' }}">{{ $section['footer']['link']['label'] ?? '' }}</a> {{ $section['footer']['text'] ?? '' }}</p>
        @endif
    </div>
@unless ($section['bare'] ?? false)</section>@endunless
