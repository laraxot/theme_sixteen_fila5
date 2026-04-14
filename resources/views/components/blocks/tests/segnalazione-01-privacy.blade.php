@props(['data' => []])

@php
    $title = (string) ($data['title'] ?? __('fixcity::segnalazione.page.title.label'));
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = (int) ($data['current_step'] ?? 1);
    $totalSteps = (int) ($data['total_steps'] ?? 3);
    $steps = [
        __('fixcity::segnalazione.steps.privacy.label'),
        __('fixcity::segnalazione.steps.data.label'),
        __('fixcity::segnalazione.steps.summary.label'),
    ];
    $privacyLink = (string) ($data['privacy_link'] ?? '#');
    $privacyIntro = (string) ($data['privacy_intro'] ?? __('fixcity::segnalazione.privacy.intro.text'));
    $privacyDetailPrefix = (string) ($data['privacy_detail_prefix'] ?? __('fixcity::segnalazione.privacy.detail_prefix.text'));
    $privacyLinkLabel = (string) ($data['privacy_link_label'] ?? __('fixcity::segnalazione.privacy.link.label'));
    $privacyCheckboxLabel = (string) ($data['privacy_checkbox_label'] ?? __('fixcity::segnalazione.privacy.checkbox.label'));
    $nextLabel = (string) ($data['next_label'] ?? __('fixcity::segnalazione.actions.next.label'));
    $contacts = is_array($data['contacts'] ?? null) ? $data['contacts'] : [];
    $phoneLabel = trim((string) ($contacts['phone'] ?? '05 0505'));
    $phoneHref = (string) ($contacts['phone_url'] ?? '#');
@endphp

{{-- Breadcrumbs section - matches reference: main > div.container > div.row > div.col-12.col-lg-10 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('fixcity::segnalazione.breadcrumb.home.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('fixcity::segnalazione.breadcrumb.services.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- Title + Steppers section - matches reference: div.container > div.row --}}
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
                                    <span class="visually-hidden">{{ __('fixcity::segnalazione.steps.confirmed.label') }}</span>
                                @elseif($index + 1 === $currentStep)
                                    <span class="visually-hidden">{{ __('fixcity::segnalazione.steps.active.label') }}</span>
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

{{-- Content section - matches reference: div.container > div.row > div.col-12.col-lg-8 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            <p class="text-paragraph mb-lg-4">{{ $privacyIntro }}</p>
            <p class="text-paragraph mb-0">
                {{ $privacyDetailPrefix }}
                <a href="{{ $privacyLink }}" class="t-primary">{{ $privacyLinkLabel }}</a>
            </p>

            <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                <div class="checkbox-body d-flex align-items-center">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field">
                    <label class="title-small-semi-bold pt-1" for="privacy">{{ $privacyCheckboxLabel }}</label>
                </div>
            </div>
            <button type="button" class="btn btn-primary mobile-full">
                <span class="">{{ $nextLabel }}</span>
            </button>
        </div>
    </div>
</div>

['data' => []])

@php
    $title = (string) ($data['title'] ?? __('fixcity::segnalazione.page.title.label'));
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = (int) ($data['current_step'] ?? 1);
    $totalSteps = (int) ($data['total_steps'] ?? 3);
    $steps = [
        __('fixcity::segnalazione.steps.privacy.label'),
        __('fixcity::segnalazione.steps.data.label'),
        __('fixcity::segnalazione.steps.summary.label'),
    ];
    $privacyLink = (string) ($data['privacy_link'] ?? '#');
    $privacyIntro = (string) ($data['privacy_intro'] ?? __('fixcity::segnalazione.privacy.intro.text'));
    $privacyDetailPrefix = (string) ($data['privacy_detail_prefix'] ?? __('fixcity::segnalazione.privacy.detail_prefix.text'));
    $privacyLinkLabel = (string) ($data['privacy_link_label'] ?? __('fixcity::segnalazione.privacy.link.label'));
    $privacyCheckboxLabel = (string) ($data['privacy_checkbox_label'] ?? __('fixcity::segnalazione.privacy.checkbox.label'));
    $nextLabel = (string) ($data['next_label'] ?? __('fixcity::segnalazione.actions.next.label'));
    $contacts = is_array($data['contacts'] ?? null) ? $data['contacts'] : [];
    $phoneLabel = trim((string) ($contacts['phone'] ?? '05 0505'));
    $phoneHref = (string) ($contacts['phone_url'] ?? '#');
@endphp

{{-- Breadcrumbs section - matches reference: main > div.container > div.row > div.col-12.col-lg-10 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('fixcity::segnalazione.breadcrumb.home.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item"><a href="#">{{ __('fixcity::segnalazione.breadcrumb.services.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- Title + Steppers section - matches reference: div.container > div.row --}}
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
                                    <span class="visually-hidden">{{ __('fixcity::segnalazione.steps.confirmed.label') }}</span>
                                @elseif($index + 1 === $currentStep)
                                    <span class="visually-hidden">{{ __('fixcity::segnalazione.steps.active.label') }}</span>
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

{{-- Content section - matches reference: div.container > div.row > div.col-12.col-lg-8 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8 pb-40 pb-lg-80">
            <p class="text-paragraph mb-lg-4">{{ $privacyIntro }}</p>
            <p class="text-paragraph mb-0">
                {{ $privacyDetailPrefix }}
                <a href="{{ $privacyLink }}" class="t-primary">{{ $privacyLinkLabel }}</a>
            </p>

            <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                <div class="checkbox-body d-flex align-items-center">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field">
                    <label class="title-small-semi-bold pt-1" for="privacy">{{ $privacyCheckboxLabel }}</label>
                </div>
            </div>
            <button type="button" class="btn btn-primary mobile-full">
                <span class="">{{ $nextLabel }}</span>
            </button>
        </div>
    </div>
</div>

{{-- Contacts section - matches reference: div.bg-grey-card.shadow-contacts > div.container > div.row --}}
<div class="bg-grey-card shadow-contacts">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                <div class="cmp-contacts">
                    <div class="card w-100">
                        <div class="card-body">
                            <h2 class="title-medium-2-semi-bold">{{ __('fixcity::segnalazione.contact.heading.label') }}</h2>
                            <ul class="contact-list p-0">
                                <li><a class="list-item" href="{{ $contacts['faq'] ?? '#' }}">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-help-circle"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.faq.label') }}</span></a></li>
                                <li><a class="list-item" href="{{ $contacts['assistenza'] ?? '#' }}" data-element="contacts">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-mail"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.assistance.label') }}</span></a></li>
                                <li><a class="list-item" href="{{ $phoneHref }}">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-hearing"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.phone.label', ['phone' => $phoneLabel]) }}</span></a></li>
                                <li><a class="list-item" href="{{ $contacts['appointment'] ?? '#' }}" data-element="appointment-booking">
                                    <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-calendar"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.appointment.label') }}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
