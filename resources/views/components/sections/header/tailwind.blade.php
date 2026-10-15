@props(['blocks' => []])

@php
    $headerData = [];
    foreach ($blocks as $block) {
        $blockData = is_array($block) ? ($block['data'] ?? []) : ($block->data ?? []);
        if (is_array($blockData)) {
            $headerData = array_merge($headerData, $blockData);
        }
    }
    $brand = $headerData['brand'] ?? ['name' => '', 'tagline' => '', 'logo' => ''];
    $region = $headerData['region'] ?? ['name' => '', 'url' => ''];
    $utilityLinks = $headerData['utility_links'] ?? [];
    $account = $headerData['account'] ?? ['label' => '', 'url' => ''];
    $navigation = $headerData['navigation'] ?? [];
    $secondaryNavigation = $headerData['secondary_navigation'] ?? [];
    $social = $headerData['social'] ?? [];
    $brandLogo = (string) ($brand['logo'] ?? '');
    if ($brandLogo !== '' && ! str_starts_with($brandLogo, '/') && ! str_starts_with($brandLogo, 'http://') && ! str_starts_with($brandLogo, 'https://')) {
        $brandLogo = asset($brandLogo);
    }

    $locale = app()->getLocale();
    $availableLocales = ['it' => 'ITA', 'en' => 'ENG'];
    $currentLocaleLabel = $availableLocales[$locale] ?? 'ITA';
    $value = static function (mixed $value, string $fallback = '') use ($locale): string {
        if (is_array($value)) {
            return (string) ($value[$locale] ?? $value['it'] ?? reset($value) ?: $fallback);
        }
        return trim((string) $value) !== '' ? (string) $value : $fallback;
    };
@endphp

@php
    $socialIcons = [
        'twitter' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.996 9.02L24 21.75h-7.84l-5.72-7.37L2.45 21.75H0l8.33-9.5L0 3.25H3.3l8.25 10.54L18.244 2.25Z"/></svg>',
        'facebook' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M22.675 0h-21.35C.592 0 .001.593.001 1.33v21.342C.001 23.408.592 24 1.326 24H12.82v-9.294H9.691V11.01h3.128V8.414c0-3.1 1.894-4.788 4.658-4.788 1.325 0 2.466.099 2.797.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.312h3.587l-.467 3.696h-3.12V24h6.116c.73 0 1.32-.592 1.32-1.33V1.33c0-.738-.589-1.33-1.322-1.33Z"/></svg>',
        'youtube' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M10.77 13.752v-3.496L15.05 12l-4.28 1.752Zm10.45-6.352v15.216c0 1.24.88 2.22 2.17 2.22.62 0 1.15-.19 1.58-.47V7.352c0-1.14-.84-2.23-2.12-2.23h-.03c-.64 0-1.16.17-1.6.47Z"/></svg>',
        'telegram' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.354 3.633c-.957-.733-2.1-.815-3.23-.815-1.17 0-1.73.347-1.73.347l-.05.06c-2.44 2.22-4.37 6.96-4.37 6.96h-.01c-.59 2.05-1.4 4.15-2.33 6.06h-.01c-.42.85-1.06 1.73-1.79 2.39-.19.15-.55.11-.76-.03-.21-.13-.37-.41-.29-.66.01-.01 1.02-2.45 1.17-2.78.93-2.18 1.32-4.29.93-6.04-.02-.06-.03-.08v-.01c-.16-.98-.34-1.77-.45-2.38C7.02 14.19 8.35 18.6 8.7 19.92c.04.14-.05.3-.18.37-1.13.55-2.45.32-3.63-.5-1.16-.82-1.98-1.97-2.3-3.31-.42-1.74-.2-3.42.05-3.8.02-.04.05-.08.07-.12.1-.13.22-.39.16-.57C2.76 11.32 2.2 10.96 1.86 10.51c-.16-.22-.2-.55-.03-.8.15-.21.38-.34.63-.31 0 0 1.93 1.6 3.8 3.24.18.15.43.03.66-.12-.01-2.42-.02-4.57.01-5.45C7.28 6.08 8.28 3.34 11.12 1.32c2.55-1.8 5.8-.88 7.68 1.06.05.05.1.1.14.15l.14.2c.09.15.14.32.14.5Z"/></svg>',
        'whatsapp' => '<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path fill="white" d="M9.3 8.5c.2-.3.5-.3.8-.1l1.1 1c.2.2.2.5 0 .7l-.5.6c.5.9 1.2 1.6 2.1 2.1l.6-.5c.2-.2.5-.2.7 0l1 1.1c.2.3.2.6-.1.8-.5.4-1.1.6-1.7.4-2.7-.8-4.8-2.9-5.6-5.6-.2-.6 0-1.2.4-1.7Z"/></svg>',
    ];
@endphp

<header class="design-comuni-header" x-data="{ open: false, langOpen: false }">
    <div class="bg-[#004d3a] text-white">
        <div class="mx-auto flex min-h-12 max-w-[1296px] items-center justify-between px-4 text-sm lg:px-6">
            <a href="{{ $region['url'] ?: '#' }}" class="!text-white no-underline hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $region['name'] ?: 'Nome della Regione' }}</a>
            <div class="flex items-center gap-4">
                <div class="relative inline-block" x-data="{ open: false }" @keydown.escape.window="open = false">
                    <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center gap-1 rounded px-2 text-white no-underline hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" @click="open = !open" :aria-expanded="open" aria-haspopup="true" aria-controls="site-language-menu" aria-label="Seleziona lingua">
                        <span class="hidden sm:inline" aria-hidden="true">Lingua:</span> {{ $currentLocaleLabel }}
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div id="site-language-menu" class="absolute right-0 top-full z-50 mt-1 min-w-[120px] rounded-md border border-slate-200 bg-white text-slate-800 shadow-lg" x-show="open" @click.outside="open = false" x-cloak role="menu" aria-label="Lingue disponibili">
                        <ul class="py-1 text-left text-sm">
                            @foreach ($availableLocales as $loc => $label)
                                <li><a href="{{ url()->current() }}?lang={{ $loc }}" role="menuitem" class="flex min-h-11 items-center px-3 py-2 text-slate-700 no-underline hover:bg-slate-100 hover:text-[#007a52] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#007a52]" @if ($locale === $loc) aria-current="true" @endif>{{ $label }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <a href="{{ $account['url'] ?: '#' }}" aria-label="{{ $account['label'] ?: 'Accedi' }}" class="inline-flex min-h-12 items-center gap-2 rounded bg-[#006b4f] px-4 font-semibold !text-white no-underline transition-colors hover:bg-[#00805b] focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7v1a4 4 0 01-4 4H9a4 4 0 01-4-4V7m8 0V5a4 4 0 10-8 0v2m8 0h2a2 2 0 012 2v5m-2 5H9a2 2 0 01-2-2V9m0 0h10"></path></svg>
                    <span class="hidden sm:inline">{{ $account['label'] ?: 'Accedi' }}</span>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-[#007a52] text-white">
        <div class="mx-auto max-w-[1296px] px-4 lg:px-6">
            <div class="flex min-h-[126px] items-center justify-between gap-6 py-6">
                <a href="{{ url('/') }}" class="!no-underline flex min-w-0 items-center gap-4 !text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white">
                    @if($brandLogo !== '')
                        <img src="{{ $brandLogo }}" alt="{{ is_array($brand['name'] ?? null) ? ($brand['name'][$locale] ?? $brand['name']['it'] ?? 'Logo') : (($brand['name'] ?? '') ?: 'Logo') }}" class="h-20 w-16 shrink-0 object-contain" width="64" height="80">
                    @endif
                    <span class="min-w-0">
                    <span class="block truncate text-2xl font-bold leading-tight !text-white sm:text-3xl">{{ $brand['name'] ?: config('app.name', 'Comune') }}</span>
                        <span class="block text-sm !text-white/90">{{ $brand['tagline'] ?? '' }}</span>
                    </span>
                </a>
                <div class="hidden items-center gap-5 lg:flex" aria-label="Collegamenti social">
                    <span class="!text-white text-sm">Seguici su</span>
                    @foreach ($social as $key => $url)
                        @if (!empty($url) && isset($socialIcons[$key]))
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="inline-flex h-11 w-11 items-center justify-center rounded-full !text-white no-underline transition-colors hover:bg-white/15 hover:!text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" aria-label="{{ ucfirst($key) }}">
                                {!! $socialIcons[$key] !!}
                            </a>
                        @endif
                    @endforeach
                    <div class="ml-2 flex items-center gap-2">
                        <span class="text-sm font-semibold text-white">Cerca</span>
                        <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white text-[#007a52] transition-colors hover:bg-slate-100 focus:outline-none focus-visible:ring-2 focus-visible:ring-white" aria-label="Cerca nel sito" @click="$dispatch('open-search')">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><circle cx="11" cy="11" r="8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle><line x1="21" y1="21" x2="15.64" y2="15.64" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line></svg>
                        </button>
                    </div>
                </div>
                <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center rounded border border-white text-white transition-colors hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40 lg:hidden" :aria-expanded="open" aria-controls="mobile-navigation" aria-label="Mostra o nascondi la navigazione" @click="open = !open">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><line x1="3" y1="12" x2="21" y2="12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="3" y1="6" x2="21" y2="6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line><line x1="3" y1="18" x2="21" y2="18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></line></svg>
                </button>
            </div>

            <div class="hidden items-center justify-between gap-8 pb-5 lg:flex">
                <nav aria-label="Principale" class="flex flex-wrap gap-x-8 gap-y-2">
                    @foreach($navigation as $item)
                        <a href="{{ $item['url'] }}" class="!no-underline text-lg font-semibold !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
                <nav aria-label="Secondaria" class="flex flex-wrap justify-end gap-x-8 gap-y-2 text-sm">
                    @foreach($secondaryNavigation as $item)
                        <a href="{{ $item['url'] }}" class="!no-underline !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
            </div>

            <div id="mobile-navigation" x-show="open" x-cloak class="border-t border-white/30 pb-5 pt-4 lg:hidden">
                <nav aria-label="Menu mobile" class="grid gap-3">
                    @foreach($navigation as $item)
                        <a href="{{ $item['url'] }}" class="!no-underline text-lg font-semibold !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] }}</a>
                    @endforeach
                    @foreach($secondaryNavigation as $item)
                        <a href="{{ $item['url'] }}" class="!no-underline !text-white hover:no-underline focus:outline-none focus-visible:ring-2 focus-visible:ring-white">{{ $item['label'] }}</a>
                    @endforeach
                </nav>
            </div>
        </div>
    </div>
</header>
