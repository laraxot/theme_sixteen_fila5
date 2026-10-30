{{--
    EXACT Design Comuni Header - HTML Structure MUST MATCH reference
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
    
    DO NOT CHANGE HTML STRUCTURE - Only Tailwind classes for styling!
--}}

{{-- Skip Links - MUST be first --}}
<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">{{ __('pub_theme::components_common.skiplinks.go_content.label') }}</a>
    <a class="visually-hidden-focusable" href="#footer">{{ __('pub_theme::components_common.skiplinks.go_footer.label') }}</a>
</div>

{{-- Header Wrapper - EXACT structure --}}
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
    
    {{-- TOP BAR (Slim) - EXACT structure --}}
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        {{-- Region Link --}}
                        <a class="d-lg-block navbar-brand" 
                           href="#" 
                           target="_blank" 
                           rel="noopener"
                           aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda"
                           title="Vai al portale {Nome della Regione}">
                            {{ $regionName ?? __('pub_theme::header.slim.region.name.label') }}
                        </a>
                        
                        {{-- Right Zone --}}
                        <div class="it-header-slim-right-zone" role="navigation">
                            
                            {{-- Language Dropdown --}}
                            <div class="nav-item dropdown">
                                <button type="button" 
                                        class="nav-link dropdown-toggle" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false" 
                                        aria-controls="languages"
                                        aria-haspopup="true">
                                    <span class="visually-hidden">{{ __('pub_theme::header.language.active_prefix.label') }}</span>
                                    <span>{{ __('pub_theme::header.language.code_it.label') }}</span>
                                    <svg class="icon">
                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-expand"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="link-list-wrapper">
                                                <ul class="link-list">
                                                    <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_it.label') }} <span class="visually-hidden">{{ __('pub_theme::header.language.selected_suffix.label') }}</span></span></a></li>
                                                    <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_en.label') }}</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Login Button --}}
                            <a class="btn btn-primary btn-icon btn-full" 
                               href="{{ route('login') }}"
                               data-element="personal-area-login">
                                <span class="rounded-icon" aria-hidden="true">
                                    <svg class="icon icon-primary">
                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-user"></use>
                                    </svg>
                                </span>
                                <span class="d-none d-lg-block">{{ __('pub_theme::faq.contacts.login') }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- MAIN HEADER (Center) - EXACT structure --}}
    <div class="it-nav-wrapper">
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            
                            {{-- Brand Wrapper --}}
                            <div class="it-brand-wrapper">
                                <a href="{{ route('home') }}">
                                    {{-- SVG Logo - EXACT size 82x82 --}}
                                    <svg width="82" height="82" class="icon" aria-hidden="true">
                                        <image href="{{ $logoUrl ?? asset('themes/sixteen/images/logo-comune.svg') }}"/>
                                    </svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">{{ $cityName ?? __('pub_theme::header.center.brand.title.label') }}</div>
                                        <div class="it-brand-tagline d-none d-md-block">{{ $tagline ?? __('pub_theme::header.center.brand.tagline.label') }}</div>
                                    </div>
                                </a>
                            </div>
                            
                            {{-- Right Zone with Socials --}}
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-lg-flex">
                                    <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
                                    <ul>
                                        @foreach($socialLinks ?? [['platform'=>'twitter','url'=>'#','icon'=>'it-twitter','label'=>'Twitter']] as $social)
                                        <li>
                                            <a href="{{ $social['url'] }}" target="_blank" rel="noopener">
                                                <svg class="icon icon-sm icon-white align-top">
                                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#{{ $social['icon'] }}"></use>
                                                </svg>
                                                <span class="visually-hidden">{{ $social['label'] }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Navigation - EXACT structure --}}
    <div class="it-nav-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg">
                        <button class="custom-navbar-toggler" 
                                type="button" 
                                data-bs-toggle="collapse" 
                                data-bs-target="#mainNav"
                                aria-controls="mainNav"
                                aria-expanded="false"
                                aria-label="{{ __('pub_theme::components_common.a11y.toggle_navigation.label') }}">
                            <svg class="icon">
                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-burger"></use>
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="mainNav">
                            <div class="navbar-nav">
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'amministrazione']) }}">{{ __('pub_theme::header.center.nav.amministrazione.label') }}</a>
                                </div>
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'novita']) }}">{{ __('pub_theme::header.center.nav.novita.label') }}</a>
                                </div>
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'servizi']) }}">{{ __('pub_theme::header.center.nav.servizi.label') }}</a>
                                </div>
                                <div class="nav-item">
                                    <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'vivere']) }}">{{ __('pub_theme::header.center.nav.vivere.label') }}12</a>
                                </div>
                                <div class="nav-item highlighted">
                                    <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'argomenti']) }}">{{ __('pub_theme::header.center.nav.argomenti.label') }}</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
