{{--
    Documento creato (IMU): niente indice laterale ne' sezioni. Chiavi: breadcrumb, heading (icon, subtitles, buttons), after {class, link {label, url, class}, text}
    (paragrafo sotto il titolo, nella stessa colonna), feedback, contacts, modals[].
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
            @if (filled($d('after')))
                <p class="{{ $d('after.class') }}"><a class="{{ $d('after.link.class') }}" href="{{ $d('after.link.url', '#') }}">{{ $d('after.link.label') }}</a> {{ $d('after.text') }}</p>
            @endif
        </div>
    </div>
</div>
@if (filled($d('feedback')))@include("$parts.rating")@endif
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
