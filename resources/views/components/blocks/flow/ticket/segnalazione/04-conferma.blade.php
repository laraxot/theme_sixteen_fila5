@props(['data' => []])

@php
    $blockData = is_array($data) ? $data : [];
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;

    $hasConfirmationCode = (string) ($blockData['code'] ?? '') !== '';
    $title = (string) ($blockData['title'] ?? __('fixcity::ticket_confirmation.title'));
    $summaryHtml = $hasConfirmationCode
        ? (string) ($blockData['summary_html'] ?? '')
        : (string) __('fixcity::ticket_confirmation.summary.without_code');
    $visibilityHtml = $hasConfirmationCode
        ? (string) ($blockData['visibility_html'] ?? '')
        : (string) __('fixcity::ticket_confirmation.visibility', ['url' => '/'.app()->getLocale().'/tickets']);
    $emailIntroHtml = $hasConfirmationCode
        ? (string) ($blockData['email_intro_html'] ?? '')
        : (string) __('fixcity::ticket_confirmation.email_intro');
    $email = (string) ($blockData['email'] ?? '');
    $receipt = $hasConfirmationCode && is_array($blockData['receipt'] ?? null) ? $blockData['receipt'] : [];
    $reservedArea = is_array($blockData['reserved_area'] ?? null) ? $blockData['reserved_area'] : [
        'link_label' => (string) __('fixcity::ticket_confirmation.reserved_area.link_label'),
        'text' => (string) __('fixcity::ticket_confirmation.reserved_area.text'),
        'url' => '/'.app()->getLocale().'/area-personale/pratiche',
    ];
    $relatedServices = $blockData['related_services'] ?? $blockData['related'] ?? [];
    $contacts = $blockData['contacts'] ?? [
        'title' => (string) __('fixcity::ticket_confirmation.contacts.title'),
        'links' => [[
            'label' => (string) __('fixcity::ticket_confirmation.contacts.assistance'),
            'url' => '/'.app()->getLocale().'/contacts',
            'icon' => 'it-mail',
            'data_element' => 'contacts',
        ]],
    ];
    if (is_array($contacts) && isset($contacts['main'])) {
        $contacts = $contacts['main'];
    }
    if (isset($contacts['items']) && !isset($contacts['links'])) {
        $contacts['links'] = $contacts['items'];
    }
    $showRating = (bool) ($blockData['show_rating'] ?? true);
    $ratingData = [];

    $breadcrumbItems = $blockData['breadcrumb']['items'] ?? [
        ['label' => 'Home', 'url' => '/'.app()->getLocale()],
        ['label' => 'Servizi', 'url' => '/'.app()->getLocale().'/tickets'],
    ];
    $breadcrumbCurrent = $blockData['breadcrumb']['current'] ?? 'Segnalazione disservizio';
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="{{ __('pub_theme::blocks_common.shared.breadcrumb.label') }}">
                    <ol class="breadcrumb p-0" data-element="breadcrumb">
                        @foreach ($breadcrumbItems as $crumb)
                            <li class="breadcrumb-item"><a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '' }}</a><span class="separator">/</span></li>
                        @endforeach
                        <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumbCurrent }}</li>
                    </ol>
                </nav>
            </div>
            <div class="cmp-heading p-0">
                <div class="categoryicon-top d-flex">
                    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
                        <use href="{{ $icon($blockData['heading']['icon'] ?? 'it-check-circle') }}"></use>
                    </svg>
                    <h1 class="title-xxlarge">{{ $title }}</h1>
                </div>

                @if ($summaryHtml !== '')
                    <p class="subtitle-small">{!! $summaryHtml !!}</p>
                @endif
                @if ($visibilityHtml !== '')
                    <p class="subtitle-small">{!! $visibilityHtml !!}</p>
                @endif
                @if ($emailIntroHtml !== '' || $email !== '')
                    <p class="subtitle-small">
                        {!! $emailIntroHtml !!}
                        @if($email !== '')<br><strong>{{ $email }}</strong>@endif
                    </p>
                @endif

                @if ($receipt !== [])
                    <a href="{{ $receipt['url'] ?? '#' }}" class="btn btn-outline-primary bg-white fw-bold">
                        <span class="rounded-icon">
                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                <use href="{{ $icon($receipt['icon'] ?? 'it-download') }}"></use>
                            </svg>
                        </span>
                        <span class="">{{ $receipt['label'] ?? '' }}</span>
                    </a>
                @endif
            </div>

            @if ($reservedArea !== [])
                <p class="mt-3">
                    @if (!empty($reservedArea['url']) && !empty($reservedArea['link_label']))
                        <a href="{{ $reservedArea['url'] }}" class="t-primary text-paragraph">{{ $reservedArea['link_label'] }}</a>
                    @endif
                    @if (!empty($reservedArea['text']))
                        <span class="text-paragraph"> {{ $reservedArea['text'] }}</span>
                    @endif
                </p>
            @endif
        </div>
    </div>

    <hr class="d-none d-lg-block mt-40 mb-0">
    <div class="row justify-content-center mb-3 mb-md-5">
        <div class="col-12 col-lg-10">
            <div class="cmp-icon-list">
                <h2 class="title-xxlarge mt-40 mb-2 mb-lg-4 mb-lg-4" id="related-service">{{ $relatedServices['title'] ?? '' }}</h2>
                <div class="link-list-wrapper">
                    <ul class="link-list">
                        @foreach (($relatedServices['items'] ?? ($relatedServices['items'] ?? [])) as $item)
                            <li class="shadow mb-4">
                                <a class="list-item icon-left t-primary title-small-semi-bold" href="{{ $item['url'] ?? '#' }}">
                                    <span class="list-item-title-icon-wrapper">
                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                            <use href="{{ $icon($item['icon'] ?? 'it-settings') }}"></use>
                                        </svg>
                                        <span class="list-item-title title-small-semi-bold">{{ $item['label'] ?? '' }}</span>
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

@if ($showRating)
    @include('pub_theme::components.blocks.feedback.rating', ['data' => $ratingData])
@endif

@if (($contacts['links'] ?? []) !== [])
    <div class="bg-grey-card shadow-contacts">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 offset-lg-3 p-contacts">
                    <div class="cmp-contacts">
                        <div class="card w-100">
                            <div class="card-body">
                                <h2 class="title-medium-2-semi-bold">{{ $contacts['title'] ?? '' }}</h2>
                                <ul class="contact-list p-0">
                                    @foreach (($contacts['links'] ?? []) as $link)
                                        <li>
                                            <a class="list-item" href="{{ $link['url'] ?? '#' }}" @if(!empty($link['data_element'])) data-element="{{ $link['data_element'] }}" @endif>
                                                <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                                    <use href="{{ $icon($link['icon'] ?? 'it-mail') }}"></use>
                                                </svg>
                                                <span>{{ $link['label'] ?? '' }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
