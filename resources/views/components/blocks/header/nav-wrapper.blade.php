@props(['municipality' => '', 'subtitle' => '', 'logo' => '', 'social' => [], 'search' => [], 'items' => []])

<!-- DEBUG: nav-wrapper.blade.php v2 with Alpine.js -->
<div class="it-nav-wrapper" data-mobile-nav>
    {{-- Header Center --}}
    <div class="it-header-center-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-center-content-wrapper">
                        <div class="it-brand-wrapper">
                            <a href="/">
                                <svg width="82" height="82" class="icon" aria-hidden="true">
                                    <image href="{{ $logo ?: asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}"/>
                                </svg>
                                <div class="it-brand-text">
                                    <div class="it-brand-title">{{ $municipality ?: __('pub_theme::header.center.brand.title.label') }}</div>
                                    @if($subtitle)
                                    <div class="it-brand-tagline d-none d-md-block">{{ $subtitle }}</div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="it-right-zone">
                            @if(!empty($social))
                            <div class="it-socials d-none d-lg-flex">
                                <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
                                <ul>
                                    @foreach($social as $s)
                                    <li>
                                        <a href="{{ $s['url'] ?? '#' }}" target="_blank">
                                            <svg class="icon icon-sm icon-white align-top">
                                                <use href="#it-{{ $s['platform'] ?? '' }}"></use>
                                            </svg>
                                            <span class="visually-hidden">{{ ucfirst($s['platform'] ?? '') }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="it-search-wrapper">
                                <span class="d-none d-md-block">{{ __('pub_theme::header.center.search.label') }}</span>
                                <button 
                                    class="search-link rounded-icon" 
                                    type="button" 
                                    @click="$nextTick(() => document.getElementById('search-modal')?._x_data?.open())"
                                    aria-label="{{ __('pub_theme::header.center.search.toggle_aria.label') }}"
                                >
                                    <svg class="icon">
                                        <use href="#it-search"></use>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Navbar --}}
    <div class="it-header-navbar-wrapper" id="header-nav-wrapper" data-mobile-nav>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="navbar navbar-expand-lg has-megamenu">
                        <button 
                            class="custom-navbar-toggler md:hidden" 
                            type="button" 
                           
                            aria-expanded="false"
                            aria-controls="nav-main" 
                            aria-label="{{ __('pub_theme::components_common.a11y.toggle_navigation_it.label') }}" 
                            data-mobile-nav-target="#nav-main"
                            data-mobile-nav-toggle
                        >
                            <svg class="icon">
                                <use href="#it-burger"></use>
                            </svg>
                        </button>
                        <div 
                            class="navbar-collapsable transition-all duration-300" data-mobile-nav-panel
                            id="nav-main"
                           
                           
                        >
                            <div class="overlay" data-mobile-nav-overlay hidden></div>
                            <div class="close-div">
                                <button 
                                    class="btn close-menu" data-mobile-nav-close
                                    type="button"
                                                                    >
                                    <span class="visually-hidden">{{ __('pub_theme::header.center.nav.close_aria.label') }}</span>
                                    <svg class="icon">
                                        <use href="#it-close-big"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="menu-wrapper">
                                <a href="/" class="logo-hamburger" @click="closeOnItemClick()">
                                    <svg class="icon" aria-hidden="true">
                                        <use href="#it-pa"></use>
                                    </svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">{{ $municipality ?: __('pub_theme::header.center.brand.title.label') }}</div>
                                    </div>
                                </a>
                                <nav aria-label="{{ __('pub_theme::components_common.a11y.main_navigation.label') }}">
                                    <ul class="navbar-nav">
                                        @foreach($items as $item)
                                        <li class="nav-item">
                                            <a 
                                                class="nav-link" 
                                                href="{{ $item['url'] ?? '#' }}"
                                                @click="closeOnItemClick()"
                                            >
                                                <span>{{ $item['label'] ?? '' }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Search Modal --}}
<div 
    class="modal fade" 
    id="search-modal" 
    tabindex="-1" 
    x-data="modal()"
    @keydown.escape="close()"
    aria-labelledby="search-modal-label" 
    aria-hidden="true"
>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="search-modal-label">{{ __('pub_theme::header.center.search.toggle_aria.label') }}</h5>
                <button 
                    type="button" 
                    class="btn-close" 
                                        aria-label="{{ __('pub_theme::components_common.actions.close.label') }}"
                ></button>
            </div>
            <div class="modal-body">
                <form action="{{ $search['action'] ?? '/it/ricerca' }}" method="get">
                    <div class="mb-3">
                        <label for="search-modal-input" class="form-label">{{ __('pub_theme::components_search.fields.keyword.label') }}</label>
                        <input type="text" class="form-control" id="search-modal-input" name="q" placeholder="{{ __('pub_theme::components_search.fields.keyword.placeholder') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('pub_theme::header.center.search.label') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
