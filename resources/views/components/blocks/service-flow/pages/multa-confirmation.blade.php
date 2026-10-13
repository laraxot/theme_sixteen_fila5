{{--
    Esito del pagamento multa (DCP-28). Chiavi: breadcrumb, heading (parts/multa-heading: icon, subtitles, buttons), after_heading {class, text, link {label, url, class}}
    (paragrafo sotto il titolo, nella stessa colonna), feedback (valutazione, parts/rating), contacts, modals[]. Senza indice laterale e senza linea.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.multa-heading")
            @if (filled($d('after_heading')))
                <p class="{{ $d('after_heading.class') }}">{{ $d('after_heading.text') }}@if (filled($d('after_heading.link'))) <a class="{{ $d('after_heading.link.class', 't-primary') }}" href="{{ $d('after_heading.link.url', '#') }}">{{ $d('after_heading.link.label') }}</a>@endif</p>
            @endif
        </div>
    </div>
</div>
@if (filled($d('feedback')))@include("$parts.rating")@endif
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
