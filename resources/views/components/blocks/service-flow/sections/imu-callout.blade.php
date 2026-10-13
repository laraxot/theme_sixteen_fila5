{{--
    Nota evidenziata IMU. Come `callout`, ma la seconda frase va a capo da `text_block_class` (default `d-lg-block`: nel riferimento IMU e' lg, non md).
    `section`: class, icon, title, text, text_block, text_block_class.
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
        @if (filled($section['text_block'] ?? null))<span class="{{ $section['text_block_class'] ?? 'd-lg-block' }}"> {{ $section['text_block'] }}</span>@endif</p>
</div>
