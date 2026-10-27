{{-- Avviso con elenco di collegamenti. `section`: icon, icon_xlink, title, text, links[] {label, url}. --}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-warning-box border-start border-warning border-2 mb-50">
    <div class="warning-box-icon">
        <svg class="icon icon-warning" aria-hidden="true"><use href="{{ $icon($section['icon'] ?? 'it-info-circle') }}" xlink:href="{{ $icon($section['icon_xlink'] ?? 'it-warning') }}"></use></svg>
        <span class="t-alert title-small-semi-bold">{{ $section['title'] ?? '' }}</span>
    </div>
    <div class="d-flex"><p class="description description-warning mb-1">{{ $section['text'] ?? '' }}</p></div>
    <ul>
        @foreach ($section['links'] ?? [] as $link)
            <li><a href="{{ $link['url'] ?? '#' }}" class="t-primary subtitle-small pb-1 pt-1">{{ $link['label'] ?? '' }}</a></li>
        @endforeach
    </ul>
</div>
