@props(['data' => []])

@php
    use Modules\Cms\Models\Page;

    $slug = $data['slug'] ?? '';
    $pageSlug = 'tests.'.$slug;
    $locale = app()->getLocale();

    // Load page from database
    $cmsPage = Page::where('slug', $pageSlug)->first();
    $blocks = [];
    if ($cmsPage) {
        $rawBlocks = $cmsPage->content_blocks[$locale] ?? $cmsPage->content_blocks['it'] ?? [];
        foreach ($rawBlocks as $blockData) {
            $blocks[] = (object) [
                'active' => true,
                'view' => $blockData['data']['view'] ?? '',
                'data' => $blockData['data'] ?? [],
            ];
        }
    }

    // Block data
    $title = $data['title'] ?? __('fixcity::segnalazione.fields.title.label');
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
    $currentStep = $data['current_step'] ?? 3;
    $totalSteps = $data['total_steps'] ?? 3;
    $steps = $data['steps'] ?? [
        __('fixcity::segnalazione.steps.privacy.label'),
        __('fixcity::segnalazione.steps.data.label'),
        __('fixcity::segnalazione.steps.summary.label'),
    ];

    // Report data from JSON
    $report = $data['report'] ?? [];
    $user = $data['user'] ?? [];

    // Navigation URLs
    $prevUrl = route('tests.view', ['slug' => 'segnalazione-02-dati']);
    $nextUrl = route('tests.view', ['slug' => 'segnalazione-04-conferma']);
@endphp

{{-- Skiplink --}}
<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">{{ __('fixcity::segnalazione.skip.main.label') }}</a>
    <a class="visually-hidden-focusable" href="#footer">{{ __('fixcity::segnalazione.skip.footer.label') }}</a>
</div>

{{-- Breadcrumbs --}}
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('tests.view', ['slug' => 'homepage']) }}">{{ __('fixcity::segnalazione.breadcrumb.home.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item"><a href="{{ route('tests.view', ['slug' => 'servizi']) }}">{{ __('fixcity::segnalazione.breadcrumb.services.label') }}</a><span class="separator">/</span></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading pb-3 pb-lg-4">
                <h1 class="title-xxxlarge">{{ $title }}</h1>
            </div>
        </div>

        {{-- Steppers --}}
        <div class="col-12">
            <div class="steppers">
                <div class="steppers-header">
                    <ul>
                        @foreach($steps as $index => $step)
                            <li class="{{ $index + 1 < $currentStep ? 'confirmed' : ($index + 1 === $currentStep ? 'active' : '') }}">
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

    {{-- Steppers Content --}}
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="steppers-content" aria-live="polite">
                <div class="it-page-sections-container">
                    <section class="it-page-section">

                        {{-- Callout Warning --}}
                        <div class="callout callout-highlight ps-3 warning">
                            <div class="callout-title mb-20 d-flex align-items-center">
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="{{ $sprite }}#it-horn"></use>
                                </svg>
                                <span>{{ __('fixcity::segnalazione.warning.title.label') }}</span>
                            </div>
                            <p class="titillium text-paragraph">{{ __('fixcity::segnalazione.warning.message.label') }}<span class="d-lg-block"> {{ __('fixcity::segnalazione.warning.message_extra.label') }}</span></p>
                        </div>

                        {{-- Segnalazione Section --}}
                        <h2 class="title-xxlarge mb-4 mt-40">{{ __('fixcity::segnalazione.heading.report.label') }}</h2>

                        {{-- Disservizio Card --}}
                        <div class="cmp-card mb-4">
                            <div class="card has-bkg-grey shadow-sm mb-0">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <div class="d-flex">
                                        <h3 class="subtitle-large mb-4">{{ $report['type'] ?? __('fixcity::segnalazione.fields.disservice.label') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-info-summary bg-white p-3 p-lg-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-0 mb-0 pb-2 d-flex justify-content-end">
                                                <a href="{{ $prevUrl }}" class="text-decoration-none"><span class="text-button-sm-semi t-primary">{{ __('fixcity::segnalazione.actions.edit.label') }}</span></a>
                                            </div>
                                            <div class="card-body p-0">
                                                @if(!empty($report['address']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.address.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $report['address'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!empty($report['type']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.type.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $report['type'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!empty($report['title']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.title.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $report['title'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!empty($report['details']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.details.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $report['details'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!empty($report['images']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.images.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ implode(', ', $report['images']) }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="card-footer p-0"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Dati Generali Section --}}
                        <h2 class="title-xxlarge mb-4 mt-40">{{ __('fixcity::segnalazione.heading.general_data.label') }}</h2>

                        {{-- Autore Card --}}
                        <div class="cmp-card mb-4">
                            <div class="card has-bkg-grey shadow-sm mb-0">
                                <div class="card-header border-0 p-0 mb-lg-20 m-0">
                                    <div class="d-flex">
                                        <h3 class="subtitle-large mb-4">{{ __('fixcity::segnalazione.heading.report_author.label') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="cmp-info-summary bg-white mb-4 mb-lg-30 p-3 p-lg-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                <h4 class="title-large-semi-bold mb-3">{{ $user['name'] ?? __('fixcity::segnalazione.fields.author.label') }}</h4>
                                            </div>
                                            <div class="card-body p-0">
                                                @if(!empty($user['cf']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.fiscal_code.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $user['cf'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="card-footer p-0 d-none"></div>
                                        </div>
                                    </div>

                                    {{-- Contatti Sub-Card --}}
                                    <div class="cmp-info-summary bg-white p-3 p-lg-4">
                                        <div class="card">
                                            <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                                <h4 class="title-large-semi-bold mb-3">{{ __('fixcity::segnalazione.heading.contacts.label') }}</h4>
                                            </div>
                                            <div class="card-body p-0">
                                                @if(!empty($user['phone']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.phone.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $user['phone'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                                @if(!empty($user['email']))
                                                <div class="single-line-info border-light">
                                                    <div class="text-paragraph-small">{{ __('fixcity::segnalazione.fields.email.label') }}</div>
                                                    <div class="border-light">
                                                        <p class="data-text">{{ $user['email'] }}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="card-footer p-0 d-none"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- Navigation Steps --}}
                <div class="cmp-nav-steps">
                    <nav class="steppers-nav" aria-label="Step">
                        <button type="button" class="btn btn-sm steppers-btn-prev p-0" onclick="window.location.href='{{ $prevUrl }}'">
                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#it-chevron-left"></use>
                            </svg>
                            <span class="text-button-sm t-primary">{{ __('fixcity::segnalazione.actions.back.label') }}</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block saveBtn">
                            <span class="text-button-sm t-primary">{{ __('fixcity::segnalazione.actions.save.label') }}</span>
                        </button>
                        <button type="button" class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-block d-lg-none saveBtn center">
                            <span class="text-button-sm t-primary">{{ __('fixcity::segnalazione.actions.save_short.label') }}</span>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm steppers-btn-confirm send" data-bs-toggle="modal" data-bs-target="#modal-terms">
                            <span class="text-button-sm">{{ __('fixcity::segnalazione.actions.send.label') }}</span>
                        </button>
                    </nav>
                    <div id="alert-message" class="alert alert-success cmp-disclaimer rounded d-none" role="alert">
                        <span class="d-inline-block text-uppercase cmp-disclaimer__message">{{ __('fixcity::segnalazione.alert.save_success.label') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Contact Card (bg-grey-card) --}}
{{-- Terms Modal --}}
<div class="cmp-modal">
    <div class="modal fade" tabindex="-1" role="dialog" id="modal-terms" aria-labelledby="modal-terms-modal-title">
        <div class="modal-dialog modal-dialog-centered small" role="document">
            <div class="modal-content modal-dimensions">
                <div class="cmp-modal__header modal-header pb-0">
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="{{ __('fixcity::segnalazione.modal.close.label') }}">
                    </button>
                    <h2 class="cmp-modal__header-title title-mini" id="modal-terms-modal-title">{{ __('fixcity::segnalazione.modal.terms.title.label') }}</h2>
                    <p class="cmp-modal__header-info header-font">{{ __('fixcity::segnalazione.modal.terms.info.label') }}</p>
                    <a href="#" class="cmp-modal__header-link text-success underline mt-1">{{ __('fixcity::segnalazione.modal.terms.link.label') }}</a>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer pb-70 pt-0">
                    <button class="btn btn-primary w-100 mx-0 fw-bold mb-4" type="submit" data-bs-toggle="modal" data-bs-target="#" form="">{{ __('fixcity::segnalazione.actions.submit.label') }}</button>
                    <button class="btn btn-outline-primary w-100 mx-0" data-bs-dismiss="modal fw-bold" type="button">{{ __('fixcity::segnalazione.actions.cancel.label') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
