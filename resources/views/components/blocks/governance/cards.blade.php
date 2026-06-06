{{--
    Governance cards + events calendar — Design Comuni homepage block.
    Usage: <x-blocks.governance.cards :data="$calendarioData" />
--}}

@props(['data' => []])

@php
    $cards = is_array($data['cards'] ?? null) ? $data['cards'] : [];
    $month = (string) ($data['month'] ?? '');
    $slides = is_array($data['slides'] ?? null) ? $data['slides'] : [];
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<section id="calendario">
    <div class="section section-muted pb-90 pb-lg-50 px-lg-5 pt-0">
        <div class="container">
            @if ($cards !== [])
                <div class="row mb-2">
                    <div class="card-wrapper px-0 card-overlapping card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                        @foreach ($cards as $card)
                            @php
                                $hasImage = filled($card['image'] ?? null);
                            @endphp
                            <div @class([
                                'card card-teaser card-flex no-after rounded shadow-sm border border-light mb-0',
                                'card-teaser-image' => $hasImage,
                            ])>
                                @if ($hasImage)
                                    <div class="card-image-wrapper with-read-more">
                                        <div class="card-body p-3 pb-5">
                                            <div class="category-top">
                                                <span class="title-xsmall-semi-bold fw-semibold">{{ $card['category'] ?? '' }}</span>
                                            </div>
                                            <h3 class="card-title text-paragraph-medium u-grey-light">{{ $card['title'] ?? '' }}</h3>
                                            @if (filled($card['role'] ?? null))
                                                <p class="text-paragraph-card u-grey-light m-0">{{ $card['role'] }}</p>
                                            @endif
                                        </div>
                                        <div class="card-image card-image-rounded pb-5">
                                            <img src="{{ $card['image'] }}" alt="{{ $card['title'] ?? '' }}">
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body p-3 pb-5">
                                        <div class="category-top">
                                            <span class="title-xsmall-semi-bold fw-semibold">{{ $card['category'] ?? '' }}</span>
                                        </div>
                                        <h3 class="card-title">{{ $card['title'] ?? '' }}</h3>
                                        @if (filled($card['description'] ?? null))
                                            <p class="card-text">{{ $card['description'] }}</p>
                                        @endif
                                    </div>
                                @endif
                                @if (filled($card['url'] ?? null))
                                    <a class="read-more ps-3" href="{{ $card['url'] }}">
                                        <span class="text">Scopri di più</span>
                                        <svg class="icon" aria-hidden="true">
                                            <use href="{{ $sprite }}#it-arrow-right"></use>
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($slides !== [])
                <div class="row pt-4 pt-lg-5">
                    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                        <h2 class="title-medium-2 mb-0">Calendario degli eventi</h2>
                        @if ($month !== '')
                            <span class="title-xsmall-semi-bold">{{ $month }}</span>
                        @endif
                    </div>
                    <div class="col-12">
                        <div class="it-carousel-wrapper it-carousel-landscape-abstract-four-cols splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($slides as $slide)
                                        <li class="splide__slide">
                                            <div class="it-single-slide-wrapper">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <span class="card-date">{{ $slide['day'] ?? '' }}</span>
                                                        <span class="card-day">{{ $slide['weekday'] ?? '' }}</span>
                                                        <ul class="list-group list-group-flush">
                                                            @foreach ($slide['events'] ?? [] as $event)
                                                                <li class="list-group-item">
                                                                    @if (filled($event['time'] ?? null))
                                                                        <span class="list-group-item-time">{{ $event['time'] }}</span>
                                                                    @endif
                                                                    <a href="{{ $event['url'] ?? '#' }}" class="list-group-item-title">
                                                                        {{ $event['title'] ?? '' }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
