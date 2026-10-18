<header class="it-header-wrapper">
    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="{{ route('comune.homepage') }}">
                                    <img src="{{ theme_asset('images/logo-comune.png') }}" alt="Logo Comune" class="icon">
                                    <div class="it-brand-text">
                                        <h2>{{ config('comune.nome', 'Nome Comune') }}</h2>
                                        <h3>Comune di {{ config('comune.nome', 'Nome Comune') }}</h3>
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
                                        <a class="nav-link {{ request()->routeIs('comune.homepage') ? 'active' : '' }}" href="{{ route('comune.homepage') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('comune.servizi*') ? 'active' : '' }}" href="{{ route('comune.servizi') }}">Servizi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('comune.novita*') ? 'active' : '' }}" href="{{ route('comune.novita') }}">Novità</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('comune.contatti') ? 'active' : '' }}" href="{{ route('comune.contatti') }}">Contatti</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('fixcity.*') ? 'active' : '' }}" href="{{ route('fixcity.tickets.index') }}">Segnalazioni</a>
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


