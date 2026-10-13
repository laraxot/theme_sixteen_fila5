{{--
    Nota evidenziata della famiglia multa (DCP-28): come `callout` con `block_class` (classi dello span della seconda frase, default `d-lg-block`).
    `section`: class (default `callout callout-highlight ps-3 warning`), icon, title, text, text_block, block_class.
--}}
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
        @if (filled($section['text_block'] ?? null))<span class="{{ $section['block_class'] ?? 'd-lg-block' }}"> {{ $section['text_block'] }}</span>@endif</p>
</div>
