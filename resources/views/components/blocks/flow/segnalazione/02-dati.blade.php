@props(['data' => []])

@php
    $title = $data['title'] ?? __('segnalazione::segnalazione.dati.title');
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            <h2 class="title-xxlarge mb-4">{{ $title }}</h2>

            <!-- Luogo -->
            <div class="card-wrapper bg-grey-card rounded h-auto mb-40">
                <div class="card card-teaser bg-grey-card rounded shadow-sm p-3 p-lg-4">
                    <div class="card-body">
                        <h3 class="title-large mb-3">{{ __('segnalazione::segnalazione.dati.place_label') }}</h3>
                        <div class="input-wrapper">
                            <label for="report-place" class="title-xsmall-bold u-grey-dark">{{ __('segnalazione::segnalazione.dati.place_label') }}*</label>
                            <input type="text" class="form-control" id="report-place"
                                   placeholder="{{ __('segnalazione::segnalazione.dati.place_placeholder') }}"
                                   x-model="luogo" data-element="place-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Disservizio -->
            <div class="card-wrapper bg-grey-card rounded h-auto mb-40">
                <div class="card card-teaser bg-grey-card rounded shadow-sm p-3 p-lg-4">
                    <div class="card-body">
                        <h3 class="title-large mb-3">{{ __('segnalazione::segnalazione.dati.details_label') }}</h3>

                        <div class="select-wrapper mb-3">
                            <label for="inefficiency-type" class="title-xsmall-bold u-grey-dark">{{ __('segnalazione::segnalazione.dati.type_label') }}</label>
                            <select class="form-select" id="inefficiency-type" x-model="tipoDisservizio" data-element="inefficiency-type-select">
                                <option value="" disabled selected>{{ __('segnalazione::segnalazione.dati.type_select') }}</option>
                                <option value="verde">{{ __('segnalazione::segnalazione.dati.types.verde') }}</option>
                                <option value="illuminazione">{{ __('segnalazione::segnalazione.dati.types.illuminazione') }}</option>
                                <option value="strade">{{ __('segnalazione::segnalazione.dati.types.strade') }}</option>
                                <option value="rifiuti">{{ __('segnalazione::segnalazione.dati.types.rifiuti') }}</option>
                                <option value="altro">{{ __('segnalazione::segnalazione.dati.types.altro') }}</option>
                            </select>
                        </div>

                        <div class="input-wrapper mb-3">
                            <label for="report-title" class="title-xsmall-bold u-grey-dark">{{ __('segnalazione::segnalazione.dati.title_label') }}</label>
                            <input type="text" class="form-control" id="report-title"
                                   placeholder="{{ __('segnalazione::segnalazione.dati.title_placeholder') }}"
                                   x-model="titolo" data-element="report-title-input">
                        </div>

                        <div class="text-area-wrapper mb-3">
                            <label for="report-details" class="title-xsmall-bold u-grey-dark">{{ __('segnalazione::segnalazione.dati.description_label') }}</label>
                            <textarea class="form-control" id="report-details" rows="4"
                                      placeholder="{{ __('segnalazione::segnalazione.dati.description_placeholder') }}"
                                      x-model="dettagli" maxlength="200"
                                      data-element="report-details-input"></textarea>
                            <p class="title-xsmall u-grey-dark mt-1 mb-0">{{ __('segnalazione::segnalazione.max_chars', ['max' => 200]) }}</p>
                        </div>

                        <div class="upload-wrapper mt-4">
                            <label class="title-xsmall-bold u-grey-dark mb-2 d-block">{{ __('segnalazione::segnalazione.dati.images_label') }}</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-white rounded border">
                                <svg class="icon icon-primary icon-md" aria-hidden="true">
                                    <use href="{{ $sprite }}#it-upload"></use>
                                </svg>
                                <span class="text-paragraph-small">{{ __('segnalazione::segnalazione.dati.no_file') }}</span>
                            </div>
                            <p class="title-xsmall u-grey-dark mt-1 mb-0">{{ __('segnalazione::segnalazione.dati.images_hint') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="d-flex justify-content-between mt-4">
                <a href="/it/tests/segnalazione-01-privacy" class="btn btn-outline-primary mobile-full" data-element="step-prev">
                    <span>{{ __('segnalazione::segnalazione.back') }}</span>
                </a>
                <a href="/it/tests/segnalazione-03-riepilogo" class="btn btn-primary mobile-full" data-element="step-next">
                    <span>{{ __('segnalazione::segnalazione.next') }}</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                @include('components.blocks.contacts.faq')
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-between">
        <button 
            type="button"
            class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
            @click="currentStep--"
            data-element="step-prev"
        >
            Indietro
        </button>
        <button 
            type="button"
            class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            :disabled="!nome || !cognome || !email"
            @click="currentStep++"
            data-element="step-next"
        >
            Continua
        </button>
    </div>
</div>
