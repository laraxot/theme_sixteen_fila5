@props(['data' => []])

@php
    $title = $data['title'] ?? __('segnalazione::segnalazione.riepilogo.title');
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            <h2 class="title-xxlarge mb-4">{{ $title }}</h2>

            <!-- Callout -->
            <div class="callout warning mb-40">
                <div class="callout-content d-flex gap-3">
                    <svg class="icon icon-md flex-shrink-0" aria-hidden="true">
                        <use href="{{ $sprite }}#it-warning"></use>
                    </svg>
                    <div>
                        <h3 class="title-medium-semi-bold mb-1">{{ __('segnalazione::segnalazione.riepilogo.warning_title') }}</h3>
                        <p class="text-paragraph">{{ __('segnalazione::segnalazione.riepilogo.warning_text') }}</p>
                    </div>
                </div>
            </div>

            <!-- Disservizio summary -->
            <div class="card-wrapper bg-grey-card rounded h-auto mb-40">
                <div class="card card-teaser bg-grey-card rounded shadow-sm p-3 p-lg-4">
                    <div class="card-body">
                        <h3 class="title-medium-semi-bold mb-3">{{ __('segnalazione::segnalazione.riepilogo.disservizio_section') }}</h3>
                        <dl class="summary-list">
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Tipo</dt>
                                <dd class="text-paragraph" x-text="tipoDisservizio || 'Verde pubblico'"></dd>
                            </div>
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Titolo</dt>
                                <dd class="text-paragraph" x-text="titolo || 'Buca in via Solferino'"></dd>
                            </div>
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Descrizione</dt>
                                <dd class="text-paragraph" x-text="dettagli || 'Segnalazione di una buca...'"></dd>
                            </div>
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Luogo</dt>
                                <dd class="text-paragraph" x-text="luogo || 'Via Solferino, 15'"></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Contacts summary -->
            <div class="card-wrapper bg-grey-card rounded h-auto mb-40">
                <div class="card card-teaser bg-grey-card rounded shadow-sm p-3 p-lg-4">
                    <div class="card-body">
                        <h3 class="title-medium-semi-bold mb-3">{{ __('segnalazione::segnalazione.riepilogo.contacts_section') }}</h3>
                        <dl class="summary-list">
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Email</dt>
                                <dd class="text-paragraph" x-text="email || 'mario.rossi@email.it'"></dd>
                            </div>
                            <div class="summary-item">
                                <dt class="title-xsmall-bold u-grey-dark">Telefono</dt>
                                <dd class="text-paragraph" x-text="telefono || '333 1234567'"></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Terms checkbox -->
            <div class="form-check mt-4 mb-3" x-data="{ accepted: false }">
                <div class="checkbox-body d-flex align-items-center">
                    <input type="checkbox" id="accetto-termini" x-model="accepted" data-element="terms-accept">
                    <label class="title-small-semi-bold pt-1" for="accetto-termini">
                        {{ __('segnalazione::segnalazione.riepilogo.terms_label') }}
                        <a href="#" class="t-primary">{{ __('segnalazione::segnalazione.riepilogo.terms_link') }}</a>
                    </label>
                </div>
            </div>

            <!-- Navigation -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/it/tests/segnalazione-02-dati" class="btn btn-outline-primary mobile-full" data-element="step-prev">
                    <span>{{ __('segnalazione::segnalazione.back') }}</span>
                </a>
                <a href="/it/tests/segnalazione-04-conferma" class="btn btn-primary mobile-full" data-element="step-next">
                    <span>{{ __('segnalazione::segnalazione.riepilogo.submit_label') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                @include('components.blocks.contacts.faq')
            </div>
        </div>
    </div>
</div>
=======
>>>>>>> 4b74b32 (.)
