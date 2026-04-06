@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione disservizio';
    $status = $data['status'] ?? 'Servizio attivo';
    $summary = $data['summary'] ?? '';
    $primaryAction = $data['primary_action'] ?? ['label' => 'Segnala disservizio', 'url' => '/it/tests/segnalazione-01-privacy'];
    $secondaryAction = $data['secondary_action'] ?? ['label' => 'Tutte le segnalazioni', 'url' => '/it/tests/segnalazioni-elenco'];
    $shareLinks = $data['share_links'] ?? [];
    $viewActions = $data['view_actions'] ?? [];
    $sections = $data['sections'] ?? [];
    $contact = $data['contact'] ?? [];
    $topics = $data['topics'] ?? [];
    $updatedAt = $data['updated_at'] ?? null;
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="container dc-service-detail">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-heading pb-3 pb-lg-4">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="title-xxxlarge" data-element="service-title">{{ $title }}</h1>

                        <ul class="d-flex flex-wrap gap-1 my-3 list-unstyled">
                            <li>
                                <div class="chip chip-simple text-button" data-element="service-status">
                                    <span class="chip-label">{{ $status }}</span>
                                </div>
                            </li>
                        </ul>

                        @if($summary)
                            <p class="subtitle-small mb-3">{{ $summary }}</p>
                        @endif

                        <div class="d-lg-flex gap-30 mb-2 dc-service-detail__cta-group">
                            <a href="{{ $primaryAction['url'] ?? '#' }}" class="btn fw-bold btn-primary mr-lg-30">
                                <span>{{ $primaryAction['label'] ?? 'Segnala disservizio' }}</span>
                            </a>
                            <a href="{{ $secondaryAction['url'] ?? '#' }}" class="btn fw-bold btn-outline-primary t-primary">
                                <span>{{ $secondaryAction['label'] ?? 'Tutte le segnalazioni' }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0 dc-service-detail__actions">
                        @if($shareLinks !== [])
                            <div class="dropdown dc-service-detail__dropdown">
                                <button aria-label="condividi sui social" class="btn btn-dropdown text-decoration-underline d-inline-flex align-items-center fs-0" type="button">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="{{ $sprite }}#it-share"></use>
                                    </svg>
                                    <small>Condividi</small>
                                </button>
                                <div class="dropdown-menu shadow-lg dc-service-detail__dropdown-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" role="menu">
                                            @foreach($shareLinks as $item)
                                                <li role="none">
                                                    <a class="list-item" href="{{ $item['url'] ?? '#' }}" role="menuitem">
                                                        <svg class="icon" aria-hidden="true">
                                                            <use xlink:href="{{ $sprite }}#{{ $item['icon'] ?? 'it-share' }}"></use>
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
                            <div class="dropdown dc-service-detail__dropdown">
                                <button aria-label="vedi azioni da compiere sulla pagina" class="btn btn-dropdown text-decoration-underline d-inline-flex align-items-center fs-0" type="button">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="{{ $sprite }}#it-more-items"></use>
                                    </svg>
                                    <small>Vedi azioni</small>
                                </button>
                                <div class="dropdown-menu shadow-lg dc-service-detail__dropdown-menu">
                                    <div class="link-list-wrapper">
                                        <ul class="link-list" role="menu">
                                            @foreach($viewActions as $item)
                                                <li role="none">
                                                    <a class="list-item" href="{{ $item['url'] ?? '#' }}" role="menuitem">
                                                        <svg class="icon" aria-hidden="true">
                                                            <use xlink:href="{{ $sprite }}#{{ $item['icon'] ?? 'it-link' }}"></use>
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

<div class="container dc-service-detail dc-service-detail__content">
    <div class="row row-column-menu-left mt-lg-80 mt-3">
        <div class="col-12 col-lg-3 mb-4 border-col">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="INDICE DELLA PAGINA">
                    <div class="navbar-custom" id="navbarNavProgress">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span class="accordion-header" id="accordion-title-one">
                                            <button class="accordion-button pb-10 px-3" type="button">
                                                INDICE DELLA PAGINA
                                                <svg class="icon icon-xs right">
                                                    <use href="{{ $sprite }}#it-expand"></use>
                                                </svg>
                                            </button>
                                        </span>
                                        <div class="progress">
                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
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
                                                            <span>Contatti</span>
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
                    <section class="it-page-section {{ $section['class'] ?? 'mb-30' }}" id="{{ $section['id'] }}">
                        <h2 class="title-xxlarge mb-3">{{ $section['title'] }}</h2>
                        @if(!empty($section['intro']))
                            <p class="text-paragraph lora mb-0">{{ $section['intro'] }}</p>
                        @endif
                        @if(!empty($section['content']))
                            <div class="text-paragraph lora mb-0 dc-service-detail__richtext">{!! $section['content'] !!}</div>
                        @endif
                        @if(!empty($section['links']))
                            @foreach($section['links'] as $link)
                                <div class="cmp-icon-link mt-3">
                                    <a class="list-item icon-left d-inline-block" href="{{ $link['url'] ?? '#' }}" aria-label="{{ $link['label'] ?? '' }}" title="{{ $link['label'] ?? '' }}">
                                        <span class="list-item-title-icon-wrapper">
                                            <svg class="icon icon-primary icon-sm me-1" aria-hidden="true">
                                                <use href="{{ $sprite }}#{{ $link['icon'] ?? 'it-clip' }}"></use>
                                            </svg>
                                            <span class="list-item">{{ $link['label'] ?? '' }}</span>
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                        @if(!empty($section['buttons']))
                            <div class="dc-service-detail__button-stack">
                                @foreach($section['buttons'] as $button)
                                    <a href="{{ $button['url'] ?? '#' }}" class="btn {{ $button['variant'] ?? 'btn-primary' }} mobile-full">
                                        <span>{{ $button['label'] ?? '' }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </section>
                @endforeach

                <section class="it-page-section" id="contacts">
                    <h2 class="mb-3">Contatti</h2>
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
                                        <div class="avatar size-xl">
                                            <img src="{{ $contact['image'] }}" alt="{{ $contact['office'] ?? 'Contatto' }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-30">
                            <span class="text-paragraph-small">Argomenti:</span>
                            <ul class="d-flex flex-wrap gap-2 mt-10 mb-3 list-unstyled">
                                @foreach($topics as $topic)
                                    <li>
                                        <a class="chip chip-simple" href="{{ $topic['url'] ?? '#' }}" data-element="service-topic">
                                            <span class="chip-label">{{ $topic['label'] ?? '' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @if($updatedAt)
                                <p class="text-paragraph-small mb-0">Pagina aggiornata il {{ $updatedAt }}</p>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
