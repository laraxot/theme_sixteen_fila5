@props([
    'title' => 'Segnalazione inviata',
    'segnalazione' => [],
    'showActions' => true,
    'email' => '',
    'showRating' => true,
])

@php
    $segnalazione = array_merge([
        'codice_segnalazione' => 'AN4059281',
        'categoria' => '',
        'titolo' => '',
        'data_invio' => '',
    ], $segnalazione);
    
    $email = $email ?: 'giulia.bianchi@gmail.com';
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-heading p-0">
                <div class="categoryicon-top d-flex">
                    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-check-circle"></use>
                    </svg>
                    <h1 class="title-xxxlarge">{{ $title }}</h1>
                </div>
                
                <p class="subtitle-small">Grazie, abbiamo ricevuto la tua <strong>segnalazione {{ $segnalazione['codice_segnalazione'] }}.</strong></p>
                <p class="subtitle-small">Sarà visibile sulla <a href="#" class="t-primary">lista di tutte le segnalazioni</a> una volta presa in carico dall'amministrazione.</p>
                <p class="subtitle-small pt-3 pt-lg-4">Abbiamo inviato il riepilogo all'email:<br><strong>{{ $email }}</strong></p>
                
                <button type="button" class="btn btn-outline-primary bg-white fw-bold mt-4">
                    <span class="rounded-icon">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-download"></use>
                        </svg>
                    </span>
                    <span class="">Scarica la ricevuta (PDF 100KB)</span>
                </button>
            </div>
            
            <p class="mt-3">
                <a href="#" class="t-primary text-paragraph">Consulta la richiesta</a>
                <span class="text-paragraph"> nella tua area riservata</span>
            </p>
        </div>
    </div>
    
    <hr class="d-none d-lg-block mt-40 mb-0">
    <div class="row justify-content-center mb-3 mb-md-5">
        <div class="col-12 col-lg-10">
            <div class="cmp-icon-list">
                <h2 class="title-xxlarge mt-40 mb-2 mb-lg-4 mb-lg-4" id="related-service">Servizi correlati</h2>
                <div class="link-list-wrapper">
                    <ul class="link-list">
                        <li class="shadow mb-4">
                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#">
                                <span class="list-item-title-icon-wrapper">
                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                        <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-settings"></use>
                                    </svg>
                                    <span class="list-item-title title-small-semi-bold">Richiesta appuntamento</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    @if($showRating)
    <div class="bg-primary">
        <div class="container">
            <div class="row d-flex justify-content-center bg-primary">
                <div class="col-12 col-lg-6 p-lg-0 px-4">
                    <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                        <div class="card shadow card-wrapper" data-element="feedback">
                            <div class="cmp-rating__card-first">
                                <div class="card-header border-0">
                                    <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">Quanto è stato facile usare questo servizio?</h2>
                                </div>
                                <div class="card-body">
                                    <fieldset class="rating">
                                        <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                                        @for($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}">
                                        <label class="full rating-star" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                            <svg class="icon icon-sm" role="img" aria-hidden="true" viewBox="0 0 24 24">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                                            </svg>
                                            <span class="visually-hidden">Valuta {{ $i }} stelle su 5</span>
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
    @endif
    
    <div class="bg-grey-card shadow-contacts">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                    <div class="cmp-contacts">
                        <div class="card w-100">
                            <div class="card-body">
                                <h2 class="title-medium-2-semi-bold">Contatta il comune</h2>
                                <ul class="contact-list p-0">
                                    <li>
                                        <a class="list-item" href="#">
                                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-help-circle"></use>
                                            </svg>
                                            <span>Leggi le domande frequenti</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-item" href="#" data-element="contacts">
                                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-mail"></use>
                                            </svg>
                                            <span>Richiedi assistenza</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-item" href="#">
                                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-hearing"></use>
                                            </svg>
                                            <span>Chiama il numero verde 05 0505</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="list-item" href="#" data-element="appointment-booking">
                                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-calendar"></use>
                                            </svg>
                                            <span>Prenota appuntamento</span>
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
</div>