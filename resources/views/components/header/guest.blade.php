{{--
  Header Guest Component - Non-Authenticated Users
  
  Standard header for non-logged-in users.
  Part of Story 5.0: Header Logged-In State
  
  @see .planning/stories/5.0-header-logged-in-state.story.md
--}}
<header class="it-header-wrapper">
    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <div class="it-brand-wrapper">
                                <a href="{{ route('comune.homepage') }}">
                                    <img src="{{ theme_asset('images/logo-comune.png') }}" alt="{{ __('pub_theme::components_header.brand.logo_alt.label') }}" class="icon">
                                    <div class="it-brand-text">
                                        <h2>{{ config('comune.nome', __('pub_theme::components_header.brand.municipality_name_default.label')) }}</h2>
                                        <h3>{{ __('pub_theme::components_header.brand.municipality_of.label') }} {{ config('comune.nome', __('pub_theme::components_header.brand.municipality_name_default.label')) }}</h3>
                                    </div>
                                </a>
                            </div>
                            
                            {{-- Guest: Login/Register Links --}}
                            <div class="it-access-right-wrapper">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                                    {{ __('pub_theme::header.guest.login.label') }}
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm ml-2">
                                    {{ __('pub_theme::header.guest.register.label') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="it-header-navbar-wrapper" x-data="mobileMenu()" @keydown.escape="close()">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg">
                            <button 
                                class="custom-navbar-toggler md:hidden" 
                                type="button"
                                @click="toggle()"
                                :aria-expanded="isOpen"
                                aria-controls="navbarNav"
                                aria-label="{{ __('pub_theme::components_common.a11y.toggle_navigation.label') }}"
                            >
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            
                            <div 
                                class="collapse navbar-collapse transition-all duration-300"
                                id="navbarNav"
                                x-show="isOpen || !isMobile()"
                                @click.outside="close()"
                            >
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link {{ request()->routeIs('comune.homepage') ? 'active' : '' }}" 
                                            href="{{ route('comune.homepage') }}"
                                            @click="closeOnItemClick()"
                                        >{{ __('pub_theme::components_common.nav.home.label') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link {{ request()->routeIs('comune.servizi*') ? 'active' : '' }}" 
                                            href="{{ route('comune.servizi') }}"
                                            @click="closeOnItemClick()"
                                        >{{ __('pub_theme::header.center.nav.servizi.label') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link {{ request()->routeIs('comune.novita*') ? 'active' : '' }}" 
                                            href="{{ route('comune.novita') }}"
                                            @click="closeOnItemClick()"
                                        >{{ __('pub_theme::header.center.nav.novita.label') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link {{ request()->routeIs('comune.contatti') ? 'active' : '' }}" 
                                            href="{{ route('comune.contatti') }}"
                                            @click="closeOnItemClick()"
                                        >{{ __('pub_theme::components_common.nav.contacts.label') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a 
                                            class="nav-link {{ request()->routeIs('fixcity.*') ? 'active' : '' }}" 
                                            href="{{ url('/'.app()->getLocale().'/tickets') }}"
                                            @click="closeOnItemClick()"
                                        >{{ __('pub_theme::home.heading.title') }}</a>
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
