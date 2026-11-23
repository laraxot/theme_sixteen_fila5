{{--
    Header Design Comuni: navigazione primaria/secondaria e menu mobile.
    @see Themes/Sixteen/docs/header-components.md
--}}
<div class="it-header-navbar-wrapper" id="header-nav-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="navbar navbar-expand-lg has-megamenu">
                    <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="{{ $d('menu.toggle_label') }}" data-bs-target="#nav4" data-bs-toggle="navbarcollapsible"><svg class="icon" aria-hidden="true"><use href="{{ $icon('it-burger') }}"></use></svg></button>
                    <div class="navbar-collapsable" id="nav4">
                        <div class="overlay" style="display: none;"></div>
                        <div class="close-div">
                            <button class="btn close-menu" type="button"><span class="visually-hidden">{{ $d('menu.close_label') }}</span><svg class="icon" aria-hidden="true"><use href="{{ $icon('it-close-big') }}"></use></svg></button>
                        </div>
                        <div class="menu-wrapper">
                            <a href="{{ $homeHref }}" class="logo-hamburger">
                                @include('pub_theme::components.sections.partials.brand-mark', ['src' => $d('brand.logo'), 'size' => 48, 'invert' => true])
                                <div class="it-brand-text"><div class="it-brand-title">{{ $d('brand.menu_title') ?: $brandTitle }}</div></div>
                            </a>
                            <nav aria-label="{{ $d('menu.main_label') }}">
                                <ul class="navbar-nav" data-element="main-navigation">
                                    @foreach ($navigation as $navIndex => $item)
                                        <li class="nav-item">@php($navActive = $navIndex === $activeNavIndex)<a @class(['nav-link', 'active' => $navActive]) href="{{ $storedNavHref((string) $item['url']) }}"@if (filled($item['element'] ?? null)) data-element="{{ $item['element'] }}"@endif @if ($navActive) aria-current="page"@endif><span>{{ $item['label'] ?? '' }}</span></a></li>
                                    @endforeach
                                </ul>
                            </nav>
                            @if ($secondaryItems !== [])
                                <nav aria-label="{{ $d('menu.secondary_label') }}">
                                    <ul class="navbar-nav navbar-secondary">
                                        @foreach ($secondaryItems as $item)
                                            <li class="nav-item"><a class="nav-link" href="{{ $storedNavHref((string) $item['url']) }}"@if (filled($item['element'] ?? null)) data-element="{{ $item['element'] }}"@endif><span>{{ $item['label'] ?? '' }}@if ($item['chevron'] ?? false) <svg class="icon icon-sm" aria-hidden="true"><use href="{{ $icon('it-chevron-right') }}"></use></svg>@endif</span></a></li>
                                        @endforeach
                                    </ul>
                                </nav>
                            @endif
                            @if ($socials !== [])
                                <div class="it-socials">
                                    <span>{{ $d('follow_us') }}</span>
                                    <ul>
                                        @foreach ($socials as $social)
                                            <li><a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"><svg class="icon icon-sm icon-white align-top" aria-hidden="true"><use href="{{ $icon($social['icon']) }}"></use></svg><span class="visually-hidden">{{ $social['label'] }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
