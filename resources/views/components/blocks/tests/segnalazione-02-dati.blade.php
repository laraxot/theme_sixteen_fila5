@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 2;
    $totalSteps = $data['total_steps'] ?? 3;
    $steps = $data['steps'] ?? ['Informativa sulla privacy', 'Dati di segnalazione', 'Riepilogo'];
    $sections = $data['sections'] ?? [];
    $placeholders = $data['placeholders'] ?? [
        'search_place' => 'Cerca un luogo*',
        'inefficiency_type' => 'Tipo di disservizio*',
        'title' => 'Titolo*',
        'details' => 'Dettagli**'
    ];
    $inefficiencyTypes = $data['inefficiency_types'] ?? ['Danneggiamento proprietà pubblica'];
    $contacts = $data['contacts'] ?? [];
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item"><a href="#">Servizi</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">{{ $title }}</h1>
            </div>
        </div>
        <div class="col-12">
            <div class="steppers">
                <div class="steppers-header">
                    <ul>
                        @foreach($steps as $index => $step)
                            <li class="{{ $index + 1 === $currentStep ? 'active' : ($index + 1 < $currentStep ? 'confirmed' : '') }}">
                                {{ $step }}
                                @if($index + 1 < $currentStep)
                                    <svg class="icon steppers-success" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-check"></use>
                                    </svg>
                                    <span class="visually-hidden">Confermato</span>
                                @elseif($index + 1 === $currentStep)
                                    <span class="visually-hidden">Attivo</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <span class="steppers-index" aria-hidden="true">{{ $currentStep }}/{{ $totalSteps }}</span>
                </div>
            </div>
            <p class="title-xsmall d-lg-none my-5">I campi contraddistinti dal simbolo asterisco sono obbligatori</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INFORMAZIONI RICHIESTE" data-bs-navscroll>
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                            <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                INFORMAZIONI RICHIESTE
                                                <svg class="icon icon-xs right">
                                                    <use href="{{ $sprite }}#it-expand"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#report-place">
                                                            <span>Luogo</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#report-info">
                                                            <span>Disservizio</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#report-author">
                                                            <span>Autore della segnalazione</span>
                                                        </a>
                                                    </li>
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
        <div class="col-12 col-lg-8 offset-lg-1">
            <div class="steppers-content" aria-live="polite">
                <div class="it-page-sections-container">
                    <section class="it-page-section" id="report-place">
                        <div class="cmp-card mb-40">
                            <div class="card has-bkg-grey shadow-sm p-big p-lg-4">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge mb-1">Luogo</h2>
                                    </div>
                                    <p class="subtitle-small mb-0">Indica il luogo del disservizio</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-input-autocomplete">
                                        <div class="form-group bg-white p-3 mb-0 mt-3">
                                            <label class="label-input d-none mb-2" for="autocomplete-regioni">{{ $placeholders['search_place'] }}</label>
                                            <input type="search" class="autocomplete" placeholder="{{ $placeholders['search_place'] }}" id="autocomplete-regioni" name="autocomplete-regioni" required>
                                            <div class="link-wrapper mt-3">
                                                <a class="list-item active icon-left" href="#">
                                                    <span class="list-item-title-icon-wrapper">
                                                        <svg class="icon icon-sm icon-primary mb-1" aria-hidden="true">
                                                            <use href="{{ $sprite }}#it-map-marker"></use>
                                                        </svg>
                                                        <span class="list-item-title t-primary">Usa la tua posizione</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="it-page-section" id="report-info">
                        <div class="cmp-card mb-40">
                            <div class="card has-bkg-grey shadow-sm p-big">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge mb-3 icon-required">Disservizio</h2>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="select-wrapper p-md-3 p-lg-4 pb-lg-0 select-partials">
                                        <label for="inefficiency" class="visually-hidden">{{ $placeholders['inefficiency_type'] }}</label>
                                        <select id="inefficiency" class="u-grey-dark" required>
                                            <option selected="selected" value="">{{ $placeholders['inefficiency_type'] }}</option>
                                            @foreach($inefficiencyTypes as $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-area-wrapper p-3 px-lg-4 pt-lg-5 pb-lg-0 bg-white">
                                        <div class="form-group cmp-input mb-0">
                                            <label class="cmp-input__label" for="title">{{ $placeholders['title'] }}</label>
                                            <input type="text" class="form-control" id="title" name="title" required>
                                        </div>
                                    </div>
                                    <div class="cmp-text-area m-0 p-3 px-lg-4 pt-lg-5 pb-lg-4 bg-white">
                                        <div class="form-group">
                                            <label for="details" class="d-block">{{ $placeholders['details'] }}</label>
                                            <textarea class="text-area" id="details" rows="2" required></textarea>
                                            <span class="label">Inserire al massimo 200 caratteri</span>
                                        </div>
                                    </div>
                                    <div class="btn-wrapper px-3 pt-2 pb-3 px-lg-4 pb-lg-4 pt-lg-0 bg-white">
                                        <label class="title-xsmall-bold u-grey-dark pb-2 ms-2">Immagini</label>
                                        <button type="button" aria-label="Carica file per il disservizio" class="btn btn-primary w-100 fw-bold">
                                            <span class="rounded-icon">
                                                <svg class="icon icon-white icon-sm" aria-hidden="true">
                                                    <use href="{{ $sprite }}#it-upload"></use>
                                                </svg>
                                            </span>
                                            <span class="">Carica file</span>
                                        </button>
                                        <p class="title-xsmall u-grey-dark pt-10 mb-0">Seleziona una o più immagini da allegare alla segnalazione</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="it-page-section" id="report-author">
                        <div class="cmp-card">
                            <div class="card has-bkg-grey shadow-sm">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <div class="d-flex">
                                        <h2 class="title-xxlarge mb-1">Autore della segnalazione</h2>
                                    </div>
                                    <p class="subtitle-small mb-0">Informazione su di te</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-info-button-card mt-3">
                                        <div class="card p-3 p-lg-4">
                                            <div class="card-body p-0">
                                                @if(!empty($data['user']))
                                                    <h3 class="big-title mb-0">{{ $data['user']['name'] ?? '' }}</h3>
                                                    <p class="card-info">Codice Fiscale <br> <span>{{ $data['user']['cf'] ?? '' }}</span></p>
                                                    <div class="accordion-item">
                                                        <div class="accordion-header" id="heading-collapse-parents">
                                                            <button class="collapsed accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-parents" aria-expanded="false" aria-controls="collapse-parents">
                                                                <span class="d-flex align-items-center">
                                                                    Mostra tutto
                                                                    <svg class="icon icon-primary icon-sm">
                                                                        <use href="{{ $sprite }}#it-expand"></use>
                                                                    </svg>
                                                                </span>
                                                            </button>
                                                        </div>
                                                        <div id="collapse-parents" class="accordion-collapse collapse" role="region">
                                                            <div class="accordion-body p-0">
                                                                <div class="cmp-info-summary bg-white has-border">
                                                                    <div class="card">
                                                                        <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                                            <h4 class="title-large-semi-bold mb-3">Contatti</h4>
                                                                        </div>
                                                                        <div class="card-body p-0">
                                                                            @if(!empty($data['user']['phone']))
                                                                                <div class="single-line-info border-light">
                                                                                    <div class="text-paragraph-small">Telefono</div>
                                                                                    <div class="border-light">
                                                                                        <p class="data-text">{{ $data['user']['phone'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @if(!empty($data['user']['email']))
                                                                                <div class="single-line-info border-light">
                                                                                    <div class="text-paragraph-small">Email</div>
                                                                                    <div class="border-light">
                                                                                        <p class="data-text">{{ $data['user']['email'] }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <p class="text-muted">Effettua il login per visualizzare i tuoi dati</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="cmp-nav-steps">
                    <nav class="steppers-nav" aria-label="Step">
                        <button type="button" class="btn btn-sm steppers-btn-prev p-0">
                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#it-chevron-left"></use>
                            </svg>
                            <span class="text-button-sm t-primary">Indietro</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn">
                            <span class="text-button-sm t-primary">Salva Richiesta</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-block d-lg-none saveBtn center">
                            <span class="text-button-sm t-primary">Salva</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm" data-bs-toggle="modal" data-bs-target="#">
                            <span class="text-button-sm">Avanti</span>
                            <svg class="icon icon-white icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#it-chevron-right"></use>
                            </svg>
                        </button>
                    </nav>
                    <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
                        <span class="d-inline-block text-uppercase cmp-disclaimer__message">Richiesta salvata con successo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row d-flex justify-content-center p-contacts">
            <div class="col-12 col-lg-5">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">Contatta il comune</h2>
                            <ul class="contact-list p-0">
                                <li><a class="list-item" href="#">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-help-circle"></use>
                                    </svg><span>Leggi le domande frequenti</span></a></li>
                                <li><a class="list-item" href="#" data-element="contacts">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-mail"></use>
                                    </svg><span>Richiedi assistenza</span></a></li>
                                <li><a class="list-item" href="#">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-hearing"></use>
                                    </svg><span>Chiama il numero verde 05 0505</span></a></li>
                                <li><a class="list-item" href="#" data-element="appointment-booking">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-calendar"></use>
                                    </svg><span>Prenota appuntamento</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>