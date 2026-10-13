{{--
    Pagina documento (graduatoria pubblicata, messaggio). Chiavi: breadcrumb, heading (+ heading.rule), body {row, col}, sections[], contacts.
    Titolo con linea dentro la riga; corpo in una riga centrata, senza indice laterale ne' contenitore delle sezioni.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="{{ $d('heading.row', 'row justify-content-center') }}">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
        @include("$parts.rule")
    </div>
    <div class="{{ $d('body.row', 'row mt-3 mt-lg-40 justify-content-center') }}">
        <div class="{{ $d('body.col', 'col-12 col-lg-8') }}">
            @include("$parts.sections", ['sections' => $d('sections', [])])
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
