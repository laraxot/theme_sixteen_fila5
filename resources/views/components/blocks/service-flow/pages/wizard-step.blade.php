{{--
    Passo del wizard con stepper (dati, preferenze, riepilogo) o pagina documento (senza stepper ne' pulsanti). Chiavi: breadcrumb, heading (row: classi della riga del titolo, default
    `row justify-content-center`; rule: linea dentro la riga, vedi parts/rule), stepper, stepper_note {class, text} (nota sotto lo stepper, nella stessa colonna),
    side_nav, body {layout: sidebar|centered, row (classi della riga del corpo), steps_content: outer|inner|split|none, steps_class (classi aggiunte a `.steppers-content`), col, sections_container, before[] (sezioni prima del contenitore, es. warning-box),
    lead {col_class, class, text} (colonna con un paragrafo prima della colonna principale, es. solo mobile), form (id di un <form> attorno a sezioni e pulsanti)},
    sections[], nav, contacts, modals[].
    `steps_content` = dove sta il wrapper `.steppers-content` del riferimento (attorno alla riga con l'indice, dentro la colonna, oppure assente);
    `split` = il container principale si chiude dopo lo stepper e se ne apre un altro per il corpo.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
    $sidebar = $d('body.layout', 'sidebar') === 'sidebar';
    $stepsContent = $d('body.steps_content', 'none');
    $container = (bool) $d('body.sections_container', true);
@endphp
<div class="container" id="main-container">
    <div class="{{ $d('heading.row', 'row justify-content-center') }}">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
        @include("$parts.rule")
        @if (filled($d('stepper')))
            <div class="col-12">
                @include("$parts.stepper")
                @if (filled($d('stepper_note')))<p class="{{ $d('stepper_note.class') }}">{{ $d('stepper_note.text') }}</p>@endif
            </div>
        @endif
    </div>
    @if ($stepsContent === 'outer')<div class="{{ trim('steppers-content '.$d('body.steps_class')) }}" aria-live="polite">@endif
    @if ($stepsContent === 'split')</div><div class="container">@endif
    <div class="{{ $d('body.row', $sidebar ? 'row' : 'row justify-content-center') }}">
        @if (filled($d('body.lead')))
            <div class="{{ $d('body.lead.col_class') }}"><p class="{{ $d('body.lead.class') }}">{{ $d('body.lead.text') }}</p></div>
        @endif
        @if ($sidebar)@include("$parts.side-index", ['sideNav' => $d('side_nav', [])])@endif
        <div class="{{ $d('body.col', $sidebar ? 'col-12 col-lg-8 offset-lg-1' : 'col-12 col-lg-8') }}">
            @if ($stepsContent === 'inner')<div class="{{ trim('steppers-content '.$d('body.steps_class')) }}" aria-live="polite">@endif
            @if (filled($d('body.form')))<form class="needs-validation" id="{{ $d('body.form') }}">@endif
            @include("$parts.sections", ['sections' => $d('body.before', [])])
            @if ($container)<div class="it-page-sections-container">@endif
                @include("$parts.sections", ['sections' => $d('sections', [])])
            @if ($container)</div>@endif
            @if (filled($d('nav')))@include("$parts.nav-steps")@endif
            @if (filled($d('body.form')))</form>@endif
            @if ($stepsContent === 'inner')</div>@endif
        </div>
    </div>
    @if ($stepsContent === 'outer')</div>@endif
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
