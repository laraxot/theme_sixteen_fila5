{{--
    AGID Compliant Header Component
    
    Implementa le linee guida AGID per l'header di un sito PA
    - Accessibilità WCAG 2.1 AA
    - Skip links per navigazione da tastiera
    - Breadcrumb semantico
    - Logo PA conforme
--}}

<header class="it-header-wrapper" data-mobile-nav-target="#header-nav-wrapper" style="">
    {{-- Skip Links per accessibilità --}}
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="sr-only sr-only-focusable" href="#main-content">
                            {{ __('pub_theme::ui_components.header.skip_main.label') }}
                        </a>
                        <a class="sr-only sr-only-focusable" href="#main-navigation">
                            {{ __('pub_theme::ui_components.header.skip_nav.label') }}
                        </a>
                        <a class="sr-only sr-only-focusable" href="#footer">
                            {{ __('pub_theme::ui_components.header.skip_footer.label') }}
                        </a>
                        
                        <div class="header-slim-right-zone" role="navigation" aria-label="{{ __('pub_theme::ui_components.header.language_access.label') }}">
                            {{-- Language Selector --}}
                            <div class="nav-item dropdown">
                                <button 
                                    class="nav-link dropdown-toggle" 
                                    type="button" 
                                    id="languageDropdown"
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false"
                                    aria-label="{{ __('pub_theme::ui_components.header.select_language.label') }}"
                                >
                                    <span class="visually-hidden">{{ __('pub_theme::ui_components.header.current_language.label') }}</span>
                                    {{ __('pub_theme::header.language.code_it.label') }}
                                    <svg class="icon d-none d-lg-block"><use href="#it-expand"></use></svg>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list">
                                            <li><a class="dropdown-item list-item" href="#" lang="it">Italiano</a></li>
                                            <li><a class="dropdown-item list-item" href="#" lang="en">English</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Area Personale / Login --}}
                            @auth
                                <a class="btn btn-primary btn-icon btn-full" href="{{ route('filament.admin.pages.dashboard') }}" data-element="personal-area-login" aria-label="{{ __('pub_theme::header.guest.cta.label') }}">
                                    <span class="rounded-icon" aria-hidden="true">
                                        <svg class="icon icon-primary"><use href="#it-user"></use></svg>
                                    </span>
                                    <span class="d-none d-lg-block">{{ __('pub_theme::ui.personal_area') }}</span>
                                </a>
                            @else
                                <a class="btn btn-primary btn-icon btn-full" href="{{ route('filament.admin.auth.login') }}" data-element="personal-area-login" aria-label="{{ __('pub_theme::header.guest.login.label') }}">
                                    <span class="rounded-icon" aria-hidden="true">
                                        <svg class="icon icon-primary"><use href="#it-user"></use></svg>
                                    </span>
                                    <span class="d-none d-lg-block">{{ __('pub_theme::ui.personal_area') }}</span>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Header Center con Logo e Ricerca --}}
    <div class="it-header-center-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-center-content-wrapper">
                        {{-- Logo --}}
                        <div class="it-brand-wrapper">
                            <a href="{{ url('/'.app()->getLocale()) }}" aria-label="{{ config('app.name') }} - {{ __('pub_theme::common.navigation.back_home.label') }}">
                                <svg class="icon" role="img" aria-labelledby="logo-title">
                                    <title id="logo-title">{{ config('app.name') }}</title>
                                    <use href="#it-pa"></use>
                                </svg>
                                <div class="it-brand-text">
                                    <h2 class="no_toc">{{ config('app.name') }}</h2>
                                    <h3 class="no_toc d-none d-md-block">{{ __('pub_theme::ui_components.header.site_title.label') }}</h3>
                                </div>
                            </a>
                        </div>
                        
                        {{-- Header Right Zone con Ricerca e Social --}}
                        <div class="it-right-zone">
                            {{-- Ricerca --}}
                            <div class="it-search-wrapper">
                                <button 
                                    class="search-link rounded-icon" 
                                    type="button" 
                                    aria-label="{{ __('pub_theme::header.center.search.label') }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#searchModal"
                                >
                                    <svg class="icon">
                                        <use href="#it-search"></use>
                                    </svg>
                                </button>
                            </div>
                            
                            {{-- Social --}}
                            <div class="it-socials d-none d-md-flex">
                                <span class="visually-hidden">{{ __('pub_theme::ui_components.header.follow_us.label') }}</span>
                                <ul>
                                    <li>
                                        <a href="#" aria-label="{{ __('pub_theme::header.social.facebook.label') }}" target="_blank" rel="noopener noreferrer">
                                            <svg class="icon"><use href="#it-facebook"></use></svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="{{ __('pub_theme::header.social.twitter.label') }}" target="_blank" rel="noopener noreferrer">
                                            <svg class="icon"><use href="#it-twitter"></use></svg>
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
    
    {{-- Navigazione Principale --}}
    <div class="it-nav-wrapper" data-mobile-nav>
        <div class="it-header-navbar-wrapper" data-mobile-nav>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg has-megamenu" id="main-navigation" aria-label="{{ __('pub_theme::navigation.main') }}">
                            <button 
                                class="custom-navbar-toggler" 
                                type="button" 
                                aria-controls="nav" 
                                aria-expanded="false" 
                                aria-label="{{ __('pub_theme::navigation_components.navbar.open_menu.label') }}"
                                data-mobile-nav-toggle
                                data-mobile-nav-target="#nav"
                            >
                                <svg class="icon"><use href="#it-burger"></use></svg>
                            </button>
                            
                            <div class="navbar-collapsable" data-mobile-nav-panel id="nav">
                                <div class="overlay" data-mobile-nav-overlay hidden></div>
                                <div class="close-div">
                                    <button 
                                        class="btn close-menu" data-mobile-nav-close
                                        type="button"
                                        aria-label="{{ __('pub_theme::common.actions.close_menu.label') }}"
                                    >
                                        <svg class="icon"><use href="#it-close-big"></use></svg>
                                    </button>
                                </div>
                                
                                <div class="menu-wrapper">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/'.app()->getLocale()) }}" aria-current="page">
                                                <span>{{ __('pub_theme::common.navigation.home.label') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/'.app()->getLocale().'/tickets') }}">
                                                <span>{{ __('pub_theme::common.navigation.reports.label') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/'.app()->getLocale().'/tickets/create') }}">
                                                <span>{{ __('pub_theme::common.navigation.new_report.label') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/info') }}">
                                                <span>{{ __('pub_theme::common.navigation.information.label') }}</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/contatti') }}">
                                                <span>{{ __('pub_theme::common.navigation.contacts.label') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- Modal Ricerca --}}
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('pub_theme::ui_components.header.close_search.label') }}">
                    <svg class="icon"><use href="#it-close"></use></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('search') }}" method="GET" role="search">
                    <div class="form-group">
                        <label for="search-input" class="visually-hidden">{{ __('pub_theme::ui.search_site_aria') }}</label>
                        <input 
                            type="search" 
                            class="form-control" 
                            id="search-input"
                            name="q"
                            placeholder="{{ __('pub_theme::ui_components.header.search_site.placeholder') }}"
                            aria-label="{{ __('pub_theme::ui_components.header.search_field.label') }}"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('pub_theme::header.center.search.label') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
