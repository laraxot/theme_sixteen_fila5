{{--
    Rating Block - Bootstrap Italia Multi-Step Style
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/risultati-ricerca.html
--}}
@props(['data' => []])

<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6">
                <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating" x-data="{ step: 1, ratingA: 0, ratingB: 0 }">
                    <div class="card shadow card-wrapper" data-element="feedback">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">Quanto sono chiare le informazioni su questa pagina?</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating">
                                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                                    <input type="radio" id="star5a" name="ratingA" value="5" x-model="ratingA" @click="step = 2">
                                    <label class="full rating-star active" for="star5a" data-element="feedback-rate-5">
                                        <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        </svg>
                                        <span class="visually-hidden">Valuta 5 stelle su 5</span>
                                    </label>
                                    <input type="radio" id="star4a" name="ratingA" value="4" x-model="ratingA" @click="step = 2">
                                    <label class="full rating-star active" for="star4a" data-element="feedback-rate-4">
                                        <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        </svg>
                                        <span class="visually-hidden">Valuta 4 stelle su 5</span>
                                    </label>
                                    <input type="radio" id="star3a" name="ratingA" value="3" x-model="ratingA" @click="step = 2">
                                    <label class="full rating-star active" for="star3a" data-element="feedback-rate-3">
                                        <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        </svg>
                                        <span class="visually-hidden">Valuta 3 stelle su 5</span>
                                    </label>
                                    <input type="radio" id="star2a" name="ratingA" value="2" x-model="ratingA" @click="step = 2">
                                    <label class="full rating-star active" for="star2a" data-element="feedback-rate-2">
                                        <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        </svg>
                                        <span class="visually-hidden">Valuta 2 stelle su 5</span>
                                    </label>
                                    <input type="radio" id="star1a" name="ratingA" value="1" x-model="ratingA" @click="step = 2">
                                    <label class="full rating-star active" for="star1a" data-element="feedback-rate-1">
                                        <svg class="icon icon-sm" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        </svg>
                                        <span class="visually-hidden">Valuta 1 stella su 5</span>
                                    </label>
                                </fieldset>
                            </div>
                        </div>

                        {{-- Step 2: Why low rating --}}
                        <div class="d-none" data-step="2" x-show="step === 2 && ratingA <= 3" x-cloak>
                            <div class="cmp-steps-rating">
                                <fieldset class="fieldset-rating-one">
                                    <legend class="iscrizioni-header w-100">
                                        <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                            <span class="d-block text-wrap" data-element="feedback-rating-question">Cosa non hai trovato chiaro?</span>
                                            <span class="step">1/2</span>
                                        </h3>
                                    </legend>
                                    <div class="cmp-steps-rating__body">
                                        <div class="cmp-radio-list">
                                            <ul class="list-unstyled">
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-6" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-6" class="active" data-element="feedback-rating-answer">Non ho capito quali erano i documenti necessari</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-7" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-7" class="active" data-element="feedback-rating-answer">A volte le indicazioni non erano complete</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-8" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-8" class="active" data-element="feedback-rating-answer">A volte non capivo se stavo procedendo correttamente</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-9" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-9" class="active" data-element="feedback-rating-answer">Ho avuto problemi tecnici</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-10" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-10" class="active" data-element="feedback-rating-answer">Altro</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        {{-- Step 2b: Positive feedback (rating >= 4) --}}
                        <div class="d-none" data-step="2-positive" x-show="step === 2 && ratingA >= 4" x-cloak>
                            <div class="cmp-steps-rating">
                                <fieldset class="fieldset-rating-one">
                                    <legend class="iscrizioni-header w-100">
                                        <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                            <span class="d-block text-wrap" data-element="feedback-rating-question">Cosa ti è piaciuto di questa pagina?</span>
                                            <span class="step">1/2</span>
                                        </h3>
                                    </legend>
                                    <div class="cmp-steps-rating__body">
                                        <div class="cmp-radio-list">
                                            <ul class="list-unstyled">
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-pos-1" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-pos-1" class="active" data-element="feedback-rating-positive">Le informazioni sono chiare</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-pos-2" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-pos-2" class="active" data-element="feedback-rating-positive">Ho trovato facilmente ciò che cercavo</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-pos-3" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-pos-3" class="active" data-element="feedback-rating-positive">La pagina è ben organizzata</label>
                                                </li>
                                                <li class="radio-body border-bottom border-light cmp-radio-list__item">
                                                    <input name="rating2" type="radio" id="radio-pos-4" x-model="ratingB" @click="step = 3">
                                                    <label for="radio-pos-4" class="active" data-element="feedback-rating-positive">Altro</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        {{-- Step 3: Additional details --}}
                        <div class="d-none" data-step="3" x-show="step === 3" x-cloak>
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
                                            <small id="formGroupExampleInputWithHelpDescription" class="form-text">
                                                Inserire massimo 200 caratteri</small>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>

                        <div class="d-flex flex-nowrap pt-4 w-100 justify-content-center button-shadow">
                            <button class="btn btn-outline-primary fw-bold me-4 btn-back" type="button" x-show="step > 1" @click="step--">Indietro</button>
                            <button class="btn btn-primary fw-bold btn-next" type="submit" form="rating">Avanti</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Contacts Section --}}
<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row d-flex justify-content-center p-contacts">
            <div class="col-12 col-lg-6">
                <div class="cmp-contacts" data-element="contacts">
                    <div class="card card-wrapper bg-white p-3">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold mb-0">Contatta l'ufficio</h2>
                            <p class="mb-4">Per maggiori informazioni sui servizi comunali</p>
                            <div class="d-flex flex-column gap-3">
                                <a href="tel:+390612345678" class="d-flex align-items-center gap-2 text-decoration-none text-primary" data-element="appointment-booking">
                                    <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-phone"></use></svg>
                                    <span>06 12345678</span>
                                </a>
                                <a href="mailto:urp@comune.it" class="d-flex align-items-center gap-2 text-decoration-none text-primary">
                                    <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-mail"></use></svg>
                                    <span>urp@comune.it</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
