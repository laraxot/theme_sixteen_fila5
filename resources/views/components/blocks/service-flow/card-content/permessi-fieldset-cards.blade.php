{{--
    Schede persona selezionabili dentro un `fieldset` con `legend` nascosta, poi il pulsante di aggiunta fuori dal fieldset (veicoli). `content`: legend,
    stessi dati di `info-cards` (radio_name, cards[], add).
--}}
<fieldset>
    <legend class="visually-hidden">{{ $content['legend'] ?? '' }}</legend>
    @include('pub_theme::components.blocks.service-flow.card-content.info-cards', ['content' => array_merge($content, ['add' => null])])
</fieldset>
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
@if (filled($content['add'] ?? null))
    <button type="button" class="btn plus-text mt-20 p-0">
        <span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($content['add']['icon'] ?? 'it-plus-circle') }}"></use></svg></span>
        <span class="">{{ $content['add']['label'] ?? '' }}</span></button>
@endif
