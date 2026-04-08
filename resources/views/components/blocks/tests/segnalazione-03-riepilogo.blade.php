@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 3;
    $totalSteps = $data['total_steps'] ?? 3;
    $steps = $data['steps'] ?? ['Informativa sulla privacy', 'Dati di segnalazione', 'Riepilogo'];
    $summary = $data['summary'] ?? [];
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
        </div>
    </div>

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
                        <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm">
                            <span class="text-button-sm">Conferma e invia</span>
                            <svg class="icon icon-white icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#it-check"></use>
                            </svg>
                        </button>
                    </nav>
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
