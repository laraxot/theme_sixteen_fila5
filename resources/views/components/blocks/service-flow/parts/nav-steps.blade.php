{{--
    Pulsanti del passo. `nav`: aria_label, back, save {long, short} (assente = nessun Salva), next {label, icon (sprite o vuoto), class, modal},
    saved_message (avviso nascosto di salvataggio).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-nav-steps">
    <nav class="steppers-nav" aria-label="{{ $d('nav.aria_label') }}">
        <button type="button" class="btn btn-sm steppers-btn-prev p-0">
            <svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon('it-chevron-left') }}"></use></svg>
            <span class="text-button-sm t-primary">{{ $d('nav.back') }}</span></button>
        @if (filled($d('nav.save.long')))
            <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn">
                <span class="text-button-sm t-primary">{{ $d('nav.save.long') }}</span></button>
            <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-block d-lg-none saveBtn center">
                <span class="text-button-sm t-primary">{{ $d('nav.save.short') }}</span></button>
        @endif
        <button type="button" class="{{ trim('btn btn-primary btn-sm steppers-btn-confirm '.$d('nav.next.class')) }}" data-bs-toggle="modal" data-bs-target="{{ $d('nav.next.modal', '#') }}">
            <span class="text-button-sm">{{ $d('nav.next.label') }}</span>
            @if (filled($d('nav.next.icon')))<svg class="icon icon-white icon-sm" aria-hidden="true"><use href="{{ $icon($d('nav.next.icon')) }}"></use></svg>@endif</button>
    </nav>
    <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
        <span class="d-inline-block text-uppercase cmp-disclaimer__message">{{ $d('nav.saved_message') }}</span>
    </div>
</div>
