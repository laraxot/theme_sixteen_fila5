{{--
    Scheda servizio. Chiavi: breadcrumb, heading (+ heading.row / heading.col / heading.rule), side_nav, body.row, sections[], feedback, related, contacts.
    Ordine: breadcrumb | titolo con azioni | indice laterale + sezioni | valutazione | correlati + contatti.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">@include("$parts.breadcrumb")</div>
    </div>
</div>
<div class="container">
    <div class="{{ $d('heading.row', 'row justify-content-center') }}">
        <div class="{{ $d('heading.col', 'col-12 col-lg-10') }}">
            @include("$parts.heading")
        </div>
        @include("$parts.rule")
    </div>
</div>
<div class="container">
    <div class="{{ $d('body.row', 'row row-column-menu-left mt-4 mt-lg-80') }}">
        @include("$parts.side-index", ['sideNav' => $d('side_nav', [])])
        <div class="col-12 col-lg-8 offset-lg-1">
            <div class="it-page-sections-container">
                @include("$parts.sections", ['sections' => $d('sections', [])])
            </div>
        </div>
    </div>
</div>
@if (filled($d('feedback')))@include("$parts.rating")@endif
@include("$parts.contacts", ['related' => $d('related')])
@include("$parts.modals")
