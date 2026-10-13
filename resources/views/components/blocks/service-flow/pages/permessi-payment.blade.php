{{--
    Pagamento dei permessi. Come `payment`, ma righe e colonne sono chiavi del JSON: `heading.row` / `heading.col` (breadcrumb e titolo, default
    `row` / `col-12 col-lg-10 offset-lg-1`), `body.row` / `body.col` (sezioni, default `row` / `col-12 col-lg-10 offset-lg-1 pt-3 pt-lg-0`).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $parts = 'pub_theme::components.blocks.service-flow.parts';
@endphp
<div class="container" id="main-container">
    <div class="{{ $d('heading.row', 'row') }}">
        <div class="{{ $d('heading.col', 'col-12 col-lg-10 offset-lg-1') }}">
            @include("$parts.breadcrumb")
            @include("$parts.heading")
        </div>
    </div>
    @include("$parts.rule")
    <div class="{{ $d('body.row', 'row') }}">
        <div class="{{ $d('body.col', 'col-12 col-lg-10 offset-lg-1 pt-3 pt-lg-0') }}">
            @include("$parts.sections", ['sections' => $d('sections', [])])
        </div>
    </div>
</div>
@include("$parts.contacts", ['related' => null])
@include("$parts.modals")
