@php
    $brandTitle = trim((string) config('comune.nome', ''));
    if (in_array(mb_strtolower($brandTitle), ['', 'nome comune', 'il mio comune', 'laravel'], true)) {
        $brandTitle = trim((string) config('app.name', 'FixCity')) ?: 'FixCity';
    }
    $brandTagline = trim((string) config('comune.sottotitolo', '')) ?: __('pub_theme::header.center.brand.tagline.label');
    $region = trim((string) config('comune.regione', ''));
    if (in_array(mb_strtolower($region), ['', 'regione', 'nome della regione'], true)) $region = '';
    $homeUrl = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/');
    $loginUrl = route('login');
    $navConfig = [];
    $navPath = app(\Modules\Tenant\Actions\Config\GetTenantFilePathAction::class)->execute('database/content/sections/header.json');
    if (is_string($navPath) && file_exists($navPath)) {
        $navConfig = \Illuminate\Support\Facades\File::json($navPath);
    }
    $labelKeys = ['amministrazione' => 'amministrazione', 'novita' => 'novita', 'servizi' => 'servizi', 'vivere-il-comune' => 'vivere', 'iscrizioni' => 'iscrizioni', 'estate-in-citta' => 'estate', 'polizia-locale' => 'polizia'];
    $navItems = collect($navConfig['sections']['primary_nav']['items'] ?? [])->filter(fn ($item) => ($item['enabled'] ?? true) && ($item['visible'] ?? true))->sortBy('order')->map(function (array $item) use ($labelKeys): array {
        $key = $labelKeys[(string) ($item['id'] ?? '')] ?? null;
        $item['label'] = $key ? __('pub_theme::header.center.nav.'.$key.'.label') : (string) ($item['label'] ?? '');
        $path = (string) ($item['url'] ?? '/');
        $segments = array_values(array_filter(explode('/', trim((string) parse_url($path, PHP_URL_PATH), '/'))));
        if ($segments !== [] && in_array($segments[0], array_keys(config('laravellocalization.supportedLocales', [])), true)) array_shift($segments);
        $item['href'] = url('/'.app()->getLocale().'/'.(match ($segments[0] ?? '') { 'servizi', 'lista-categorie' => 'services', 'novita' => 'news', 'amministrazione' => 'administration', 'eventi', 'vivere-il-comune' => 'events', default => $segments[0] ?? '' }));
        return $item;
    })->values();
    try { $locales = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales(); } catch (\Throwable) { $locales = ['it' => ['native' => 'Italiano'], 'en' => ['native' => 'English']]; }
    $locale = app()->getLocale();
@endphp

<header class="border-b border-slate-200 bg-white text-slate-950 shadow-sm" x-data="{ mobileOpen: false, languageOpen: false, userOpen: false }">
    <div class="bg-emerald-950 text-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-2 text-sm sm:px-6 lg:px-8">
            @if ($region !== '')<a class="underline decoration-white underline-offset-4 hover:text-emerald-100 focus:outline-none focus:ring-2 focus:ring-white" href="{{ config('comune.regione_url') }}">{{ $region }}</a>@else<span></span>@endif
            <div class="flex items-center gap-2">
                <div class="relative" @click.outside="languageOpen = false">
                    <button type="button" class="inline-flex min-h-10 items-center gap-1 rounded-lg px-3 py-2 font-semibold hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white" @click="languageOpen = !languageOpen" :aria-expanded="languageOpen.toString()" aria-haspopup="true"><span class="sr-only">{{ __('pub_theme::header.language.active_prefix.label') }}</span>{{ strtoupper(substr($locale, 0, 2)) }}<span aria-hidden="true">⌄</span></button>
                    <div x-cloak x-show="languageOpen" class="absolute right-0 z-40 mt-1 min-w-32 rounded-lg bg-white p-1 text-slate-950 shadow-xl ring-1 ring-slate-200" role="menu">
                        @foreach ($locales as $code => $_meta)
                            <a class="block rounded-md px-3 py-2 font-semibold hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($code) }}" role="menuitem" @if ($code === $locale) aria-current="page" @endif>{{ strtoupper(substr((string) $code, 0, 2)) }}</a>
                        @endforeach
                    </div>
                </div>
                @guest
                    <a class="inline-flex min-h-10 items-center rounded-lg bg-white px-3 py-2 font-semibold text-emerald-950 hover:bg-emerald-50 focus:outline-none focus:ring-2 focus:ring-white" href="{{ $loginUrl }}">{{ __('pub_theme::header.guest.cta.label') }}</a>
                @else
                    <div class="relative" @click.outside="userOpen = false">
                        <button type="button" class="inline-flex min-h-10 items-center rounded-lg px-3 py-2 font-semibold hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white" @click="userOpen = !userOpen" :aria-expanded="userOpen.toString()" aria-haspopup="true">{{ auth()->user()->name ?? auth()->user()->email }} <span class="ml-1" aria-hidden="true">⌄</span></button>
                        <div x-cloak x-show="userOpen" class="absolute right-0 z-40 mt-1 min-w-56 rounded-lg bg-white p-2 text-slate-950 shadow-xl ring-1 ring-slate-200" role="menu">
                            <a class="block rounded-md px-3 py-2 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ route('dashboard') }}" role="menuitem">{{ __('pub_theme::header.user.dropdown.my_practices.label') }}</a>
                            <a class="block rounded-md px-3 py-2 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ route('profile.edit') }}" role="menuitem">{{ __('pub_theme::header.user.dropdown.settings.label') }}</a>
                            <form method="POST" action="{{ url('/'.app()->getLocale().'/auth/logout') }}">@csrf<button class="block w-full rounded-md px-3 py-2 text-left hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-800" type="submit">{{ __('pub_theme::header.user.dropdown.logout.label') }}</button></form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>

    <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-5 sm:px-6 lg:px-8">
        <a class="flex min-w-0 items-center gap-3 rounded-lg focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $homeUrl }}">
            <img class="h-14 w-14 shrink-0 object-contain" src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}" alt="">
            <span class="min-w-0"><span class="block truncate text-xl font-bold text-slate-950 sm:text-2xl">{{ $brandTitle }}</span><span class="hidden text-sm text-slate-700 sm:block">{{ $brandTagline }}</span></span>
        </a>
        <div class="flex items-center gap-2">
            <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-lg border border-slate-300 text-slate-800 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-sky-800/20" @click="$dispatch('open-search')" aria-label="{{ __('pub_theme::header.center.search.toggle_aria.label') }}"><svg aria-hidden="true" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"></circle><path d="m20 20-4-4"></path></svg></button>
            <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-lg border border-slate-300 text-slate-800 hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-sky-800/20 lg:hidden" @click="mobileOpen = !mobileOpen" :aria-expanded="mobileOpen.toString()" aria-controls="sixteen-primary-nav" aria-label="{{ __('pub_theme::header.center.nav.toggle_aria.label') }}"><svg aria-hidden="true" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
        </div>
    </div>

    <nav id="sixteen-primary-nav" class="border-t border-slate-200" aria-label="{{ __('pub_theme::header.center.nav.primary_aria.label') }}" :class="mobileOpen ? 'block' : 'hidden lg:block'">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <ul class="flex flex-col gap-1 py-2 lg:flex-row lg:flex-wrap lg:items-center lg:gap-2">
                @foreach ($navItems as $item)
                    <li><a class="block rounded-lg px-4 py-3 font-semibold text-slate-800 transition hover:bg-sky-50 hover:text-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $item['href'] }}" @if (request()->is(trim(parse_url($item['href'], PHP_URL_PATH), '/'))) aria-current="page" @endif>{{ $item['label'] }}</a></li>
                @endforeach
                <li class="lg:ml-auto"><a class="block rounded-lg px-4 py-3 font-semibold text-sky-900 underline decoration-slate-400 underline-offset-4 hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/segnalazioni') }}">{{ __('pub_theme::segnalazione.elenco.title') }}</a></li>
            </ul>
        </div>
    </nav>
</header>
