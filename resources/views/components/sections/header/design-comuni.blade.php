@props(['blocks' => []])
{{--
    Header Design Comuni (variante scelta dal layout con chrome="design-comuni"): markup del riferimento, tutti i testi,
    link e icone da sections/header.json. Il sito reale usa header/v1 (invariato). Comportamenti: resources/js/app.js
    (menu a tendina, menu mobile, modale di ricerca), stile: resources/css/design-comuni/components.css.
--}}
@php
    $data = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $data = array_merge($data, $blockData);
        }
    }
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $locale = app()->getLocale();
    $locales = array_column($d('languages.items', []), 'locale');
    // stesso percorso nell'altra lingua: /it/tests/x -> /en/tests/x
    $localeUrl = static function (string $code) use ($locales): string {
        $segments = explode('/', trim(request()->path(), '/'));
        if (in_array($segments[0] ?? '', $locales, true)) {
            $segments[0] = $code;
        } else {
            array_unshift($segments, $code);
        }

        return url(implode('/', $segments));
    };
    $socials = $d('social_links', []);
@endphp
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" target="_blank" href="{{ $d('region.url', '#') }}" aria-label="{{ $d('region.aria_label') }}" title="{{ $d('region.title') }}">{{ $d('region.name') }}</a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                                    <span class="visually-hidden">{{ $d('languages.active_label') }}</span>
                                    <span>{{ collect($d('languages.items', []))->firstWhere('locale', $locale)['label'] ?? '' }}</span>
                                    <svg class="icon"><use href="{{ $icon('it-expand') }}"></use></svg>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="link-list-wrapper">
                                                <ul class="link-list">
                                                    @foreach ($d('languages.items', []) as $language)
                                                        <li>
                                                            <a class="dropdown-item list-item" href="{{ $localeUrl($language['locale']) }}"><span>{{ $language['label'] }}@if ($language['locale'] === $locale) <span class="visually-hidden">{{ $d('languages.selected_label') }}</span>@endif</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-primary btn-icon btn-full" href="{{ $d('account.url', '#') }}" data-element="{{ $d('account.element') }}">
                                <span class="rounded-icon" aria-hidden="true"><svg class="icon icon-primary"><use xlink:href="{{ $icon('it-user') }}"></use></svg></span>
                                <span class="d-none d-lg-block">{{ $d('account.login_label') ?: $d('account.label') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="{{ url('/') }}">
                                    <svg width="82" height="82" class="icon" aria-hidden="true"><image xlink:href="{{ asset($d('brand.logo')) }}"/></svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">{{ $d('brand.header_title') ?: $d('brand.name') }}</div>
                                        <div class="it-brand-tagline d-none d-md-block">{{ $d('brand.tagline') }}</div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-lg-flex">
                                    <span>{{ $d('follow_us') }}</span>
                                    <ul>
                                        @foreach ($socials as $social)
                                            <li><a href="{{ $social['url'] ?? '#' }}" target="_blank"><svg class="icon icon-sm icon-white align-top"><use xlink:href="{{ $icon($social['icon']) }}"></use></svg><span class="visually-hidden">{{ $social['label'] }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="it-search-wrapper">
                                    <span class="d-none d-md-block">{{ $d('search.label') }}</span>
                                    <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="{{ $d('search.aria_label') }}"><svg class="icon"><use href="{{ $icon('it-search') }}"></use></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="{{ $d('menu.toggle_label') }}" data-bs-target="#nav4" data-bs-toggle="navbarcollapsible"><svg class="icon"><use href="{{ $icon('it-burger') }}"></use></svg></button>
                            <div class="navbar-collapsable" id="nav4">
                                <div class="overlay" style="display: none;"></div>
                                <div class="close-div">
                                    <button class="btn close-menu" type="button"><span class="visually-hidden">{{ $d('menu.close_label') }}</span><svg class="icon"><use href="{{ $icon('it-close-big') }}"></use></svg></button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="{{ url('/') }}" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true"><use href="{{ $icon('it-pa') }}"></use></svg>
                                        <div class="it-brand-text"><div class="it-brand-title">{{ $d('brand.menu_title') ?: $d('brand.name') }}</div></div>
                                    </a>
                                    <nav aria-label="{{ $d('menu.main_label') }}">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            @foreach ($d('navigation', []) as $item)
                                                <li class="nav-item"><a class="nav-link" href="{{ $item['url'] ?? '#' }}"@if (filled($item['element'] ?? null)) data-element="{{ $item['element'] }}"@endif><span>{{ $item['label'] ?? '' }}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <nav aria-label="{{ $d('menu.secondary_label') }}">
                                        <ul class="navbar-nav navbar-secondary">
                                            @foreach ($d('secondary_navigation', []) as $item)
                                                <li class="nav-item">
                                                    @if (filled($item['element'] ?? null))
                                                        <a class="nav-link" href="{{ $item['url'] ?? '#' }}" data-element="{{ $item['element'] }}"><span>{{ $item['label'] ?? '' }} @if ($item['chevron'] ?? false)<svg class="icon icon-sm"><use xlink:href="{{ $icon('it-chevron-right') }}"></use></svg>@endif</span></a>
                                                    @else
                                                        <a class="nav-link" href="{{ $item['url'] ?? '#' }}">{{ $item['label'] ?? '' }}</a>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <div class="it-socials">
                                        <span>{{ $d('follow_us') }}</span>
                                        <ul>
                                            @foreach ($socials as $social)
                                                <li><a href="{{ $social['url'] ?? '#' }}" target="_blank"><svg class="icon icon-sm icon-white align-top"><use xlink:href="{{ $icon($social['icon']) }}"></use></svg><span class="visually-hidden">{{ $social['label'] }}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
