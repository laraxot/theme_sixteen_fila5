@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $privacyText = $data['privacy_text'] ?? '';
    $privacyLink = $data['privacy_link'] ?? '#';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 1;
    $totalSteps = $data['total_steps'] ?? 3;
    $steps = $data['steps'] ?? ['Autorizzazioni e condizioni', 'Dati di segnalazione', 'Riepilogo'];
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
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <h1 class="title-xxxlarge mb-4">{{ $title }}</h1>
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
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            @if($privacyText)
                <p class="text-paragraph mb-lg-4">{{ $privacyText }}</p>
            @else
                <p class="text-paragraph mb-lg-4">
                    Il Comune di Firenze gestisce i dati personali forniti e liberamente comunicati sulla base dell'articolo 13
                    del Regolamento (UE) 2016/679 General data protection regulation (Gdpr) e degli articoli 13 e successive
                    modifiche e integrazione del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).
                </p>
                <p class="text-paragraph mb-0">
                    Per i dettagli sul trattamento dei dati personali consulta l'
                    <a href="{{ $privacyLink }}" class="t-primary">informativa sulla privacy.</a>
                </p>
            @endif

            <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                <div class="checkbox-body d-flex align-items-center">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field">
                    <label class="title-small-semi-bold pt-1" for="privacy">Ho letto e compreso l'informativa sulla privacy</label>
                </div>
            </div>
            <button type="button" class="btn btn-primary mobile-full">
                <span class="">Avanti</span>
            </button>
        </div>
    </div>
</div>

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">Contatta il comune</h2>
                            <ul class="contact-list p-0">
                                @if(!empty($contacts['faq']))
                                    <li><a class="list-item" href="{{ $contacts['faq'] }}">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-help-circle"></use>
                                        </svg><span>Leggi le domande frequenti</span></a></li>
                                @else
                                    <li><a class="list-item" href="#">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-help-circle"></use>
                                        </svg><span>Leggi le domande frequenti</span></a></li>
                                @endif
                                @if(!empty($contacts['assistenza']))
                                    <li><a class="list-item" href="{{ $contacts['assistenza'] }}" data-element="contacts">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-mail"></use>
                                        </svg><span>Richiedi assistenza</span></a></li>
                                @else
                                    <li><a class="list-item" href="#" data-element="contacts">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-mail"></use>
                                        </svg><span>Richiedi assistenza</span></a></li>
                                @endif
                                @if(!empty($contacts['phone']))
                                    <li><a class="list-item" href="tel:{{ $contacts['phone'] }}">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-hearing"></use>
                                        </svg><span>Chiama il numero {{ $contacts['phone'] }}</span></a></li>
                                @else
                                    <li><a class="list-item" href="#">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-hearing"></use>
                                        </svg><span>Chiama il numero verde 05 0505</span></a></li>
                                @endif
                                @if(!empty($contacts['appointment']))
                                    <li><a class="list-item" href="{{ $contacts['appointment'] }}" data-element="appointment-booking">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-calendar"></use>
                                        </svg><span>Prenota appuntamento</span></a></li>
                                @else
                                    <li><a class="list-item" href="#" data-element="appointment-booking">
                                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-calendar"></use>
                                        </svg><span>Prenota appuntamento</span></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>