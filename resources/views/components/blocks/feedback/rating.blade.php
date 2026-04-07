{{--
    Feedback Rating Block
    Reference: design-comuni-pagine-statiche/sito/homepage.html #rating section
    Uses Bootstrap Italia structure with Tailwind @apply classes
--}}
@props(['data' => []])

@php
    $title = $data['title'] ?? 'Quanto sono chiare le informazioni su questa pagina?';
    $subtitle = $data['subtitle'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!';
@endphp

<div class="bg-primary" id="rating" x-data="{ rating: 0, hover: 0, step: 1, answer: '', feedbackType: '' }">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6">
                <div class="cmp-rating pt-lg-80 pb-lg-80">
                    <div class="card shadow card-wrapper" data-element="feedback">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ $title }}</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating" id="fieldset-rating-one">
                                    <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>

                    {{-- 5 stars - reverse order for CSS star rating --}}
                    <input type="radio" id="star5a" name="ratingA" value="5" x-model="rating" class="visually-hidden">
                    <label class="full rating-star active" for="star5a"
                           data-element="feedback-rate-5"
                           @click="rating = 5; step = rating >= 4 ? 2 : 2; feedbackType = rating >= 4 ? 'positive' : 'negative'"
                           @mouseenter="hover = 5"
                           @mouseleave="hover = 0">
                        <svg class="icon icon-sm" role="img" aria-labelledby="first-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="first-star">Valuta 5 stelle su 5</span>
                    </label>

                    <input type="radio" id="star4a" name="ratingA" value="4" x-model="rating" class="visually-hidden">
                    <label class="full rating-star active" for="star4a"
                           data-element="feedback-rate-4"
                           @click="rating = 4; step = rating >= 4 ? 2 : 2; feedbackType = rating >= 4 ? 'positive' : 'negative'"
                           @mouseenter="hover = 4"
                           @mouseleave="hover = 0">
                        <svg class="icon icon-sm" role="img" aria-labelledby="second-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="second-star">Valuta 4 stelle su 5</span>
                    </label>

                    <input type="radio" id="star3a" name="ratingA" value="3" x-model="rating" class="visually-hidden">
                    <label class="full rating-star active" for="star3a"
                           data-element="feedback-rate-3"
                           @click="rating = 3; step = rating >= 4 ? 2 : 2; feedbackType = rating >= 4 ? 'positive' : 'negative'"
                           @mouseenter="hover = 3"
                           @mouseleave="hover = 0">
                        <svg class="icon icon-sm" role="img" aria-labelledby="third-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="third-star">Valuta 3 stelle su 5</span>
                    </label>

                    <input type="radio" id="star2a" name="ratingA" value="2" x-model="rating" class="visually-hidden">
                    <label class="full rating-star active" for="star2a"
                           data-element="feedback-rate-2"
                           @click="rating = 2; step = rating >= 4 ? 2 : 2; feedbackType = rating >= 4 ? 'positive' : 'negative'"
                           @mouseenter="hover = 2"
                           @mouseleave="hover = 0">
                        <svg class="icon icon-sm" role="img" aria-labelledby="fourth-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="fourth-star">Valuta 2 stelle su 5</span>
                    </label>

                    <input type="radio" id="star1a" name="ratingA" value="1" x-model="rating" class="visually-hidden">
                    <label class="full rating-star active" for="star1a"
                           data-element="feedback-rate-1"
                           @click="rating = 1; step = rating >= 4 ? 2 : 2; feedbackType = rating >= 4 ? 'positive' : 'negative'"
                           @mouseenter="hover = 1"
                           @mouseleave="hover = 0">
                        <svg class="icon icon-sm" role="img" aria-labelledby="fifth-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="fifth-star">Valuta 1 stella su 5</span>
                    </label>
                </fieldset>

                {{-- Step 1: Rating selected, show follow-up --}}
                <div class="cmp-rating__card-second" :class="{ 'd-none': step === 1 }">
                    <p class="text-wrap">{{ $subtitle }}</p>
                </div>

                {{-- Step 2: Multi-step form --}}
                <div class="form-rating" :class="{ 'd-none': step < 2 }">
                    {{-- Positive feedback fieldset --}}
                    <fieldset class="fieldset-rating-one" :class="{ 'd-none': feedbackType !== 'positive' }" data-element="feedback-rating-positive">
                        <legend>
                            <span data-element="feedback-rating-question">Cosa ritieni di meglio di questa pagina?</span>
                        </legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="positiveFeedback" id="pos1" value="clear">
                            <label class="form-check-label" for="pos1" data-element="feedback-rating-answer">
                                <span>Le informazioni sono chiare</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="positiveFeedback" id="pos2" value="complete">
                            <label class="form-check-label" for="pos2" data-element="feedback-rating-answer">
                                <span>Le informazioni sono complete</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="positiveFeedback" id="pos3" value="easy">
                            <label class="form-check-label" for="pos3" data-element="feedback-rating-answer">
                                <span>È facile trovare quello che cerco</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="positiveFeedback" id="pos4" value="design">
                            <label class="form-check-label" for="pos4" data-element="feedback-rating-answer">
                                <span>Il design è gradevole</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="positiveFeedback" id="pos5" value="other">
                            <label class="form-check-label" for="pos5" data-element="feedback-rating-answer">
                                <span>Altro</span>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Negative feedback fieldset --}}
                    <fieldset class="fieldset-rating-two" :class="{ 'd-none': feedbackType !== 'negative' }" data-element="feedback-rating-negative">
                        <legend>
                            <span data-element="feedback-rating-question">Cosa non va in questa pagina?</span>
                        </legend>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="negativeFeedback" id="neg1" value="unclear">
                            <label class="form-check-label" for="neg1" data-element="feedback-rating-answer">
                                <span>Le informazioni non sono chiare</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="negativeFeedback" id="neg2" value="incomplete">
                            <label class="form-check-label" for="neg2" data-element="feedback-rating-answer">
                                <span>Le informazioni sono incomplete</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="negativeFeedback" id="neg3" value="hard">
                            <label class="form-check-label" for="neg3" data-element="feedback-rating-answer">
                                <span>È difficile trovare quello che cerco</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="negativeFeedback" id="neg4" value="design">
                            <label class="form-check-label" for="neg4" data-element="feedback-rating-answer">
                                <span>Il design non è gradevole</span>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="negativeFeedback" id="neg5" value="other">
                            <label class="form-check-label" for="neg5" data-element="feedback-rating-answer">
                                <span>Altro</span>
                            </label>
                        </div>
                    </fieldset>

                    {{-- Step 2b: Text feedback --}}
                    <div class="mt-4" :class="{ 'd-none': step < 3 }">
                        <label class="form-label" for="feedback-text">Vuoi aggiungere un commento?</label>
                        <textarea class="form-control" id="feedback-text" x-model="answer" maxlength="200" data-element="feedback-input-text" rows="3"></textarea>
                        <p class="form-text"><span x-text="answer.length"></span>/200 caratteri</p>
                        <button class="btn btn-primary mt-3" @click="step = 4">Invia</button>
                        <button class="btn btn-back btn-link text-decoration-none" @click="step = 2">Indietro</button>
                    </div>
                </div>

                {{-- Step 4: Thank you --}}
                <div class="cmp-rating__card-second d-none" :class="{ 'd-none': step !== 4 }" data-step="3">
                    <p class="text-wrap">Grazie per il tuo feedback!</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
