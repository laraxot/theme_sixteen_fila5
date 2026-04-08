@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 3;
    $totalSteps = $data['total_steps'] ?? 3;
<<<<<<< HEAD
    $steps = $data['steps'] ?? ['Autorizzazioni e condizioni', 'Dati di segnalazione', 'Riepilogo'];
    $report = $data['report'] ?? [
        'address' => 'Via Solferino - 50100 Firenze (FI)',
        'type' => 'Danneggiamento proprietà pubblica',
        'title' => 'Panchina danneggiata',
        'details' => 'La seduta della panchina risulta inutilizzabile e pericolosa dato che ci sono molte schegge e parti appuntite',
        'images' => ['6yhakandsahm413d8da.jpg']
    ];
    $user = $data['user'] ?? [
        'name' => 'Giulia Bianchi',
        'cf' => 'GLABNC72H25H501Y',
        'phone' => '+39 331 1234567',
        'email' => 'giulia.bianchi@gmail.com'
    ];
    $contacts = $data['contacts'] ?? [];
=======
    $steps = $data['steps'] ?? ['Informativa sulla privacy', 'Dati di segnalazione', 'Riepilogo'];
    $summary = $data['summary'] ?? [];
>>>>>>> 7b4aba8 (.)
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
<<<<<<< HEAD

=======
>>>>>>> 7b4aba8 (.)
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
        </div>
    </div>

<<<<<<< HEAD
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="callout callout-highlight ps-3 warning">
                <div class="callout-title mb-20 d-flex align-items-center">
                    <svg class="icon icon-sm" aria-hidden="true">
                        <use href="{{ $sprite }}#it-horn"></use>
                    </svg>
                    <span>Attenzione</span>
                </div>
                <p class="titillium text-paragraph">Le informazioni che hai fornito hanno valore di dichiarazione.<span class="d-lg-block"> Verifica che siano corrette.</span></p>
            </div>
            <h2 class="title-xxlarge mb-4 mt-40">Segnalazione</h2>

            <div class="cmp-card mb-4">
                <div class="card has-bkg-grey shadow-sm mb-0">
                    <div class="card-header border-0 p-0 mb-lg-20 m-0">
                        <div class="d-flex">
                            <h3 class="subtitle-large mb-4">Disservizio</h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="cmp-info-summary bg-white p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 pb-2 d-flex justify-content-end">
                                    <a href="#" class="text-decoration-none"><span class="text-button-sm-semi t-primary">Modifica</span></a>
                                </div>
                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Indirizzo</div>
                                        <div class="border-light">
                                            <p class="data-text">{{ $report['address'] }}</p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Tipo di disservizio</div>
                                        <div class="border-light">
                                            <p class="data-text">{{ $report['type'] }}</p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Titolo</div>
                                        <div class="border-light">
                                            <p class="data-text">{{ $report['title'] }}</p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Dettagli</div>
                                        <div class="border-light">
                                            <p class="data-text">{{ $report['details'] }}</p>
                                        </div>
                                    </div>
                                    @if(!empty($report['images']))
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Immagini</div>
                                            <div class="border-light">
                                                <p class="data-text">{{ implode(', ', $report['images']) }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h2 class="title-xxlarge mb-4 mt-40">Dati Generali</h2>

            <div class="cmp-card mb-4">
                <div class="card has-bkg-grey shadow-sm mb-0">
                    <div class="card-header border-0 p-0 mb-lg-20 m-0">
                        <div class="d-flex">
                            <h3 class="subtitle-large mb-4">Autore della segnalazione</h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">{{ $user['name'] }}</h4>
                                </div>
                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Codice Fiscale</div>
                                        <div class="border-light">
                                            <p class="data-text">{{ $user['cf'] }}</p>
=======
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <div class="steppers-content" aria-live="polite">
                <div class="it-page-sections-container">
                    <section class="it-page-section">
                        <div class="cmp-card mb-40">
                            <div class="card has-bkg-grey shadow-sm p-big p-lg-4">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <h2 class="title-xxlarge mb-3">Riepilogo segnalazione</h2>
                                    <p class="subtitle-small mb-0">Controlla i dati inseriti prima di inviare la segnalazione</p>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-info-summary bg-white has-border mb-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-3">
                                                <h3 class="title-large-semi-bold mb-0">Luogo</h3>
                                            </div>
                                            <div class="card-body p-3">
                                                <p class="text-paragraph mb-0">{{ $summary['place'] ?? 'Via Roma, 1' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="cmp-info-summary bg-white has-border mb-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-3">
                                                <h3 class="title-large-semi-bold mb-0">Dettagli disservizio</h3>
                                            </div>
                                            <div class="card-body p-3">
                                                <p class="text-paragraph mb-2"><strong>Tipo:</strong> {{ $summary['type'] ?? 'Danneggiamento proprietà pubblica' }}</p>
                                                <p class="text-paragraph mb-2"><strong>Titolo:</strong> {{ $summary['title'] ?? 'Buca sulla strada' }}</p>
                                                <p class="text-paragraph mb-0">{{ $summary['details'] ?? 'Presente una buca pericolosa sul manto stradale.' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="cmp-info-summary bg-white has-border mb-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-3">
                                                <h3 class="title-large-semi-bold mb-0">Autore della segnalazione</h3>
                                            </div>
                                            <div class="card-body p-3">
                                                <p class="text-paragraph mb-2"><strong>Nome:</strong> {{ $summary['user_name'] ?? 'Giulia Bianchi' }}</p>
                                                <p class="text-paragraph mb-0"><strong>Email:</strong> {{ $summary['user_email'] ?? 'giulia.bianchi@email.it' }}</p>
                                            </div>
>>>>>>> 7b4aba8 (.)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD
                        <div class="cmp-info-summary bg-white p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">Contatti</h4>
                                </div>
                                <div class="card-body p-0">
                                    @if(!empty($user['phone']))
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Telefono</div>
                                            <div class="border-light">
                                                <p class="data-text">{{ $user['phone'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    @if(!empty($user['email']))
                                        <div class="single-line-info border-light">
                                            <div class="text-paragraph-small">Email</div>
                                            <div class="border-light">
                                                <p class="data-text">{{ $user['email'] }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm send" data-bs-toggle="modal" data-bs-target="#modal-terms" @click="modalOpen = true">
                        <span class="text-button-sm">Invia</span>
                    </button>
                </nav>
                <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
                    <span class="d-inline-block text-uppercase cmp-disclaimer__message">Richiesta salvata con successo</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="cmp-modal">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-terms" aria-labelledby="modal-terms-modal-title" x-data="{ modalOpen: false }" x-show="modalOpen" @keydown.escape.window="modalOpen = false" x-cloak>
        <div class="modal-dialog modal-dialog-centered small" role="document">
            <div class="modal-content modal-dimensions">
                <div class="cmp-modal__header modal-header pb-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" @click="modalOpen = false" aria-label="Chiudi finestra modale"></button>
                    <h2 class="cmp-modal__header-title title-mini" id="modal-terms-modal-title">Termini e condizioni</h2>
                    <p class="cmp-modal__header-info header-font">Cliccando su Conferma e invia confermi di aver preso visione dei termini e delle condizioni di servizio.</p>
                    <a href="#" class="cmp-modal__header-link text-success underline mt-1">Leggi termini e condizioni</a>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer pb-70 pt-0">
                    <button class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="#" @click="submitForm()" form="">Conferma e invia</button>
                    <button class="btn btn-outline-primary w-100 mx-0 fw-bold" type="button" data-bs-dismiss="modal" @click="modalOpen = false">Annulla</button>
=======
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
                        <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm">
                            <span class="text-button-sm">Conferma e invia</span>
                            <svg class="icon icon-white icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#it-check"></use>
                            </svg>
                        </button>
                    </nav>
>>>>>>> 7b4aba8 (.)
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-grey-card shadow-contacts">
    <div class="container">
<<<<<<< HEAD
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
=======
        <div class="row d-flex justify-content-center p-contacts">
            <div class="col-12 col-lg-5">
>>>>>>> 7b4aba8 (.)
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
