{{--
    Vestito Tailwind dell'header (`tpl` default via header/v1).
    Contenuto (slogan, link, lingue, account, social, search): SOLO da sections/header.json
    via <x-section slug="header">. Qui solo markup + localizzazione path (FrontofficeUrl).
--}}
@props(['blocks' => []])

@php
    $headerData = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $headerData = array_merge($headerData, $blockData);
        }
    }
    $d = static fn (string $key, mixed $default = '') => data_get($headerData, $key, $default);
    $href = static function (?string $url): ?string {
        $raw = trim((string) ($url ?? ''));
        if ($raw === '' || $raw === '#') {
            return null;
        }
        $resolved = \Themes\Sixteen\Infrastructure\Url\FrontofficeUrl::fromStoredUrl($raw);

        return ($resolved !== '' && $resolved !== '#') ? $resolved : null;
    };

    $brand = is_array($d('brand', [])) ? $d('brand', []) : [];
    $region = is_array($d('region', [])) ? $d('region', []) : [];
    // DCP-289: regione e social arrivano solo dall'ente (config('ente')); se il dato manca la voce sparisce.
    $ente = app(\Modules\Tenant\Actions\Ente\GetEnteDataAction::class)->execute();
    $regionLink = \Themes\Sixteen\Presentation\Accessibility\RegionPortalLinkLabels::resolve([...$region, 'name' => $ente->region_name]);
    $regionHref = $ente->region_url !== '' ? $ente->region_url : null;
    $utilityLinks = is_array($d('utility_links', [])) ? $d('utility_links', []) : [];
    $account = is_array($d('account', [])) ? $d('account', []) : [];
    $accountHref = $href((string) ($account['url'] ?? ''));
    $navigation = is_array($d('navigation', [])) ? $d('navigation', []) : [];
    $secondaryNavigation = is_array($d('secondary_navigation', [])) ? $d('secondary_navigation', []) : [];
    $socialLinks = $ente->social;
    $languages = is_array($d('languages.items', [])) ? $d('languages.items', []) : [];
    $locale = app()->getLocale();
    $currentLocaleLabel = collect($languages)->firstWhere('locale', $locale)['label'] ?? strtoupper($locale);
    $brandLogo = (string) ($brand['logo'] ?? '');
    if ($brandLogo !== '' && ! str_starts_with($brandLogo, '/') && ! str_starts_with($brandLogo, 'http://') && ! str_starts_with($brandLogo, 'https://')) {
        $brandLogo = asset($brandLogo);
    }
    $brandName = (string) ($brand['header_title'] ?? $brand['name'] ?? '');
    $brandTagline = (string) ($brand['tagline'] ?? '');
    $homeHref = $href((string) ($brand['url'] ?? ''));
    $localeUrl = static function (string $code) use ($languages): string {
        $locales = array_column($languages, 'locale');
        $segments = explode('/', trim(request()->path(), '/'));
        if (in_array($segments[0] ?? '', $locales, true)) {
            $segments[0] = $code;
        } else {
            array_unshift($segments, $code);
        }

        return url(implode('/', $segments));
    };
@endphp

<header class="design-comuni-header" x-data="{ open: false }">
    <div class="bg-[#004d3a] text-white">
        <div class="mx-auto flex min-h-12 max-w-[1296px] items-center justify-between px-4 text-sm lg:px-6">
            @if ($regionLink['name'] === '')
                {{-- DCP-289: senza il nome della regione dall'ente la voce sparisce; la barra resta per lingua e accesso. --}}
            @elseif ($regionHref)
                <a href="{{ $regionHref }}" class="!text-white no-underline hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white" @if ($regionLink['aria_label']) aria-label="{{ $regionLink['aria_label'] }}" @endif @if ($regionLink['title']) title="{{ $regionLink['title'] }}" @endif>{{ $regionLink['name'] }}</a>
            @else
                <span class="!text-white">{{ $regionLink['name'] }}</span>
            @endif
            <div class="ml-auto flex items-center gap-4">
                @if ($languages !== [])
                    <div class="relative inline-block" x-data="{ open: false }" @keydown.escape.window="open = false">
                        <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center gap-1 rounded px-2 text-white no-underline hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" @click="open = !open" :aria-expanded="open" aria-haspopup="true" aria-controls="site-language-menu" aria-label="{{ $d('languages.active_label') }}">
                            <span class="hidden sm:inline" aria-hidden="true">{{ $d('languages.active_label') }}</span> {{ $currentLocaleLabel }}
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div id="site-language-menu" class="absolute right-0 top-full z-50 mt-1 min-w-[120px] rounded-md border border-slate-200 bg-white text-slate-800 shadow-lg" x-show="open" @click.outside="open = false" x-cloak role="menu" aria-label="{{ $d('languages.active_label') }}">
                            <ul class="py-1 text-left text-sm">
                                @foreach ($languages as $language)
                                    <li>
                                        <a href="{{ $localeUrl($language['locale']) }}" role="menuitem" class="flex min-h-11 items-center px-3 py-2 text-slate-700 no-underline hover:bg-slate-100 hover:text-[#007a52] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#007a52]" @if ($locale === ($language['locale'] ?? '')) aria-current="true" @endif>
                                            {{ $language['label'] ?? '' }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if ($accountHref !== null && filled($account['login_label'] ?? $account['label'] ?? null))
                <a href="{{ $accountHref }}" aria-label="{{ $account['login_label'] ?? $account['label'] }}" class="inline-flex min-h-12 items-center gap-2 rounded bg-[#006b4f] px-4 font-semibold !text-white no-underline transition-colors hover:bg-[#00805b] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7v1a4 4 0 01-4 4H9a4 4 0 01-4-4V7m8 0V5a4 4 0 10-8 0v2m8 0h2a2 2 0 012 2v5m-2 5H9a2 2 0 01-2-2V9m0 0h10"></path></svg>
                    <span class="hidden sm:inline">{{ $account['login_label'] ?? $account['label'] ?? '' }}</span>
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-[#007a52] text-white">
        <div class="mx-auto max-w-[1296px] px-4 lg:px-6">
            <div class="flex min-h-[126px] items-center justify-between gap-6 py-6">
                <a href="{{ $homeHref }}" class="!no-underline flex min-w-0 items-center gap-4 !text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" @if (filled($brand['link_title'] ?? null)) title="{{ $brand['link_title'] }}" @endif>
                    @if ($brandLogo !== '')
                        <img src="{{ $brandLogo }}" alt="{{ $brandName }}" class="h-20 w-16 shrink-0 object-contain" width="64" height="80">
                    @endif
                    <span class="min-w-0">
                        <span class="block truncate text-2xl font-bold leading-tight !text-white sm:text-3xl">{{ $brandName }}</span>
                        @if ($brandTagline !== '')
                            <span class="block text-sm !text-white/90">{{ $brandTagline }}</span>
                        @endif
                    </span>
                </a>
                <div class="hidden items-center gap-5 lg:flex">
                    @if ($socialLinks !== [])
                        <span class="!text-white text-sm">{{ $d('follow_us') }}</span>
                        @foreach ($socialLinks as $social)
                            @php $socialHref = $social['url']; @endphp
                            @if ($socialHref)
                                <a href="{{ $socialHref }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 w-11 items-center justify-center rounded-full !text-white no-underline transition-colors hover:bg-white/15 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" aria-label="{{ $social['label'] ?? '' }}">
                                    <span class="sr-only">{{ $social['label'] ?? '' }}</span>
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="8"/></svg>
                                </a>
                            @endif
                        @endforeach
                    @endif
                    @if (filled($d('search.label')) || filled($d('search.aria_label')))
                        <div class="ml-2 flex items-center gap-2">
                            @if (filled($d('search.label')))
                                <span class="text-sm font-semibold text-white">{{ $d('search.label') }}</span>
                            @endif
                            <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white text-[#007a52] transition-colors hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" aria-label="{{ $d('search.aria_label') ?: $d('search.label') }}" @click="$dispatch('open-search')">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><line x1="21" y1="21" x2="15.64" y2="15.64" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line></svg>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center rounded border border-white text-white transition-colors hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40 lg:hidden" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="{{ $d('menu.toggle_label') }}" @click="open = !open">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="3" y1="6" x2="21" y2="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="3" y1="18" x2="21" y2="18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line></svg>
                </button>
            </div>

            <div class="hidden items-center justify-between gap-8 pb-5 lg:flex">
                <nav aria-label="{{ $d('menu.main_label') }}" class="flex flex-wrap gap-x-8 gap-y-2">
                    @foreach ($navigation as $item)
                        @php $itemHref = $href((string) ($item['url'] ?? '')); @endphp
                        @if ($itemHref)
                            <a href="{{ $itemHref }}" class="!no-underline text-lg font-semibold !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] ?? '' }}</a>
                        @endif
                    @endforeach
                </nav>
                <nav aria-label="{{ $d('menu.secondary_label') }}" class="flex flex-wrap justify-end gap-x-8 gap-y-2 text-sm">
                    @foreach ($secondaryNavigation as $item)
                        @php $itemHref = $href((string) ($item['url'] ?? '')); @endphp
                        @if ($itemHref)
                            <a href="{{ $itemHref }}" class="!no-underline !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] ?? '' }}</a>
                        @endif
                    @endforeach
                    @foreach ($utilityLinks as $item)
                        @php $itemHref = $href((string) ($item['url'] ?? '')); @endphp
                        @if ($itemHref)
                            <a href="{{ $itemHref }}" class="!no-underline !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] ?? '' }}</a>
                        @endif
                    @endforeach
                </nav>
            </div>

            <div id="mobile-navigation" x-show="open" x-cloak class="border-t border-white/30 pb-5 pt-4 lg:hidden">
                <nav aria-label="{{ $d('menu.main_label') }}" class="grid gap-3">
                    @foreach ($navigation as $item)
                        @php $itemHref = $href((string) ($item['url'] ?? '')); @endphp
                        @if ($itemHref)
                            <a href="{{ $itemHref }}" class="!no-underline text-lg font-semibold !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] ?? '' }}</a>
                        @endif
                    @endforeach
                    @foreach ($secondaryNavigation as $item)
                        @php $itemHref = $href((string) ($item['url'] ?? '')); @endphp
                        @if ($itemHref)
                            <a href="{{ $itemHref }}" class="!no-underline !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] ?? '' }}</a>
                        @endif
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</header>
