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

{{-- Segnalazione 01 Privacy - Step 1: Autorizzazioni e condizioni --}}
{{-- Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/segnalazione-01-privacy.html --}}
{{-- Philosophy: Tailwind CSS + Alpine.js + Lit, NO Bootstrap classes --}}

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
    $privacyCheckboxLabel = 'Ho letto e compreso l\'informativa sulla privacy';
    $nextLabel = (string) ($data['next_label'] ?? __('fixcity::segnalazione.actions.next.label'));
    $contacts = is_array($data['contacts'] ?? null) ? $data['contacts'] : [];
    $phoneLabel = trim((string) ($contacts['phone'] ?? '05 0505'));
    $phoneHref = (string) ($contacts['phone_url'] ?? '#');
@endphp

{{-- Breadcrumbs section --}}
<div class="container mx-auto px-4">
    <div class="flex justify-center">
        <div class="w-full lg:w-10/12">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="flex items-center space-x-2 m-0 p-0 list-none" data-element="breadcrumb">
                        <li><a href="#" class="text-primary hover:underline">{{ __('fixcity::segnalazione.breadcrumb.home.label') }}</a><span class="separator mx-2">/</span></li>
                        <li><a href="#" class="text-primary hover:underline">{{ __('fixcity::segnalazione.breadcrumb.services.label') }}</a><span class="separator mx-2">/</span></li>
                        <li class="active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

{{-- Title + Steppers section --}}
<div class="container mx-auto px-4 mt-6">
    <div class="flex justify-center">
        <div class="w-full lg:w-10/12">
            <h1 class="text-3xl lg:text-4xl font-semibold mb-4">{{ $title }}</h1>
        </div>
    </div>
    <div class="w-full">
        <div class="steppers bg-white border border-gray-200 rounded-lg p-4">
            <div class="steppers-header">
                <ul class="flex flex-row space-x-4 list-none p-0 m-0 overflow-x-auto">
                    @foreach($steps as $index => $step)
                        <li class="flex-shrink-0 {{ $index + 1 === $currentStep ? 'active font-semibold text-primary border-b-2 border-primary' : ($index + 1 < $currentStep ? 'confirmed text-green-600' : 'text-gray-400') }}">
                            <span>{{ $step }}</span>
                            @if($index + 1 < $currentStep)
                                <svg class="icon w-4 h-4 ml-1 inline" aria-hidden="true">
                                    <use href="{{ $sprite }}#it-check"></use>
                                </svg>
                                <span class="sr-only">{{ __('fixcity::segnalazione.steps.confirmed.label') }}</span>
                            @elseif($index + 1 === $currentStep)
                                <span class="sr-only">{{ __('fixcity::segnalazione.steps.active.label') }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <span class="steppers-index text-sm text-gray-500 mt-2 block" aria-hidden="true">{{ $currentStep }}/{{ $totalSteps }}</span>
            </div>
        </div>
    </div>
</div>

{{-- Content section --}}
<div class="container mx-auto px-4 mt-8">
    <div class="flex justify-center">
        <div class="w-full lg:w-8/12 pb-10 lg:pb-20">
            <p class="text-base mb-4 lg:mb-6">{{ $privacyIntro }}</p>
            <p class="text-base mb-0">
                {{ $privacyDetailPrefix }}
                <a href="{{ $privacyLink }}" class="text-primary hover:underline">{{ $privacyLinkLabel }}</a>
            </p>

            <div class="mt-6 mb-4 lg:mt-10 lg:mb-10">
                <div class="flex items-center space-x-3">
                    <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field" class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                    <label class="text-sm font-semibold pt-1" for="privacy">{{ $privacyCheckboxLabel }}</label>
                </div>
            </div>
            <button type="button" class="bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded w-full md:w-auto">
                <span>{{ $nextLabel }}</span>
            </button>
        </div>
    </div>
</div>

{{-- Contacts section --}}
<div class="bg-gray-100 shadow-lg mt-8 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full lg:w-6/12 lg:ml-24 p-6">
                <div class="cmp-contacts">
                    <div class="card w-full bg-white rounded-lg shadow">
                        <div class="card-body p-6">
                            <h2 class="text-xl font-semibold mb-4">{{ __('fixcity::segnalazione.contact.heading.label') }}</h2>
                            <ul class="contact-list space-y-3 p-0 m-0 list-none">
                                <li><a class="flex items-center space-x-2 text-primary hover:underline" href="{{ $contacts['faq'] ?? '#' }}">
                                    <svg class="icon w-4 h-4 text-primary flex-shrink-0" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-help-circle"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.faq.label') }}</span></a></li>
                                <li><a class="flex items-center space-x-2 text-primary hover:underline" href="{{ $contacts['assistenza'] ?? '#' }}" data-element="contacts">
                                    <svg class="icon w-4 h-4 text-primary flex-shrink-0" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-mail"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.assistance.label') }}</span></a></li>
                                <li><a class="flex items-center space-x-2 text-primary hover:underline" href="{{ $phoneHref }}">
                                    <svg class="icon w-4 h-4 text-primary flex-shrink-0" aria-hidden="true">
                                        <use href="{{ $sprite }}#it-hearing"></use>
                                    </svg><span>{{ __('fixcity::segnalazione.contact.phone.label', ['phone' => $phoneLabel]) }}</span></a></li>
                                <li><a class="flex items-center space-x-2 text-primary hover:underline" href="{{ $contacts['appointment'] ?? '#' }}" data-element="appointment-booking">
                                    <svg class="icon w-4 h-4 text-primary flex-shrink-0" aria-hidden="true">
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
