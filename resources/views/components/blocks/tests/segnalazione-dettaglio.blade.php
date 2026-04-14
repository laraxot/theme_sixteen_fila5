@props(['data' => []])

@php
    $ns = 'fixcity::segnalazione';
    $blockData = is_array($data) ? $data : [];
    
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

<!-- Heading section - matches reference structure -->
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
                <button type="button" class="btn fw-bold btn-primary mr-lg-30">
                    <span>{{ $primaryAction['label'] ?? '' }}</span>
                </button>
                <button type="button" class="btn fw-bold btn-outline-primary t-primary">
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
<hr class="d-none d-lg-block mb-0 mt-2">

<!-- Content sections with sidebar -->
<div class="container">
    <div class="row row-column-menu-left mt-lg-80 mt-3">
        <div class="col-12 col-lg-3 mb-4 border-col">
            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="{{ __($ns.'.detail.index.label') }}">
                    <div id="navbarNavProgress" class="navbar-custom">
                        <div class="menu-wrapper">
                            <div class="link-list-wrapper">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <span id="accordion-title-one" class="accordion-header">
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
                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
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
                    <section id="{{ $section['id'] }}" class="it-page-section mb-30{{ isset($section['class']) ? ' ' . $section['class'] : '' }}">
                        <h2 class="title-xxlarge mb-3">{{ $section['title'] }}</h2>
                        @if(!empty($section['intro']))
                            <p class="text-paragraph lora mb-0">{{ $section['intro'] }}</p>
                        @endif
                        @if(!empty($section['content']))
                            <p class="text-paragraph lora mb-0">{!! $section['content'] !!}</p>
                        @endif
                        @if(!empty($section['links']))
                            <div class="cmp-icon-link">
                                @foreach($section['links'] as $link)
                                    <a class="list-item icon-left d-inline-block" href="{{ $link['url'] ?? '#' }}">
                                        <span class="list-item-title-icon-wrapper">
                                            <svg class="icon icon-primary icon-sm me-1" aria-hidden="true">
                                                <use href="{{ $sprite }}#{{ $link['icon'] ?? 'it-clip' }}"></use>
                                            </svg>
                                            <span class="list-item">{{ $link['label'] ?? '' }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                        @if(!empty($section['buttons']))
                            @foreach($section['buttons'] as $button)
                                @if($loop->first)
                                    <p class="text-paragraph lora"></p>
                                @endif
                                @if($loop->iteration == 2)
                                    <p class="text-paragraph mt-4 lora">{{ $button['extra_text'] ?? '' }}</p>
                                @endif
                                <button type="button" class="btn {{ $button['variant'] ?? 'btn-primary' }} mobile-full">
                                    <span>{{ $button['label'] ?? '' }}</span>
                                </button>
                            @endforeach
                        @endif
                    </section>
                @endforeach

                <section class="it-page-section" id="contacts">
                    <h2 class="mb-3">{{ __($ns.'.detail.contacts.label') }}</h2>
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
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

