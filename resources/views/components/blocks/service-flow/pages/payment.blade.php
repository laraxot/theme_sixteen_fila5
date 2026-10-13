{{--
    Pagamento: riepilogo del dovuto e pulsante di pagamento. Chiavi: breadcrumb, heading + heading.rule, sections[] (summary, cta), contacts.
    Colonna centrale `col-12 col-lg-10 offset-lg-1`, senza indice laterale.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
    </div>
    @include("$parts.rule")
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1 pt-3 pt-lg-0">
            @include("$parts.sections", ['sections' => $d('sections', [])])
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
