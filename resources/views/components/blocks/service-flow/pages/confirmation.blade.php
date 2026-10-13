{{--
    Esito della richiesta (richiesta inviata). Chiavi: breadcrumb, heading (con icon, subtitles, buttons) + heading.rule, side_nav, sections[],
    feedback, contacts. Titolo e corpo con indice laterale, come la scheda servizio ma con la linea sotto il titolo fuori dalla colonna.
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
        </div>
    </div>
    @include("$parts.rule")
    <div class="row">
        @include("$parts.side-index", ['sideNav' => $d('side_nav', [])])
        <div class="col-12 col-lg-8 offset-lg-1">
            <div class="it-page-sections-container">
                @include("$parts.sections", ['sections' => $d('sections', [])])
            </div>
        </div>
    </div>
</div>
@if (filled($d('feedback')))@include("$parts.rating")@endif
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
