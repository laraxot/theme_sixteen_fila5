<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" role="banner">
    {{-- ============================================
        Level 1: Top Bar (Slim Header)
        Background: DARK GREEN (#00614a)
        Contains: Region link, Language, Login
        ============================================ --}}
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        {{-- Region Link --}}
                        <a class="d-lg-block navbar-brand" 
                           target="_blank" 
                           href="#" 
                           aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda" 
                           title="Vai al portale {Nome della Regione}">
                            Nome della Regione
                        </a>
                        
                        {{-- Right Zone: Language + Login --}}
                        <div class="it-header-slim-right-zone" role="navigation">
                            {{-- Language Dropdown --}}
                            <div class="nav-item dropdown">
                                <button type="button" 
                                        class="nav-link dropdown-toggle" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false" 
                                        aria-controls="languages" 
                                        aria-haspopup="true">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>ITA</span>
                                    <svg class="icon">
                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu" id="languages">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="link-list-wrapper">
                                                <ul class="link-list">
                                                    <li>
                                                        <a class="dropdown-item list-item" href="#">
                                                            <span>ITA <span class="visually-hidden">selezionata</span></span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item list-item" href="#">
                                                            <span>ENG</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Login Button --}}
                            @guest
                                <a class="btn btn-primary btn-icon btn-full" 
                                   href="{{ route('login') }}" 
                                   data-element="personal-area-login"
                                   aria-label="Accedi all'area personale">
                                    <span class="rounded-icon" aria-hidden="true">
                                        <svg class="icon icon-primary">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                        </svg>
                                    </span>
                                    <span class="d-none d-lg-block">Accedi all'area personale</span>
                                </a>
                            @else
                                {{-- User Dropdown --}}
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-icon btn-full dropdown-toggle" 
                                            type="button" 
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                            aria-haspopup="true">
                                        <span class="rounded-icon" aria-hidden="true">
                                            <svg class="icon icon-primary">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                            </svg>
                                        </span>
                                        <span class="d-none d-lg-block">{{ Auth::user()->name }}</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        <li><a class="dropdown-item list-item" href="#"><span>I miei servizi</span></a></li>
                                                        <li><a class="dropdown-item list-item" href="#"><span>Le mie pratiche</span></a></li>
                                                        <li><a class="dropdown-item list-item" href="#"><span>Notifiche</span></a></li>
                                                        <li class="divider"></li>
                                                        <li><a class="dropdown-item list-item" href="#"><span>Impostazioni</span></a></li>
                                                        <li class="divider"></li>
                                                        <li>
                                                            <form method="POST" action="{{ route('logout') }}">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item list-item">
                                                                    <span><svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use></svg> Esci</span>
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
    
    {{-- ============================================
        Level 2: Main Header (Center)
        Background: GREEN (#007a52)
        Contains: Logo, Municipality Name, Slogan, Social, Search
        ============================================ --}}
    <div class="it-header-center-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-center-content-wrapper">
                        {{-- Brand/Logo Section --}}
                        @php
                            $brandBlock = collect($blocks)->firstWhere('type', 'header_brand');
                            $brandData = $brandBlock ? $brandBlock->data : [];
                            $logo = $brandData['logo'] ?? asset('themes/Sixteen/images/logo.svg');
                            $name = $brandData['name'] ?? 'Il mio Comune';
                            $slogan = $brandData['slogan'] ?? 'Un comune da vivere';
                        @endphp
                        <div class="it-brand-wrapper">
                            <a href="/" aria-label="{{ $name }} - Vai alla homepage">
                                {{-- Logo --}}
                                @if (Str::endsWith($logo, '.svg') && !Str::contains($logo, '://'))
                                    <img src="{{ $logo }}" alt="{{ $name }} Logo" class="icon" width="82" height="82" />
                                @elseif (Str::contains($logo, 'sprites.svg#'))
                                    <svg width="82" height="82" class="icon" aria-hidden="true">
                                        <use href="{{ $logo }}"></use>
                                    </svg>
                                @else
                                    <img src="{{ $logo }}" alt="{{ $name }} Logo" class="icon" width="82" height="82" />
                                @endif
                                
                                {{-- Municipality Name and Slogan --}}
                                <div class="it-brand-text">
                                    <div class="it-brand-title">{{ $name }}</div>
                                    <div class="it-brand-tagline d-none d-md-block">{{ $slogan }}</div>
                                </div>
                            </a>
                        </div>
                        
                        {{-- Right Zone: Social Media + Search --}}
                        <div class="it-right-zone">
                            {{-- Social Media Links --}}
                            <div class="it-socials d-none d-lg-flex">
                                <span>Seguici su</span>
                                <ul>
                                    <li>
                                        <a href="#" target="_blank" aria-label="Twitter">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" aria-label="Facebook">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" aria-label="YouTube">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" aria-label="Telegram">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" aria-label="Whatsapp">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank" aria-label="RSS">
                                            <svg class="icon icon-sm icon-white" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            
                            {{-- Search Toggle Button --}}
                            <div class="it-search-wrapper">
                                <span class="d-none d-md-block">Cerca</span>
                                <button class="search-link rounded-icon" 
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#search-modal"
                                        aria-label="Cerca nel sito">
                                    <svg class="icon" aria-hidden="true">
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
    
    {{-- ============================================
        Level 3: Navigation Bar
        Background: WHITE
        Contains: Hamburger menu, Main navigation, Secondary navigation
        ============================================ --}}
    <div class="it-nav-wrapper">
        <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg" aria-label="Navigazione principale">
                            {{-- Hamburger Toggle Button --}}
                            <button class="custom-navbar-toggler" 
                                    type="button" 
                                    aria-controls="nav4" 
                                    aria-expanded="false" 
                                    aria-label="Mostra/Nascondi la navigazione"
                                    data-bs-toggle="navbarcollapsible"
                                    data-bs-target="#nav4">
                                <svg class="icon" aria-hidden="true">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                                </svg>
                            </button>
                            
                            {{-- Collapsible Mobile Menu --}}
                            <div class="navbar-collapsable" id="nav4">
                                <div class="overlay"></div>
                                <div class="close-div">
                                    <button class="btn close-menu" type="button">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <svg class="icon" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close"></use>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="menu-wrapper">
                                    {{-- Logo Hamburger (Mobile Only) --}}
                                    <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa"></use>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">Nome del Comune</div>
                                        </div>
                                    </a>
                                    
                                    {{-- Primary Navigation --}}
                                    <nav aria-label="Principale">
                                        <ul class="navbar-nav">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/amministrazione">
                                                    <span>Amministrazione</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/novita">
                                                    <span>Novità</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/servizi">
                                                    <span>Servizi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/vivere">
                                                    <span>Vivere il Comune</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    
                                    {{-- Secondary Navigation --}}
                                    <nav aria-label="Secondaria">
                                        <ul class="navbar-nav navbar-secondary">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/iscrizioni">
                                                    <span>Iscrizioni</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/estate-citta">
                                                    <span>Estate in città</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/polizia-locale">
                                                    <span>Polizia locale</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/argomenti">
                                                    <span>Tutti gli argomenti</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                    
                                    {{-- Social Media (Mobile Only) --}}
                                    <div class="it-socials">
                                        <span>Seguici su</span>
                                        <ul>
                                            <li><a href="#" aria-label="Twitter"><svg class="icon icon-sm icon-white"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use></svg></a></li>
                                            <li><a href="#" aria-label="Facebook"><svg class="icon icon-sm icon-white"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use></svg></a></li>
                                            <li><a href="#" aria-label="YouTube"><svg class="icon icon-sm icon-white"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use></svg></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Search Modal --}}
<div class="modal fade" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="search-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="search-modal-label">Cerca nel sito</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <svg class="icon" aria-hidden="true">
                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-close"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <form class="search-form" role="search">
                    <div class="form-group">
                        <label for="search-input" class="visually-hidden">Cerca</label>
                        <input type="search" class="form-control" id="search-input" placeholder="Cerca una parola chiave" name="q">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <svg class="icon icon-sm">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                        </svg>
                        Invio
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
