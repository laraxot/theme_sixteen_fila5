{{--
    Feedback Rating Block - Multi-Step Wizard
    Reference: design-comuni-pagine-statiche/sito/homepage.html #rating section
    Structure: 3-step wizard (stars → radio feedback → optional text → thank you)
    Multilingual: ALL text from JSON, NO hardcoded strings
--}}
@php
    $data = $data ?? [];
    // Rating configuration - support @include (direct vars) and @component (via $data)
    $titleData = isset($title) ? $title : ($data['title'] ?? []);
    $subtitleData = isset($subtitle) ? $subtitle : ($data['subtitle'] ?? []);
    $title = is_array($titleData) ? ($titleData['it'] ?? 'Quanto sono chiare le informazioni su questa pagina?') : ($titleData ?: 'Quanto sono chiare le informazioni su questa pagina?');
    $subtitle = is_array($subtitleData) ? ($subtitleData['it'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!') : ($subtitleData ?: 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!');
    
    // Step 1: Positive feedback options
    $positiveQuestion = $data['positive_question']['it'] ?? 'Quali sono stati gli aspetti che hai preferito?';
    $positiveOptions = $data['positive_options']['it'] ?? [
        'Le indicazioni erano chiare',
        'Le indicazioni erano complete',
        'Capivo sempre che stavo procedendo correttamente',
        'Non ho avuto problemi tecnici',
        'Altro'
    ];
    
    // Step 1: Negative feedback options
    $negativeQuestion = $data['negative_question']['it'] ?? 'Dove hai incontrato le maggiori difficoltà?';
    $negativeOptions = $data['negative_options']['it'] ?? [
        'A volte le indicazioni non erano chiare',
        'A volte le indicazioni non erano complete',
        'A volte non capivo se stavo procedendo correttamente',
        'Ho avuto problemi tecnici',
        'Altro'
    ];
    
    // Step 2: Optional text input
    $textQuestion = $data['text_question']['it'] ?? 'Vuoi aggiungere altri dettagli?';
    $textLabel = $data['text_label']['it'] ?? 'Dettaglio';
    $textHelp = $data['text_help']['it'] ?? 'Inserire massimo 200 caratteri';
    $textMaxlength = $data['text_maxlength'] ?? 200;
    
    // Navigation buttons
    $btnBack = $data['btn_back']['it'] ?? 'Indietro';
    $btnNext = $data['btn_next']['it'] ?? 'Avanti';
    
    // Star rating
    $starLegend = $data['star_legend']['it'] ?? 'Valuta da 1 a 5 stelle la pagina';
    $starLabels = $data['star_labels']['it'] ?? [
        5 => 'Valuta 5 stelle su 5',
        4 => 'Valuta 4 stelle su 5',
        3 => 'Valuta 3 stelle su 5',
        2 => 'Valuta 2 stelle su 5',
        1 => 'Valuta 1 stella su 5'
    ];
@endphp

<<<<<<< HEAD
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
=======
<div class="cmp-rating pt-lg-80 pb-lg-80" id="rating" x-data="{ 
    step: 0, 
    rating: 0, 
    hover: 0,
    isPositive: true,
    showStep(stepNum) {
        this.step = stepNum;
        document.querySelectorAll('[data-step]').forEach(el => {
            el.classList.add('d-none');
        });
        const target = document.querySelector(`[data-step="${stepNum}"]`);
        if (target) target.classList.remove('d-none');
    }
}">
    <div class="card shadow card-wrapper" data-element="feedback">
        {{-- Step 0: Star Rating --}}
        <div class="cmp-rating__card-first" data-step="0">
            <div class="card-header border-0">
                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <fieldset class="rating" id="fieldset-rating-one">
                    <legend class="visually-hidden">{{ $starLegend }}</legend>

                    {{-- Stars in reverse order for CSS rating pattern --}}
                    @foreach([5, 4, 3, 2, 1] as $i)
                    @php
                        $labelMap = [5 => 'first', 4 => 'second', 3 => 'third', 2 => 'fourth', 1 => 'fifth'];
                        $labelName = $labelMap[$i];
                    @endphp
                    <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}" x-model="rating">
                    <label class="full rating-star active" for="star{{ $i }}a"
                           data-element="feedback-rate-{{ $i }}"
                           @click="rating = {{ $i }}; isPositive = {{ $i }} >= 3"
                           @mouseenter="hover = {{ $i }}"
                           @mouseleave="hover = 0"
                           :class="{'active': hover >= {{ $i }} || rating >= {{ $i }}}">
                        <svg class="icon icon-sm" role="img" aria-labelledby="{{ $labelName }}-star" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                            <path fill="none" d="M0 0h24v24H0z"/>
                        </svg>
                        <span class="visually-hidden" id="{{ $labelName }}-star">{{ $starLabels[$i] }}</span>
>>>>>>> 4b74b32 (.)
                    </label>
                    @endforeach
                </fieldset>

<<<<<<< HEAD
                {{-- Step 1: Rating selected, show follow-up --}}
                <div class="cmp-rating__card-second" :class="{ 'd-none': step === 1 }">
                    <p class="text-wrap">{{ $subtitle }}</p>
=======
                {{-- Thank you message (shown after rating) --}}
                <div class="cmp-rating__card-second d-none" data-step="3">
                    <div class="card-header border-0 mb-0">
                        <h2 class="title-medium-2-bold mb-0" id="rating-feedback">{{ $subtitle }}</h2>
                    </div>
>>>>>>> 4b74b32 (.)
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

        {{-- Multi-step form (hidden until star rating submitted) --}}
        <form id="rating" x-show="step > 0" class="d-none">
            {{-- Step 1: Radio Button Feedback --}}
            <div class="d-none" data-step="1">
                <div class="cmp-steps-rating">
                    {{-- Positive feedback fieldset --}}
                    <fieldset class="fieldset-rating-one d-none" data-element="feedback-rating-positive" x-show="isPositive">
                        <legend class="iscrizioni-header w-100">
                            <h3 class="step-title d-flex flex-column flex-lg-row align-items-lg-center justify-content-between drop-shadow">
                                <span class="d-block text-wrap" data-element="feedback-rating-question">
                                    {{ $positiveQuestion }}
                                </span>
                                <span class="step">1/2</span>
                            </h3>
                        </legend>
                        <div class="cmp-steps-rating__body">
                            <div class="cmp-radio-list">
                                <div class="card card-teaser shadow-rating">
                                    <div class="card-body">
                                        <div class="form-check m-0">
                                            @foreach($positiveOptions as $index => $option)
                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                <input name="rating1" type="radio" id="radio-{{ $index + 1 }}">
                                                <label for="radio-{{ $index + 1 }}" class="active" data-element="feedback-rating-answer">{{ $option }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    {{-- Negative feedback fieldset --}}
                    <fieldset class="fieldset-rating-two d-none" data-element="feedback-rating-negative" x-show="!isPositive">
                        <legend class="iscrizioni-header w-100">
                            <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                <span class="d-block text-wrap" data-element="feedback-rating-question">
                                    {{ $negativeQuestion }}
                                </span>
                                <span class="step">1/2</span>
                            </h3>
                        </legend>
                        <div class="cmp-steps-rating__body">
                            <div class="cmp-radio-list">
                                <div class="card card-teaser shadow-rating">
                                    <div class="card-body">
                                        <div class="form-check m-0">
                                            @foreach($negativeOptions as $index => $option)
                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                <input name="rating2" type="radio" id="radio-{{ $index + 6 }}">
                                                <label for="radio-{{ $index + 6 }}" class="active" data-element="feedback-rating-answer">{{ $option }}</label>
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

            {{-- Step 2: Optional Text Input --}}
            <div class="d-none" data-step="2">
                <div class="cmp-steps-rating">
                    <fieldset>
                        <legend class="iscrizioni-header w-100">
                            <h3 class="step-title d-flex flex-column flex-lg-row flex-wrap align-items-lg-center justify-content-between drop-shadow">
                                <span class="d-block text-wrap">
                                    {{ $textQuestion }}
                                </span>
                                <span class="step">2/2</span>
                            </h3>
                        </legend>
                        <div class="cmp-steps-rating__body">
                            <div class="form-group">
                                <label for="formGroupExampleInputWithHelp">{{ $textLabel }}</label>
                                <input type="text" class="form-control" id="formGroupExampleInputWithHelp" aria-describedby="formGroupExampleInputWithHelpDescription" maxlength="{{ $textMaxlength }}" data-element="feedback-input-text">
                                <small id="formGroupExampleInputWithHelpDescription" class="form-text">
                                    {{ $textHelp }}</small>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            {{-- Step Navigation Buttons --}}
            <div class="d-none" data-step="buttons">
                <div class="d-flex flex-nowrap pt-4 w-100 justify-content-center button-shadow">
                    <button class="btn btn-outline-primary fw-bold me-4 btn-back" type="button" @click="showStep(step > 1 ? step - 1 : 0)">{{ $btnBack }}</button>
                    <button class="btn btn-primary fw-bold btn-next" type="submit" form="rating">{{ $btnNext }}</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</div>
</div>
