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
                    @if(auth()->check())
                    <div x-data="{ dropdownOpen: false }" class="relative flex-shrink-0 sm:p-0 sm:flex sm:w-auto sm:bg-transparent sm:items-center sm:ml-1.5" x-cloak>
                        <button @click="dropdownOpen=!dropdownOpen" class="inline-flex items-center justify-between w-full sm:px-3.5 sm:py-2 py-2.5 px-4 text-sm font-medium text-gray-500 transition duration-0 bg-white border-transparent rounded-full hover:bg-slate-200/50 dark:text-white/70 dark:hover:text-gray-100 dark:bg-transparent dark:hover:bg-gray-800/70 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            <div class="flex items-center">
                                <img src="{{ Auth::user()->avatar ?? 'https://www.gravatar.com/avatar/'.md5(Auth::user()->email) }}" alt="avatar" class="w-8 h-8 rounded-full mr-2" />
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <svg class="w-4 h-4 fill-current ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                        <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 sm:scale-95" x-transition:enter-end="transform opacity-100 sm:scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 sm:scale-100" x-transition:leave-end="transform opacity-0 sm:scale-95" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg" x-cloak>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Modifica profilo</a>
                            <a href="{{ route('user.services') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Servizi</a>
                            <a href="{{ route('user.practices') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Pratiche</a>
                            <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Notifiche</a>
                            <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Impostazioni</a>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">Accedi all'area personale</a>
                @endif

                    

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

            </div>
        </div>
    </div>
</header>