@props(['data' => []])

@php
    use Illuminate\Support\Str;
    use Modules\Fixcity\Enums\TicketStatusEnum;
    use Modules\Fixcity\ViewModels\SegnalazioniFilterViewModel;

    $ns = 'pub_theme::segnalazione';
    $blockData = is_array($data) ? $data : [];
    $phoneNumber = (string) ($blockData['phone'] ?? '05 0505');
    $t = function ($value, $default = '') use ($phoneNumber) {
        if (empty($value)) return $default;
        $resolved = str_contains((string) $value, '::') ? __((string) $value) : (string) $value;
        return str_replace(':phone', $phoneNumber, $resolved);
    };

    $breadcrumbItems = collect($blockData['breadcrumb'] ?? [])->map(fn ($item): array => [
        'label' => $t($item['label'] ?? ''), 'url' => $item['url'] ?? null, 'active' => $item['active'] ?? false,
    ])->all();
    $title = $t($blockData['title'] ?? '', __($ns.'.heading.title.label'));
    $subtitle = $t($blockData['subtitle'] ?? '', __($ns.'.heading.subtitle.text', ['count' => 73]));
    $tabs = collect($blockData['tabs']['items'] ?? [])->map(fn ($tab): array => [
        'id' => $tab['id'] ?? 'map', 'label' => $t($tab['label'] ?? ''), 'active' => $tab['active'] ?? false,
    ])->values()->all();
    $mainContent = $blockData['main_content'] ?? [];
    $selectedTypes = request()->collect('types')->filter(static fn ($type): bool => is_string($type) && $type !== '')->values()->all();
    $baseTicketsQuery = \Modules\Fixcity\Models\Ticket::query();
    $currentUserId = auth()->id();
    if ($currentUserId !== null) {
        $baseTicketsQuery->where(function ($query) use ($currentUserId): void {
            $query->whereIn('status', TicketStatusEnum::canViewByAll())->orWhere('created_by', $currentUserId)->orWhere('updated_by', $currentUserId);
        });
    } else {
        $baseTicketsQuery->whereIn('status', TicketStatusEnum::canViewByAll());
    }
    $filterViewModel = new SegnalazioniFilterViewModel();
    $filters = [
        'title' => $t($blockData['filters']['title'] ?? '', __($ns.'.filters.legend.label')),
        'items' => $filterViewModel->getFilterItems(), 'total' => $filterViewModel->getTotalCount(),
    ];
    $filteredTicketsQuery = clone $baseTicketsQuery;
    if ($selectedTypes !== []) $filteredTicketsQuery->whereIn('type', $selectedTypes);
    $liveTickets = $filteredTicketsQuery->latest()->take(20)->get();
    $resultsCount = $filterViewModel->getFilteredCount($selectedTypes);
    $filterItemsAttr = e(json_encode($filters['items'], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
    $selectedTypesAttr = e(json_encode($selectedTypes, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
    $cta = ($mainContent['cta'] ?? []) !== [] ? [
        'title' => $t($mainContent['cta']['title'] ?? '', __($ns.'.map.cta.title.label')),
        'text' => $t($mainContent['cta']['text'] ?? '', __($ns.'.map.cta.text.label')),
        'button_text' => $t($mainContent['cta']['button_text'] ?? '', __($ns.'.map.cta.button.label')),
    ] : [];
    $contactsData = $blockData['contacts'] ?? [];
    $contacts = $contactsData !== [] ? [
        'contact_title' => $t($contactsData['contact_title'] ?? '', __($ns.'.contacts.title.label')),
        'contacts' => collect($contactsData['contacts'] ?? [])->map(fn ($contact): array => ['label' => $t($contact['label'] ?? ''), 'url' => $contact['url'] ?? '#'])->all(),
    ] : [];
    $tabsSectionId = $blockData['tabs']['id'] ?? 'map-and-list';
    $filtersSectionId = $mainContent['id'] ?? 'filter-and-cards';
@endphp

<div id="segnalazioni-elenco-root" class="bg-slate-50" data-section-map="{{ $tabsSectionId }}" data-section-filters="{{ $filtersSectionId }}" role="region" aria-label="{{ $title }}" x-data="{ activeTab: '{{ $tabs[0]['id'] ?? 'map' }}', filterOpen: false }">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12" id="main-container">
        <header class="mb-8 border-b border-slate-200 pb-8">
            <nav aria-label="{{ __('fixcity::global.breadcrumb') }}">
                <ol class="flex flex-wrap gap-2 text-sm text-slate-700" data-element="breadcrumb">
                    @foreach ($breadcrumbItems as $item)
                        <li{{ $item['active'] ? ' aria-current="page"' : '' }}>
                            @if ($item['url'])<a class="underline decoration-slate-400 underline-offset-4 hover:text-sky-800" href="{{ $item['url'] }}">{{ $item['label'] }}</a><span class="mx-2" aria-hidden="true">/</span>@else{{ $item['label'] }}@endif
                        </li>
                    @endforeach
                </ol>
            </nav>
            <h1 class="mt-6 text-3xl font-bold tracking-tight text-slate-950 sm:text-4xl">{{ $title }}</h1>
            @if ($subtitle)<p class="mt-3 max-w-3xl text-lg leading-8 text-slate-700">{{ $subtitle }}</p>@endif
        </header>

        <div class="grid gap-8 lg:grid-cols-[minmax(15rem,20rem)_minmax(0,1fr)]">
            @if (!empty($filters['items']))
                <aside class="hidden lg:block" id="{{ $filtersSectionId }}" aria-label="{{ $filters['title'] }}">
                    <map-filter-lit map-id="ticket-map" title="{{ $filters['title'] }}" filters="{{ $filterItemsAttr }}" total="{{ $filters['total'] }}" initial-selected="{{ $selectedTypesAttr }}" results-target="#segnalazioni-results-count" clear-target="#segnalazioni-clear-filters"></map-filter-lit>
                </aside>
            @endif

            <section aria-labelledby="segnalazioni-results-count">
                <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
                    <span id="segnalazioni-results-count" class="font-semibold text-slate-950" data-count-template="{{ __($ns.'.results.count.text', ['count' => ':count']) }}">{{ __($ns.'.results.count.text', ['count' => $resultsCount]) }}</span>
                    @if (!empty($filters['items']))
                        <button type="button" class="min-h-11 rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 lg:hidden" @click="filterOpen = true" aria-controls="modal-categories">{{ __($ns.'.filter.button.label') }}</button>
                        <button type="button" id="segnalazioni-clear-filters" class="hidden min-h-11 rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 lg:block">{{ __($ns.'.filter.remove.label') }}</button>
                    @endif
                </div>

                @if (!empty($tabs))
                    <div class="mt-6 flex border-b border-slate-300" role="tablist" data-section="{{ $tabsSectionId }}">
                        @foreach ($tabs as $index => $tab)
                            <button type="button" class="min-h-12 flex-1 border-b-4 px-4 py-3 text-center font-semibold transition focus:outline-none focus:ring-4 focus:ring-sky-800/20" :class="activeTab === '{{ $tab['id'] }}' ? 'border-sky-800 text-sky-900' : 'border-transparent text-slate-700 hover:border-slate-400'" @click="activeTab = '{{ $tab['id'] }}'" role="tab" aria-controls="data-ex-disservizio{{ $index + 1 }}" :aria-selected="activeTab === '{{ $tab['id'] }}' ? 'true' : 'false'">{{ $tab['label'] }}</button>
                        @endforeach
                    </div>
                @endif

                <div class="mt-6">
                    <div id="data-ex-disservizio1" x-show="activeTab === '{{ $tabs[0]['id'] ?? 'map' }}'" role="tabpanel" tabindex="0">
                        <div class="space-y-8">
                            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm"><map-lit id="ticket-map" data-url="/data/tickets.json" height="clamp(360px,58vh,560px)" class="block w-full" style="height:clamp(360px,58vh,560px)" aria-label="{{ __($ns.'.map.image.alt') }}"></map-lit></div>
                            @if (!empty($cta))
                                <div class="rounded-xl border border-sky-200 bg-sky-50 p-6 sm:p-8"><h2 class="text-2xl font-bold text-slate-950">{{ $cta['title'] }}</h2><p class="mt-3 max-w-2xl leading-7 text-slate-800">{{ $cta['text'] }}</p><a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/create') }}" class="mt-5 inline-flex min-h-12 items-center rounded-lg bg-sky-800 px-5 py-3 font-semibold text-white shadow-sm transition hover:bg-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-800/30">{{ $cta['button_text'] }}</a></div>
                            @endif
                        </div>
                    </div>
                    <div id="data-ex-disservizio2" x-show="activeTab !== '{{ $tabs[0]['id'] ?? 'map' }}'" role="tabpanel" tabindex="0" class="space-y-4">
                        @forelse ($liveTickets as $item)
                            @php $itemLocation = is_array($item->location) ? $item->location : []; $itemAddress = $itemLocation['address'] ?? $itemLocation['display_name'] ?? ''; @endphp
                            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6"><h2 class="text-xl font-bold text-slate-950">{{ $item->name }}</h2><p class="mt-2 text-sm text-slate-700">{{ __($ns.'.card.type.label') }}: {{ $item->type_label }}</p><div x-data="{ open: false }"><button type="button" class="mt-4 min-h-11 rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-800/20" @click="open = !open" :aria-expanded="open.toString()">{{ __($ns.'.card.expand.button.label') }}</button><div x-show="open" x-cloak class="mt-4 border-t border-slate-200 pt-4">@if ($itemAddress)<p class="text-slate-800"><strong>{{ __($ns.'.card.address.label') }}:</strong> {{ $itemAddress }}</p>@endif @if ($item->content)<p class="mt-2 leading-7 text-slate-800"><strong>{{ __($ns.'.card.detail.label') }}:</strong> {{ Str::limit($item->content, 200) }}</p>@endif <a class="mt-4 inline-flex min-h-11 items-center rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/tickets/'.rawurlencode((string) $item->getKey())) }}">{{ __('fixcity::ticket.card.detail.label') }}</a></div></div></article>
                        @empty
                            <p class="rounded-xl border border-slate-200 bg-white p-6 text-slate-700" role="status">{{ __($ns.'.results.empty') }}</p>
                        @endforelse
                    </div>
                </div>
            </section>
        </div>
    </div>

    @include('pub_theme::components.blocks.feedback.rating', ['data' => $blockData['rating'] ?? []])
    @if (!empty($contacts))
        <section id="info-contacts" class="border-t border-slate-200 bg-white px-4 py-10 sm:px-6 lg:px-8" aria-labelledby="contacts-title"><div class="mx-auto max-w-3xl"><h2 id="contacts-title" class="text-2xl font-bold text-slate-950">{{ $contacts['contact_title'] }}</h2><ul class="mt-4 divide-y divide-slate-200 rounded-xl border border-slate-200">@foreach ($contacts['contacts'] as $contact)<li><a class="flex min-h-12 items-center px-4 py-3 font-semibold text-sky-900 underline-offset-4 hover:underline focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $contact['url'] }}">{{ $contact['label'] }}</a></li>@endforeach</ul></div></section>
    @endif
    @if (!empty($filters['items']))
        <div id="modal-categories" x-cloak x-show="filterOpen" class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/60 p-4" role="dialog" aria-modal="true" aria-labelledby="modal-categories-title" @keydown.escape.window="filterOpen = false"><div class="mx-auto mt-8 max-w-lg rounded-xl bg-white p-6 shadow-xl"><div class="flex items-start justify-between gap-4"><h2 id="modal-categories-title" class="text-xl font-bold text-slate-950">{{ $filters['title'] }}</h2><button type="button" class="min-h-11 min-w-11 rounded-lg text-2xl text-slate-700 focus:outline-none focus:ring-4 focus:ring-sky-800/20" @click="filterOpen = false" aria-label="{{ __('Chiudi') }}">&times;</button></div><div class="mt-4"><map-filter-lit map-id="ticket-map" title="" filters="{{ $filterItemsAttr }}" total="{{ $filters['total'] }}" initial-selected="{{ $selectedTypesAttr }}" results-target="#segnalazioni-results-count"></map-filter-lit></div></div></div>
    @endif
</div>

<style>.leaflet-container { z-index: 1; }</style>
