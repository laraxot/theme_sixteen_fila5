@props([
    'blocks' => [],
    'view' => null,
    'brand' => null,
    'columns' => [],
    'contact' => null,
    'legal_links' => [],
    'social' => [],
    'copyright' => null,
    'footer_bottom_links' => [],
])

@php
    $configuredBlock = collect($blocks)->first();
    $configuredData = is_object($configuredBlock)
        ? ($configuredBlock->data ?? [])
        : (is_array($configuredBlock) ? ($configuredBlock['data'] ?? []) : []);

    // x-section supplies the locale-resolved CMS block; direct props remain a test/fallback API.
    if (is_array($configuredData) && $configuredData !== []) {
        $brand = $configuredData['brand'] ?? $brand;
        $columns = $configuredData['columns'] ?? $columns;
        $contact = $configuredData['contact'] ?? $contact;
        $legal_links = $configuredData['legal_links'] ?? $legal_links;
    $social = $configuredData['social'] ?? $social;
        $copyright = $configuredData['copyright'] ?? $copyright;
        $footer_bottom_links = $configuredData['footer_bottom_links'] ?? $footer_bottom_links;
    }

    $locale = app()->getLocale();
    if ($brand === null && $columns === [] && $contact === null) {
        $english = $locale === 'en';
        $footer = [
            'brand' => ['name' => 'FixCity', 'description' => $english ? 'City reports and services.' : 'Segnalazioni e servizi della città.'],
            'columns' => [
                ['title' => $english ? 'Services' : 'Servizi', 'links' => [
                    ['label' => $english ? 'Submit a report' : 'Invia una segnalazione', 'url' => '/tickets/create'],
                    ['label' => $english ? 'Track a report' : 'Segui una segnalazione', 'url' => '/tickets/track'],
                ]],
                ['title' => $english ? 'Information' : 'Informazioni', 'links' => [
                    ['label' => $english ? 'Frequently asked questions' : 'Domande frequenti', 'url' => '/domande-frequenti'],
                    ['label' => $english ? 'Sitemap' : 'Mappa del sito', 'url' => '/mappa-sito'],
                ]],
            ],
            'legal_links' => [
                ['label' => $english ? 'Privacy' : 'Privacy', 'url' => '/privacy'],
                ['label' => $english ? 'Accessibility' : 'Accessibilità', 'url' => '/accessibilita'],
            ],
        ];
    } else {
        $footer = [
            'brand' => $brand,
            'columns' => $columns,
            'contact' => $contact,
            'legal_links' => $legal_links,
            'social' => $social,
            'copyright' => $copyright,
        ];
    }

    $value = static function (mixed $value, string $fallback = '') use ($locale): string {
        if (is_array($value)) return (string) ($value[$locale] ?? $value['it'] ?? reset($value) ?: $fallback);
        return trim((string) $value) !== '' ? (string) $value : $fallback;
    };
    $localize = static function (string $path): string {
        if ($path === '' || str_starts_with($path, '#') || preg_match('/^https?:\\/\\//', $path)) return $path === '' ? url('/') : $path;
        try { return \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/'.ltrim($path, '/')); } catch (\Throwable) { return url('/'.ltrim($path, '/')); }
    };

    $brand = is_array($footer['brand'] ?? null) ? $footer['brand'] : [];
    $columns = is_array($footer['columns'] ?? null) ? $footer['columns'] : [];
    $contact = is_array($footer['contact'] ?? null) ? $footer['contact'] : [];
    $legal = is_array($footer['legal_links'] ?? null) ? $footer['legal_links'] : [];
    $social = is_array($footer['social'] ?? null) ? $footer['social'] : [];
@endphp

<footer id="footer" class="border-t border-slate-700 bg-slate-950 !text-slate-100" role="contentinfo">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:min-h-[714px] lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div><a class="inline-flex items-start gap-3 rounded-lg !text-white no-underline focus:outline-none focus-visible:ring-4 focus-visible:ring-white/60" href="{{ $localize('/') }}"><img class="h-12 w-12 object-contain" src="{{ asset((string) ($brand['logo'] ?? 'themes/Sixteen/design-comuni/assets/images/logo-comune.svg')) }}" alt=""><span><span class="block text-xl font-bold !text-white">{{ $value($brand['name'] ?? null, config('app.name', 'Comune')) }}</span><span class="mt-2 block max-w-xs text-sm leading-6 !text-slate-200">{{ $value($brand['description'] ?? null, 'Servizi e informazioni del Comune.') }}</span></span></a></div>
            @foreach ($columns as $column)
                <div><h2 class="!text-white text-lg font-bold">{{ $value($column['title'] ?? null) }}</h2><ul class="mt-4 space-y-3">@foreach (($column['links'] ?? []) as $link)<li><a class="!text-slate-100 underline decoration-slate-400 underline-offset-4 hover:!text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '/')) }}">{{ $value($link['label'] ?? null) }}</a></li>@endforeach</ul></div>
            @endforeach
        </div>
        @if ($contact !== [])
            <div class="mt-10 grid gap-6 border-t border-white/20 pt-8 md:grid-cols-2">
                <div>
                    <h2 class="!text-white text-lg font-bold">{{ $value($contact['title'] ?? null, 'Contatti') }}</h2>
                     <address class="mt-3 text-sm not-italic leading-6 text-slate-300">{{ $value($contact['address'] ?? null) }}<br>@if (!empty($contact['email']))<a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a><br>@endif @if (!empty($contact['phone']))<a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="tel:{{ preg_replace('/[^0-9+]/', '', (string) $contact['phone']) }}">{{ $contact['phone'] }}</a>@endif</address>
                </div>
                <div>
                    @if (!empty($contact['office']))
                        <h3 class="!text-white text-sm font-bold">{{ $value($contact['office'] ?? null) }}</h3>
                    @endif
                    @if (!empty($contact['links']))
                        <ul class="mt-3 space-y-2">
                            @foreach ($contact['links'] as $link)
                                <li><a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '/')) }}" @if (!empty($link['data_element'])) data-element="{{ $link['data_element'] }}" @endif>{{ $value($link['label'] ?? null) }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endif
        @php
            $social = array_values(array_filter($social, static fn (mixed $item): bool => is_array($item) && trim((string) ($item['url'] ?? '')) !== ''));
        @endphp
        @if ($social !== [])
            <div class="mt-8 flex flex-wrap gap-4 border-t border-white/20 pt-6">@foreach ($social as $item)<a class="text-slate-300 underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) $item['url']) }}" @if (str_starts_with((string) $item['url'], 'http')) target="_blank" rel="noopener noreferrer" @endif aria-label="{{ $value($item['label'] ?? null) }}">{{ $value($item['label'] ?? null) }}</a>@endforeach</div>
        @endif
    </div>
    <div class="border-t border-white/20">
        <div class="mx-auto flex max-w-7xl flex-wrap gap-x-6 gap-y-2 px-4 py-5 text-sm !text-slate-200 sm:px-6 lg:px-8">
            @foreach ($legal as $link)
                <a class="underline underline-offset-4 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '/')) }}">{{ $value($link['label'] ?? null) }}</a>
            @endforeach
            @if (!empty($footer_bottom_links))
                @foreach ($footer_bottom_links as $link)
                    <a class="underline underline-offset-4 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '/')) }}">{{ $value($link['label'] ?? null) }}</a>
                @endforeach
            @endif
            <span class="ml-auto">{{ $value($footer['copyright'] ?? null, '© '.date('Y').' '.config('app.name', 'Comune')) }}</span>
        </div>
    </div>
</footer>
