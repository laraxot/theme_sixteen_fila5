{{--
    Passo del wizard con linea sotto il titolo e senza stepper (preferenze del servizio). Chiavi: breadcrumb, heading (+ heading.rule), side_nav, body {row, col, steps_class},
    sections[], nav, contacts. Il titolo sta in una riga `row` (non centrata) con la linea dentro la riga; le sezioni stanno in `.steppers-content` (classi: body.steps_class).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="{{ $d('heading.row', 'row') }}">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
        @include("$parts.rule")
    </div>
    <div class="{{ $d('body.row', 'row mt-lg-40') }}">
        @include("$parts.side-index", ['sideNav' => $d('side_nav', [])])
        <div class="{{ $d('body.col', 'col-12 col-lg-8 offset-lg-1') }}">
            <div class="{{ trim('steppers-content '.$d('body.steps_class')) }}" aria-live="polite">
                <div class="it-page-sections-container">
                    @include("$parts.sections", ['sections' => $d('sections', [])])
                </div>
                @include("$parts.nav-steps")
            </div>
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
