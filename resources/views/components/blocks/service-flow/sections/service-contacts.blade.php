{{--
    Contatti del servizio. `section`: id, title, office {name, url, lines[] (indirizzo, telefono: separati da a capo), email, email_aria, image {src, alt},
    card_class (default `card card-teaser card-teaser-info rounded shadow-sm p-3`), title_class (default `title-small`), name_class (classi del link del nome, default
    `text-decoration-none`), name_element (data-element del link del nome, default `service-area`, vuoto = assente), email_href (indirizzo del mailto, default `email`),
    email_plain (true = link email senza class ne' title), text_wrap (true = paragrafo dentro `div.card-text`)}, topics {label, items[]}, updated.
--}}
@php
    $plain = (bool) data_get($section, 'office.email_plain');
@endphp
<section class="it-page-section" id="{{ $section['id'] ?? '' }}">
    <h2 class="mb-3">{{ $section['title'] ?? '' }}</h2>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mb-30">
            <div class="card-wrapper rounded h-auto pb-0">
                <div class="{{ data_get($section, 'office.card_class', 'card card-teaser card-teaser-info rounded shadow-sm p-3') }}">
                    <div class="card-body pe-3">
                        <span class="{{ data_get($section, 'office.title_class', 'title-small') }}"><a class="{{ data_get($section, 'office.name_class', 'text-decoration-none') }}" href="{{ data_get($section, 'office.url', '#') }}"@if (filled($element = data_get($section, 'office.name_element', 'service-area'))) data-element="{{ $element }}"@endif>{{ data_get($section, 'office.name') }}</a></span>
                        @if (data_get($section, 'office.text_wrap'))<div class="card-text">@endif
                        <p class="subtitle-small mb-0">
                            @foreach (data_get($section, 'office.lines', []) as $line){{ $line }} <br>@endforeach
                            <a {!! $plain ? '' : 'class="" ' !!}href="mailto:{{ data_get($section, 'office.email_href', data_get($section, 'office.email')) }}" aria-label="{{ data_get($section, 'office.email_aria') }}"{!! $plain ? '' : ' title="'.e(data_get($section, 'office.email_aria')).'"' !!}>{{ data_get($section, 'office.email') }}</a></p>
                        @if (data_get($section, 'office.text_wrap'))</div>@endif
                    </div>
                    <div class="avatar size-xl"><img src="{{ data_get($section, 'office.image.src') }}" alt="{{ data_get($section, 'office.image.alt') }}"></div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-30">
            <span class="text-paragraph-small">{{ data_get($section, 'topics.label') }}</span>
            <ul class="d-flex flex-wrap gap-2 mt-10 mb-3">
                @foreach (data_get($section, 'topics.items', []) as $topic)
                    <li><a class="chip chip-simple" href="#" data-element="service-topic"><span class="chip-label">{{ $topic }}</span></a></li>
                @endforeach
            </ul>
            <p class="text-paragraph-small mb-0">{{ $section['updated'] ?? '' }}</p>
        </div>
    </div>
</section>
