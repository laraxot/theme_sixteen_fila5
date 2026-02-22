<header class="text-white" role="banner">
    {{-- Top bar --}}
    <div class="h-10 min-h-10 border-b" style="background-color: var(--agid-primary-dark); border-color: rgba(255,255,255,0.2);">
        <div class="flex items-center justify-between w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <a class="text-xs font-medium hover:text-opacity-90 agid-focus agid-transition focus:outline-2 focus:outline-white focus:outline-offset-2" href="#" aria-label="Vai al portale della Regione">Nome della Regione</a>
            </div>
            <div class="flex items-center gap-4">
                <livewire:dark-mode-switcher />
                <livewire:lang.switcher />

                @guest
                    <a class="flex items-center gap-2 text-xs sm:text-sm font-medium hover:text-opacity-90 agid-focus agid-transition focus:outline-2 focus:outline-white focus:outline-offset-2" href="{{ route('login') }}" aria-label="Accedi all'area personale">
                        <x-heroicon-o-user class="w-4 h-4" aria-hidden="true" />
                        <span class="hidden md:block">Accedi all'area personale</span>
                    </a>
                @endguest

                @auth
                    <div class="relative">
                        <button id="dropdownDefaultButton" class="flex items-center gap-2 text-xs sm:text-sm font-medium hover:text-opacity-90 agid-focus agid-transition focus:outline-2 focus:outline-white focus:outline-offset-2" type="button" aria-expanded="false" aria-haspopup="true" aria-label="Menu utente - {{ Auth::user()->name }}">
                            <x-heroicon-o-user class="w-4 h-4" aria-hidden="true" />
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div id="dropdown" class="absolute right-0 z-50 hidden mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700" role="menu" aria-orientation="vertical" aria-labelledby="dropdownDefaultButton">
                            <div class="py-2">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 agid-focus agid-transition focus:outline-2 focus:outline-blue-600 focus:outline-offset-2" role="menuitem" aria-label="Vai ai miei servizi">I miei servizi</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 agid-focus agid-transition focus:outline-2 focus:outline-blue-600 focus:outline-offset-2" role="menuitem" aria-label="Vai alle mie pratiche">Le mie pratiche</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 agid-focus agid-transition focus:outline-2 focus:outline-blue-600 focus:outline-offset-2" role="menuitem" aria-label="Vai alle notifiche">Notifiche</a>
                                <hr class="my-2 border-gray-200 dark:border-gray-600" role="separator" aria-orientation="horizontal">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 agid-focus agid-transition focus:outline-2 focus:outline-blue-600 focus:outline-offset-2" role="menuitem" aria-label="Vai alle impostazioni">Impostazioni</a>
                                <form method="POST" action="{{ route('logout') }}" class="block">@csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 agid-focus agid-transition focus:outline-2 focus:outline-blue-600 focus:outline-offset-2 flex items-center gap-2" role="menuitem" aria-label="Esci dall'area personale">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" /></svg>
                                        <span>Esci</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- Header principale --}}
    <div class="border-b" style="background-color: var(--agid-primary); border-color: rgba(255,255,255,0.2);">
        <div class="flex items-center justify-between w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="/" class="flex items-center gap-4 agid-focus agid-transition hover:opacity-90 focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="{{ $_theme->metatag('title') }} - Vai alla homepage">
                <x-filament-panels::logo class="w-12 h-12 sm:w-16 sm:h-16" alt="{{ $_theme->metatag('title') }}" />
                <div class="text-start">
                    <h1 class="text-xl sm:text-2xl font-bold leading-tight">{{ $_theme->metatag('title') }}</h1>
                    <p class="text-xs sm:text-sm opacity-95 leading-tight">{{ $_theme->metatag('subtitle') }}</p>
                </div>
            </a>
            <div class="hidden md:flex items-center gap-3">
                <span class="text-sm opacity-95 sr-only md:not-sr-only">Seguici su</span>
                @foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $social)
                    <a href="#" class="p-2 hover:bg-white hover:bg-opacity-10 rounded-full agid-transition agid-focus focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Segui su {{ ucfirst($social) }} - si apre in una nuova finestra" target="_blank" rel="noopener noreferrer">
                        @if($social === 'facebook')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        @elseif($social === 'twitter')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        @elseif($social === 'instagram')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.619 5.367 11.987 11.988 11.987s11.987-5.368 11.987-11.987C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.542-3.293-1.411-.845-.869-1.293-2.018-1.293-3.315s.448-2.446 1.293-3.315c.845-.869 1.996-1.411 3.293-1.411s2.448.542 3.293 1.411c.845.869 1.293 2.018 1.293 3.315s-.448 2.446-1.293 3.315c-.845.869-1.996 1.411-3.293 1.411zm7.718-6.928c-.845-.869-1.996-1.411-3.293-1.411s-2.448.542-3.293 1.411c-.845.869-1.293 2.018-1.293 3.315s.448 2.446 1.293 3.315c.845.869 1.996 1.411 3.293 1.411s2.448-.542 3.293-1.411c.845-.869 1.293-2.018 1.293-3.315s-.448-2.446-1.293-3.315z"/></svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        @endif
                    </a>
                @endforeach
                <button class="bg-white bg-opacity-20 hover:bg-opacity-30 border-0 rounded-full p-2 agid-focus agid-transition focus:outline-2 focus:outline-white focus:outline-offset-2" style="color: var(--agid-primary);" aria-label="Cerca nel sito" type="button">
                    <x-heroicon-o-magnifying-glass class="w-5 h-5" aria-hidden="true" />
                </button>
            </div>
        </div>
    </div>

    {{-- Navigazione --}}
    <nav class="hidden md:block border-b" style="background-color: var(--agid-primary-light); border-color: rgba(255,255,255,0.2);" role="navigation" aria-label="Menu principale">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-12 min-h-12">
                @php $nav1 = Arr::first($blocks ?? [], fn($item) => $item->slug == 'nav1'); @endphp
                <ul class="flex items-center gap-3" role="menubar">
                    @if($nav1 && isset($nav1->data['items']) && is_array($nav1->data['items']))
                        @foreach($nav1->data['items'] as $index => $item)
                            <li role="none">
                                <a href="{{ $item['url'] ?? '#' }}" class="text-white text-sm font-medium px-3 py-2 rounded agid-transition agid-focus focus:outline-2 focus:outline-white focus:outline-offset-2 hover:text-opacity-80 hover:bg-white hover:bg-opacity-10" role="menuitem" aria-label="Vai a {{ $item['label'] ?? '' }}">
                                    {{ $item['label'] ?? '' }}
                                </a>
                            </li>
                        @endforeach
                    @else
                        @foreach(['Amministrazione','Novità','Servizi','Vivere il Comune'] as $i => $label)
                            <li role="none"><a href="#" class="text-white text-sm font-medium px-3 py-2 rounded agid-transition agid-focus focus:outline-2 focus:outline-white focus:outline-offset-2 hover:text-opacity-80 hover:bg-white hover:bg-opacity-10" role="menuitem" aria-label="Vai a {{ $label }}">{{ $label }}</a></li>
                        @endforeach
                    @endif
                </ul>
                <ul class="flex items-center gap-3" role="menubar" aria-label="Menu secondario">
                    @foreach(['Iscrizioni','Estate in città','Polizia locale','Tutti gli argomenti'] as $label)
                        <li role="none"><a href="#" class="text-white text-sm font-medium px-3 py-2 rounded agid-transition agid-focus focus:outline-2 focus:outline-white focus:outline-offset-2 hover:text-opacity-80 hover:bg-white hover:bg-opacity-10" role="menuitem" aria-label="Vai a {{ $label }}">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </nav>

    {{-- Mobile menu button --}}
    <div class="md:hidden px-4 py-3 border-t" style="background-color: var(--agid-primary); border-color: rgba(255,255,255,0.2);">
        <button type="button"
                class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white hover:bg-opacity-10 agid-focus transition-all focus:outline-2 focus:outline-white focus:outline-offset-2"
                aria-controls="mobile-menu"
                aria-expanded="false"
                id="mobile-menu-button"
                aria-label="Apri menu principale">
            <span class="sr-only">Apri menu principale</span>
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" id="menu-icon-open">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true" id="menu-icon-close">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <nav class="md:hidden hidden" id="mobile-menu" style="background-color: var(--agid-primary);" role="navigation" aria-label="Menu principale mobile">
        <div class="px-4 py-4 space-y-2 border-t" style="border-color: rgba(255,255,255,0.2);">
            @if($nav1 && isset($nav1->data['items']) && is_array($nav1->data['items']))
                @foreach($nav1->data['items'] as $item)
                <a href="{{ $item['url'] ?? '#' }}"
                   class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2"
                   aria-label="Vai a {{ $item['label'] ?? '' }}">
                    {{ $item['label'] ?? '' }}
                </a>
                @endforeach
            @else
                <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai ad Amministrazione">Amministrazione</a>
                <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Novità">Novità</a>
                <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Servizi">Servizi</a>
                <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Vivere il Comune">Vivere il Comune</a>
            @endif

            <hr class="my-4 opacity-20" role="separator" aria-orientation="horizontal">

            <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Iscrizioni">Iscrizioni</a>
            <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Estate in città">Estate in città</a>
            <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Polizia locale">Polizia locale</a>
            <a href="#" class="block px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-md agid-focus font-medium transition-all focus:outline-2 focus:outline-white focus:outline-offset-2" aria-label="Vai a Tutti gli argomenti">Tutti gli argomenti</a>
        </div>
    </nav>
</header>
