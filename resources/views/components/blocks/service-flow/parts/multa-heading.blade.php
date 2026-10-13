{{--
    Titolo di pagina della famiglia multa (DCP-28). `heading`: title, icon {name, class} (titolo con icona), class, subtitles[] {text | segments[] (vedi parts/multa-inline),
    class, link {label, url, class, class_first (true = class prima di href, come in alcune pagine del riferimento)}}, buttons[] {label, class, icon}. Come parts/heading, senza chips e azioni, con i sottotitoli a segmenti.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $heading = $d('heading', []);
@endphp
<div class="{{ trim('cmp-heading pb-3 pb-lg-4 '.($heading['class'] ?? '')) }}">
    @if (filled($heading['icon'] ?? null))
        <div class="categoryicon-top d-flex">
            <svg class="icon {{ $heading['icon']['class'] ?? '' }}" aria-hidden="true"><use href="{{ $icon($heading['icon']['name'] ?? '') }}"></use></svg>
            <h1 class="title-xxxlarge">{{ $heading['title'] ?? '' }}</h1>
        </div>
    @else
        <h1 class="title-xxxlarge">{{ $heading['title'] ?? '' }}</h1>
    @endif
    @foreach ($heading['subtitles'] ?? [] as $subtitle)
        <p class="{{ $subtitle['class'] ?? 'subtitle-small' }}">@include('pub_theme::components.blocks.service-flow.parts.multa-inline', ['value' => $subtitle['segments'] ?? ($subtitle['text'] ?? '')])@if (filled($subtitle['link'] ?? null)) @if ($subtitle['link']['class_first'] ?? false)<a class="{{ $subtitle['link']['class'] ?? 'title-small-semi-bold t-primary' }}" href="{{ $subtitle['link']['url'] ?? '' }}">@else<a href="{{ $subtitle['link']['url'] ?? '' }}" class="{{ $subtitle['link']['class'] ?? 'title-small-semi-bold t-primary' }}">@endif{{ $subtitle['link']['label'] ?? '' }}</a>@endif</p>
    @endforeach
    @foreach ($heading['buttons'] ?? [] as $button)
        <button type="button" class="{{ $button['class'] ?? 'btn btn-primary fw-bold' }}">
            @if (filled($button['icon'] ?? null))<span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($button['icon']) }}"></use></svg></span>@endif
            <span class="">{{ $button['label'] ?? '' }}</span></button>
    @endforeach
</div>
