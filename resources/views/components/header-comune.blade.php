<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    <!-- Header Slim -->
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        {{-- Left: Region --}}
                        <a class="d-lg-block navbar-brand" href="#" aria-label="Vai al portale {{ config('comune.nome', 'Nome Comune') }} - link esterno - apertura nuova scheda" title="Vai al portale {{ config('comune.nome', 'Nome Comune') }}">{{ config('comune.regione', 'Nome della Regione') }}</a>
                        
                        {{-- Right: Language + Login + Social --}}
                        <div class="it-header-slim-right-zone" role="navigation">
                            {{-- Language Dropdown --}}
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="language-button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>{{ strtoupper(app()->getLocale()) }}</span>
                                    <svg class="icon icon-xs">
                                        <use href="#it-chevron-down"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="language-button">
                                    <a class="dropdown-item" href="#" lang="it">
                                        <span>ITA</span>
                                        @if(app()->getLocale() === 'it')
                                        <svg class="icon icon-xs ms-2">
                                            <use href="#it-check"></use>
                                        </svg>
                                        @endif
                                    </a>
                                    <a class="dropdown-item" href="#" lang="en">
                                        <span>ENG</span>
                                        @if(app()->getLocale() === 'en')
                                        <svg class="icon icon-xs ms-2">
                                            <use href="#it-check"></use>
                                        </svg>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            
                            {{-- Login Button --}}
                            <a class="btn btn-primary btn-sm" href="{{ route('login') }}" data-element="personal-area-login">
                                <svg class="icon">
                                    <use href="#it-user"></use>
                                </svg>
                                <span>Accedi all'area personale</span>
                            </a>
                            
                            {{-- Social Icons --}}
                            <div class="it-header-slim-social d-none d-lg-flex">
                                <span class="me-2">Seguici su</span>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Twitter">
                                            <svg class="icon icon-sm">
                                                <use href="#it-twitter"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Facebook">
                                            <svg class="icon icon-sm">
                                                <use href="#it-facebook"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="YouTube">
                                            <svg class="icon icon-sm">
                                                <use href="#it-youtube"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Telegram">
                                            <svg class="icon icon-sm">
                                                <use href="#it-telegram"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Whatsapp">
                                            <svg class="icon icon-sm">
                                                <use href="#it-whatsapp"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="RSS">
                                            <svg class="icon icon-sm">
                                                <use href="#it-rss"></use>
                                            </svg>
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
    
    <!-- Header Main -->
    <div class="it-header-main-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-main-content-wrapper">
                        {{-- Brand --}}
                        <div class="it-brand-wrapper">
                            <a href="{{ route('comune.homepage') }}">
                                <img class="it-logo" src="{{ theme_asset('images/logo-comune.png') }}" alt="Logo" width="80" height="80">
                                <div class="it-brand-text">
                                    <h2 class="it-brand-title">{{ config('comune.nome', 'Nome del Comune') }}</h2>
                                    <p class="it-brand-tagline">{{ config('comune.sottotitolo', 'Un comune da vivere') }}</p>
                                </div>
                            </a>
                        </div>
                        
                        {{-- Search --}}
                        <div class="it-search-wrapper">
                            <button class="search-link" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cerca">
                                <svg class="icon icon-white">
                                    <use href="#it-search"></use>
                                </svg>
                                <span class="d-none d-lg-block">Cerca</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Navbar -->
    <div class="it-nav-wrapper">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        {{-- Hamburger Toggle --}}
                        <button class="custom-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav-wrapper" aria-controls="header-nav-wrapper" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        
                        {{-- Navbar Content --}}
                        <div class="navbar-collapse collapse" id="header-nav-wrapper">
                            {{-- Primary Menu --}}
                            <ul class="navbar-nav" data-element="main-navigation">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('comune.homepage') ? 'active' : '' }}" href="{{ route('comune.homepage') }}">
                                        <span>Home</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('comune.servizi*') ? 'active' : '' }}" href="{{ route('comune.servizi') }}">
                                        <span>Servizi</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('comune.novita*') ? 'active' : '' }}" href="{{ route('comune.novita') }}">
                                        <span>Novità</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('comune.contatti') ? 'active' : '' }}" href="{{ route('comune.contatti') }}">
                                        <span>Contatti</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('fixcity.*') ? 'active' : '' }}" href="{{ route('fixcity.tickets.index') }}">
                                        <span>Segnalazioni</span>
                                    </a>
                                </li>
                            </ul>
                            
                            {{-- Secondary Menu --}}
                            <ul class="navbar-nav navbar-secondary">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span>Iscrizioni</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span>Estate in città</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <span>Polizia locale</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/it/tests/argomenti">
                                        <span>Tutti gli argomenti</span>
                                    </a>
                                </li>
                            </ul>
                            
                            {{-- Social (Mobile) --}}
                            <div class="it-nav-social d-lg-none">
                                <span class="me-2">Seguici su</span>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Twitter">
                                            <svg class="icon icon-sm">
                                                <use href="#it-twitter"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Facebook">
                                            <svg class="icon icon-sm">
                                                <use href="#it-facebook"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="YouTube">
                                            <svg class="icon icon-sm">
                                                <use href="#it-youtube"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Telegram">
                                            <svg class="icon icon-sm">
                                                <use href="#it-telegram"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="Whatsapp">
                                            <svg class="icon icon-sm">
                                                <use href="#it-whatsapp"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a class="text-link" href="#" target="_blank" aria-label="RSS">
                                            <svg class="icon icon-sm">
                                                <use href="#it-rss"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>


