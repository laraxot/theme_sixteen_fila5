@props(['data' => []])

@php
    $title = $data['title'] ?? 'Elenco segnalazioni';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $totalCount = $data['total_count'] ?? 645;
    $resolvedCount = $data['resolved_count'] ?? 73;
    $timeframe = $data['timeframe'] ?? '12 mesi';
    $categories = $data['categories'] ?? [
        ['id' => 'water', 'label' => 'Acqua, allagamenti, problemi fognari', 'count' => 21],
        ['id' => 'environment', 'label' => 'Ambiente, inquinamento, protezione ambientale', 'count' => 14],
        ['id' => 'street-furniture', 'label' => 'Arredo urbano', 'count' => 7],
        ['id' => 'rodent-control', 'label' => 'Disinfestazione, derattizazione, animali randagi', 'count' => 208],
        ['id' => 'waste', 'label' => 'Igiene urbana, rifiuti, pulizia e decoro', 'count' => 321],
        ['id' => 'maintenance', 'label' => 'Manutenzione immobili, edifici pubblici, scuole, barriere architettoniche, cimiteri', 'count' => 302],
        ['id' => 'public-order', 'label' => 'Ordine pubblico, disturbo della quiete', 'count' => 302],
        ['id' => 'green', 'label' => 'Parchi e verde pubblico', 'count' => 302],
        ['id' => 'service', 'label' => 'Servizi del comune', 'count' => 302],
        ['id' => 'security', 'label' => 'Sicurezza, degrado urbano e sociale', 'count' => 302],
        ['id' => 'road', 'label' => 'Strade, marciapiedi, segnaletica e viabilità', 'count' => 302],
    ];
    $reports = $data['reports'] ?? [
        [
            'title' => 'Buca in via Solferino',
            'type' => 'Verde pubblico e arredo urbano',
            'address' => 'Via Solferino - 50100 Firenze',
            'details' => "Sulla strada c'è una buca piuttosto profonda che andrebbe sistemata con urgenza",
            'images' => []
        ]
    ];
    $primaryActionUrl = $data['primary_action_url'] ?? '/it/tests/segnalazione-01-privacy';
    $contacts = $data['contacts'] ?? [];
@endphp

<div class="container" id="main-container" x-data="{ activeTab: 'disservizio1', modalCategories: false, modalDisservizio: false, openAccordion: {} }">
    <div class="row justify-content-center mb-md-40 mb-lg-80">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading p-0">
                <h1 class="title-xxxlarge">{{ $title }}</h1>
                <p class="subtitle-small">Negli ultimi {{ $timeframe }} sono state risolte {{ $resolvedCount }} segnalazioni.</p>
            </div>
        </div>
        <hr class="d-none d-lg-block mt-30 mb-2">
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-3 d-none d-lg-block">
            <fieldset>
                <legend class="h6 text-uppercase category-list__title">categoria</legend>
                <div class="categoy-list pb-4">
                    <ul>
                        @foreach($categories as $cat)
                            <li>
                                <div class="form-check">
                                    <div class="checkbox-body border-light py-1">
                                        <input type="checkbox" id="{{ $cat['id'] }}" name="category" value="{{ $cat['label'] }}">
                                        <label for="{{ $cat['id'] }}" class="subtitle-small_semi-bold mb-0 category-list__list">{{ $cat['label'] }} ({{ $cat['count'] }})</label>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </fieldset>
        </div>
        <div class="col-lg-8 offset-lg-1">
            <div class="d-flex justify-content-between border-bottom border-light pb-3 mt-5">
                <span class="search-results">{{ $totalCount }} Risultati</span>

                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-categories" @click="modalCategories = true" class="btn p-0 pe-2 d-lg-none">
                    <span class="rounded-icon">
                        <svg class="icon icon-primary icon-xs" aria-hidden="true">
                            <use href="{{ $sprite }}#it-funnel"></use>
                        </svg>
                    </span>
                    <span class="t-primary title-xsmall-semi-bold ms-1">Filtra</span>
                </button>
                <button type="button" class="btn p-0 pe-2 d-none d-lg-block">
                    <span class="title-xsmall-semi-bold ms-1">Rimuovi tutti i filtri</span>
                </button>
            </div>

            <ul class="nav nav-tabs w-100 flex-nowrap border-bottom border-light mb-40 mt-3 shadow-none" id="tabDisservizio" role="tablist">
                <li class="nav-item w-100" role="tab">
                    <a class="nav-link active title-medium-semi-bold pt-0" href="#data-ex-disservizio1" aria-current="page" data-bs-toggle="tab" role="button" aria-controls="disservizio1" aria-selected="true" @click="activeTab = 'disservizio1'">
                        Mappa
                    </a>
                </li>
                <li class="nav-item w-100" role="tab">
                    <a class="nav-link title-medium-semi-bold pt-0" href="#data-ex-disservizio2" aria-current="page" data-bs-toggle="tab" role="button" aria-controls="disservizio2" aria-selected="true" @click="activeTab = 'disservizio2'">
                        Elenco
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" :class="{ 'fade show active': activeTab === 'disservizio1' }" id="data-ex-disservizio1" role="tabpanel" x-show="activeTab === 'disservizio1'">
                    <div class="row">
                        <div class="col-12">
                            <div class="map-box">
                                <img src="/themes/Sixteen/design-comuni/assets/images/map-placeholder.svg" alt="Mappa" class="w-100">
                                <button type="button" class="pin" data-bs-toggle="modal" data-bs-target="#modal-disservizio" @click="modalDisservizio = true">
                                    <img src="/themes/Sixteen/design-comuni/assets/images/map-pin.svg" alt="Pin di geolocalizzazione" title="Pin di geolocalizzazione">
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                            <div class="cmp-text-button mt-0">
                                <h2 class="title-xxlarge mb-0">Fai una segnalazione</h2>
                                <div class="text-wrapper">
                                    <p class="subtitle-small mb-3 mt-3">Se vuoi aggiungere una segnalazione, puoi farlo dopo esserti autenticato con le tue credenziali SPID o CIE.</p>
                                </div>
                                <div class="button-wrapper">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-disservizio" @click="modalDisservizio = true" class="btn btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0">
                                        <span class="">Segnala disservizio</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" :class="{ 'fade show active': activeTab === 'disservizio2' }" id="data-ex-disservizio2" role="tabpanel" x-show="activeTab === 'disservizio2'">
                    <div class="row">
                        @foreach($reports as $report)
                            <div class="cmp-card mb-4 mb-lg-30">
                                <div class="card has-bkg-grey shadow-sm">
                                    <div class="card-body p-0">
                                        <div class="cmp-info-button-card">
                                            <div class="card p-3 p-lg-4">
                                                <div class="card-body p-0">
                                                    <h3 class="medium-title mb-0">{{ $report['title'] }}</h3>
                                                    <p class="card-info">Tipologia di segnalazione <br>
                                                        <span>{{ $report['type'] }}</span></p>
                                                    <div class="accordion-item">
                                                        <div class="accordion-header">
                                                            <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $loop->index }}" @click="openAccordion[$loop.index] = !openAccordion[$loop.index]" aria-expanded="false" aria-controls="collapse-{{ $loop->index }}">
                                                                <span class="d-flex align-items-center">
                                                                    Mostra tutto
                                                                    <svg class="icon icon-primary icon-sm">
                                                                        <use href="{{ $sprite }}#it-expand"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse" role="region">
                                                            <div class="accordion-body p-0">
                                                                <div class="cmp-info-summary bg-white border-0">
                                                                    <div class="card">
                                                                        <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-end">
                                                                            <a href="#" class="d-none text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                                                        </div>
                                                                        <div class="card-body p-0">
                                                                            <div class="single-line-info border-light">
                                                                                <div class="text-paragraph-small">Indirizzo</div>
                                                                                <div class="border-light">
                                                                                    <p class="data-text">{{ $report['address'] }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="single-line-info border-light">
                                                                                <div class="text-paragraph-small">Dettaglio</div>
                                                                                <div class="border-light">
                                                                                    <p class="data-text">{{ $report['details'] }}</p>
                                                                                </div>
                                                                            </div>
                                                                            @if(!empty($report['images']))
                                                                                <div class="single-line-info border-light border-0">
                                                                                    <div class="text-paragraph-small">Immagini</div>
                                                                                    <div class="border-light border-0">
                                                                                        <div class="d-lg-flex gap-2 mt-3">
                                                                                            @foreach($report['images'] as $img)
                                                                                                <div>
                                                                                                    <img src="{{ $img }}" alt="Immagine della mappa di dove si trova il disservizio" class="img-fluid w-100 mb-3 mb-lg-0">
                                                                                                </div>
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
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
                            </div>
                        @endforeach

                        <div class="col-12 text-center">
                            <button type="button" class="btn btn btn-outline-primary mobile-full py-3 mt-10 mx-auto">
                                <span class="">Carica altre segnalazioni</span>
                            </button>
                        </div>
                        <div class="col-lg-6 mt-50 mb-4 mb-lg-0">
                            <div class="cmp-text-button mt-0">
                                <h2 class="title-xxlarge mb-0">Fai una segnalazione</h2>
                                <div class="text-wrapper">
                                    <p class="subtitle-small mb-3 mt-3">Se vuoi aggiungere una segnalazione, puoi farlo dopo esserti autenticato con le tue credenziali SPID o CIE.</p>
                                </div>
                                <div class="button-wrapper">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#modal-disservizio" @click="modalDisservizio = true" class="btn btn btn-primary mobile-full py-3 mt-2 mb-4 mb-lg-0">
                                        <span class="">Segnala disservizio</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6 p-lg-0 px-3">
                <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                    <div class="card shadow card-wrapper" data-element="feedback">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">Quanto sono chiare le informazioni su questa pagina?</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating">
                                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                                    @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}b" name="ratingB" value="{{ $i }}">
                                        <label class="full rating-star active" for="star{{ $i }}b" data-element="feedback-rate-{{ $i }}">
                                            <svg class="icon icon-sm" role="img" aria-labelledby="star-b-{{ $i }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                                                <path fill="none" d="M0 0h24v24H0z"/>
                                            </svg>
                                            <span class="visually-hidden" id="star-b-{{ $i }}">Valuta {{ $i }} stelle su 5</span>
                                        </label>
                                    @endfor
                                </fieldset>
                            </div>
                        </div>
                        <div class="cmp-rating__card-second d-none" data-step="3">
                            <div class="card-header border-0 mb-0">
                                <h2 class="title-medium-2-bold mb-0" id="rating-feedback">Grazie, il tuo parere ci aiuterà a migliorare il servizio!</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>