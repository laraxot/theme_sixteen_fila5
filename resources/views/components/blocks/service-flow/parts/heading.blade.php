{{--
    Titolo di pagina. `heading`: title, title_class (classi dell'h1 senza icona, default `title-xxxlarge`), title_element (data-element), icon {name, class} (titolo con icona),
    subtitles[] {text | segments[] (vedi parts/multa-inline), class, span {text, class} (testo in coda), link {label, url, class, class_first (true = attributo class prima di href)}},
    chips[] {label, element}, buttons[] {label, class, icon}, actions[] (menu a tendina: id, aria_label, icon, label, items[] {label, icon, url}), class.
    Con `actions` il titolo si divide in due colonne (contenuto + azioni), come la scheda servizio.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $heading = $d('heading', []);
    $actions = $heading['actions'] ?? [];
@endphp
<div class="{{ trim('cmp-heading pb-3 pb-lg-4 '.($heading['class'] ?? '')) }}">
    @if ($actions !== [])<div class="row"><div class="col-lg-8">@endif
    @if (filled($heading['icon'] ?? null))
        <div class="categoryicon-top d-flex">
            <svg class="icon {{ $heading['icon']['class'] ?? '' }}" aria-hidden="true"><use href="{{ $icon($heading['icon']['name'] ?? '') }}"></use></svg>
            <h1 class="title-xxxlarge">{{ $heading['title'] ?? '' }}</h1>
        </div>
    @else
        <h1 class="{{ $heading['title_class'] ?? 'title-xxxlarge' }}"@if (filled($heading['title_element'] ?? null)) data-element="{{ $heading['title_element'] }}"@endif>{{ $heading['title'] ?? '' }}</h1>
    @endif
    @if (filled($heading['chips'] ?? null))
        <ul class="d-flex flex-wrap gap-1 my-3">
            @foreach ($heading['chips'] as $chip)
                <li><div class="chip chip-simple text-button"@if (filled($chip['element'] ?? null)) data-element="{{ $chip['element'] }}"@endif><span class="chip-label">{{ $chip['label'] ?? '' }}</span></div></li>
            @endforeach
        </ul>
    @endif
    @foreach ($heading['subtitles'] ?? [] as $subtitle)
        <p class="{{ $subtitle['class'] ?? 'subtitle-small' }}">@include('pub_theme::components.blocks.service-flow.parts.multa-inline', ['value' => $subtitle['segments'] ?? ($subtitle['text'] ?? '')])@if (filled($subtitle['span'] ?? null)) <span class="{{ $subtitle['span']['class'] ?? '' }}">{{ $subtitle['span']['text'] ?? '' }}</span>@endif @if (filled($subtitle['link'] ?? null)) @if ($subtitle['link']['class_first'] ?? false)<a class="{{ $subtitle['link']['class'] ?? 'title-small-semi-bold t-primary' }}" href="{{ $subtitle['link']['url'] ?? '' }}">{{ $subtitle['link']['label'] ?? '' }}</a>@else<a href="{{ $subtitle['link']['url'] ?? '' }}" class="{{ $subtitle['link']['class'] ?? 'title-small-semi-bold t-primary' }}">{{ $subtitle['link']['label'] ?? '' }}</a>@endif @endif</p>
    @endforeach
    @foreach ($heading['buttons'] ?? [] as $button)
        <button type="button" class="{{ $button['class'] ?? 'btn btn-primary fw-bold' }}">
            @if (filled($button['icon'] ?? null))<span class="rounded-icon"><svg class="icon icon-primary icon-sm" aria-hidden="true"><use href="{{ $icon($button['icon']) }}"></use></svg></span>@endif
            <span class="">{{ $button['label'] ?? '' }}</span></button>
    @endforeach
    @if ($actions !== [])
        </div>
        <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
            @foreach ($actions as $action)
                <div class="dropdown">
                    <button aria-label="{{ $action['aria_label'] ?? '' }}" class="btn btn-dropdown dropdown-toggle text-decoration-underline d-inline-flex align-items-center fs-0" type="button" id="{{ $action['id'] ?? '' }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon" aria-hidden="true"><use xlink:href="{{ $icon($action['icon'] ?? '') }}"></use></svg>
                        <small>{{ $action['label'] ?? '' }}</small></button>
                    <div class="dropdown-menu shadow-lg" aria-labelledby="{{ $action['id'] ?? '' }}">
                        <div class="link-list-wrapper">
                            <ul class="link-list" role="menu">
                                @foreach ($action['items'] ?? [] as $entry)
                                    <li role="none">
                                        <a class="list-item" href="{{ $entry['url'] ?? '#' }}" role="menuitem">
                                            <svg class="icon" aria-hidden="true"><use xlink:href="{{ $icon($entry['icon'] ?? '') }}"></use></svg>
                                            <span>{{ $entry['label'] ?? '' }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div></div>
    @endif
</div>
