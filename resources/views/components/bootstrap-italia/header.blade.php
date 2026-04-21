{{--
    Bootstrap Italia Header — EXACT match of Design Comuni reference
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
--}}
@php
    /** HTML parity: slug route non è sempre disponibile nel contesto della section header; path è stabile. */
    $testsPath = (string) request()->path();
    $headerHtmlParityPersonalArea = str_contains($testsPath, 'tests/segnalazione-area-personale');
@endphp
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda" title="Vai al portale {Nome della Regione}">Nome della Regione</a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle" id="header-language-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="header-language-menu" aria-haspopup="true">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>ITA</span>
                                    <svg class="icon">
                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" id="header-language-menu" aria-labelledby="header-language-toggle">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="link-list-wrapper">
                                                <ul class="link-list">
                                                    <li><a class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 flex items-center space-x-2" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                                    <li><a class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 flex items-center space-x-2" href="#"><span>ENG</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @guest
                                @if ($headerHtmlParityPersonalArea)
                                    {{-- Design Comuni reference uses full it-user-wrapper dropdown (logged-in chrome); mirror for structural parity --}}
                                    <div class="it-user-wrapper nav-item dropdown">
                                        <a
                                            href="#"
                                            class="btn btn-primary btn-icon btn-full"
                                            data-bs-toggle="dropdown"
                                            data-element="personal-area-login"
                                            data-focus-mouse="false"
                                            aria-expanded="false"
                                            aria-controls="header-user-menu-guest-parity"
                                            id="header-user-toggle-guest-parity"
                                            title="{{ __('pub_theme::ui.header_area_personale.user_menu_toggle.tooltip') }}"
                                        >
                                            <span class="rounded-icon" aria-hidden="true">
                                                <svg class="icon icon-white">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                                </svg>
                                            </span>
                                            <span class="d-none d-lg-block">{{ __('pub_theme::ui.header_area_personale.parity_demo_user.label') }}</span>
                                            <svg class="icon icon-white d-none d-lg-block" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu" id="header-user-menu-guest-parity" aria-labelledby="header-user-toggle-guest-parity">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="link-list-wrapper">
                                                        <ul class="link-list">
                                                            <li>
                                                                <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'servizi']) }}">
                                                                    <span>{{ __('pub_theme::ui.header_area_personale.my_services.label') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                    <span>{{ __('pub_theme::ui.header_area_personale.my_practices.label') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                    <span>{{ __('pub_theme::ui.header_area_personale.notifications.label') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <span class="divider"></span>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                    <span>{{ __('pub_theme::ui.header_area_personale.settings.label') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="list-item left-icon" href="#">
                                                                    <svg class="icon icon-primary icon-sm left" aria-hidden="true">
                                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-external-link"></use>
                                                                    </svg>
                                                                    <span class="fw-bold">{{ __('pub_theme::ui.header_area_personale.logout.label') }}</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a class="btn btn-primary btn-icon btn-full text-primary bg-white rounded-md" href="{{ route('login') }}" data-element="personal-area-login">
                                        <span class="rounded-icon" aria-hidden="true">
                                            <svg class="icon icon-white">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                            </svg>
                                        </span>
                                        <span class="d-none d-lg-block">{{ __('pub_theme::ui.personal_area') }}</span>
                                    </a>
                                @endif
                            @else
                                @php
                                    $authUser = auth()->user();
                                    $headerProfile = $authUser?->profile;
                                    $headerUserDisplayName = trim((string) ($headerProfile->user_name ?? ''));
                                    if ($headerUserDisplayName === '') {
                                        $headerUserDisplayName = trim((string) ($headerProfile->full_name ?? ''));
                                    }
                                    if ($headerUserDisplayName === '') {
                                        $headerUserDisplayName = trim((string) ($authUser->user_name ?? ''));
                                    }
                                    if ($headerUserDisplayName === '') {
                                        $headerUserDisplayName = trim((string) ($authUser->full_name ?? ''));
                                    }
                                    if ($headerUserDisplayName === '') {
                                        $headerUserDisplayName = trim((string) (($authUser->first_name ?? '').' '.($authUser->last_name ?? '')));
                                    }
                                    if ($headerUserDisplayName === '') {
                                        $headerUserDisplayName = (string) ($authUser->name ?? $authUser->email ?? 'Account');
                                    }

                                    $headerAvatarUrl = null;
                                    if (\is_object($headerProfile) && method_exists($headerProfile, 'getAvatarUrl')) {
                                        $headerAvatarUrl = $headerProfile->getAvatarUrl();
                                    } elseif (filled($headerProfile->avatar_url ?? null) && \is_string($headerProfile->avatar_url)) {
                                        $headerAvatarUrl = $headerProfile->avatar_url;
                                    } elseif (isset($authUser->profile_photo_url) && is_string($authUser->profile_photo_url) && $authUser->profile_photo_url !== '') {
                                        $headerAvatarUrl = $authUser->profile_photo_url;
                                    } elseif (! empty($authUser->profile_photo_path)) {
                                        $p = $authUser->profile_photo_path;
                                        if (\Illuminate\Support\Str::startsWith($p, ['http://', 'https://'])) {
                                            $headerAvatarUrl = $p;
                                        } elseif (\Illuminate\Support\Str::startsWith($p, '/')) {
                                            $headerAvatarUrl = url($p);
                                        } else {
                                            $headerAvatarUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($p);
                                        }
                                    }
                                @endphp
                                <div class="it-user-wrapper nav-item dropdown">
                                    <a
                                        href="#"
                                        class="btn btn-primary btn-icon btn-full"
                                        id="header-user-toggle"
                                        data-bs-toggle="dropdown"
                                        data-element="personal-area-login"
                                        data-focus-mouse="false"
                                        aria-expanded="false"
                                        aria-controls="header-user-menu"
                                        aria-haspopup="true"
                                        title="{{ __('pub_theme::ui.header_area_personale.user_menu_toggle.tooltip') }}"
                                    >
                                        <span class="rounded-icon" aria-hidden="true">
                                            @if ($headerAvatarUrl)
                                                <img src="{{ $headerAvatarUrl }}" class="border rounded-circle icon-white" alt="{{ __('pub_theme::ui.header_area_personale.avatar_alt.label') }}" width="20" height="20">
                                            @else
                                                <svg class="icon icon-white">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                                </svg>
                                            @endif
                                        </span>
                                        <span class="d-none d-lg-block">{{ $headerUserDisplayName }}</span>
                                        <svg class="icon icon-white d-none d-lg-block" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" id="header-user-menu" aria-labelledby="header-user-toggle">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        <li>
                                                            <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'servizi']) }}">
                                                                <span>{{ __('pub_theme::ui.header_area_personale.my_services.label') }}</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                <span>{{ __('pub_theme::ui.header_area_personale.my_practices.label') }}</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                <span>{{ __('pub_theme::ui.header_area_personale.notifications.label') }}</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <span class="divider"></span>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item list-item" href="{{ route('tests.view', ['slug' => 'segnalazione-area-personale']) }}">
                                                                <span>{{ __('pub_theme::ui.header_area_personale.settings.label') }}</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                                                @csrf
                                                                <button type="submit" class="list-item left-icon dropdown-item w-100 text-start border-0 bg-transparent p-0">
                                                                    <span class="d-flex align-items-center gap-2 py-2 px-3">
                                                                        <svg class="icon icon-primary icon-sm left" aria-hidden="true">
                                                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-external-link"></use>
                                                                        </svg>
                                                                        <span class="fw-bold">{{ __('pub_theme::ui.header_area_personale.logout.label') }}</span>
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endguest
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
                                <a href="/">
                                    <svg width="82" height="82" class="icon" aria-hidden="true">
                                        <image href="/themes/Sixteen/design-comuni/assets/images/logo-comune.svg"/>
                                    </svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">Il mio Comune</div>
                                        <div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-lg-flex">
                                    <span>Seguici su</span>
                                    <ul>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                                                </svg>
                                                <span class="visually-hidden">Twitter</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                                                </svg>
                                                <span class="visually-hidden">Facebook</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                                                </svg>
                                                <span class="visually-hidden">YouTube</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                                                </svg>
                                                <span class="visually-hidden">Telegram</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                                                </svg>
                                                <span class="visually-hidden">Whatsapp</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                                                </svg>
                                                <span class="visually-hidden">RSS</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="it-search-wrapper d-flex align-items-center">
                                    <span class="search-label me-2">Cerca</span>
                                    <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito">
                                        <svg class="icon">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper" x-data="headerMobileNav">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" :aria-expanded="mobileNavOpen.toString()" aria-label="Mostra/Nascondi la navigazione" @click="toggle()">
                                <svg class="icon">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                                </svg>
                            </button>
                            <!-- Mobile overlay backdrop -->
                            <div x-show="mobileNavOpen" @click.self="close()" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="navbar-overlay" style="display: none;"></div>
                            <!-- Mobile menu panel -->
                            <div
                                x-show="mobileNavOpen"
                                x-trap="mobileNavOpen"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="translate-x-[-100%]"
                                x-transition:enter-end="translate-x-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="translate-x-0"
                                x-transition:leave-end="translate-x-[-100%]"
                                class="navbar-collapsable"
                                id="nav4"
                                aria-label="{{ __('pub_theme::ui.header_mobile_nav.dialog_label') }}"
                                @keydown.escape.window="close()"
                                style="display: none;"
                            >
                                <div class="close-div">
                                    <button class="btn close-menu" type="button" @click="close()">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <svg class="icon">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close-big"></use>
                                        </svg>
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa"></use>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">Nome del Comune</div>
                                        </div>
                                    </a>
                                    <nav aria-label="Principale">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/amministrazione" data-element="management">
                                                    <span>Amministrazione</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/novita" data-element="news">
                                                    <span>Novità</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="/it/tests/servizi" data-element="all-services">
                                                    <span>Servizi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/eventi" data-element="live">
                                                    <span>Vivere il Comune</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <nav aria-label="Secondaria">
                                        <ul class="navbar-nav navbar-secondary">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Iscrizioni</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Estate in città</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Polizia locale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/argomenti" data-element="all-topics">
                                                    <span>Tutti gli argomenti
                                                        <svg class="icon icon-sm">
                                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-chevron-right"></use>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="it-socials">
                                        <span>Seguici su</span>
                                        <ul>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Twitter</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Facebook</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                                                    </svg>
                                                    <span class="visually-hidden">YouTube</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Telegram</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                                                    </svg>
                                                    <span class="visually-hidden">Whatsapp</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" target="_blank">
                                                    <svg class="icon icon-sm icon-white align-top">
                                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                                                    </svg>
                                                    <span class="visually-hidden">RSS</span>
                                                </a>
                                            </li>
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
