@props(['data' => []])

@php
    use Modules\Fixcity\ViewModels\TicketLayoutViewModel;
    $vm = app(TicketLayoutViewModel::class, ['data' => $data]);
    $ns = 'fixcity::ticket';
    $initialSelectedTypes = $vm->selectedTypes();
    $initialSelectedStatuses = $vm->selectedStatuses();
    $hasSidebarFilters = $vm->hasSidebarFilters();
@endphp

{{-- Design Comuni reference: https://italia.github.io/design-comuni-pagine-statiche/sito/ticket-list.html --}}
<div class="bg-slate-50" id="main-container" x-data="{ activeTab: '{{ $vm->defaultActiveTab() }}', filterOpen: false }">

{{-- Alpine: sync desktop ↔ modale; app.js applica filtro mappa su filter-types-updated --}}
<div x-data="{
    dispatchMapFilters() {
        const selectedTypes = [];
        document.querySelectorAll('[data-filter-type]:checked').forEach(function (cb) {
            selectedTypes.push(cb.value);
        });
        const selectedStatuses = [];
        document.querySelectorAll('[data-filter-status]:checked').forEach(function (cb) {
            selectedStatuses.push(cb.value);
        });
        const mapEl = document.getElementById('block-map');
        const detail = { types: selectedTypes, statuses: selectedStatuses };
        if (mapEl) {
            mapEl.dispatchEvent(new CustomEvent('filters-changed', { detail }));
        } else {
            window.dispatchEvent(new CustomEvent('filters-changed', { detail }));
        }
        window.dispatchEvent(new CustomEvent('filter-types-updated'));
    },
    toggleType(type, checked) {
        document.querySelectorAll('[data-filter-type=&quot;' + type + '&quot;]').forEach(function (cb) {
            cb.checked = checked;
        });
        this.dispatchMapFilters();
    },
    toggleStatus(status, checked) {
        document.querySelectorAll('[data-filter-status=&quot;' + status + '&quot;]').forEach(function (cb) {
            cb.checked = checked;
        });
        this.dispatchMapFilters();
    },
}" @filter-type-changed.window="toggleType($event.detail.type, $event.detail.checked)" @filter-status-changed.window="toggleStatus($event.detail.status, $event.detail.checked)">

    <div class="ticket-layout-container">
        <div class="mb-8 border-b border-slate-200 pb-8">
        @include('pub_theme::components.blocks.ticket.heading', ['data' => $data])
        </div>

    <div class="ticket-layout-grid">
        @if ($hasSidebarFilters)
            <aside class="ticket-layout-sidebar" id="{{ $vm->filtersSectionId() }}" aria-label="{{ $vm->filtersTitle() }}">
                @include('pub_theme::components.blocks.ticket.filters-sidebar', [
                    'filters' => $vm->filters(),
                    'statusFilters' => $vm->statusFilters(),
                    'selectedTypes' => $initialSelectedTypes,
                    'selectedStatuses' => $initialSelectedStatuses,
                    'context' => 'desktop',
                ])
            </aside>
        @endif

        <div class="ticket-layout-main">
            @include('pub_theme::components.blocks.ticket.results-header', [
                'ns' => $ns,
                'resultsCount' => $vm->resultsCount(),
                'sprite' => $vm->sprite(),
            ])

            <div class="tab-section">
                @include('pub_theme::components.blocks.ticket.tabs', [
                    'tabs' => $vm->tabs(),
                    'sectionId' => $vm->tabsId(),
                ])

                <div class="mt-6">
                    @php $cta = $vm->cta(); @endphp
                    <div
                        id="data-ex-disservizio1"
                        aria-labelledby="tab-{{ $vm->mapTabId() }}"
                        role="tabpanel"
                        class="space-y-8"
                        x-show="activeTab === '{{ $vm->mapTabId() }}'"
                        x-cloak
                    >
                        <div>
                                <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                                    @if ($vm->useReferenceStaticMap())
                                        <img
                                            src="{{ $vm->referenceMapImageUrl() }}"
                                            alt="{{ __($ns . '.map.image.alt') }}"
                                            class="block w-full"
                                        >
                                    @else
                                        <map-lit
                                            id="block-map"
                                            class="block w-full"
                                            legend-mode="sidebar"
                                            data-url="{{ $vm->mapDataUrl() }}"
                                            height="clamp(12rem,52vw,46rem)"
                                            style="height:clamp(12rem,52vw,46rem);display:block;width:100%"
                                            aria-label="{{ __($ns . '.map.image.alt') }}"
                                        ></map-lit>
                                    @endif
                                </div>
                        </div>
                    </div>

                    <div
                        id="data-ex-disservizio2"
                        aria-labelledby="tab-{{ $vm->listTabId() }}"
                        role="tabpanel"
                        class="space-y-4"
                        x-show="activeTab === '{{ $vm->listTabId() }}'"
                        x-cloak
                    >
                        <div class="space-y-4">
                            @forelse ($vm->liveTickets() as $item)
                                @include('pub_theme::components.blocks.ticket.ticket-card', [
                                    'item' => $item,
                                    'loop' => $loop,
                                    'ns' => $ns,
                                    'sprite' => $vm->sprite(),
                                ])
                            @empty
                                <div class="rounded-xl border border-slate-200 bg-white p-6 text-center text-slate-700">
                                    <p>{{ __($ns . '.results.empty') }}</p>
                                </div>
                            @endforelse
                        </div>
                        @if ($vm->hasPreviousListPage() || $vm->hasNextListPage())
                            <nav class="flex items-center justify-between gap-3 pt-4" aria-label="{{ __('fixcity::pagination.next') }}">
                                @if ($vm->hasPreviousListPage())
                                    <a class="inline-flex min-h-11 items-center rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900" href="{{ $vm->listPageUrl($vm->listPage() - 1) }}">
                                        {{ __('fixcity::pagination.previous') }}
                                    </a>
                                @else
                                    <span aria-hidden="true"></span>
                                @endif
                                <span class="text-slate-700" aria-live="polite">Pagina {{ $vm->listPage() }}</span>
                                @if ($vm->hasNextListPage())
                                    <a class="inline-flex min-h-11 items-center rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900" href="{{ $vm->listPageUrl($vm->listPage() + 1) }}">
                                        {{ __($ns . '.load-more.button.label') }}
                                    </a>
                                @else
                                    <span aria-hidden="true"></span>
                                @endif
                            </nav>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (!empty($cta))
        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8" aria-labelledby="create-ticket-heading">
            <div class="max-w-2xl rounded-xl border border-sky-200 bg-sky-50 p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-slate-950" id="create-ticket-heading">{{ $cta['title'] }}</h2>
                    <p class="mt-3 leading-7 text-slate-800">{{ $cta['text'] }}</p>
                    <a class="mt-5 inline-flex min-h-12 items-center rounded-lg bg-sky-800 px-5 py-3 font-semibold text-white hover:bg-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-800/30" href="{{ $cta['button_url'] }}">
                        {{ $cta['button_text'] }}
                    </a>
            </div>
        </section>
    @endif
</div>{{-- /x-data wrapper --}}

</div>{{-- /#main-container --}}

@include('pub_theme::components.blocks.feedback.rating', ['data' => $data['rating'] ?? []])

@include('pub_theme::components.blocks.ticket.contacts', [
    'contacts' => $vm->contacts(),
    'contactsId' => $vm->contactsId(),
    'sprite' => $vm->sprite(),
])

@if ($vm->hasSidebarFilters())
    <div id="modal-categories" x-cloak x-show="filterOpen" x-on:keydown.escape.window="filterOpen = false" class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/60 p-4" role="dialog" aria-modal="true" aria-labelledby="modal-categories-title">
        <div class="mx-auto mt-8 max-w-lg rounded-xl bg-white p-6 shadow-xl">
                <div class="flex items-start justify-between gap-4">
                    <h2 class="text-xl font-bold text-slate-950" id="modal-categories-title">{{ $vm->filtersTitle() }}</h2>
                    <button type="button" class="min-h-11 min-w-11 rounded-lg text-2xl text-slate-700 focus:outline-none focus:ring-4 focus:ring-sky-800/20" x-on:click="filterOpen = false" aria-label="{{ __('pub_theme::ui.close') }}">&times;</button>
                </div>
                <div class="mt-4 text-slate-950">
                    @include('pub_theme::components.blocks.ticket.filters-sidebar', [
                        'filters' => $vm->filters(),
                        'statusFilters' => $vm->statusFilters(),
                        'selectedTypes' => $initialSelectedTypes,
                        'selectedStatuses' => $initialSelectedStatuses,
                        'context' => 'mobile',
                    ])
                </div>
        </div>
    </div>
@endif

<style>
    .leaflet-container { z-index: 1; }
    .ticket-layout-container { max-width: 80rem; margin-inline: auto; padding: 2rem 1rem 0; }
    .ticket-layout-grid { display: grid; gap: 2rem; }
    .ticket-layout-main { min-width: 0; }
    .ticket-layout-sidebar { display: none; }
    .ticket-layout-container .ticket-layout-grid { margin-top: 1rem; }
    @media (min-width: 64rem) {
        .ticket-layout-container { padding-inline: 1.5rem; padding-top: 3rem; }
        .ticket-layout-grid { grid-template-columns: minmax(15rem, 20rem) minmax(0, 1fr); }
        .ticket-layout-sidebar { display: block; }
    }
    @media (min-width: 80rem) { .ticket-layout-container { padding-inline: 2rem; } }
</style>
