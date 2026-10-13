{{-- Variante graduatoria di callout (DCP-26): `text_class` = classe dello span della seconda frase (default `d-md-block`; il riferimento usa `d-lg-block`). Nota evidenziata. `section`: class (default `callout callout-highlight ps-3 warning`), icon, title, text, text_block (seconda frase, su una riga propria da md). --}}
@php
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="{{ $section['class'] ?? 'callout callout-highlight ps-3 warning' }}">
    <div class="callout-title mb-20 d-flex align-items-center">
        <svg class="icon icon-sm" aria-hidden="true"><use href="{{ $icon($section['icon'] ?? 'it-horn') }}"></use></svg>
        <span>{{ $section['title'] ?? '' }}</span>
    </div>
    <p class="titillium text-paragraph">{{ $section['text'] ?? '' }}
        @if (filled($section['text_block'] ?? null))<span class="{{ $section['text_class'] ?? 'd-md-block' }}"> {{ $section['text_block'] }}</span>@endif</p>
</div>
