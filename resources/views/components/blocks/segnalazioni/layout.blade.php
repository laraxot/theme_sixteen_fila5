@props(['data' => []])

@php
    use Illuminate\Support\Str;
    use Modules\Fixcity\Enums\TicketStatusEnum;
    use Modules\Fixcity\ViewModels\SegnalazioniFilterViewModel;
    $ns = 'fixcity::segnalazione';
    $blockData = is_array($data) ? $data : [];
    $phoneNumber = (string) ($blockData['phone'] ?? '05 0505');

    $t = function ($value, $default = '') use ($phoneNumber) {
        if (empty($value)) {
            return $default;
        }

        $resolved = str_contains((string) $value, '::') ? __((string) $value) : (string) $value;

        return str_replace(':phone', $phoneNumber, $resolved);
    };

    $rawBreadcrumb = $blockData['breadcrumb'] ?? [];
    $breadcrumbItems = [];
    foreach ($rawBreadcrumb as $item) {
        $breadcrumbItems[] = [
            'label' => $t($item['label'] ?? ''),
            'url' => $item['url'] ?? null,
            'active' => $item['active'] ?? false,
        ];
    }

    $title = $t($blockData['title'] ?? '', __($ns . '.heading.title.label'));
    $subtitle = $t($blockData['subtitle'] ?? '', __($ns . '.heading.subtitle.text', ['count' => 73]));
    $resultsCount = (int) ($blockData['results_count'] ?? 645);

    $tabsData = $blockData['tabs'] ?? [];
    $tabsId = $tabsData['id'] ?? 'map-and-list';
    $rawTabs = $tabsData['items'] ?? [];
    $tabs = [];
    foreach ($rawTabs as $tab) {
        $tabs[] = [
            'id' => $tab['id'] ?? 'map',
            'label' => $t($tab['label'] ?? ''),
            'active' => $tab['active'] ?? false,
        ];
    }

    $defaultActiveTab = $tabs[0]['id'] ?? 'map';
    foreach ($tabs as $tab) {
        if ($tab['active'] ?? false) {
            $defaultActiveTab = $tab['id'];
            break;
        }
    }
    $mapTabId = $tabs[0]['id'] ?? 'map';
    $listTabId = $tabs[1]['id'] ?? 'list';

    $mainContent = $blockData['main_content'] ?? [];
    $mainContentId = $mainContent['id'] ?? 'filter-and-cards';

    // Filtri da querystring (GET): ?types[]=...
    $selectedTypes = request()->collect('types')
        ->filter(static fn ($type): bool => is_string($type) && $type !== '')
        ->values()
        ->all();

    // Query base visibile per ruolo/utente (allineata al comportamento frontoffice)
    $baseTicketsQuery = \Modules\Fixcity\Models\Ticket::query();
    $currentUserId = auth()->id();
    if ($currentUserId !== null) {
        $baseTicketsQuery->where(function ($q) use ($currentUserId): void {
            $q->whereIn('status', TicketStatusEnum::canViewByAll())
                ->orWhere('created_by', $currentUserId)
                ->orWhere('updated_by', $currentUserId);
        });
    } else {
        $baseTicketsQuery->whereIn('status', TicketStatusEnum::canViewByAll());
    }

    // SSoT: Filtri leggono da JSON (stessa fonte della mappa)
    $filterViewModel = new SegnalazioniFilterViewModel();
    $filters = [
        'title' => $t($blockData['filters']['title'] ?? '', __($ns . '.filters.legend.label')),
        'items' => $filterViewModel->getFilterItems(),
        'total' => $filterViewModel->getTotalCount(),
    ];

    // Conteggi filtri per reference (backward compatibility)
    $typeCountsRaw = $filterViewModel->getCountsPerType();

    // Applica filtro tipologia a lista/mappa (query canonica unica)
    $filteredTicketsQuery = (clone $baseTicketsQuery);
    if ($selectedTypes !== []) {
        $filteredTicketsQuery->whereIn('type', $selectedTypes);
    }

    // Lista ticket reale (top 20) filtrata
    $liveTickets = (clone $filteredTicketsQuery)
        ->latest()
        ->take(20)
        ->get();

    $minListCards = 3;
    if ($liveTickets->count() < $minListCards) {
        $supplements = $filterViewModel->getSupplementListItems(
            $minListCards - $liveTickets->count(),
            $liveTickets->pluck('id')->all(),
        );
        $liveTickets = $liveTickets->concat($supplements);
    }

    $resultsCount = $filterViewModel->getFilteredCount($selectedTypes);
    $mapDataUrl = '/data/tickets.json';
    $filterItemsAttr = e(json_encode($filters['items'], JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));
    $selectedTypesAttr = e(json_encode($selectedTypes, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));

    $rawCta = $mainContent['cta'] ?? [];
    $cta = $rawCta !== []
        ? [
            'title' => $t($rawCta['title'] ?? '', __($ns . '.map.cta.title.label')),
            'text' => $t($rawCta['text'] ?? '', __($ns . '.map.cta.text.label')),
            'button_text' => $t($rawCta['button_text'] ?? '', __($ns . '.map.cta.button.label')),
        ]
        : [];

    $items = $mainContent['items'] ?? [];

    $contactsData = $blockData['contacts'] ?? [];
    $contactsId = $contactsData['id'] ?? 'info-contacts';
    $contacts = $contactsData !== []
        ? [
            'contact_title' => $t($contactsData['contact_title'] ?? '', __($ns . '.contacts.title.label')),
            'contacts' => collect($contactsData['contacts'] ?? [])->map(
                fn ($contact) => [
                    'label' => $t($contact['label'] ?? ''),
                    'url' => $contact['url'] ?? '#',
                    'icon' => $contact['icon'] ?? 'it-help-circle',
                ],
            )->toArray(),
        ]
        : [];

    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';

    // Landmark ids (CMS JSON + Design Comuni reference): https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazioni-elenco.html
    $tabsSectionId = $tabsData['id'] ?? 'map-and-list';
    $filtersSectionId = $mainContent['id'] ?? 'filter-and-cards';
@endphp

{{-- Structure aligned with static `main` > `#main-container` > sidebar row (col-lg-3 + col-lg-8): tabs live in the right column. Outer `<main>` is provided by `components/layouts/app`. --}}
<div id="segnalazioni-elenco-root" class="segnalazioni-elenco" x-data="segnalazioniLayout" x-init="activeTab = '{{ $defaultActiveTab }}'" data-section-map="{{ $tabsSectionId }}" data-section-filters="{{ $filtersSectionId }}" role="region" aria-label="{{ $title }}">
    <div class="container" id="main-container">
        <div class="row justify-content-center mb-md-40 mb-lg-80">
            <div class="col-12 col-lg-10">
                <div class="cmp-breadcrumbs" role="navigation">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb p-0" data-element="breadcrumb">
                            @foreach ($breadcrumbItems as $item)
                                <li class="breadcrumb-item{{ $item['active'] ?? false ? ' active' : '' }}"{{ $item['active'] ?? false ? ' aria-current="page"' : '' }}>
                                    @if ($item['url'] ?? false)
                                        <a href="{{ $item['url'] }}">{{ $item['label'] }}</a><span class="separator">/</span>
                                    @else
                                        {{ $item['label'] }}
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
                <div class="cmp-heading p-0">
                    <h1 class="title-xxxlarge">{{ $title }}</h1>
                    @if ($subtitle)
                        <p class="subtitle-small">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
            <hr class="d-none d-lg-block mt-30 mb-2">
        </div>

        <div class="row justify-content-center">
            <aside class="col-lg-3 d-none d-lg-block" id="{{ $filtersSectionId }}" aria-label="{{ $filters['title'] }}">
                @if (!empty($filters['items']))
                    @include('pub_theme::components.blocks.segnalazioni.filters-sidebar', [
                        'filters' => $filters,
                        'selectedTypes' => $selectedTypes,
                    ])
                @else
                    <p class="subtitle-small text-muted p-3">{{ __($ns . '.filters.empty') }}</p>
                @endif
            </aside>

            <div class="col-lg-8 offset-lg-1">
                <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
                    <span
                        id="segnalazioni-results-count"
                        class="search-results"
                        data-count-template="{{ __($ns . '.results.count.text', ['count' => ':count']) }}"
                    >{{ __($ns . '.results.count.text', ['count' => $resultsCount]) }}</span>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-categories" class="btn p-0 pe-2 d-lg-none">
                        <span class="rounded-icon">
                            <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                <use href="{{ $sprite }}#it-funnel"></use>
                            </svg>
                        </span>
                        <span class="t-primary title-xsmall-semi-bold ms-1">{{ __($ns . '.filter.button.label') }}</span>
                    </button>

                    <a href="#" id="segnalazioni-clear-filters" class="btn p-0 pe-2 d-none d-lg-block text-decoration-none">
                        <span class="title-xsmall-semi-bold ms-1">{{ __($ns . '.filter.remove.label') }}</span>
                    </a>
                </div>

                <div class="tab-section">
                    @include('pub_theme::components.blocks.segnalazioni.tabs', [
                        'tabs' => $tabs,
                        'sectionId' => $tabsSectionId,
                    ])

<div class="tab-content">
                          <div
                              id="data-ex-disservizio1"
                              role="tabpanel"
                              class="tab-pane fade show active"
                          >
                        <div class="row">
                            <div class="col-12">
                                <map-lit
                                    id="ticket-map"
                                    data-url="{{ $mapDataUrl }}"
                                    height="clamp(360px,58vh,560px)"
                                    style="height:clamp(360px,58vh,560px);display:block;width:100%"
                                    aria-label="{{ __($ns . '.map.image.alt') }}"
                                ></map-lit>
                            </div>
                            @if (!empty($cta))
                                <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                                    <div class="cmp-text-button mt-0">
                                        <h2 class="title-xxlarge mb-0">{{ $cta['title'] }}</h2>
                                        <div class="text-wrapper">
                                            <p class="subtitle-small mb-3 mt-3">{{ $cta['text'] }}</p>
                                        </div>
                                        <div class="button-wrapper">
                                            <a href="{{ $cta['button_url'] ?? '/it/segnalazione-crea' }}" class="btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0">
                                                <span>{{ $cta['button_text'] }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
</div>

                      <div
                          id="data-ex-disservizio2"
                          role="tabpanel"
                          class="tab-pane fade"
                      >
                        <div class="row">
                            @forelse ($liveTickets as $item)
                                @php
                                    $itemLocation = is_array($item->location) ? $item->location : [];
                                    $itemAddress = $itemLocation['address'] ?? $itemLocation['display_name'] ?? '';
                                    $itemTypeLabel = (string) ($item->type_label ?? '');
                                @endphp
                                <div class="cmp-card mb-4 mb-lg-30">
                                    <div class="card has-bkg-grey shadow-sm">
                                        <div class="card-body p-0">
                                            <div class="cmp-info-button-card">
                                                <div class="card p-3 p-lg-4">
                                                    <div class="card-body p-0">
                                                        <h3 class="medium-title mb-0">{{ $item->name }}</h3>
                                                        <p class="card-info">
                                                            {{ __($ns . '.card.type.label') }}<br><span>{{ $itemTypeLabel }}</span>
                                                        </p>

                                                        <div class="accordion-item">
                                                            <div class="accordion-header">
                                                                <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapse{{ $loop->iteration }}">
                                                                    <span class="d-flex align-items-center">
                                                                        {{ __($ns . '.card.expand.button.label') }}
                                                                        <svg class="icon icon-primary icon-sm">
                                                                            <use href="{{ $sprite }}#it-expand"></use>
                                                                        </svg>
                                                                    </span>
                                                                </button>
                                                            </div>
                                                            <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse @if ($loop->first) pb-0 @endif" role="region">
                                                                <div class="accordion-body p-0">
                                                                    <div class="cmp-info-summary bg-white border-0">
                                                                        <div class="card">
                                                                            <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-end">
                                                                                <a href="#" class="d-none text-decoration-none" data-element="ticket-edit">
                                                                                    <span class="text-button-sm-semi t-primary">{{ __($ns . '.card.edit.link.label') }}</span>
                                                                                </a>
                                                                            </div>
                                                                            <div class="card-body p-0">
                                                                                @if ($itemAddress)
                                                                                    <div class="single-line-info border-light">
                                                                                        <div class="text-paragraph-small">{{ __($ns . '.card.address.label') }}</div>
                                                                                        <div class="border-light">
                                                                                            <p class="data-text">{{ $itemAddress }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                @if (! empty($item->content ?? null))
                                                                                    <div class="single-line-info border-light">
                                                                                        <div class="text-paragraph-small">{{ __($ns . '.card.detail.label') }}</div>
                                                                                        <div class="border-light">
                                                                                            <p class="data-text">{{ Str::limit($item->content, 200) }}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                                @if ($loop->first)
                                                                                    <div class="border-light single-line-info">
                                                                                        <div class="text-paragraph-small">{{ __($ns . '.card.photos.label') }}</div>
                                                                                        <div class="border-0 border-light">
                                                                                            <div class="d-lg-flex gap-2 mt-3">
                                                                                                <div>
                                                                                                    <img
                                                                                                        class="img-fluid mb-3 mb-lg-0 w-100"
                                                                                                        src="/themes/Sixteen/design-comuni/assets/images/img-disservizio-thumbnail.png"
                                                                                                        alt=""
                                                                                                        loading="lazy"
                                                                                                    >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            <div class="card-footer p-0 d-none"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <p class="subtitle-small text-muted">{{ __($ns . '.results.empty') }}</p>
                                </div>
                            @endforelse
                        </div>
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-outline-primary mobile-full py-3 mt-10 mx-auto">
                                <span>{{ __($ns . '.load-more.button.label') }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pub_theme::components.blocks.feedback.rating', ['data' => $blockData['rating'] ?? []])

    <section id="info-contacts">
        @if (!empty($contacts))
            <div class="bg-grey-card shadow-contacts">
                <div class="container">
                    <div class="row d-flex justify-content-center p-contacts">
                        <div class="col-12 col-lg-5">
                            <div class="cmp-contacts">
                                <div class="card w-100">
                                    <div class="card-body">
                                        <h2 class="title-medium-2-semi-bold">{{ $contacts['contact_title'] }}</h2>
                                        <ul class="contact-list p-0">
                                            @foreach ($contacts['contacts'] as $contact)
                                                @php
                                                    $icon = $contact['icon'] ?? 'it-help-circle';
                                                    $dataElement = $contact['data_element'] ?? null;
                                                @endphp
                                                <li>
                                                    <a class="list-item" href="{{ $contact['url'] }}"@if ($dataElement) data-element="{{ $dataElement }}"@endif>
                                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                            <use href="{{ $sprite }}#{{ $icon }}"></use>
                                                        </svg>
                                                        <span>{{ $contact['label'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </section>

    @include('pub_theme::components.blocks.segnalazioni.modal-disservizio', ['sprite' => $sprite])

    @if (!empty($filters['items']))
        <div class="modal fade d-lg-none" id="modal-categories" tabindex="-1" aria-labelledby="modal-categories-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h2 class="title-medium-semi-bold" id="modal-categories-title">{{ $filters['title'] }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Chiudi') }}"></button>
                    </div>
                    <div class="modal-body text-black">
                        @include('pub_theme::components.blocks.segnalazioni.filters-sidebar', [
                            'filters' => $filters,
                            'selectedTypes' => $selectedTypes,
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- map-lit + filtri fieldset (STORY-058): Sixteen app.js + modulo Geo --}}
<style>.leaflet-container { z-index: 1; }</style>
