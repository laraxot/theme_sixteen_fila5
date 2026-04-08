@props([
    'breadcrumb' => [],
    'title' => '',
    'subtitle' => '',
    'results_count' => 645,
    'tabs' => [],
    'filters' => [],
    'cta' => [],
    'items' => [],
    'contacts' => [],
])

@php
    $ns = 'fixcity::segnalazione';

    // Helper to resolve translation keys from JSON
    $t = function ($value, $default = '') use ($ns) {
        if (empty($value)) {
            return $default;
        }
        if (str_contains($value, '::')) {
            return __($value);
        }
        return $value;
    };

    // Data extraction
    $rawBreadcrumb = $breadcrumb;
    $breadcrumbItems = [];
    foreach ($rawBreadcrumb as $item) {
        $breadcrumbItems[] = [
            'label' => $t($item['label'] ?? ''),
            'url' => $item['url'] ?? null,
            'active' => $item['active'] ?? false,
        ];
    }
    if (empty($breadcrumbItems)) {
        $breadcrumbItems = [
            ['label' => __($ns . '.breadcrumb.home.label'), 'url' => '/it/tests/homepage'],
            ['label' => __($ns . '.breadcrumb.elenco.label'), 'url' => null, 'active' => true],
        ];
    }

    $title = $t($title, __($ns . '.heading.title.label'));
    $subtitle = $t($subtitle, __($ns . '.heading.subtitle.text', ['count' => 73]));
    $resultsCount = $results_count;

    $rawTabs = $tabs;
    $tabs = [];
    foreach ($rawTabs as $tab) {
        $tabs[] = [
            'id' => $tab['id'] ?? 'map',
            'label' => $t($tab['label'] ?? ''),
            'active' => $tab['active'] ?? false,
        ];
    }
    if (empty($tabs)) {
        $tabs = [
            ['id' => 'map', 'label' => __($ns . '.tabs.map.label'), 'active' => true],
            ['id' => 'list', 'label' => __($ns . '.tabs.list.label'), 'active' => false],
        ];
    }

    $rawFilters = $filters;
    $filters = [
        'title' => $t($rawFilters['title'] ?? '', __($ns . '.filters.legend.label')),
        'items' => $rawFilters['items'] ?? [],
    ];

    $rawCta = $cta;
    $cta = !empty($rawCta)
        ? [
            'title' => $t($rawCta['title'] ?? '', __($ns . '.map.cta.title.label')),
            'text' => $t($rawCta['text'] ?? '', __($ns . '.map.cta.text.label')),
            'button_text' => $t($rawCta['button_text'] ?? '', __($ns . '.map.cta.button.label')),
        ]
        : [];

    $rawContacts = $contacts;
    $contacts = !empty($rawContacts)
        ? [
            'contact_title' => $t($rawContacts['contact_title'] ?? '', __($ns . '.contacts.title.label')),
            'contacts' => collect($rawContacts['contacts'] ?? [])
                ->map(
                    fn($c) => [
                        'label' => $t($c['label'] ?? ''),
                        'url' => $c['url'] ?? '#',
                        'icon' => $c['icon'] ?? 'it-help-circle',
                        'data_element' => $c['data_element'] ?? null,
                    ],
                )
                ->toArray(),
            'issues_title' => $t($rawContacts['issues_title'] ?? '', __($ns . '.contacts.issues.title.label')),
            'issues' => collect($rawContacts['issues'] ?? [])
                ->map(
                    fn($i) => [
                        'label' => $t($i['label'] ?? ''),
                        'url' => $i['url'] ?? '#',
                    ],
                )
                ->toArray(),
        ]
        : [];

    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container" id="main-container">
    {{-- Breadcrumb + Heading Row --}}
    <div class="row justify-content-center mb-md-40 mb-lg-80">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        @foreach ($breadcrumbItems as $item)
                            <li
                                class="breadcrumb-item{{ $item['active'] ?? false ? ' active' : '' }}"{{ $item['active'] ?? false ? ' aria-current="page"' : '' }}>
                                @if ($item['url'] ?? false)
                                    <a href="{{ $item['url'] }}">{{ $item['label'] }}</a><span
                                        class="separator">/</span>
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

    {{-- Content Row: Filters + Results --}}
    <div class="row justify-content-center">
        {{-- Filters Sidebar (Desktop) --}}
        @if (!empty($filters['items']))
            <div class="col-lg-3 d-none d-lg-block">
                <fieldset>
                    <legend class="h6 text-uppercase category-list__title">{{ $filters['title'] }}</legend>
                    <div class="categoy-list pb-4">
                        <ul>
                            @foreach ($filters['items'] as $filter)
                                <li>
                                    <div class="form-check">
                                        <div class="checkbox-body border-light py-1">
                                            <input type="checkbox" id="{{ $filter['id'] }}" name="category"
                                                value="{{ $filter['value'] ?? '' }}">
                                            <label for="{{ $filter['id'] }}"
                                                class="subtitle-small_semi-bold mb-0 category-list__list">{{ $filter['label'] }}
                                                ({{ $filter['count'] ?? 0 }})
                                            </label>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </fieldset>
            </div>
        @endif

        {{-- Results Column --}}
        <div class="col-lg-8 offset-lg-1">
            <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
                <span class="search-results">{{ __($ns . '.results.count.text', ['count' => $resultsCount]) }}</span>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-categories"
                    class="btn p-0 pe-2 d-lg-none">
                    <span class="rounded-icon">
                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                            <use href="{{ $sprite }}#it-funnel"></use>
                        </svg>
                    </span>
                    <span class="t-primary title-xsmall-semi-bold ms-1">{{ __($ns . '.filter.button.label') }}</span>
                </button>

                <button type="button" class="btn p-0 pe-2 d-none d-lg-block">
                    <span class="title-xsmall-semi-bold ms-1">{{ __($ns . '.filter.remove.label') }}</span>
                </button>
            </div>

            {{-- Tabs --}}
            <ul class="nav nav-tabs w-100 flex-nowrap border-bottom border-light mb-40 mt-3 shadow-none"
                id="tabDisservizio" role="tablist">
                @foreach ($tabs as $index => $tab)
                    <li class="nav-item w-100" role="tab">
                        <a class="nav-link{{ $tab['active'] ?? false ? ' active' : '' }} title-medium-semi-bold pt-0"
                            href="#data-ex-disservizio{{ $index + 1 }}" aria-current="page" data-bs-toggle="tab"
                            role="button" aria-controls="disservizio{{ $index + 1 }}"
                            aria-selected="{{ $tab['active'] ?? false ? 'true' : 'false' }}">
                            {{ $tab['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

            {{-- Tab Content --}}
            <div class="tab-content">
                {{-- Map Tab --}}
                <div class="tab-pane fade{{ isset($tabs[0]) && ($tabs[0]['active'] ?? false) ? ' show active' : '' }}"
                    id="data-ex-disservizio1" role="tabpanel">
                    <div class="row">
                        <div class="col-12">
                            <div class="map-box">
                                <img src="/themes/Sixteen/design-comuni/assets/images/map-placeholder.svg"
                                    alt="Mappa" class="w-100">
                                <button type="button" class="pin" data-bs-toggle="modal"
                                    data-bs-target="#modal-disservizio">
                                    <img src="/themes/Sixteen/design-comuni/assets/images/map-pin.svg"
                                        alt="Pin di geolocalizzazione" title="Pin di geolocalizzazione">
                                </button>
                            </div>
                        </div>
                        @if (!empty($cta))
                            <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                                <div class="cmp-text-button mt-0">
                                    <h2 class="title-xxlarge mb-0">{{ $cta['title'] }}</h2>
                                    <div class="text-wrapper">
                                        <p class="subtitle-small mb-3 mt-3">{{ $cta['text'] }}</p>
                                    </div>
                                    <div class="button-wrapper">
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#modal-disservizio"
                                            class="btn btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0">
                                            <span class>{{ $cta['button_text'] }}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- List Tab --}}
                <div class="tab-pane fade{{ (isset($tabs[0]) && !($tabs[0]['active'] ?? false)) || !isset($tabs[0]) ? ' show active' : '' }}"
                    id="data-ex-disservizio2" role="tabpanel">
                    <div class="row">
                        @foreach ($items as $item)
                            <div class="cmp-card mb-4 mb-lg-30">
                                <div class="card has-bkg-grey shadow-sm">
                                    <div class="card-body p-0">
                                        <div class="cmp-info-button-card">
                                            <div class="card p-3 p-lg-4">
                                                <div class="card-body p-0">
                                                    <h3 class="medium-title mb-0">{{ $item['title'] ?? '' }}</h3>
                                                    <p class="card-info">
                                                        @if ($loop->first)
                                                            {{ __($ns . '.card.type.label') }}<br><span>{{ $item['type'] ?? '' }}</span>
                                                        @else
                                                            {{ __($ns . '.card.type.short') }}
                                                        @endif
                                                    </p>

                                                    <div class="accordion-item">
                                                        <div class="accordion-header">
                                                            <button class="collapsed accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#collapse{{ $loop->iteration }}"
                                                                aria-expanded="false"
                                                                aria-controls="collapse{{ $loop->iteration }}">
                                                                <span class="d-flex align-items-center">
                                                                    {{ __($ns . '.card.expand.button.label') }}
                                                                    <svg class="icon icon-primary icon-sm">
                                                                        <use href="{{ $sprite }}#it-expand">
                                                                        </use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapse{{ $loop->iteration }}"
                                                            class="accordion-collapse collapse @if ($loop->first) pb-0 @endif" role="region">
                                                            <div class="accordion-body p-0">
                                                                <div class="cmp-info-summary bg-white border-0">
                                                                    <div class="card">
                                                                        <div
                                                                            class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-end">
                                                                            @if (!empty($item['edit_url']))
                                                                                <a href="{{ $item['edit_url'] }}"
                                                                                    class="d-none text-decoration-none"><span
                                                                                        class="text-button-sm-semi t-primary">{{ __($ns . '.card.edit.link.label') }}</span></a>
                                                                            @endif
                                                                        </div>
                                                                        <div class="card-body p-0">
                                                                            @if (!empty($item['location']))
                                                                                <div
                                                                                    class="single-line-info border-light">
                                                                                    <div class="text-paragraph-small">
                                                                                        {{ __($ns . '.card.address.label') }}
                                                                                    </div>
                                                                                    <div class="border-light">
                                                                                        <p class="data-text">
                                                                                            {{ $item['location'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @if (!empty($item['description']))
                                                                                <div
                                                                                    class="single-line-info border-light">
                                                                                    <div class="text-paragraph-small">
                                                                                        {{ __($ns . '.card.detail.label') }}
                                                                                    </div>
                                                                                    <div class="border-light">
                                                                                        <p class="data-text">
                                                                                            {{ $item['description'] }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @if (!empty($item['images']) && is_array($item['images']))
                                                                                <div
                                                                                    class="single-line-info border-light">
                                                                                    <div class="text-paragraph-small">
                                                                                        {{ __($ns . '.card.images.label') }}
                                                                                    </div>
                                                                                    <div class="border-light border-0">
                                                                                        <div
                                                                                            class="d-lg-flex gap-2 mt-3">
                                                                                        @foreach ($item['images'] as $index => $img)
                                                                                            <div>
                                                                                                <img src="{{ $img }}"
                                                                                                    alt="{{ __($ns . '.card.images.alt') }}"
                                                                                                    class="img-fluid w-100{{ $index < 2 ? ' mb-3 mb-lg-0' : '' }}">
                                                                                            </div>
                                                                                        @endforeach
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
                        @endforeach
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn btn-outline-primary mobile-full py-3 mt-10 mx-auto">
                            <span>{{ __($ns . '.load-more.button.label') }}</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- Rating Section --}}
        <div class="bg-primary">
            <div class="container">
                <div class="row d-flex justify-content-center bg-primary">
                    <div class="col-12 col-lg-6 p-lg-0 px-3">
                        <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                            <div class="card shadow card-wrapper" data-element="feedback">
                                <div class="cmp-rating__card-first">
                                    <div class="card-header border-0">
                                        <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ __($ns . '.rating.question.text') }}</h2>
                                    </div>
                                    <div class="card-body">
                                        <fieldset class="rating">
                                            <legend class="visually-hidden">{{ __($ns . '.rating.legend.text') }}</legend>
                                            @php
                                                $starLabels = [
                                                    5 => 'Valuta 5 stelle su 5',
                                                    4 => 'Valuta 4 stelle su 5',
                                                    3 => 'Valuta 3 stelle su 5',
                                                    2 => 'Valuta 2 stelle su 5',
                                                    1 => 'Valuta 1 stelle su 5',
                                                ];
                                                $starIds = [
                                                    5 => 'first-star',
                                                    4 => 'second-star',
                                                    3 => 'third-star',
                                                    2 => 'fourth-star',
                                                    1 => 'fifth-star',
                                                ];
                                            @endphp
                                            @for ($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}">
                                                <label class="full rating-star active" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                                    <svg class="icon icon-sm" role="img" aria-labelledby="{{ $starIds[$i] }}" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                                    </svg>
                                                    <span class="visually-hidden" id="{{ $starIds[$i] }}">{{ $starLabels[$i] }}</span>
                                                </label>
                                            @endfor
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

{{-- Contacts Section --}}
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
                                            <a class="list-item" href="{{ $contact['url'] }}"@if($dataElement) data-element="{{ $dataElement }}"@endif>
                                                <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                    <use href="{{ $sprite }}#{{ $icon }}"></use>
                                                </svg>
                                                <span>{{ $contact['label'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (!empty($contacts['issues']))
                                    <h2 class="title-medium-2-semi-bold mb-3">{{ $contacts['issues_title'] }}</h2>
                                    <ul class="contact-list p-0">
                                        @foreach ($contacts['issues'] as $issue)
                                            <li>
                                                <a class="list-item" href="{{ $issue['url'] }}">
                                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                        <use href="{{ $sprite }}#it-warning-circle"></use>
                                                    </svg>
                                                    <span>{{ $issue['label'] }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (!empty($filters['items']))
    <div class="it-example-modal">
        <div class="modal fade" id="modal-categories" tabindex="-1" role="dialog"
            aria-labelledby="modal-categories-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h4" id="modal-categories-label">{{ $filters['title'] }}</h2>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __($ns . '.modal.close.label') }}"></button>
                    </div>
                    <div class="modal-body">
                        <fieldset>
                            <div class="categoy-list pb-4">
                                <ul>
                                    @foreach ($filters['items'] as $filter)
                                        <li>
                                            <div class="form-check">
                                                <div class="checkbox-body border-light py-1">
                                                    <input type="checkbox" id="mobile-{{ $filter['id'] }}"
                                                        name="category" value="{{ $filter['value'] ?? '' }}">
                                                    <label for="mobile-{{ $filter['id'] }}"
                                                        class="subtitle-small_semi-bold mb-0 category-list__list">
                                                        {{ $filter['label'] }} ({{ $filter['count'] ?? 0 }})
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
