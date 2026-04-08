@props(['data' => []])

@php
    $ns = 'fixcity::segnalazione';
    
    // Fallback: read from JSON config if DB blocks are empty
    $jsonPath = config_path('local/fixcity/database/content/pages/tests.segnalazione-dettaglio.json');
    $jsonData = [];
    if (file_exists($jsonPath)) {
        $jsonData = json_decode(file_get_contents($jsonPath), true);
    }
    $blockData = $data ?: ($jsonData['content_blocks']['it'][1]['data'] ?? []);
    
    $title = $blockData['title'] ?? '';
    $status = $blockData['status'] ?? '';
    $summary = $blockData['summary'] ?? '';
    $primaryAction = $blockData['primary_action'] ?? [];
    $secondaryAction = $blockData['secondary_action'] ?? [];
    $shareLinks = $blockData['share_links'] ?? [];
    $viewActions = $blockData['view_actions'] ?? [];
    $sections = $blockData['sections'] ?? [];
    $contact = $blockData['contact'] ?? [];
    $topics = $blockData['topics'] ?? [];
    $updatedAt = $blockData['updated_at'] ?? null;
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-heading pb-3 pb-lg-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="title-xxxlarge" data-element="service-title">{{ $title }}</h1>

                        <ul class="d-flex flex-wrap gap-1 my-3">
                            <li>
                                <div class="chip chip-simple text-button" data-element="service-status">
                                    <span class="chip-label">{{ $status }}</span>
                                </div>
                            </li>
                        </ul>

                        @if($summary)
                            <p class="subtitle-small mb-3">{{ $summary }}</p>
                        @endif

                        <div class="d-lg-flex gap-30 mb-2">
                            <button class="btn fw-bold btn-primary mr-lg-30" onclick="window.location.href='{{ $primaryAction['url'] ?? '#' }}'">
                                <span>{{ $primaryAction['label'] ?? '' }}</span>
                            </button>
                            <button class="btn fw-bold btn-outline-primary t-primary" onclick="window.location.href='{{ $secondaryAction['url'] ?? '#' }}'">
                                <span>{{ $secondaryAction['label'] ?? '' }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-5 mt-lg-0">
                        @if($shareLinks !== [])
                            <div class="dropdown" x-data="{ shareOpen: false }">
                                <button aria-label="{{ __($ns.'.detail.share.aria') }}" class="btn btn-dropdown dropdown-toggle text-decoration-underline d-inline-flex align-items-center fs-0" type="button" id="shareActions" data-bs-toggle="dropdown" @click="shareOpen = !shareOpen" aria-haspopup="true" :aria-expanded="shareOpen.toString()">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="{{ $sprite }}#it-share"></use>
                                    </svg>
                                    <small>{{ __($ns.'.detail.share.label') }}</small>
                                </button>
                                <div class="dropdown-menu shadow-lg" aria-labelledby="shareActions" x-show="shareOpen" @click.away="shareOpen = false" x-cloak>
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" role="menu">
                                            @foreach($shareLinks as $item)
                                                <li role="none">
                                                    <a class="list-item" href="{{ $item['url'] ?? '#' }}" role="menuitem" @click="shareOpen = false">
                                                        <svg class="icon" aria-hidden="true">
                                                            <use href="{{ $sprite }}#{{ $item['icon'] ?? 'it-share' }}"></use>
                                                        </svg>
                                                        <span>{{ $item['label'] ?? '' }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($viewActions !== [])
                            <div class="dropdown" x-data="{ actionsOpen: false }">
                                <button aria-label="{{ __($ns.'.detail.actions.aria') }}" class="btn btn-dropdown dropdown-toggle text-decoration-underline d-inline-flex align-items-center fs-0" type="button" id="viewActions" data-bs-toggle="dropdown" @click="actionsOpen = !actionsOpen" aria-haspopup="true" :aria-expanded="actionsOpen.toString()">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="{{ $sprite }}#it-more-items"></use>
                                    </svg>
                                    <small>{{ __($ns.'.detail.actions.label') }}</small>
                                </button>
                                <div class="dropdown-menu shadow-lg" aria-labelledby="viewActions" x-show="actionsOpen" @click.away="actionsOpen = false" x-cloak>
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" role="menu">
                                            @foreach($viewActions as $item)
                                                <li role="none">
                                                    <a class="list-item" href="{{ $item['url'] ?? '#' }}" role="menuitem" @click="actionsOpen = false">
                                                        <svg class="icon" aria-hidden="true">
                                                            <use href="{{ $sprite }}#{{ $item['icon'] ?? 'it-link' }}"></use>
                                                        </svg>
                                                        <span>{{ $item['label'] ?? '' }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <hr class="d-none d-lg-block mb-0 mt-2">
    </div>
</div>

<div class="container">
    <div class="row mt-3 mt-lg-80">
        <div class="col-12 col-lg-3 border-col">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" id="navbarNavProgress" aria-label="{{ __($ns.'.detail.index.label') }}">
                    <div class="navbar-custom">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                            <button class="accordion-button pb-10 px-3" type="button">
                                                {{ __($ns.'.detail.index.label') }}
                                                <svg class="icon icon-xs right">
                                                    <use href="{{ $sprite }}#it-expand"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="accordion-collapse collapse show" id="collapse-one" role="region" aria-labelledby="accordion-title-one">
                                            <div class="accordion-body">
                                                <ul class="link-list" data-element="page-index">
                                                    @foreach($sections as $section)
                                                        <li class="nav-item">
                                                            <a class="nav-link" href="#{{ $section['id'] }}">
                                                                <span>{{ $section['nav_label'] ?? $section['title'] }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#contacts">
                                                            <span>{{ __($ns.'.detail.contacts.label') }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="col-12 col-lg-8 offset-lg-1">
            <div class="it-page-sections-container">
                @foreach($sections as $section)
                    <section class="it-page-section mb-30" id="{{ $section['id'] }}">
                        <h2 class="title-xxlarge mb-3">{{ $section['title'] }}</h2>
                        @if(!empty($section['intro']))
                            <p class="text-paragraph lora mb-0">{{ $section['intro'] }}</p>
                        @endif
                        @if(!empty($section['content']))
                            <p class="text-paragraph lora mb-0">{!! $section['content'] !!}</p>
                        @endif
                        @if(!empty($section['links']))
                            <ul class="link-list list-wrapper lora">
                                @foreach($section['links'] as $link)
                                    <li class="list-item">
                                        <span>{{ $link['label'] ?? '' }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        @if(!empty($section['buttons']))
                            <div class="mt-3">
                                @foreach($section['buttons'] as $button)
                                    <button type="button" class="btn {{ $button['variant'] ?? 'btn-primary' }} mobile-full" onclick="window.location.href='{{ $button['url'] ?? '#' }}'">
                                        <span>{{ $button['label'] ?? '' }}</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </section>
                @endforeach

                <section class="it-page-section" id="contacts">
                    <h2 class="mb-3">{{ __($ns.'.detail.contacts.title') }}</h2>
                    <div class="row">
                        <div class="col-12 col-md-8 col-lg-6 mb-30">
                            <div class="card-wrapper rounded h-auto pb-0">
                                <div class="card card-teaser card-teaser-info rounded shadow-sm p-3">
                                    <div class="card-body pe-3">
                                        <span class="title-small">
                                            <a class="text-decoration-none" href="{{ $contact['url'] ?? '#' }}" data-element="service-area">{{ $contact['office'] ?? '' }}</a>
                                        </span>
                                        <p class="subtitle-small mb-0">{!! nl2br(e($contact['details'] ?? '')) !!}</p>
                                    </div>
                                    @if(!empty($contact['image']))
                                        <div class="col-12 mb-30">
                                            <div class="avatar size-xl">
                                                <img src="{{ $contact['image'] }}" alt="{{ $contact['office'] ?? 'Contatto' }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-30">
                        <span class="text-paragraph-small">{{ __($ns.'.detail.topics.label') }}:</span>
                        <ul class="d-flex flex-wrap gap-2 mt-10 mb-3">
                            @foreach($topics as $topic)
                                <li>
                                    <a class="chip chip-simple" href="{{ $topic['url'] ?? '#' }}" data-element="service-topic">
                                        <span class="chip-label">{{ $topic['label'] ?? '' }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        @if($updatedAt)
                            <p class="text-paragraph-small mb-0">{{ __($ns.'.detail.updated.text', ['date' => $updatedAt]) }}</p>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

{{-- Rating Section --}}
<div class="bg-primary">
    <div class="container">
        <div class="row d-flex justify-content-center bg-primary">
            <div class="col-12 col-lg-6 p-lg-0 px-3">
                <div class="cmp-rating pt-lg-80 pb-lg-80" id="rating">
                    <div class="card shadow card-wrapper" data-element="feedback">
                        <div class="cmp-rating__card-first">
                            <div class="card-header border-0">
                                <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">{{ __($ns.'.rating.question.text') }}</h2>
                            </div>
                            <div class="card-body">
                                <fieldset class="rating">
                                    <legend class="visually-hidden">{{ __($ns.'.rating.legend.text') }}</legend>
                                    @php
                                        $starLabels = [
                                            5 => 'Valuta 5 stelle su 5',
                                            4 => 'Valuta 4 stelle su 5',
                                            3 => 'Valuta 3 stelle su 5',
                                            2 => 'Valuta 2 stelle su 5',
                                            1 => 'Valuta 1 stelle su 5',
                                        ];
                                        $starIds = [
                                            5 => 'first-star',
                                            4 => 'second-star',
                                            3 => 'third-star',
                                            2 => 'fourth-star',
                                            1 => 'fifth-star',
                                        ];
                                    @endphp
                                    @for ($i = 5; $i >= 1; $i--)
                                        <input type="radio" id="star{{ $i }}a" name="ratingA" value="{{ $i }}">
                                        <label class="full rating-star active" for="star{{ $i }}a" data-element="feedback-rate-{{ $i }}">
                                            <svg class="icon icon-sm" role="img" aria-labelledby="{{ $starIds[$i] }}" viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                                <path fill="none" d="M0 0h24v24H0z"></path>
                                            </svg>
                                            <span class="visually-hidden" id="{{ $starIds[$i] }}">{{ $starLabels[$i] }}</span>
                                        </label>
                                    @endfor
                                </fieldset>
                            </div>
                        </div>
                        <div class="cmp-rating__card-second d-none">
                            <div class="card-header border-0 mb-0">
                                <h2 class="title-medium-2-bold mb-0" id="rating-feedback"></h2>
                            </div>
                            <div class="d-none form-rating">
                                <div class="d-none">
                                    <div class="cmp-steps-rating">
                                        <fieldset class="d-none fieldset-rating-one">
                                            <legend class="iscrizione"></legend>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
