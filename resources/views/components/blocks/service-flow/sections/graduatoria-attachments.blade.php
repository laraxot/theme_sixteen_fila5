{{--
    Elenco allegati con descrizione (`cmp-icon-list`), senza sezione. `section`: title, title_class, wrapper_class (default `link-list-wrapper default`),
    items[] {label, aria, description, class, description_class}.
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="cmp-icon-list">
    <h2 class="{{ $section['title_class'] ?? 'title-xxlarge mt-40 mb-2 mb-lg-4' }}">{{ $section['title'] ?? '' }}</h2>
    <div class="{{ $section['wrapper_class'] ?? 'link-list-wrapper default' }}">
        <ul class="link-list">
            @foreach ($section['items'] ?? [] as $item)
                <li class="{{ $item['class'] ?? '' }}">
                    <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="{{ $item['aria'] ?? '' }}">
                        <span class="list-item-title-icon-wrapper">
                            <svg class="icon icon-sm align-self-start icon-primary icon-color" aria-hidden="true"><use href="{{ $icon('it-clip') }}"></use></svg>
                            <span class="list-item-title title-small-semi-bold fw-normal">{{ $item['label'] ?? '' }}</span></span>
                        <p class="{{ $item['description_class'] ?? 'ml-40 text-paragraph-regular-medium text-black' }}">{{ $item['description'] ?? '' }}</p></a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
