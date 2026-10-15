@props(['blocks' => []])
{{--
    Header Design Comuni (variante scelta dal layout con chrome="design-comuni"): markup del riferimento, tutti i testi,
    link e icone da sections/header.json (`account.signed_in`: menu utente, mostrato dal layout design-comuni-authenticated). Voce di menu attiva: variabile di vista `dcHeaderActive` = `data-element` della voce (management | news | all-services | live), condivisa dal layout; la pagina la dichiara nel JSON (`header_active` nel primo blocco). Il sito reale usa header/v1 (invariato). Comportamenti: resources/js/app.js
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
    $assets = \Themes\Sixteen\Support\DesignComuniAssets::base();
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
    // `dcSignedIn` serve solo alle preview delle pagine area-personale; il front office usa la sessione reale.
    $realUser = auth()->user();
    $isSignedIn = (bool) (($dcSignedIn ?? false) || $realUser !== null);
    $displayName = $realUser !== null
        ? (trim((string) ($realUser->name ?? '')) ?: (string) $realUser->email)
        : __('pub_theme::header.user.personal_area');
    $avatarUrl = $realUser !== null ? (string) data_get($realUser, 'profile_photo_url', '') : '';
    $userInitial = mb_strtoupper(mb_substr($displayName, 0, 1));
    $localizedUrl = static fn (string $path): string => url(trim('/'.app()->getLocale().'/'.ltrim($path, '/'), '/'));
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
                            @if ($isSignedIn)
                                <div class="it-user-wrapper nav-item dropdown">
                                    <button type="button" class="btn btn-primary btn-icon btn-full" id="header-user-toggle" data-bs-toggle="dropdown" aria-label="{{ __('pub_theme::header.user.aria.toggle_menu.label') }}" aria-expanded="false" aria-controls="header-user-menu" aria-haspopup="true">
                                        <span class="rounded-icon" aria-hidden="true">
                                            @if ($avatarUrl !== '')
                                                <img src="{{ $avatarUrl }}" class="border rounded-circle icon-white" alt="" width="20" height="20" loading="lazy">
                                            @else
                                                <strong class="user-initial-fallback fw-bold text-uppercase">{{ $userInitial !== '' ? $userInitial : 'U' }}</strong>
                                            @endif
                                        </span>
                                        <span class="d-none d-lg-block">{{ $displayName }}</span>
                                        <svg class="icon icon-white d-none d-lg-block" aria-hidden="true"><use href="{{ $icon('it-expand') }}"></use></svg>
                                    </button>
                                    <div class="dropdown-menu" id="header-user-menu" role="menu" aria-labelledby="header-user-toggle">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        <li><a class="dropdown-item list-item" href="{{ $localizedUrl('area-personale/pratiche') }}" role="menuitem"><span>{{ __('pub_theme::header.user.dropdown.my_reports.label') }}</span></a></li>
                                                        <li><a class="dropdown-item list-item" href="{{ $localizedUrl('area-personale/seguite') }}" role="menuitem"><span>{{ __('pub_theme::header.user.dropdown.followed_reports.label') }}</span></a></li>
                                                        <li><a class="dropdown-item list-item" href="{{ $localizedUrl('area-personale/notifiche') }}" role="menuitem"><span>{{ __('pub_theme::header.user.dropdown.notification_center.label') }}</span></a></li>
                                                        <li><span class="divider"></span></li>
                                                        <li><a class="dropdown-item list-item" href="{{ $localizedUrl('area-personale/impostazioni') }}" role="menuitem"><span>{{ __('pub_theme::header.user.dropdown.settings_privacy.label') }}</span></a></li>
                                                        @if ($realUser !== null)
                                                            <li>
                                                                <form method="POST" action="{{ route('logout') }}">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item list-item" role="menuitem"><span>{{ __('pub_theme::header.user.dropdown.logout.label') }}</span></button>
                                                                </form>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- aria-label: la parola e' visibile solo da lg in su (d-none d-lg-block); sotto resterebbe un'icona senza nome (axe link-name) --}}
                                <a class="btn btn-primary btn-icon btn-full" href="{{ $localizedUrl('auth/login') }}" data-element="{{ $d('account.element') }}" aria-label="{{ $d('account.login_label') ?: $d('account.label') }}">
                                    <span class="rounded-icon" aria-hidden="true"><svg class="icon icon-primary"><use xlink:href="{{ $icon('it-user') }}"></use></svg></span>
                                    <span class="d-none d-lg-block">{{ $d('account.login_label') ?: $d('account.label') }}</span>
                                </a>
                            @endif
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
                                <a href="{{ $localizedUrl('') }}"{!! ! $isSignedIn && filled($d('brand.link_title')) ? ' title="'.e($d('brand.link_title')).'"' : '' !!}>
                                    <svg width="82" height="82" class="icon" aria-hidden="true"><image xlink:href="{{ \Themes\Sixteen\Support\DesignComuniAssets::url($d('brand.logo')) }}"/></svg>
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
                                    <a href="{{ $localizedUrl('') }}" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true"><use href="{{ $icon('it-pa') }}"></use></svg>
                                        <div class="it-brand-text"><div class="it-brand-title">{{ $d('brand.menu_title') ?: $d('brand.name') }}</div></div>
                                    </a>
                                    <nav aria-label="{{ $d('menu.main_label') }}">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            @foreach ($d('navigation', []) as $item)
                                                <li class="nav-item"><a @class(['nav-link', 'active' => filled($dcHeaderActive ?? null) && ($item['element'] ?? null) === $dcHeaderActive]) href="{{ $item['url'] ?? '#' }}"@if (filled($item['element'] ?? null)) data-element="{{ $item['element'] }}"@endif><span>{{ $item['label'] ?? '' }}</span></a></li>
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
