{{--
    Feedback Rating Block - Full Bootstrap Italia Structure
    Reference: design-comuni-pagine-statiche/sito/homepage.html .bg-primary #rating
--}}
@props(['data' => []])
@php
    $title    = $data['title'] ?? 'Quanto sono chiare le informazioni su questa pagina?';
    $subtitle = $data['subtitle'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!';
@endphp

<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6">
                <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                    <div class="card shadow card-wrapper" data-element="feedback">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ $title }}</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating">
                                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                                    @php
                                        $stars = [
                                            5 => ['id' => 'first-star',  'label' => 'Valuta 5 stelle su 5'],
                                            4 => ['id' => 'second-star', 'label' => 'Valuta 4 stelle su 5'],
                                            3 => ['id' => 'third-star',  'label' => 'Valuta 3 stelle su 5'],
                                            2 => ['id' => 'fourth-star', 'label' => 'Valuta 2 stelle su 5'],
                                            1 => ['id' => 'fifth-star',  'label' => 'Valuta 1 stelle su 5'],
                                        ];
                                    @endphp
                                    @foreach($stars as $val => $star)
                                    <input type="radio" id="star{{ $val }}a" name="ratingA" value="{{ $val }}">
                                    <label class="full rating-star active" for="star{{ $val }}a" data-element="feedback-rate-{{ $val }}">
                                        <svg class="icon icon-sm" role="img" aria-labelledby="{{ $star['id'] }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                        </svg>
                                        <span class="visually-hidden" id="{{ $star['id'] }}">{{ $star['label'] }}</span>
                                    </label>
                                    @endforeach
                                </fieldset>
                            </div>
                        </div>
                        <div class="cmp-rating__card-second d-none" data-step="3">
                            <div class="card-header border-0 mb-0">
                                <h2 class="title-medium-2-bold mb-0" id="rating-feedback">{{ $subtitle }}</h2>
                            </div>
                        </div>
                        <div class="form-rating d-none">
                            <div class="d-none" data-step="1">
                                <div class="cmp-steps-rating">
                                    <fieldset class="fieldset-rating-one d-none" data-element="feedback-rating-positive">
                                        <legend class="iscrizioni-header w-100">
                                            <h3 class="step-title d-flex flex-column flex-lg-row align-items-lg-center justify-content-between drop-shadow">
                                                <span class="d-block text-wrap" data-element="feedback-rating-question">Quali sono stati gli aspetti che hai preferito?</span>
                                                <span class="step">1/2</span>
                                            </h3>
                                        </legend>
                                        <div class="cmp-steps-rating__body">
                                            <div class="cmp-radio-list">
                                                <div class="card card-teaser shadow-rating">
                                                    <div class="card-body">
                                                        <div class="form-check m-0">
                                                            @foreach(['Le indicazioni erano chiare','Le indicazioni erano complete','Capivo sempre che stavo procedendo correttamente','Non ho avuto problemi tecnici','Altro'] as $i => $answer)
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-{{ $i+1 }}">
                                                                <label for="radio-{{ $i+1 }}" class="active" data-element="feedback-rating-answer">{{ $answer }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="fieldset-rating-two d-none" data-element="feedback-rating-negative">
                                        <legend class="iscrizioni-header w-100">
                                            <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                                <span class="d-block text-wrap" data-element="feedback-rating-question">Dove hai incontrato le maggiori difficoltà?</span>
                                                <span class="step">1/2</span>
                                            </h3>
                                        </legend>
                                        <div class="cmp-steps-rating__body">
                                            <div class="cmp-radio-list">
                                                <div class="card card-teaser shadow-rating">
                                                    <div class="card-body">
                                                        <div class="form-check m-0">
                                                            @foreach(['A volte le indicazioni non erano chiare','A volte le indicazioni non erano complete','A volte non capivo se stavo procedendo correttamente','Ho avuto problemi tecnici','Altro'] as $i => $answer)
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-{{ $i+6 }}">
                                                                <label for="radio-{{ $i+6 }}" class="active" data-element="feedback-rating-answer">{{ $answer }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="d-none" data-step="2">
                                <div class="cmp-steps-rating">
                                    <fieldset>
                                        <legend class="iscrizioni-header w-100">
                                            <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                                <span class="d-block text-wrap">Vuoi aggiungere altri dettagli?</span>
                                                <span class="step">2/2</span>
                                            </h3>
                                        </legend>
                                        <div class="cmp-steps-rating__body">
                                            <div class="form-group">
                                                <label for="formGroupExampleInputWithHelp" class="">Dettaglio</label>
                                                <input type="text" class="form-control" id="formGroupExampleInputWithHelp" aria-describedby="formGroupExampleInputWithHelpDescription" maxlength="200" data-element="feedback-input-text">
                                                <small id="formGroupExampleInputWithHelpDescription" class="form-text">Inserire massimo 200 caratteri</small>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="d-flex flex-nowrap pt-4 w-100 justify-content-center button-shadow">
                                <button class="btn btn-outline-primary fw-bold me-4 btn-back" type="button">Indietro</button>
                                <button class="btn btn-primary fw-bold btn-next" type="submit" form="rating">Avanti</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
