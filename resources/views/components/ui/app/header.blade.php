<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">{{ __('pub_theme::ui.skip_to_content') }}</a>
    <a class="visually-hidden-focusable" href="#footer">{{ __('pub_theme::ui.skip_to_footer') }}</a>
</div>

<header class="it-header-wrapper" data-mobile-nav-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="{{ __('pub_theme::header.slim.region.portal_title.label', ['region' => '{'.__('pub_theme::header.slim.region.name.label').'}']) }}" title="Vai al portale {Nome della Regione}">
                            {{ __('pub_theme::header.slim.region.name.label') }}
                        </a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button id="languages-toggle" type="button" class="nav-link dropdown-toggle btn btn-primary btn-full" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true" x-data="{ open: false }" @click="open = !open" @click.away="open = false">
                                    <span class="visually-hidden">{{ __('pub_theme::header.language.active_prefix.label') }}</span>
                                    <span>{{ __('pub_theme::header.language.code_it.label') }}</span>
                                    <x-ui::icon name="chevron-down" class="w-4 h-4 ml-1" x-show="!open" />
                                    <x-ui::icon name="chevron-up" class="w-4 h-4 ml-1" x-show="open" />
                                </button>
                                <div id="languages" x-show="open"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     class="dropdown-menu dropdown-menu-right show"
                                     role="menu"
                                     aria-orientation="vertical"
                                     aria-labelledby="languages-toggle">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_it.label') }} <span class="visually-hidden">{{ __('pub_theme::header.language.selected_suffix.label') }}</span></span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>{{ __('pub_theme::header.language.code_en.label') }}</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            @guest
                            <a class="btn btn-primary btn-icon btn-full" href="{{ route('login') }}" data-element="personal-area-login">
                                <span class="rounded-icon" aria-hidden="true">
                                    <x-filament::icon icon="heroicon-o-user" class="icon icon-primary" />
                                </span>
                                <span class="d-none d-lg-block">{{ __('pub_theme::ui.personal_area') }}</span>
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
                                            aria-label="{{ __('pub_theme::header.user.aria.toggle_menu') }}">
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
                                            <span class="text-muted">{{ __('pub_theme::header.user.welcome', ['name' => $user->name]) }}</span>
                                        </div>

                                        {{-- Menu Items — named route Folio (folio:list) + pub_theme::header.user.dropdown.* --}}
                                        <a href="{{ route('services.categories') }}" class="dropdown-item bg-white text-gray-800 rounded-md px-3 py-2 hover:bg-gray-100 hover:text-primary flex items-center space-x-2" role="menuitem">
                                            <x-ui::icon name="briefcase" class="w-4 h-4 text-gray-600" />
                                            {{ __('pub_theme::header.user.dropdown.my_services.label') }}
                                        </a>

                                        <a href="{{ route('dashboard') }}" class="dropdown-item" role="menuitem">
                                            <x-ui::icon name="document-text" class="w-4 h-4 mr-2" />
                                            {{ __('pub_theme::header.user.dropdown.my_practices.label') }}
                                        </a>

                                        <a href="{{ route('notifications') }}" class="dropdown-item" role="menuitem">
                                            <span class="d-flex align-items-center">
                                                <x-ui::icon name="bell" class="w-4 h-4 mr-2" />
                                                {{ __('pub_theme::header.user.dropdown.notifications.label') }}
                                                @if($user->unreadNotificationsCount > 0)
                                                    <span class="badge badge-primary ml-auto">{{ $user->unreadNotificationsCount }}</span>
                                                @endif
                                            </span>
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="{{ route('profile.edit') }}" class="dropdown-item" role="menuitem">
                                            <x-ui::icon name="cog-6-tooth" class="w-4 h-4 mr-2" />
                                            {{ __('pub_theme::header.user.dropdown.settings.label') }}
                                        </a>

                                        <div class="dropdown-divider"></div>

                                        <a href="{{ url('/'.app()->getLocale().'/auth/logout') }}" class="dropdown-item text-danger" role="menuitem">
                                            <x-ui::icon name="arrow-right-on-rectangle" class="w-4 h-4 mr-2" />
                                            {{ __('pub_theme::header.user.dropdown.logout.label') }}
                                        </a>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="it-nav-wrapper" data-mobile-nav>
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <button class="custom-navbar-toggler custom-navbar-toggler-center d-lg-none" type="button" aria-controls="nav4" aria-expanded="false" aria-label="{{ __('pub_theme::header.center.nav.toggle_aria.label') }}" data-mobile-nav-toggle data-mobile-nav-target="#nav4" form="__never_submit_header_nav">
                                <svg class="icon">
                                    <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-burger') }}"/>
                                </svg>
                            </button>
                            <div class="it-brand-wrapper">
                                <a href="/">
                                    <svg width="82" height="82" class="icon" aria-hidden="true">
                                        <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-pa') }}"/>
                                    </svg>
                                    <div class="it-brand-text">
                                        <div class="it-brand-title">{{ __('pub_theme::header.center.brand.title.label') }}</div>
                                        <div class="it-brand-tagline d-none d-md-block">{{ __('pub_theme::header.center.brand.tagline.label') }}</div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-lg-flex">
                                    <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
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
                                    <span class="d-none d-md-block">{{ __('pub_theme::header.center.search.label') }}</span>
                                    <button class="search-link rounded-icon" type="button" aria-label="{{ __('pub_theme::header.center.search.toggle_aria.label') }}">
                                        <x-filament::icon icon="heroicon-o-magnifying-glass" class="icon" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="it-header-navbar-wrapper" id="header-nav-wrapper" data-mobile-nav>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="{{ __('pub_theme::header.center.nav.toggle_aria.label') }}" data-mobile-nav-target="#nav4" data-mobile-nav-toggle>
                                <x-filament::icon icon="heroicon-o-bars-3" class="icon" />
                            </button>
                            <div class="navbar-collapsable" data-mobile-nav-panel id="nav4">
                                <div class="overlay" data-mobile-nav-overlay hidden></div>
                                <div class="close-div">
                                    <button class="btn close-menu" data-mobile-nav-close type="button">
                                        <span class="visually-hidden">{{ __('pub_theme::header.center.nav.close_aria.label') }}</span>
                                        <x-filament::icon icon="heroicon-o-x-mark" class="icon" />
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-pa') }}"/>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">{{ __('pub_theme::header.center.nav.hamburger_brand.label') }}</div>
                                        </div>
                                    </a>
                                     <nav aria-label="{{ __('pub_theme::header.center.nav.primary_aria.label') }}">
                                         <ul class="navbar-nav" data-element="main-navigation">
                                             @foreach($headerNavItems as $item)
                                                 <li class="nav-item">
                                                     <a class="nav-link{{ $headerNavItemIsActive($item) ? ' active' : '' }}"
                                                        href="{{ $item['url'] ?? '#' }}"
                                                        @if(! empty($item['data_element'])) data-element="{{ $item['data_element'] }}" @endif>
                                                         <span>{{ $item['label'] ?? '' }}</span>
                                                     </a>
                                                 </li>
                                             @endforeach
                                         </ul>
                                     </nav>
                                     <nav aria-label="{{ __('pub_theme::header.center.nav.secondary_aria.label') }}">
                                         <ul class="navbar-nav navbar-secondary">
                                             @foreach($headerNavSecondary as $headerNavSecItem)
                                                 <li class="nav-item">
                                                     <a class="nav-link{{ $headerNavItemIsActive($headerNavSecItem) ? ' active' : '' }}"
                                                        href="{{ $headerNavSecItem['url'] ?? '#' }}"
                                                        @if(! empty($headerNavSecItem['data_element'])) data-element="{{ $headerNavSecItem['data_element'] }}" @endif>
                                                         <span>{{ $headerNavSecItem['label'] ?? '' }}</span>
                                                     </a>
                                                 </li>
                                             @endforeach
                                             <li class="nav-item">
                                                 <a class="nav-link" href="{{ $headerNavTopicsUrl }}" data-element="all-topics">
                                                     <span>{{ __('pub_theme::header.center.nav.argomenti.label') }}
                                                         <x-filament::icon icon="heroicon-o-chevron-right" class="icon icon-sm" />
                                                     </span>
                                                 </a>
                                             </li>
                                         </ul>
                                     </nav>
                                    <div class="it-socials d-lg-none">
                                        <span>{{ __('pub_theme::header.center.social.follow.label') }}</span>
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
