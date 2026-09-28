@props(['data' => []])

@php
    $blockData = is_array($data) ? $data : [];
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';

    $hasConfirmationCode = (string) ($blockData['code'] ?? '') !== '';
    $title = (string) __('fixcity::ticket_confirmation.title');
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
    $reservedArea = [
        'link_label' => (string) __('fixcity::ticket_confirmation.reserved_area.link_label'),
        'text' => (string) __('fixcity::ticket_confirmation.reserved_area.text'),
        'url' => $hasConfirmationCode
            ? (string) data_get($blockData, 'reserved_area.url', '/'.app()->getLocale().'/area-personale/pratiche')
            : '/'.app()->getLocale().'/area-personale/pratiche',
    ];
    $relatedServices = $blockData['related_services'] ?? [];
    $contacts = [
        'title' => (string) __('fixcity::ticket_confirmation.contacts.title'),
        'links' => [[
            'label' => (string) __('fixcity::ticket_confirmation.contacts.assistance'),
            'url' => '/'.app()->getLocale().'/contacts',
            'icon' => 'it-mail',
            'data_element' => 'contacts',
        ]],
    ];
    $showRating = (bool) ($blockData['show_rating'] ?? true);
    $ratingData = [];
@endphp

<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <p class="text-paragraph-small mb-3">
                {{ __('fixcity::segnalazione.steps.current_of_total.label', ['current' => 4, 'total' => 4]) }}
            </p>
            <div class="cmp-heading p-0">
                <div class="categoryicon-top d-flex">
                    <svg class="icon icon-success mr-10 icon-md" aria-hidden="true">
                        <use href="{{ $sprite }}#it-check-circle"></use>
                    </svg>
                    <h1 class="title-xxxlarge">{{ $title }}</h1>
                </div>

                @if ($summaryHtml !== '')
                    <p class="subtitle-small">{!! $summaryHtml !!}</p>
                @endif
                @if ($visibilityHtml !== '')
                    <p class="subtitle-small">{!! $visibilityHtml !!}</p>
                @endif
                @if ($emailIntroHtml !== '' || $email !== '')
                    <p class="subtitle-small pt-3 pt-lg-4">{!! $emailIntroHtml !!}@if($email !== '')<br><strong>{{ $email }}</strong>@endif</p>
                @endif

                @if ($receipt !== [])
                    <a href="{{ $receipt['url'] ?? '#' }}" class="btn btn-outline-primary bg-white fw-bold mt-4">
                        <span class="rounded-icon">
                            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                                <use href="{{ $sprite }}#{{ $receipt['icon'] ?? 'it-download' }}"></use>
                            </svg>
                        </span>
                        <span>{{ $receipt['label'] ?? '' }}</span>
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

    @if (($relatedServices['items'] ?? []) !== [])
        <hr class="d-none d-lg-block mt-40 mb-0">
        <div class="row justify-content-center mb-3 mb-md-5">
            <div class="col-12 col-lg-10">
                <div class="cmp-icon-list">
                    <h2 class="title-xxlarge mt-40 mb-2 mb-lg-4 mb-lg-4" id="related-service">{{ $relatedServices['title'] ?? '' }}</h2>
                    <div class="link-list-wrapper">
                        <ul class="link-list">
                            @foreach (($relatedServices['items'] ?? []) as $item)
                                <li class="shadow mb-4">
                                    <a class="list-item icon-left t-primary title-small-semi-bold" href="{{ $item['url'] ?? '#' }}">
                                        <span class="list-item-title-icon-wrapper">
                                            <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                <use href="{{ $sprite }}#{{ $item['icon'] ?? 'it-settings' }}"></use>
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
    @endif
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
                                                    <use href="{{ $sprite }}#{{ $link['icon'] ?? 'it-help-circle' }}"></use>
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
