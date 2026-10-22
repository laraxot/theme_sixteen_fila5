@props(['blocks' => []])
{{--
    Vestito Design Comuni dell'header (`<x-section slug="header" tpl="design-comuni">`).
    Slogan, brand, nav, social, lingue, account: SOLO da config/.../sections/header.json
    (x-section → Section::getBlocksBySlug). Qui solo markup + FrontofficeUrl per i path.
    Voce attiva: `dcHeaderActive` = data-element (dal JSON pagina `header_active`).
    Comportamenti: resources/js/app.js; stile: resources/css/design-comuni/components.css.
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
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
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
    $socials = array_values(array_filter(
        $d('social_links', []),
        static fn (mixed $social): bool => is_array($social) && filled(trim((string) ($social['url'] ?? ''))) && trim((string) ($social['url'] ?? '')) !== '#'
    ));
    $socialLabels = $d('social_labels', []);
    $languageLabel = (string) $d('languages.active_label');
    $accountLabel = (string) ($d('account.login_label') ?: $d('account.label'));
    $storedNavHref = static function (?string $url): ?string {
        $raw = trim((string) ($url ?? ''));
        if ($raw === '' || $raw === '#') {
            return null;
        }

        $resolved = \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($raw);

        return $resolved !== '' && $resolved !== '#' ? $resolved : null;
    };
    $regionPortalHref = $storedNavHref((string) $d('region.url', ''));
    // `dcSignedIn` serve solo alle preview delle pagine area-personale; il front office usa la sessione reale.
    $realUser = auth()->user();
    $isSignedIn = (bool) (($dcSignedIn ?? false) || $realUser !== null);
    $displayName = $realUser !== null
        ? (trim((string) ($realUser->name ?? '')) ?: (string) $realUser->email)
        : __('pub_theme::header.user.personal_area');
    $avatarUrl = $realUser !== null ? (string) data_get($realUser, 'profile_photo_url', '') : '';
    $userInitial = mb_strtoupper(mb_substr($displayName, 0, 1));
    $localizedUrl = static fn (string $path): string => url(trim('/'.app()->getLocale().'/'.ltrim($path, '/'), '/'));
    $regionBlock = is_array($data['region'] ?? null) ? $data['region'] : [];
    $regionLink = \Themes\Sixteen\Presentation\Accessibility\RegionPortalLinkLabels::resolve($regionBlock);
    $regionDisplayName = $regionLink['name'] !== '' ? $regionLink['name'] : (string) $d('region.name');
@endphp
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        @if ($regionPortalHref !== null)
                            <a class="d-lg-block navbar-brand" target="_blank" rel="noopener noreferrer" href="{{ $regionPortalHref }}" @if ($regionLink['aria_label']) aria-label="{{ $regionLink['aria_label'] }}" @endif @if ($regionLink['title']) title="{{ $regionLink['title'] }}" @endif>{{ $regionDisplayName }}</a>
                        @else
                            <span class="d-lg-block navbar-brand">{{ $regionDisplayName }}</span>
                        @endif
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                                    <span class="visually-hidden">{{ $languageLabel }}</span>
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
                                    <button type="button" class="btn btn-primary btn-icon btn-full" id="header-user-toggle" data-bs-toggle="dropdown" aria-label="{{ $d('account.signed_in.name') }}" aria-expanded="false" aria-controls="header-user-menu" aria-haspopup="true">
                                        <span class="rounded-icon" aria-hidden="true">
                                            @if ($avatarUrl !== '')
                                                <img src="{{ $avatarUrl }}" class="border rounded-circle icon-white" alt="" width="20" height="20" loading="lazy">
                                            @else
                                                <strong class="user-initial-fallback fw-bold text-uppercase">{{ $userInitial !== '' ? $userInitial : mb_strtoupper(mb_substr((string) $d('account.signed_in.name'), 0, 1)) }}</strong>
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
                                                        @foreach ($d('account.signed_in.menu', []) as $menuItem)
                                                            @if (($menuItem['divider'] ?? false) === true)
                                                                <li><span class="divider"></span></li>
                                                            @elseif (($menuItem['icon'] ?? '') === 'it-external-link' && $realUser !== null)
                                                                <li><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="dropdown-item list-item" role="menuitem"><span>{{ $menuItem['label'] }}</span></button></form></li>
                                                            @elseif (filled($menuItem['label'] ?? null) && ($storedNavHref((string) ($menuItem['url'] ?? '')) !== null))
                                                                <li><a class="dropdown-item list-item" href="{{ $storedNavHref((string) $menuItem['url']) }}" role="menuitem"><span>{{ $menuItem['label'] }}</span></a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- aria-label: la parola e' visibile solo da lg in su (d-none d-lg-block); sotto resterebbe un'icona senza nome (axe link-name) --}}
                                <a class="btn btn-primary btn-icon btn-full" href="{{ $storedNavHref((string) $d('account.url')) }}" data-element="{{ $d('account.element') }}" aria-label="{{ $accountLabel }}">
                                    <span class="rounded-icon" aria-hidden="true"><svg class="icon icon-primary"><use xlink:href="{{ $icon('it-user') }}"></use></svg></span>
                                    <span class="d-none d-lg-block">{{ $accountLabel }}</span>
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
                                <a href="{{ $localizedUrl((string) $d('brand.url')) }}"{!! ! $isSignedIn && filled($d('brand.link_title')) ? ' title="'.e($d('brand.link_title')).'"' : '' !!}>
                                    {{-- Sulla barra verde il marchio è bianco. Il filtro nello sheet è !important e isolate-legacy lo toglie dalle pagine con data-dc, quindi il logo restava nero. --}}
                                    <svg width="82" height="82" class="icon" aria-hidden="true" style="filter: brightness(0) invert(1)"><image xlink:href="{{ \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::url($d('brand.logo')) }}" style="filter: brightness(0) invert(1)"/></svg>
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
                                    <a href="{{ $localizedUrl((string) $d('brand.url')) }}" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true"><use href="{{ $icon('it-pa') }}"></use></svg>
                                        <div class="it-brand-text"><div class="it-brand-title">{{ $d('brand.menu_title') ?: $d('brand.name') }}</div></div>
                                    </a>
                                    <nav aria-label="{{ $d('menu.main_label') }}">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            @foreach ($d('navigation', []) as $item)
                                                @php($navHref = $storedNavHref((string) ($item['url'] ?? '')))
                                                @if ($navHref !== null)
                                                    <li class="nav-item"><a @class(['nav-link', 'active' => filled($dcHeaderActive ?? null) && ($item['element'] ?? null) === $dcHeaderActive]) href="{{ $navHref }}"@if (filled($item['element'] ?? null)) data-element="{{ $item['element'] }}"@endif><span>{{ $item['label'] ?? '' }}</span></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <nav aria-label="{{ $d('menu.secondary_label') }}">
                                        <ul class="navbar-nav navbar-secondary">
                                            @foreach ($d('secondary_navigation', []) as $item)
                                                @php($secondaryHref = $storedNavHref((string) ($item['url'] ?? '')))
                                                @if ($secondaryHref !== null)
                                                    <li class="nav-item">
                                                        @if (filled($item['element'] ?? null))
                                                            <a class="nav-link" href="{{ $secondaryHref }}" data-element="{{ $item['element'] }}"><span>{{ $item['label'] ?? '' }} @if ($item['chevron'] ?? false)<svg class="icon icon-sm"><use xlink:href="{{ $icon('it-chevron-right') }}"></use></svg>@endif</span></a>
                                                        @else
                                                            <a class="nav-link" href="{{ $secondaryHref }}">{{ $item['label'] ?? '' }}</a>
                                                        @endif
                                                    </li>
                                                @endif
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
