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
{{--
    Footer full/v1 — vestito Tailwind.
    SSoT: footer.json via <x-section slug="footer">. Solo markup + FrontofficeUrl.
--}}
@php
    $configuredBlock = collect($blocks)->first();
    $configuredData = is_object($configuredBlock)
        ? ($configuredBlock->data ?? [])
        : (is_array($configuredBlock) ? ($configuredBlock['data'] ?? []) : []);

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
    $value = static function (mixed $value, string $fallback = '') use ($locale): string {
        if (is_array($value)) {
            return (string) ($value[$locale] ?? $value['it'] ?? reset($value) ?: $fallback);
        }

        return trim((string) $value) !== '' ? (string) $value : $fallback;
    };
    $localize = static function (string $path): string {
        $path = trim($path);
        if ($path === '' || $path === '#') {
            return '';
        }

        return \Themes\Sixteen\Support\FrontofficeUrl::fromStoredUrl($path);
    };
    $hasUrl = static function (mixed $item): bool {
        if (! is_array($item)) {
            return false;
        }
        $url = trim((string) ($item['url'] ?? ''));

        return $url !== '' && $url !== '#';
    };

    $brand = is_array($brand) ? $brand : [];
    $columns = is_array($columns) ? $columns : [];
    $contact = is_array($contact) ? $contact : [];
    $legal = array_values(array_filter(is_array($legal_links) ? $legal_links : [], $hasUrl));
    $social = array_values(array_filter(is_array($social) ? $social : [], $hasUrl));
    $footer_bottom_links = array_values(array_filter(is_array($footer_bottom_links) ? $footer_bottom_links : [], $hasUrl));
    $contactLinks = array_values(array_filter(is_array($contact['links'] ?? null) ? $contact['links'] : [], $hasUrl));
@endphp

<footer id="footer" class="border-t border-slate-700 bg-slate-950 !text-slate-100" role="contentinfo">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:min-h-[714px] lg:px-8">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div>
                <a class="inline-flex items-start gap-3 rounded-lg !text-white no-underline focus:outline-none focus-visible:ring-4 focus-visible:ring-white/60" href="{{ $localize('/') }}">
                    @if (filled($brand['logo'] ?? null))
                        <img class="h-12 w-12 object-contain" src="{{ asset((string) $brand['logo']) }}" alt="">
                    @endif
                    <span>
                        <span class="block text-xl font-bold !text-white">{{ $value($brand['name'] ?? null) }}</span>
                        @if (filled($brand['description'] ?? null))
                            <span class="mt-2 block max-w-xs text-sm leading-6 !text-slate-200">{{ $value($brand['description'] ?? null) }}</span>
                        @endif
                    </span>
                </a>
            </div>
            @foreach ($columns as $column)
                @php
                    $colLinks = array_values(array_filter(is_array($column['links'] ?? null) ? $column['links'] : [], $hasUrl));
                @endphp
                @if ($colLinks !== [])
                    <div>
                        <h2 class="!text-white text-lg font-bold">{{ $value($column['title'] ?? null) }}</h2>
                        <ul class="mt-4 space-y-3">
                            @foreach ($colLinks as $link)
                                <li>
                                    <a class="!text-slate-100 underline decoration-slate-400 underline-offset-4 hover:!text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '')) }}">{{ $value($link['label'] ?? null) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
        @if ($contact !== [] && (filled($contact['title'] ?? null) || $contactLinks !== [] || filled($contact['address'] ?? null)))
            <div class="mt-10 grid gap-6 border-t border-white/20 pt-8 md:grid-cols-2">
                <div>
                    @if (filled($contact['title'] ?? null))
                        <h2 class="!text-white text-lg font-bold">{{ $value($contact['title'] ?? null) }}</h2>
                    @endif
                    @if (filled($contact['address'] ?? null) || filled($contact['email'] ?? null) || filled($contact['phone'] ?? null))
                        <address class="mt-3 text-sm not-italic leading-6 text-slate-300">
                            {{ $value($contact['address'] ?? null) }}
                            @if (filled($contact['email'] ?? null))
                                <br><a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="mailto:{{ $contact['email'] }}">{{ $contact['email'] }}</a>
                            @endif
                            @if (filled($contact['phone'] ?? null))
                                <br><a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="tel:{{ preg_replace('/[^0-9+]/', '', (string) $contact['phone']) }}">{{ $contact['phone'] }}</a>
                            @endif
                        </address>
                    @endif
                </div>
                <div>
                    @if (filled($contact['office'] ?? null))
                        <h3 class="!text-white text-sm font-bold">{{ $value($contact['office'] ?? null) }}</h3>
                    @endif
                    @if ($contactLinks !== [])
                        <ul class="mt-3 space-y-2">
                            @foreach ($contactLinks as $link)
                                <li>
                                    <a class="underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '')) }}" @if (! empty($link['data_element'])) data-element="{{ $link['data_element'] }}" @endif>{{ $value($link['label'] ?? null) }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endif
        @if ($social !== [])
            <div class="mt-8 flex flex-wrap gap-4 border-t border-white/20 pt-6">
                @foreach ($social as $item)
                    <a class="text-slate-300 underline decoration-white/40 underline-offset-4 hover:text-white hover:decoration-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) $item['url']) }}" @if (str_starts_with((string) $item['url'], 'http')) target="_blank" rel="noopener noreferrer" @endif aria-label="{{ $value($item['label'] ?? null) }}">{{ $value($item['label'] ?? null) }}</a>
                @endforeach
            </div>
        @endif
    </div>
    <div class="border-t border-white/20">
        <div class="mx-auto flex max-w-7xl flex-wrap gap-x-6 gap-y-2 px-4 py-5 text-sm !text-slate-200 sm:px-6 lg:px-8">
            @foreach ($legal as $link)
                <a class="underline underline-offset-4 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '')) }}">{{ $value($link['label'] ?? null) }}</a>
            @endforeach
            @foreach ($footer_bottom_links as $link)
                <a class="underline underline-offset-4 hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-white" href="{{ $localize((string) ($link['url'] ?? '')) }}" @if (! empty($link['preferences'])) data-cookie-preferences data-element="cookie-preferences" @endif>{{ $value($link['label'] ?? null) }}</a>
            @endforeach
            @if (filled($copyright))
                <span class="ml-auto">{{ $value($copyright) }}</span>
            @endif
        </div>
    </div>
</footer>
