{{--
    Passo del wizard del pagamento multa (DCP-28). Chiavi: breadcrumb, heading (parts/multa-heading), stepper (+ stepper.note {class, text}: avviso nella colonna dello stepper),
    body {wrap: steppers-content|container|none, col, form (id del <form>)}, sections[], nav (parts/multa-nav-steps), contacts, modals[].
    `body.wrap`: dove sta il contenitore del corpo nel riferimento: `steppers-content` = `.steppers-content` dentro il container principale; `container` = il container
    principale si chiude dopo lo stepper e se ne apre un altro; `none` = la riga del corpo sta direttamente nel container principale.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
    $wrap = $d('body.wrap', 'none');
    $form = $d('body.form', '');
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            @include("$parts.breadcrumb")
            @include("$parts.multa-heading")
        </div>
        <div class="col-12">
            @include("$parts.stepper")
            @if (filled($d('stepper.note')))<p class="{{ $d('stepper.note.class') }}">{{ $d('stepper.note.text') }}</p>@endif
        </div>
    </div>
    @if ($wrap === 'steppers-content')<div class="steppers-content" aria-live="polite">@endif
    @if ($wrap === 'container')</div><div class="container">@endif
    <div class="row justify-content-center">
        <div class="{{ $d('body.col', 'col-12 col-lg-8') }}">
            @if (filled($form))<form class="needs-validation" id="{{ $form }}">@endif
            @include("$parts.sections", ['sections' => $d('sections', [])])
            @include("$parts.multa-nav-steps")
            @if (filled($form))</form>@endif
        </div>
    </div>
    @if ($wrap === 'steppers-content')</div>@endif
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
