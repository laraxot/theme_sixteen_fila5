@props(['region' => __('pub_theme::header.slim.region.name.label'), 'municipality' => __('pub_theme::components_header.brand.municipality_name_caps.label'), 'subtitle' => __('pub_theme::header.center.brand.tagline.label'), 'language' => 'ITA'])

{{-- EXACT Bootstrap Italia Header - 1:1 Replication from view-source --}}
{{-- Source: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html --}}

<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper">
  <div class="it-header-slim-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-slim-wrapper-content">
            
            {{-- Left: Region Link --}}
            <a class="it-header-slim-link" href="#">
              <span>{{ $region }}</span>
            </a>
            
            {{-- Right: Language + Login + Social --}}
            <div class="it-header-slim-right-zone">
              
              {{-- Language Dropdown --}}
              <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" id="language-button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="visually-hidden">{{ __('pub_theme::header.language.active_prefix.label') }}</span>
                  <span>{{ $language }}</span>
                  <svg class="icon icon-xs">
                    <use href="#it-chevron-down"></use>
                  </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="language-button">
                  <a class="dropdown-item" href="#" lang="it">
                    <span>{{ __('pub_theme::header.language.code_it.label') }}</span>
                    @if($language === 'ITA')
                    <svg class="icon icon-xs ms-2">
                      <use href="#it-check"></use>
                    </svg>
                    @endif
                  </a>
                  <a class="dropdown-item" href="#" lang="en">
                    <span>{{ __('pub_theme::header.language.code_en.label') }}</span>
                    @if($language === 'ENG')
                    <svg class="icon icon-xs ms-2">
                      <use href="#it-check"></use>
                    </svg>
                    @endif
                  </a>
                </div>
              </div>
              
              {{-- Login Button --}}
              <a class="btn btn-primary btn-sm" href="#">
                <svg class="icon">
                  <use href="#it-user"></use>
                </svg>
                <span>{{ __('pub_theme::faq.contacts.login') }}</span>
              </a>
              
              {{-- Social Icons --}}
              <div class="it-header-slim-social d-none d-lg-flex">
                <span class="me-2">{{ __('pub_theme::header.center.social.follow.label') }}</span>
                <ul class="list-inline mb-0">
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="Twitter">
                      <svg class="icon icon-sm">
                        <use href="#it-twitter"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="Facebook">
                      <svg class="icon icon-sm">
                        <use href="#it-facebook"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="YouTube">
                      <svg class="icon icon-sm">
                        <use href="#it-youtube"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="Telegram">
                      <svg class="icon icon-sm">
                        <use href="#it-telegram"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="Whatsapp">
                      <svg class="icon icon-sm">
                        <use href="#it-whatsapp"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-link" href="#" aria-label="RSS">
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
  
  <div class="it-header-main-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="it-header-main-content-wrapper">
            
            {{-- Brand --}}
            <div class="it-brand-wrapper">
              <a href="/">
                <img class="it-logo" src="https://picsum.photos/80/80" alt="{{ __('pub_theme::components_common.a11y.logo.label') }}" width="80" height="80">
                <div class="it-brand-text">
                  <h2 class="it-brand-title">{{ $municipality }}</h2>
                  <p class="it-brand-tagline">{{ $subtitle }}</p>
                </div>
              </a>
            </div>
            
            {{-- Search --}}
            <div class="it-search-wrapper">
              <button class="search-link" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="{{ __('pub_theme::header.center.search.label') }}">
                <svg class="icon icon-white">
                  <use href="#it-search"></use>
                </svg>
                <span class="d-none d-lg-block">{{ __('pub_theme::header.center.search.label') }}</span>
              </button>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="it-nav-wrapper">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        
        {{-- Hamburger Toggle --}}
        <button class="custom-navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#header-nav-wrapper" aria-controls="header-nav-wrapper" aria-expanded="false" aria-label="{{ __('pub_theme::components_common.a11y.toggle_navigation.label') }}">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        {{-- Navbar Content --}}
        <div class="navbar-collapse collapse" id="header-nav-wrapper">
          
          {{-- Primary Menu --}}
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'amministrazione']) }}">
                <span>{{ __('pub_theme::header.center.nav.amministrazione.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'novita']) }}">
                <span>{{ __('pub_theme::header.center.nav.novita.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'servizi']) }}">
                <span>{{ __('pub_theme::header.center.nav.servizi.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'eventi']) }}">
                <span>{{ __('pub_theme::header.center.nav.vivere.label') }}8</span>
              </a>
            </li>
          </ul>
          
          {{-- Secondary Menu --}}
          <ul class="navbar-nav navbar-secondary">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>{{ __('pub_theme::header.center.nav.iscrizioni.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>{{ __('pub_theme::header.center.nav.estate.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>{{ __('pub_theme::header.center.nav.polizia.label') }}</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('container0.view', ['container0' => 'tests', 'slug0' => 'argomenti']) }}">
                <span>{{ __('pub_theme::header.center.nav.argomenti.label') }}</span>
              </a>
            </li>
          </ul>
          
        </div>
      </div>
    </nav>
  </div>
</header>

{{-- Search Modal --}}
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="searchModalLabel">{{ __('pub_theme::header.center.search.toggle_aria.label') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('pub_theme::components_common.actions.close_aria.label') }}"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="get">
          <div class="mb-3">
            <label for="search-input" class="form-label">{{ __('pub_theme::components_search.fields.keyword.label') }}</label>
            <input type="text" class="form-control" id="search-input" placeholder="{{ __('pub_theme::components_search.fields.keyword.placeholder') }}">
          </div>
          <button type="submit" class="btn btn-primary">{{ __('pub_theme::header.center.search.label') }}</button>
        </form>
      </div>
    </div>
  </div>
</div>
