@props(['data' => []])

@php
    $title = $data['title'] ?? __('segnalazione::segnalazione.privacy.title');
    $description = $data['description'] ?? __('segnalazione::segnalazione.privacy.description');
    $nextLabel = $data['next_label'] ?? __('segnalazione::segnalazione.next');
    $nextUrl = $data['next_url'] ?? '/it/tests/segnalazione-02-dati';
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            @if($description)
                <p class="text-paragraph mb-lg-4">
                    {{ $description }}
                </p>
            @endif

            <p class="text-paragraph mb-0">
                {{ __('segnalazione::segnalazione.privacy.details') }}
                <a href="#" class="t-primary">{{ __('segnalazione::segnalazione.privacy.link_label') }}</a>
            </p>

            <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40" x-data="{ checked: false }">
                <div class="checkbox-body d-flex align-items-center">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field"
                           x-model="checked" data-element="privacy-consent">
                    <label class="title-small-semi-bold pt-1" for="privacy">
                        {{ __('segnalazione::segnalazione.privacy.accept_label') }}
                    </label>
                </div>
            </div>

            <div class="d-flex gap-3 mt-4">
                <a href="{{ $nextUrl }}"
                   class="btn btn-primary mobile-full"
                   x-data="{ checked: false }"
                   :class="{ 'disabled': !checked }"
                   :disabled="!checked"
                   data-element="step-next">
                    <span>{{ $nextLabel }}</span>
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
</div>
