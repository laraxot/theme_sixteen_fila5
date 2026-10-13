{{--
    Variante graduatoria di service-contacts (DCP-26): scheda `align-items-center`, titolo `card-title mb-2 title-small`, link email senza class ne' title.
    Contatti del servizio. `section`: id, title, office {name, url, lines[] (indirizzo, telefono: separati da a capo), email, image {src, alt}},
    topics {label, items[]}, updated.
--}}
<section class="it-page-section" id="{{ $section['id'] ?? '' }}">
    <h2 class="mb-3">{{ $section['title'] ?? '' }}</h2>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mb-30">
            <div class="card-wrapper rounded h-auto pb-0">
                <div class="card card-teaser card-teaser-info align-items-center rounded shadow-sm p-3">
                    <div class="card-body pe-3">
                        <span class="card-title mb-2 title-small"><a class="text-decoration-none" href="{{ data_get($section, 'office.url', '#') }}" data-element="service-area">{{ data_get($section, 'office.name') }}</a></span>
                        <p class="subtitle-small mb-0">
                            @foreach (data_get($section, 'office.lines', []) as $line){{ $line }} <br>@endforeach
                            <a href="mailto:{{ data_get($section, 'office.email') }}" aria-label="{{ data_get($section, 'office.email_aria') }}">{{ data_get($section, 'office.email') }}</a></p>
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
