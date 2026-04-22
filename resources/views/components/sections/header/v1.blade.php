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
        $profilePhotoPath = $authUser->profile_photo_path;
        if (\Illuminate\Support\Str::startsWith($profilePhotoPath, ['http://', 'https://'])) {
            $headerAvatarUrl = $profilePhotoPath;
        } elseif (\Illuminate\Support\Str::startsWith($profilePhotoPath, '/')) {
            $headerAvatarUrl = url($profilePhotoPath);
        } else {
            $headerAvatarUrl = \Illuminate\Support\Facades\Storage::disk('public')->url($profilePhotoPath);
        }
    }

    $headerUserInitial = strtoupper((string) \Illuminate\Support\Str::substr($headerUserDisplayName, 0, 1));

    $testsPath = (string) request()->path();
    $isSegnalazioneCrea = str_contains($testsPath, 'tests/segnalazione-crea');
    /** Story 7-3: chrome slim come kit statico Design Comuni per compare-html.sh (path tests/segnalazione-area-personale) */
    $headerHtmlParityPersonalArea = str_contains($testsPath, 'tests/segnalazione-area-personale');
@endphp

{{--
    Bootstrap Italia Header — EXACT match of Design Comuni reference
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
    Reference: https://italia.github.io/design-comuni-pagine-statiche/servizi/graduatoria-area-personale.html
    
    Updated for Story 5.0: Header Logged-In State
    - Auth state detection
    - User dropdown for authenticated users
    - Area Personale menu (servizi, pratiche, notifiche, impostazioni, logout)
    
    Updated for Story 8-34: Real section owner fix
    - Section header is the real runtime owner for segnalazione-crea
    - Slim dropdowns lingua + utente: data-bs-toggle + app.js (Story 7-54), no Alpine inline (Livewire/Filament)
    - Authenticated user block prioritizes display name over decorative avatar
    - Sfondo slim: token design-comuni (no override hex inline; vedi design-comuni-tokens.css)
--}}
<header class="it-header-wrapper{{ $isSegnalazioneCrea ? ' is-segnalazione-crea' : '' }}" data-bs-target="#header-nav-wrapper">
    {{-- Slim Header: background from theme tokens --}}
    <div class="it-header-slim-wrapper{{ $isSegnalazioneCrea ? ' is-segnalazione-crea' : '' }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        {{-- White text on primary blue background --}}
                        <a class="navbar-brand text-white" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda" title="Vai al portale {Nome della Regione}">Nome della Regione</a>
                        
                        <div class="it-header-slim-right-zone" role="navigation">
                            @include('pub_theme::components.sections.header.partials.language-switcher')
                            @guest
                                @if ($headerHtmlParityPersonalArea)
                                    @include('pub_theme::components.sections.header.partials.personal-area-guest-parity')
                                @else
                                    @include('pub_theme::components.sections.header.partials.personal-area-guest-cta')
                                @endif
                            @else
                                @include('pub_theme::components.sections.header.partials.user-dropdown', [
                                    'avatarUrl' => $headerAvatarUrl,
                                    'displayName' => $headerUserDisplayName,
                                    'unreadNotificationsCount' => $authUser->unreadNotificationsCount ?? 0,
                                    'userInitial' => $headerUserInitial,
                                ])
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
                            <button class="custom-navbar-toggler custom-navbar-toggler-center" type="button" aria-controls="nav4" :aria-expanded="mobileNavOpen.toString()" aria-label="Mostra/Nascondi la navigazione" @click="toggle()" form="__never_submit_header_nav">
                                <svg class="icon">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                                </svg>
                            </button>
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
        {{-- BI 2.18: default `.it-header-navbar-wrapper{background:#06c}`; `theme-light-desk` attiva fascia menu chiara (allineamento segnalazione-02-dati). --}}
        <div class="it-header-navbar-wrapper{{ $isSegnalazioneCrea ? ' theme-light-desk' : '' }}" id="header-nav-wrapper" x-data="headerMobileNav">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler custom-navbar-toggler-navbar" type="button" aria-controls="nav4" :aria-expanded="mobileNavOpen.toString()" aria-label="Mostra/Nascondi la navigazione" @click="toggle()" form="__never_submit_header_nav">
                                <svg class="icon">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                                </svg>
                            </button>
                            <!-- Mobile overlay backdrop -->
                            <div x-show="mobileNavOpen" @click.self="close()" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="navbar-overlay" style="display: none;"></div>
                            <!-- Mobile menu panel -->
                            <div x-show="mobileNavOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-[-100%]" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-[-100%]" class="navbar-collapsable" id="nav4" @keydown.escape.window="close()" style="display: none;">
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
