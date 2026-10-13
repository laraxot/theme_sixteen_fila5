{{--
    Passo del wizard IMU. Come `wizard-step`, piu': `stepper_note` {class, text} (nota sotto lo stepper, nella stessa colonna) e
    `body.lead` {col_class, class, text} (colonna con un paragrafo prima della colonna principale, es. solo mobile). Le altre chiavi sono quelle
    di wizard-step: breadcrumb, heading, stepper, side_nav, body {layout, steps_content, col, sections_container, before[]}, sections[], nav, contacts, modals[].
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
    $sidebar = $d('body.layout', 'sidebar') === 'sidebar';
    $stepsContent = $d('body.steps_content', 'none');
    $container = (bool) $d('body.sections_container', true);
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
        @if (filled($d('stepper')))
            <div class="col-12">
                @include("$parts.stepper")
                @if (filled($d('stepper_note')))<p class="{{ $d('stepper_note.class') }}">{{ $d('stepper_note.text') }}</p>@endif
            </div>
        @endif
    </div>
    @if ($stepsContent === 'outer')<div class="steppers-content" aria-live="polite">@endif
    <div class="{{ $sidebar ? 'row' : 'row justify-content-center' }}">
        @if (filled($d('body.lead')))
            <div class="{{ $d('body.lead.col_class') }}"><p class="{{ $d('body.lead.class') }}">{{ $d('body.lead.text') }}</p></div>
        @endif
        @if ($sidebar)@include("$parts.side-index", ['sideNav' => $d('side_nav', [])])@endif
        <div class="{{ $d('body.col', $sidebar ? 'col-12 col-lg-8 offset-lg-1' : 'col-12 col-lg-8') }}">
            @if ($stepsContent === 'inner')<div class="steppers-content" aria-live="polite">@endif
            @include("$parts.sections", ['sections' => $d('body.before', [])])
            @if ($container)<div class="it-page-sections-container">@endif
                @include("$parts.sections", ['sections' => $d('sections', [])])
            @if ($container)</div>@endif
            @if (filled($d('nav')))@include("$parts.nav-steps")@endif
            @if ($stepsContent === 'inner')</div>@endif
        </div>
    </div>
    @if ($stepsContent === 'outer')</div>@endif
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
