{{--
    Consenso (informativa privacy) con stepper. Chiavi: breadcrumb, title (h1 semplice), title_class, stepper, sections[] (testi, casella, pulsante), body {col}, contacts.
    Tre contenitori: breadcrumb | titolo + stepper | corpo in colonna centrata.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h1 class="{{ $d('title_class', 'title-xxxlarge mb-4') }}">{{ $d('title') }}</h1>
        </div>
        <div class="col-12">@include("$parts.stepper")</div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="{{ $d('body.col', 'col-12 col-lg-8') }}">
            @include("$parts.sections", ['sections' => $d('sections', [])])
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
