{{--
    Esito della richiesta (richiesta inviata o pagamento eseguito). Chiavi: breadcrumb, heading (con icon, subtitles, buttons) + heading.rule, after_heading {class, text, link {label, url, class},
    link_first (true = prima il link, poi il testo)} (paragrafo sotto il titolo, nella stessa colonna), side_nav, sections[] (se assenti: niente linea, indice e corpo), feedback, contacts, modals[].
    Titolo e corpo con indice laterale, come la scheda servizio ma con la linea sotto il titolo fuori dalla colonna.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
    $linkFirst = (bool) $d('after_heading.link_first', false);
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
            @if (filled($d('after_heading')))
                <p class="{{ $d('after_heading.class') }}">
                    @if ($linkFirst)
                        <a class="{{ $d('after_heading.link.class', 't-primary') }}" href="{{ $d('after_heading.link.url', '#') }}">{{ $d('after_heading.link.label') }}</a> {{ $d('after_heading.text') }}
                    @else
                        {{ $d('after_heading.text') }}@if (filled($d('after_heading.link'))) <a class="{{ $d('after_heading.link.class', 't-primary') }}" href="{{ $d('after_heading.link.url', '#') }}">{{ $d('after_heading.link.label') }}</a>@endif
                    @endif
                </p>
            @endif
        </div>
    </div>
    @if (filled($d('sections')))
        @include("$parts.rule")
        <div class="row">
            @include("$parts.side-index", ['sideNav' => $d('side_nav', [])])
            <div class="col-12 col-lg-8 offset-lg-1">
                <div class="it-page-sections-container">
                    @include("$parts.sections", ['sections' => $d('sections', [])])
                </div>
            </div>
        </div>
    @endif
</div>
@if (filled($d('feedback')))@include("$parts.rating")@endif
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
