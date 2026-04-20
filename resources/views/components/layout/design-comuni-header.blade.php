<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
    <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>

<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione}" title="Vai al portale {Nome della Regione}">
                            Nome della Regione
                        </a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle btn btn-primary btn-full" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true" x-data="{ open: false }" @click="open = !open" @click.away="open = false">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>ITA</span>
                                    <x-ui::icon name="chevron-down" class="w-4 h-4 ml-1" x-show="!open" />
                                    <x-ui::icon name="chevron-up" class="w-4 h-4 ml-1" x-show="open" />
                                </button>
                                <div x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="dropdown-menu dropdown-menu-right show"
                                     role="menu"
                                     aria-orientation="vertical"
                                     aria-labelledby="lang-dropdown-button">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            @guest
                            <a class="btn btn-primary btn-icon btn-full" href="{{ route('login') }}" data-element="personal-area-login">
                                <span class="rounded-icon" aria-hidden="true">
                                    <x-filament::icon icon="heroicon-o-user" class="icon icon-primary" />
                                </span>
                                <span class="d-none d-lg-block">Accedi all'area personale</span>
                            </a>
                            @endguest
                            @auth
                                @php
                                    $user = Auth::user();
                                @endphp
                                <div class="dropdown" x-data="{ open: false }" @click.away="open = false">
                                    <button @click="open = !open"
                                            class="btn btn-primary btn-icon btn-full"
                                            :aria-expanded="open"
                                            aria-label="{{ __('sixteen::header.user.aria.toggle_menu') }}">
                                        <span class="d-none d-md-inline">{{ $user->name }}</span>
                                        <x-ui::icon name="user-circle" class="w-4 h-4" />
                                        <x-ui::icon name="chevron-down" class="w-4 h-4 ml-1" x-show="!open" />
                                        <x-ui::icon name="chevron-up" class="w-4 h-4 ml-1" x-show="open" />
                                    </button>

                                    <div x-show="open"
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 transform scale-95"
                                         x-transition:enter-end="opacity-100 transform scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 transform scale-100"
                                         x-transition:leave-end="opacity-0 transform scale-95"
                                         class="dropdown-menu dropdown-menu-right show"
                                         role="menu"
                                         aria-orientation="vertical"
                                         aria-labelledby="user-menu-button">
                                        {{-- Mobile Welcome (visible only on small screens) --}}
                                        <div class="d-md-none px-4 py-2 border-bottom">
                                            <span class="text-muted">{{ __('sixteen::header.user.welcome', ['name' => $user->name]) }}</span>
                                        </div>

                                        {{-- Menu Items --}}
                                        <a href="{{ route('area-personale.servizi') }}" class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 hover:text-primary flex items-center space-x-2">
                                            <x-ui::icon name="briefcase" class="w-4 h-4 text-gray-600" />
                                            {{ __('sixteen::header.user.dropdown.my_services') }}
                                        </a>

                                        <a href="{{ route('area-personale.pratiche') }}" class="dropdown-item" role="menuitem">
                                            <x-ui::icon name="document-text" class="w-4 h-4 mr-2" />
                                            {{ __('sixteen::header.user.dropdown.my_practices') }}
                                        </a>

                                        <a href="{{ route('area-personale.notifiche') }}" class="dropdown-item" role="menuitem">
                                            <span class="d-flex align-items-center">
                                                <x-ui::icon name="bell" class="w-4 h-4 mr-2" />
                                                {{ __('sixteen::header.user.dropdown.notifications') }}
                                                {{-- Badge - only show if notifications exist --}}
                                                @if($user->unreadNotificationsCount > 0)
                                                    <span class="badge badge-primary ml-auto">{{ $user->unreadNotificationsCount }}</span>
                                                @endif
                                            </span>
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="{{ route('area-personale.impostazioni') }}" class="dropdown-item" role="menuitem">
                                            <x-ui::icon name="cog-6-tooth" class="w-4 h-4 mr-2" />
                                            {{ __('sixteen::header.user.dropdown.settings') }}
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        {{-- Logout Form --}}
                                        <form method="POST" action="{{ route('logout') }}" role="menuitem">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <x-ui::icon name="arrow-right-on-rectangle" class="w-4 h-4 mr-2" />
                                                {{ __('sixteen::header.user.dropdown.logout') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endauth
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
                                        <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-pa') }}"/>
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
                                                <x-filament::icon icon="ui-brands.twitter" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">Twitter</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <x-filament::icon icon="ui-brands.facebook" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">Facebook</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <x-filament::icon icon="ui-brands.youtube" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">YouTube</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <x-filament::icon icon="ui-brands.telegram" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">Telegram</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <x-filament::icon icon="ui-brands.whatsapp" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">WhatsApp</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" target="_blank">
                                                <x-filament::icon icon="ui-brands.rss" class="icon icon-sm icon-white align-top" />
                                                <span class="visually-hidden">RSS</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="it-search-wrapper">
                                    <span class="d-none d-md-block">Cerca</span>
                                    <button class="search-link rounded-icon" type="button" aria-label="Cerca nel sito">
                                        <x-filament::icon icon="heroicon-o-magnifying-glass" class="icon" />
                                    </button>
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
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-target="#nav4" data-bs-toggle="navbarcollapsible">
                                <x-filament::icon icon="heroicon-o-bars-3" class="icon" />
                            </button>
                            <div class="navbar-collapsable" id="nav4">
                                <div class="overlay" style="display: none;"></div>
                                <div class="close-div">
                                    <button class="btn close-menu" type="button">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <x-filament::icon icon="heroicon-o-x-mark" class="icon" />
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-pa') }}"/>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">Nome del Comune</div>
                                        </div>
                                    </a>
                                    <nav aria-label="Principale">
                                        <ul class="navbar-nav" data-element="main-navigation">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/amministrazione" data-element="management">
                                                    <span>Amministrazione</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/novita" data-element="news">
                                                    <span>Novità</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/servizi" data-element="all-services">
                                                    <span>Servizi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/eventi" data-element="live">
                                                    <span>Vivere il Comune</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <nav aria-label="Secondaria">
                                        <ul class="navbar-nav navbar-secondary">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/argomento">Iscrizioni</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/argomento">Estate in città</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/argomento">Polizia locale</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/it/tests/argomenti" data-element="all-topics">
                                                    <span>Tutti gli argomenti
                                                        <x-filament::icon icon="heroicon-o-chevron-right" class="icon icon-sm" />
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="it-socials d-lg-none">
                                        <span>Seguici su</span>
                                        <ul>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.twitter" class="icon icon-sm icon-white" /><span class="visually-hidden">Twitter</span></a></li>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.facebook" class="icon icon-sm icon-white" /><span class="visually-hidden">Facebook</span></a></li>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.youtube" class="icon icon-sm icon-white" /><span class="visually-hidden">YouTube</span></a></li>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.telegram" class="icon icon-sm icon-white" /><span class="visually-hidden">Telegram</span></a></li>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.whatsapp" class="icon icon-sm icon-white" /><span class="visually-hidden">WhatsApp</span></a></li>
                                            <li><a href="#" target="_blank"><x-filament::icon icon="ui-brands.rss" class="icon icon-sm icon-white" /><span class="visually-hidden">RSS</span></a></li>
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
