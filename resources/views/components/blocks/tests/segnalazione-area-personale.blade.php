@props(['data' => []])

@php
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $imagesPath = '/themes/Sixteen/design-comuni/assets/images';

    $user = $data['user'] ?? [];
    $tabs = $data['tabs'] ?? [];
    $deskIndex = $data['desk_index'] ?? [];
    $serviceIndex = $data['service_index'] ?? [];
    $messages = $data['messages'] ?? [];
    $activities = $data['activities'] ?? [];
    $practices = $data['practices'] ?? [];
    $payments = $data['payments'] ?? [];
    $contacts = $data['contacts'] ?? [];
    $highlight = $data['highlight'] ?? [];

    $userName = trim((string) (($user['first_name'] ?? '').' '.($user['last_name'] ?? '')));
    $taxCodeLabel = (string) ($user['tax_code_label'] ?? '');
    $taxCode = (string) ($user['tax_code'] ?? '');

    $messagesTitle = (string) ($data['messages_title'] ?? '');
    $activitiesTitle = (string) ($data['activities_title'] ?? '');
    $practicesTitle = (string) ($data['practices_title'] ?? '');
    $paymentsTitle = (string) ($data['payments_title'] ?? '');
    $contactsTitle = (string) ($data['contacts_title'] ?? '');
    $searchTitle = (string) ($data['search_title'] ?? '');
    $searchLabel = (string) ($data['search_label'] ?? '');
    $searchButton = (string) ($data['search_button'] ?? '');
    $searchSuggestionsTitle = (string) ($data['search_suggestions_title'] ?? '');
    $breadcrumbs = $data['breadcrumbs'] ?? [];
    $breadcrumbLabel = (string) ($data['breadcrumb_label'] ?? '');
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="{{ $breadcrumbLabel }}">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        @foreach($breadcrumbs as $index => $breadcrumb)
                            @php
                                $isLast = $index === count($breadcrumbs) - 1;
                            @endphp
                            <li class="breadcrumb-item{{ $isLast ? ' active' : '' }}"{{ $isLast ? ' aria-current="page"' : '' }}>
                                @if (! $isLast)
                                    <a href="{{ $breadcrumb['url'] ?? '#' }}">{{ $breadcrumb['label'] ?? '' }}</a><span class="separator">/</span>
                                @else
                                    {{ $breadcrumb['label'] ?? '' }}
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">{{ $userName }}</h1>
                <p class="subtitle-small">{{ trim($taxCodeLabel.' '.$taxCode) }}</p>
            </div>
        </div>

        <div class="col-12 p-0">
            <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap" id="myTab" role="tablist">
                    @foreach($tabs as $index => $tab)
                        @php
                            $tabId = (string) ($tab['id'] ?? ('tab'.($index + 1)));
                            $active = (bool) ($tab['active'] ?? false);
                            $icon = (string) ($tab['icon'] ?? 'it-files');
                            $label = (string) ($tab['label'] ?? '');
                        @endphp
                        <li class="nav-item w-100" role="tab">
                            <a class="nav-link justify-content-start text-tab{{ $active ? ' active' : '' }}" href="#{{ $tabId }}" aria-current="page" aria-controls="{{ $tabId }}" aria-selected="{{ $active ? 'true' : 'false' }}" data-bs-toggle="tab" role="button">
                                <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                    <use href="{{ $sprite }}#{{ $icon }}"></use>
                                </svg>
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="it-page-sections-container">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="data-ex-tab1" role="tabpanel">
                <div class="row">
                    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
                        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="{{ $data['desk_index_title'] ?? '' }}" data-bs-navscroll>
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <span class="accordion-header" id="accordion-title-one">
                                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                            {{ $data['desk_index_title'] ?? '' }}
                                                            <svg class="icon icon-xs right"><use href="{{ $sprite }}#it-expand"></use></svg>
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                @foreach($deskIndex as $item)
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#{{ $item['target'] ?? '' }}"><span>{{ $item['label'] ?? '' }}</span></a>
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
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 offset-lg-1 px-0 px-sm-3">
                        <div class="it-page-section mb-40 mb-lg-60" id="latest-posts">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-20">
                                        <div class="d-flex"><h2 class="title-xxlarge">{{ $messagesTitle }}</h2></div>
                                    </div>
                                    <div class="card-body p-0">
                                        @foreach($messages as $index => $message)
                                            <div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#modal-message" id="{{ $index + 1 }}">
                                                <div class="card shadow-sm px-4 pt-4 pb-4">
                                                    <span class="visually-hidden">{{ $message['category_label'] ?? '' }}</span>
                                                    <div class="card-header border-0 p-0 m-0">
                                                        <date class="date-xsmall">{{ $message['date'] ?? '' }}</date>
                                                    </div>
                                                    <div class="card-body p-0 my-2">
                                                        <h3 class="title-small-semi-bold t-primary m-0 mb-1">
                                                            <a href="{{ $message['url'] ?? '#' }}" class="text-decoration-none">{{ $message['title'] ?? '' }}</a>
                                                        </h3>
                                                        <p class="text-paragraph text-truncate">{{ $message['excerpt'] ?? '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(!empty($data['messages_cta']))
                                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0"><span>{{ $data['messages_cta'] }}</span></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="latest-activities">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                        <div class="d-flex"><h2 class="title-xxlarge mb-3">{{ $activitiesTitle }}</h2></div>
                                    </div>
                                    <div class="card-body p-0">
                                        @foreach($activities as $activity)
                                            <div class="cmp-icon-card mb-3">
                                                <div class="card pt-20 pb-4 ps-4 pr-30 drop-shadow">
                                                    <div class="cmp-card-title d-flex">
                                                        <svg class="icon icon-sm me-2" aria-hidden="true"><use href="{{ $sprite }}#{{ $activity['icon'] ?? 'it-files' }}"></use></svg>
                                                        <h3 class="t-primary mb-2 underline title-small-semi-bold">
                                                            <a href="{{ $activity['url'] ?? '#' }}">{{ $activity['title'] ?? '' }}</a>
                                                        </h3>
                                                    </div>
                                                    <div class="cmp-icon-card__description"><date class="date-xsmall ml-30">{{ $activity['date'] ?? '' }}</date></div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(!empty($data['activities_cta']))
                                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0"><span>{{ $data['activities_cta'] }}</span></button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="data-ex-tab2" role="tabpanel"></div>

            <div class="tab-pane" id="data-ex-tab3" role="tabpanel">
                <div class="row">
                    <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
                        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-Three">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="{{ $data['service_index_title'] ?? '' }}" data-bs-navscroll>
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <span class="accordion-header" id="accordion-title-Three">
                                                        <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Three" aria-expanded="true" aria-controls="collapse-Three">
                                                            {{ $data['service_index_title'] ?? '' }}
                                                            <svg class="icon icon-xs right"><use href="{{ $sprite }}#it-expand"></use></svg>
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div id="collapse-Three" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-Three">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                @foreach($serviceIndex as $item)
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#{{ $item['target'] ?? '' }}"><span>{{ $item['label'] ?? '' }}</span></a>
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
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 offset-lg-1 px-0 px-sm-3">
                        <section class="it-page-section mb-40 mb-lg-60" id="practices">
                            <div class="cmp-filter">
                                <div class="filter-section">
                                    <h2 class="cmp-filter__title title-xxlarge">{{ $practicesTitle }}</h2>
                                    <div class="filter-wrapper d-flex align-items-center">
                                        <button type="button" class="btn p-0 pe-2 t-primary">
                                            <span class="rounded-icon"><svg class="icon icon-primary icon-xs me-1" aria-hidden="true"><use href="{{ $sprite }}#it-funnel"></use></svg></span>
                                            <span>{{ $data['filter_label'] ?? '' }}</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pratiche" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                                <svg class="icon-expand icon icon-sm icon-primary"><use href="{{ $sprite }}#it-expand"></use></svg>
                                                <span class="dropdown__title">{{ $data['sort_label'] ?? '' }}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-pratiche">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        @foreach(($data['sort_options'] ?? []) as $option)
                                                            <li><a class="dropdown-item list-item" href="#"><span>{{ $option }}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmp-input-search">
                                    <div class="form-group autocomplete-wrapper">
                                        <div class="input-group">
                                            <label for="autocomplete-pratiche" class="visually-hidden">{{ $searchLabel }}</label>
                                            <input type="search" class="autocomplete form-control" placeholder="{{ $searchButton }}" id="autocomplete-pratiche" name="pratiche" data-bs-autocomplete="[]">
                                            <span class="autocomplete-icon" aria-hidden="true">
                                                <svg class="icon icon-sm"><use href="{{ $sprite }}#it-search"></use></svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cmp-accordion">
                                <div class="accordion">
                                    @foreach($practices as $idx => $practice)
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="heading{{ $idx + 1 }}">
                                                <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx + 1 }}" aria-expanded="true" aria-controls="collapse{{ $idx + 1 }}">
                                                    <div class="button-wrapper">
                                                        {{ $practice['title'] ?? '' }}
                                                        <div class="icon-wrapper">
                                                            <img class="icon-folder" src="{{ $imagesPath }}/{{ $practice['folder_image'] ?? 'folder-concluded.svg' }}" alt="{{ $practice['status_icon_alt'] ?? '' }}" role="img">
                                                            <span class="{{ $practice['status_class'] ?? '' }}">{{ $practice['status_label'] ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </button>
                                                <p class="accordion-date title-xsmall-regular mb-0">{{ $practice['date'] ?? '' }}</p>
                                            </div>

                                            <div id="collapse{{ $idx + 1 }}" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample{{ $idx + 1 }}" role="region" aria-labelledby="heading{{ $idx + 1 }}">
                                                <div class="accordion-body">
                                                    <p class="mb-2 fw-normal">{{ $practice['code_label'] ?? '' }} <span class="label">{{ $practice['code'] ?? '' }}</span></p>
                                                    <a href="{{ $practice['service_url'] ?? '#' }}" class="mb-2"><span class="t-primary">{{ $practice['service_label'] ?? '' }}</span></a>
                                                    <a class="chip chip-simple" href="{{ $practice['service_url'] ?? '#' }}"><span class="chip-label">{{ $practice['service_chip'] ?? '' }}</span></a>
                                                    @if(!empty($practice['attachments']))
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    @foreach($practice['attachments'] as $attachment)
                                                                        <li class="shadow mt-3">
                                                                            <a href="{{ $attachment['url'] ?? '#' }}" class="list-item icon-left t-primary title-small-semi-bold" aria-label="{{ $attachment['label'] ?? '' }}">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true"><use href="{{ $sprite }}#it-clip"></use></svg>
                                                                                    <span class="list-item-title title-small-semi-bold">{{ $attachment['label'] ?? '' }}</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <button type="button" class="btn btn-primary justify-content-center my-3"><span>{{ $practice['action_label'] ?? '' }}</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(!empty($data['practices_cta']))
                                <button type="button" class="btn accordion-view-more mb-2 pt-3 t-primary title-xsmall-semi-bold ps-lg-3"><span>{{ $data['practices_cta'] }}</span></button>
                            @endif
                        </section>

                        <section class="it-page-section mb-50 mb-lg-90" id="payments">
                            <div class="cmp-filter">
                                <div class="filter-section">
                                    <h2 class="cmp-filter__title title-xxlarge">{{ $paymentsTitle }}</h2>
                                    <div class="filter-wrapper d-flex align-items-center">
                                        <button type="button" class="btn p-0 pe-2 t-primary">
                                            <span class="rounded-icon"><svg class="icon icon-primary icon-xs me-1" aria-hidden="true"><use href="{{ $sprite }}#it-funnel"></use></svg></span>
                                            <span>{{ $data['filter_label'] ?? '' }}</span>
                                        </button>
                                        <div class="dropdown">
                                            <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pagamenti" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                                <svg class="icon-expand icon icon-sm icon-primary"><use href="{{ $sprite }}#it-expand"></use></svg>
                                                <span class="dropdown__title">{{ $data['sort_label'] ?? '' }}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-payments">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        @foreach(($data['sort_options'] ?? []) as $option)
                                                            <li><a class="dropdown-item list-item" href="#"><span>{{ $option }}</span></a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cmp-input-search">
                                    <div class="form-group autocomplete-wrapper">
                                        <div class="input-group">
                                            <label for="autocomplete-pagamenti" class="visually-hidden">{{ $searchLabel }}</label>
                                            <input type="search" class="autocomplete form-control" placeholder="{{ $searchButton }}" id="autocomplete-pagamenti" name="pagamenti" data-bs-autocomplete="[]">
                                            <span class="autocomplete-icon" aria-hidden="true">
                                                <svg class="icon icon-sm"><use href="{{ $sprite }}#it-search"></use></svg>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="cmp-accordion">
                                <div class="accordion">
                                    @foreach($payments as $idx => $payment)
                                        <div class="accordion-item">
                                            <div class="accordion-header" id="heading{{ $idx + 5 }}">
                                                <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idx + 5 }}" aria-expanded="true" aria-controls="collapse{{ $idx + 5 }}">
                                                    <div class="button-wrapper">
                                                        {{ $payment['title'] ?? '' }}
                                                        <div class="icon-wrapper">
                                                            <img class="icon-folder" src="{{ $imagesPath }}/{{ $payment['folder_image'] ?? 'folder-payment.svg' }}" alt="{{ $payment['status_icon_alt'] ?? '' }}" role="img">
                                                            <span class="{{ $payment['status_class'] ?? '' }}">{{ $payment['status_label'] ?? '' }}</span>
                                                        </div>
                                                    </div>
                                                </button>
                                                <p class="accordion-date title-xsmall-regular mb-0">{{ $payment['date'] ?? '' }}</p>
                                            </div>

                                            <div id="collapse{{ $idx + 5 }}" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample{{ $idx + 5 }}" role="region" aria-labelledby="heading{{ $idx + 5 }}">
                                                <div class="accordion-body">
                                                    <p class="mb-2 fw-normal">{{ $payment['code_label'] ?? '' }} <span class="label">{{ $payment['code'] ?? '' }}</span></p>
                                                    <a href="{{ $payment['service_url'] ?? '#' }}" class="mb-2"><span class="t-primary">{{ $payment['service_label'] ?? '' }}</span></a>
                                                    <a class="chip chip-simple" href="{{ $payment['service_url'] ?? '#' }}"><span class="chip-label">{{ $payment['service_chip'] ?? '' }}</span></a>
                                                    @if(!empty($payment['attachments']))
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    @foreach($payment['attachments'] as $attachment)
                                                                        <li class="shadow mt-3">
                                                                            <a href="{{ $attachment['url'] ?? '#' }}" class="list-item icon-left t-primary title-small-semi-bold" aria-label="{{ $attachment['label'] ?? '' }}">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true"><use href="{{ $sprite }}#it-clip"></use></svg>
                                                                                    <span class="list-item-title title-small-semi-bold">{{ $attachment['label'] ?? '' }}</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <button type="button" class="btn btn-primary justify-content-center my-3"><span>{{ $payment['action_label'] ?? '' }}</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if(!empty($data['payments_cta']))
                                <button type="button" class="btn accordion-view-more mb-2 pt-3 t-primary title-xsmall-semi-bold ps-lg-3"><span>{{ $data['payments_cta'] }}</span></button>
                            @endif
                        </section>

                        <section class="it-page-section mb-50 mb-lg-90" id="contacts">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                        <div class="d-flex"><h2 class="title-xxlarge mb-3">{{ $contactsTitle }}</h2></div>
                                    </div>
                                    <div class="card-body p-0">
                                        <ul class="link-list">
                                            @foreach($contacts as $contact)
                                                <li><a class="list-item" href="{{ $contact['url'] ?? '#' }}"><span>{{ $contact['label'] ?? '' }}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="it-page-section mb-50 mb-lg-90" id="highlight">
                            <div class="cmp-card">
                                <div class="card card-teaser rounded shadow-sm p-4">
                                    <div class="card-body p-0">
                                        <date class="date-xsmall">{{ $highlight['date'] ?? '' }}</date>
                                        <h2 class="title-xxlarge mt-2">{{ $highlight['title'] ?? '' }}</h2>
                                        <h5 class="subtitle-large mb-3">{{ $highlight['subtitle'] ?? '' }}</h5>
                                        <p class="mb-3">{{ $highlight['text'] ?? '' }}</p>
                                        <a href="{{ $highlight['url'] ?? '#' }}" class="t-primary text-decoration-none">{{ $highlight['link_label'] ?? '' }}</a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="it-page-section mb-50 mb-lg-90" id="search-section">
                            <div class="cmp-search-box">
                                <h2 class="title-xxlarge mb-3">{{ $searchTitle }}</h2>
                                <form>
                                    <div class="cmp-input-search">
                                        <label class="visually-hidden" for="search-area-personale">{{ $searchLabel }}</label>
                                        <input id="search-area-personale" type="search" class="form-control" placeholder="{{ $searchLabel }}">
                                        <button type="submit" class="btn btn-primary"><span>{{ $searchButton }}</span></button>
                                    </div>
                                </form>
                                <div class="cmp-icon-list mt-4">
                                    <h3 class="title-medium mb-3">{{ $searchSuggestionsTitle }}</h3>
                                    <ul class="link-list">
                                        @foreach(($data['search_suggestions'] ?? []) as $suggestion)
                                            <li><a class="list-item" href="{{ $suggestion['url'] ?? '#' }}"><span>{{ $suggestion['label'] ?? '' }}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal for messages - matches reference: div.modal#modal-message --}}
<div class="modal fade it-dialog-scrollable" tabindex="-1" role="dialog" id="modal-message" aria-labelledby="modal-message-modal-title">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-dimensions h-100">
            <div class="cmp-modal__header modal-header pb-0">
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ __('fixcity::segnalazione.modal.close.label') }}">
                </button>
                <div class="cmp-modal__header mt-30 mt-lg-50">
                    <date class="date-regular w-100">{{ $messages[0]['date'] ?? '15/03/2022' }}</date>
                    <h2 id="modal-message-modal-title" class="title-xxxlarge mt-2 mb-0">{{ $messages[0]['title'] ?? __('fixcity::segnalazione.modal.message.title') }}</h2>
                </div>
            </div>
            <div class="modal-body">
                <div class="mb-60 mb-lg-80">
                    <h5 class="subtitle-large">{{ $messages[0]['subtitle'] ?? __('fixcity::segnalazione.modal.message.subtitle') }}</h5>
                    <p class="text-paragraph mb-4 fw-normal">{{ $messages[0]['body'] ?? __('fixcity::segnalazione.modal.message.body') }}</p>
                    @if(!empty($messages[0]['link']))
                        <a href="{{ $messages[0]['link'] }}" class="text-paragraph t-primary text-decoration-underline">{{ $messages[0]['link_label'] ?? '' }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
