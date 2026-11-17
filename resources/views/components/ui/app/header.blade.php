<<<<<<< HEAD
<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
    <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>

<header class="it-header-wrapper" data-sixteen-mobile-nav-target="#header-nav-wrapper">
    <div class="it-header-slim-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-header-slim-wrapper-content">
                        <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione}" title="Vai al portale {Nome della Regione}">
                            Nome della Regione
                        </a>
                        <div class="it-header-slim-right-zone" role="navigation">
                            <div class="nav-item dropdown">
                                <button type="button" class="nav-link dropdown-toggle btn btn-primary btn-full" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true" x-data="{ open: false }" @click="open = !open" @click.away="open = false">
                                    <span class="visually-hidden">Lingua attiva:</span>
                                    <span>ITA</span>
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
                                     aria-labelledby="lang-dropdown-button">
                                    <ul class="link-list">
                                        <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                        <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                                    </ul>
                                </div>
                            </div>
                            @guest
                            <a class="btn btn-primary btn-icon btn-full" href="{{ route('login') }}" data-element="personal-area-login">
                                <span class="rounded-icon" aria-hidden="true">
                                    <x-filament::icon icon="heroicon-o-user" class="icon icon-primary" />
                                </span>
                                <span class="d-none d-lg-block">Accedi all'area personale</span>
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
                                            aria-label="{{ __('sixteen::header.user.aria.toggle_menu') }}">
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
                                            <span class="text-muted">{{ __('sixteen::header.user.welcome', ['name' => $user->name]) }}</span>
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

                                        <a href="{{ route('area-personale.notifiche') }}" class="dropdown-item" role="menuitem">
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

                                        <a href="{{ route('logout') }}" class="dropdown-item text-danger" role="menuitem">
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

    <div class="it-nav-wrapper" data-sixteen-mobile-nav>
        <div class="it-header-center-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-header-center-content-wrapper">
                            <button class="custom-navbar-toggler custom-navbar-toggler-center d-lg-none" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-sixteen-mobile-nav-toggle data-sixteen-mobile-nav-target="#nav4" form="__never_submit_header_nav">
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
                                        <div class="it-brand-title">Il mio Comune</div>
                                        <div class="it-brand-tagline d-none d-md-block">Un comune da vivere</div>
                                    </div>
                                </a>
                            </div>
                            <div class="it-right-zone">
                                <div class="it-socials d-none d-lg-flex">
                                    <span>Seguici su</span>
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
                                    <span class="d-none d-md-block">Cerca</span>
                                    <button class="search-link rounded-icon" type="button" aria-label="Cerca nel sito">
                                        <x-filament::icon icon="heroicon-o-magnifying-glass" class="icon" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="it-header-navbar-wrapper" id="header-nav-wrapper" data-sixteen-mobile-nav>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar navbar-expand-lg has-megamenu">
                            <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-sixteen-mobile-nav-target="#nav4" data-sixteen-mobile-nav-toggle>
                                <x-filament::icon icon="heroicon-o-bars-3" class="icon" />
                            </button>
                            <div class="navbar-collapsable" data-sixteen-mobile-nav-panel id="nav4">
                                <div class="overlay" data-sixteen-mobile-nav-overlay hidden></div>
                                <div class="close-div">
                                    <button class="btn close-menu" data-sixteen-mobile-nav-close type="button">
                                        <span class="visually-hidden">Nascondi la navigazione</span>
                                        <x-filament::icon icon="heroicon-o-x-mark" class="icon" />
                                    </button>
                                </div>
                                <div class="menu-wrapper">
                                    <a href="/" class="logo-hamburger">
                                        <svg class="icon" aria-hidden="true">
                                            <use href="{{ asset('themes/Sixteen/assets/svg/sprites.svg#it-pa') }}"/>
                                        </svg>
                                        <div class="it-brand-text">
                                            <div class="it-brand-title">Nome del Comune</div>
                                        </div>
                                    </a>
                                     <nav aria-label="Principale">
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
                                     <nav aria-label="Secondaria">
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
                                                     <span>Tutti gli argomenti
                                                         <x-filament::icon icon="heroicon-o-chevron-right" class="icon icon-sm" />
                                                     </span>
                                                 </a>
                                             </li>
                                         </ul>
                                     </nav>
                                    <div class="it-socials d-lg-none">
                                        <span>Seguici su</span>
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
=======
<header x-data="{ open: false }" class="bg-white border-b border-gray-200/80 dark:bg-gray-900/40 dark:border-gray-200/[15%]">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center shrink-0">
                <x-ui.logo class="block w-auto text-gray-800 fill-current h-7 dark:text-gray-200" />
            </a>

            <!-- Navigation -->
            <div :class="{ 'absolute left-0' : open, 'relative' : !open }" class="flex flex-col justify-start w-full sm:relative sm:flex-row sm:justify-between" x-cloak>
                @php
                    $navLinks = ['Dashboard' => '/dashboard', 'Learn More' => '/learn'];
                @endphp
                <!-- Navigation Links -->
                <nav :class="{'flex flex-col bg-white dark:bg-gray-900 relative z-50 w-full h-auto px-4 py-5 left-0 mt-16': open, 'hidden': ! open}" class="items-center space-y-3 sm:space-x-3 sm:space-y-0 sm:mt-0 sm:bg-transparent sm:p-0 sm:relative sm:flex sm:-my-px sm:ml-8" x-cloak>
                    @foreach($navLinks as $title => $route)
                        <x-ui.nav-link href="{{ $route }}">{{ $title }}</x-ui.nav-link>
                    @endforeach
                </nav>

                <div class="flex items-center">
                    <div class="hidden w-[38px] h-[38px] overflow-hidden rounded-full sm:block" x-cloak>
                        <x-ui.light-dark-switch></x-ui.light-dark-switch>
                    </div>
                    {{--
                    <!-- User Dropdown -->
                    <div x-data="{ dropdownOpen: false }"
                        :class="{ 'block z-50 w-full p-4 border-t border-gray-100 bg-white dark:bg-gray-900 dark:border-gray-800' : open, 'hidden': ! open }"
                        class="relative flex-shrink-0 sm:p-0 sm:flex sm:w-auto sm:bg-transparent sm:items-center sm:ml-1.5"
                        x-cloak
                    >
                        <button @click="dropdownOpen=!dropdownOpen" class="inline-flex items-center justify-between w-full sm:px-3.5 sm:py-2 py-2.5 px-4 text-sm font-medium text-gray-500 transition duration-0 bg-white border-transparent sm:border rounded-full hover:bg-slate-200/50 dark:text-white/70 dark:hover:text-gray-100 dark:bg-transparent dark:hover:bg-gray-800/70 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            </div>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 sm:scale-95" x-transition:enter-end="transform opacity-100 sm:scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 sm:scale-100" x-transition:leave-end="transform opacity-0 sm:scale-95" 
                            class="absolute top-0 right-0 z-50 w-full mt-16 sm:mt-12 sm:origin-top-right sm:w-40" x-cloak>
                            <div class="p-4 pt-0 mt-1 space-y-3 text-gray-600 bg-white dark:text-white/70 dark:bg-gray-900 dark:shadow-xl sm:p-2 sm:space-y-0.5 sm:border sm:shadow-md sm:rounded-lg border-gray-200/70 dark:border-white/10">
                                <a href="{{ route('profile.edit') }}" class="relative flex cursor-pointer hover:text-gray-700 dark:hover:text-white/70 select-none hover:bg-gray-100/70 dark:hover:bg-gray-800/80 items-center rounded-full py-2 px-4 sm:px-2.5 sm:py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span>Edit Profile</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button onclick="event.preventDefault(); this.closest('form').submit();" class="relative w-full flex cursor-pointer hover:text-gray-700 dark:hover:text-white/70 select-none hover:bg-gray-100/70 dark:hover:bg-gray-800/80 items-center rounded-full py-2 px-4 sm:px-2.5 sm:py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
                                        <span>Log out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    --}}

                    

                    <!-- Mobile Switch and Hamburger -->
                    <div :class="{ 'right-4' : open, 'right-0' : !open }" class="absolute top-0 flex items-center mt-3 space-x-2 sm:right-0 sm:hidden">
                        <div class="block w-10 h-10 overflow-hidden rounded-md" x-cloak>
                            <x-ui.light-dark-switch></x-ui.light-dark-switch>
                        </div>
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

>>>>>>> 6ed19256f (.)
            </div>
        </div>
    </div>
</header>