@props(['data' => []])
{{--
    Pagina dei risultati di ricerca Design Comuni: testi, filtri, risultati e link arrivano dal JSON della pagina
    (tests.risultati-ricerca.json); la struttura segue la pagina di riferimento. Stili: resources/css/design-comuni/.
    Rating e contatti sono i partial condivisi con la homepage.
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
    $results = $d('results.items', []);
@endphp

<div class="dc-page">
<h1 class="visually-hidden" id="search-container">{{ $d('title') }}</h1>
<div class="container" id="main-container">
    <div class="mb-md-5">
        <div class="cmp-breadcrumbs" role="navigation">
            <nav class="breadcrumb-container" aria-label="breadcrumb"><ol class="breadcrumb p-0" data-element="breadcrumb">
                @foreach ($d('breadcrumb.items', []) as $crumb)
                    <li class="breadcrumb-item"><a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '' }}</a><span class="separator">/</span></li>
                @endforeach
                <li class="breadcrumb-item active" aria-current="page">{{ $d('breadcrumb.current') }}</li>
            </ol></nav>
        </div>
    </div>
</div>
<div class="container">
    <div class="form-group cmp-input-search-button mt-2 mb-4 mb-lg-50">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><svg class="icon icon-md"><use href="{{ $icon('it-search') }}"></use></svg></div>
            </div>
            <label for="input-group-1" class="active">{{ $d('search.label') }}</label>
            <input type="search" class="form-control" id="input-group-1" name="input-group-1" placeholder="{{ $d('search.placeholder') }}" value="{{ $d('search.query') }}" data-focus-mouse="false">
        </div>
        <button type="button" data-bs-toggle="modal" data-bs-target="#" class="btn btn-primary"><span class="">{{ $d('search.button') }}</span></button>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 d-none d-lg-block scroll-filter-wrapper">
            <h2 class="visually-hidden" id="filter">{{ $d('filters.hidden_title') }}</h2>
            @foreach ($d('filters.groups', []) as $group)
                <fieldset>
                    <legend class="h6 text-uppercase category-list__title">{{ $group['title'] ?? '' }}</legend>
                    <div class="categoy-list pb-4">
                        <ul>
                            @foreach ($group['items'] ?? [] as $filter)
                                <li>
                                    <div class="form-check">
                                        <div class="checkbox-body border-light py-1">
                                            <input type="checkbox" id="{{ $filter['id'] ?? '' }}" name="category" value="{{ $filter['value'] ?? '' }}">
                                            <label for="{{ $filter['id'] ?? '' }}" class="subtitle-small_semi-bold mb-0 category-list__list">{{ $filter['label'] ?? '' }}</label>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </fieldset>
            @endforeach
        </div>
        <div class="col-lg-8 offset-lg-1">
            <div class="d-flex justify-content-between align-items-center border-bottom border-light pb-3 mb-2">
                <h2 class="visually-hidden" id="search-result">{{ $d('results.hidden_title') }}</h2>
                <span class="search-results u-grey-light"><span class="numResult">{{ $d('results.count') }}</span> {{ $d('results.count_label') }}</span>
                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-categories" class="btn p-0 pe-2 d-lg-none">
                    <span class="rounded-icon"><svg class="icon icon-primary icon-xs" aria-hidden="true"><use href="{{ $icon('it-funnel') }}"></use></svg></span>
                    <span class="t-primary title-xsmall-semi-bold ms-1">{{ $d('results.filter_button') }}</span>
                </button>
                <button type="button" class="btn d-none d-lg-block btn-result" disabled="disabled">{{ $d('results.clear') }}</button>
            </div>
            <div class="container p-0">
                <div class="row flex-column-reverse flex-lg-row">
                    <div class="col-12 pt-3">
                        @foreach ($results as $result)
                            <div @class(['cmp-card-latest-messages', 'mb-3', 'mb-30' => ! $loop->last, 'mb-4' => $loop->last]) data-bs-toggle="modal" data-bs-target="#">
                                <div class="card shadow-sm px-4 pt-4 pb-4 rounded">
                                    <span class="visually-hidden">{{ $d('results.category_label') }}</span>
                                    <div class="card-header border-0 p-0">
                                        <a class="text-decoration-none title-xsmall-bold mb-2 category text-uppercase" href="{{ $result['url'] ?? '#' }}">{{ $result['category'] ?? '' }}</a>
                                    </div>
                                    <div class="card-body p-0 my-2">
                                        <h3 class="green-title-big t-primary mb-8"><a href="{{ $result['url'] ?? '#' }}" class="text-decoration-none" data-element="service-link">{{ $result['title'] ?? '' }}</a></h3>
                                        <p class="text-paragraph">{{ $result['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="container p-0">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-outline-primary pt-15 pb-15 pl-90 pr-90 mb-30 mb-lg-50 full-mb text-button"><span class="">{{ $d('results.load_more') }}</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pub_theme::components.blocks.partials.dc-rating', ['data' => $data])
@include('pub_theme::components.blocks.partials.dc-contacts', ['data' => $data])
</div>
