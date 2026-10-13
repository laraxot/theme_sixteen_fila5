{{--
    Contatti del servizio (vantaggi): scheda con avatar centrato verticalmente e titolo piu' spaziato rispetto a `service-contacts`.
    `section`: id, title, office {name, url, lines[], email, email_aria, image {src, alt}}, topics {label, items[]}, updated.
--}}
<section class="it-page-section" id="{{ $section['id'] ?? '' }}">
    <h2 class="mb-3">{{ $section['title'] ?? '' }}</h2>
    <div class="row">
        <div class="col-12 col-md-8 col-lg-6 mb-30">
            <div class="card-wrapper rounded h-auto pb-0">
                <div class="card card-teaser card-teaser-info align-items-center rounded shadow-sm p-3">
                    <div class="card-body pe-3">
                        <span class="title-small mb-2"><a class="text-decoration-none" href="{{ data_get($section, 'office.url', '#') }}" data-element="service-area">{{ data_get($section, 'office.name') }}</a></span>
                        <p class="subtitle-small mb-0">
                            @foreach (data_get($section, 'office.lines', []) as $line){{ $line }} <br>@endforeach
                            <a class="" href="mailto:{{ data_get($section, 'office.email') }}" aria-label="{{ data_get($section, 'office.email_aria') }}" title="{{ data_get($section, 'office.email_aria') }}">{{ data_get($section, 'office.email') }}</a></p>
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
