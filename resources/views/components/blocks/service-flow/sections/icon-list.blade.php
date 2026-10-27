{{-- Elenco di link con icona (servizi correlati). `section`: id, title, title_class, items[] {label, icon, url, class}. --}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<section class="it-page-section" id="{{ $section['id'] ?? '' }}">
    <div class="cmp-icon-list">
        <h2 class="{{ $section['title_class'] ?? 'title-xxlarge mt-40 mb-2 mb-lg-4 mb-lg-4' }}">{{ $section['title'] ?? '' }}</h2>
        <div class="link-list-wrapper">
            <ul class="link-list">
                @foreach ($section['items'] ?? [] as $item)
                    <li class="{{ $item['class'] ?? 'shadow mb-10' }}">
                        <a class="list-item icon-left t-primary title-small-semi-bold" href="{{ $item['url'] ?? '#' }}">
                            <span class="list-item-title-icon-wrapper">
                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true"><use href="{{ $icon($item['icon'] ?? 'it-settings') }}"></use></svg>
                                <span class="list-item-title title-small-semi-bold">{{ $item['label'] ?? '' }}</span></span></a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
