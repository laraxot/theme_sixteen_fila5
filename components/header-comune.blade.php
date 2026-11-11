<header class="it-header-wrapper">
    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="{{ route('home') }}">
                                    <img src="{{ theme_asset('images/logo-comune.png') }}" alt="{{ __('pub_theme::navigation.site_title') }}" class="icon">
                                    <div class="it-brand-text">
                                        <h2>{{ config('comune.nome', 'Nome Comune') }}</h2>
                                        <h3>{{ __('pub_theme::comune_pages.shared.municipality_of_name.label', ['name' => config('comune.nome', 'Nome Comune')]) }}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="it-header-navbar-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg">
                            <button class="custom-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">{{ __('pub_theme::navigation.home') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('services.categories*') ? 'active' : '' }}" href="{{ route('services.categories') }}">{{ __('pub_theme::navigation.services') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('news*') ? 'active' : '' }}" href="{{ route('news') }}">{{ __('pub_theme::navigation.news') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">{{ __('pub_theme::navigation.contact') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('segnalazioni') ? 'active' : '' }}" href="{{ route('segnalazioni') }}">{{ __('pub_theme::home.heading.title') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


