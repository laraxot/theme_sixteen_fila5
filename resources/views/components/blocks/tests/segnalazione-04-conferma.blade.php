@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione inviata';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $reportId = $data['report_id'] ?? 'AN4059281';
    $email = $data['email'] ?? 'giulia.bianchi@gmail.com';
    $relatedServices = $data['related_services'] ?? [
        ['label' => 'Richiesta appuntamento', 'url' => '#', 'icon' => 'it-settings']
    ];
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
            <div class="cmp-heading p-0">
                <div class="categoryicon-top d-flex">
                    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
                        <use href="{{ $sprite }}#it-check-circle"></use>
                    </svg>
                    <h1 class="title-xxxlarge">{{ $title }}</h1>
                </div>

                <p class="subtitle-small">Grazie, abbiamo ricevuto la tua <strong>segnalazione {{ $reportId }}.</strong></p>
                <p class="subtitle-small">Sarà visibile sulla <a href="#" class="t-primary">lista di tutte segnalazioni</a> una volta presa in carico dall'amministrazione.</p>
                <p class="subtitle-small pt-3 pt-lg-4">Abbiamo inviato il riepilogo all'email:<br><strong>{{ $email }}</strong></p>

                <button type="button" class="btn btn-outline-primary bg-white fw-bold">
                    <span class="rounded-icon">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                            <use href="{{ $sprite }}#it-download"></use>
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
                        @foreach($relatedServices as $service)
                            <li class="shadow mb-4">
                                <a class="list-item icon-left t-primary title-small-semi-bold" href="{{ $service['url'] ?? '#' }}">
                                    <span class="list-item-title-icon-wrapper">
                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                            <use href="{{ $sprite }}#{{ $service['icon'] ?? 'it-settings' }}"></use>
                                        </svg>
                                        <span class="list-item-title title-small-semi-bold">{{ $service['label'] ?? '' }}</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                        <label class="full rating-star active" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                            <svg class="icon icon-sm" role="img" aria-labelledby="star-{{ $i }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                                                <path fill="none" d="M0 0h24v24H0z"/>
                                            </svg>
                                            <span class="visually-hidden" id="star-{{ $i }}">Valuta {{ $i }} stelle su 5</span>
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
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-1">
                                                                <label for="radio-1" class="active" data-element="feedback-rating-answer">Le indicazioni erano chiare</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-2">
                                                                <label for="radio-2" class="active" data-element="feedback-rating-answer">Le indicazioni erano complete</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-3">
                                                                <label for="radio-3" class="active" data-element="feedback-rating-answer">Capivo sempre che stavo procedendo correttamente</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-4">
                                                                <label for="radio-4" class="active" data-element="feedback-rating-answer">Non ho avuto problemi tecnici</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-5">
                                                                <label for="radio-5" class="active" data-element="feedback-rating-answer">Altro</label>
                                                            </div>
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
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-6">
                                                                <label for="radio-6" class="active" data-element="feedback-rating-answer">A volte le indicazioni non erano chiare</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-7">
                                                                <label for="radio-7" class="active" data-element="feedback-rating-answer">A volte le indicazioni non erano complete</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-8">
                                                                <label for="radio-8" class="active" data-element="feedback-rating-answer">A volte non capivo se stavo procedendo correttamente</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-9">
                                                                <label for="radio-9" class="active" data-element="feedback-rating-answer">Ho avuto problemi tecnici</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-10">
                                                                <label for="radio-10" class="active" data-element="feedback-rating-answer">Altro</label>
                                                            </div>
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

['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione inviata';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $reportId = $data['report_id'] ?? 'AN4059281';
    $email = $data['email'] ?? 'giulia.bianchi@gmail.com';
    $relatedServices = $data['related_services'] ?? [
        ['label' => 'Richiesta appuntamento', 'url' => '#', 'icon' => 'it-settings']
    ];
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
            <div class="cmp-heading p-0">
                <div class="categoryicon-top d-flex">
                    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
                        <use href="{{ $sprite }}#it-check-circle"></use>
                    </svg>
                    <h1 class="title-xxxlarge">{{ $title }}</h1>
                </div>

                <p class="subtitle-small">Grazie, abbiamo ricevuto la tua <strong>segnalazione {{ $reportId }}.</strong></p>
                <p class="subtitle-small">Sarà visibile sulla <a href="#" class="t-primary">lista di tutte segnalazioni</a> una volta presa in carico dall'amministrazione.</p>
                <p class="subtitle-small pt-3 pt-lg-4">Abbiamo inviato il riepilogo all'email:<br><strong>{{ $email }}</strong></p>

                <button type="button" class="btn btn-outline-primary bg-white fw-bold">
                    <span class="rounded-icon">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true">
                            <use href="{{ $sprite }}#it-download"></use>
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
                        @foreach($relatedServices as $service)
                            <li class="shadow mb-4">
                                <a class="list-item icon-left t-primary title-small-semi-bold" href="{{ $service['url'] ?? '#' }}">
                                    <span class="list-item-title-icon-wrapper">
                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                            <use href="{{ $sprite }}#{{ $service['icon'] ?? 'it-settings' }}"></use>
                                        </svg>
                                        <span class="list-item-title title-small-semi-bold">{{ $service['label'] ?? '' }}</span>
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                        <label class="full rating-star active" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                            <svg class="icon icon-sm" role="img" aria-labelledby="star-{{ $i }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                                                <path fill="none" d="M0 0h24v24H0z"/>
                                            </svg>
                                            <span class="visually-hidden" id="star-{{ $i }}">Valuta {{ $i }} stelle su 5</span>
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
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-1">
                                                                <label for="radio-1" class="active" data-element="feedback-rating-answer">Le indicazioni erano chiare</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-2">
                                                                <label for="radio-2" class="active" data-element="feedback-rating-answer">Le indicazioni erano complete</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-3">
                                                                <label for="radio-3" class="active" data-element="feedback-rating-answer">Capivo sempre che stavo procedendo correttamente</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-4">
                                                                <label for="radio-4" class="active" data-element="feedback-rating-answer">Non ho avuto problemi tecnici</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating1" type="radio" id="radio-5">
                                                                <label for="radio-5" class="active" data-element="feedback-rating-answer">Altro</label>
                                                            </div>
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
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-6">
                                                                <label for="radio-6" class="active" data-element="feedback-rating-answer">A volte le indicazioni non erano chiare</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-7">
                                                                <label for="radio-7" class="active" data-element="feedback-rating-answer">A volte le indicazioni non erano complete</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-8">
                                                                <label for="radio-8" class="active" data-element="feedback-rating-answer">A volte non capivo se stavo procedendo correttamente</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-9">
                                                                <label for="radio-9" class="active" data-element="feedback-rating-answer">Ho avuto problemi tecnici</label>
                                                            </div>
                                                            <div class="radio-body border-bottom border-light cmp-radio-list__item">
                                                                <input name="rating2" type="radio" id="radio-10">
                                                                <label for="radio-10" class="active" data-element="feedback-rating-answer">Altro</label>
                                                            </div>
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

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
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