@props(['data' => []])

@php
    $cards = $data['cards'] ?? [];
    $month = $data['month'] ?? '';
    $slides = $data['slides'] ?? [];
@endphp

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-lg-7">
                <h2 class="title-xxlarge mb-4">Organi di governo</h2>

                <div class="row g-4">
                    @foreach($cards as $card)
                        <div class="col-12 col-md-6 col-xl-4">
                            <article class="card card-teaser shadow-sm h-100 rounded border border-light">
                                @if($card['image'] ?? false)
                                    <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['title'] ?? '' }}">
                                @endif

                                <div class="card-body">
                                    @if($card['category'] ?? false)
                                        <div class="category-top mb-2">
                                            <span class="title-xsmall-semi-bold fw-semibold">{{ $card['category'] }}</span>
                                        </div>
                                    @endif

                                    <h3 class="card-title h5 mb-2">
                                        <a href="{{ $card['url'] ?? '#' }}" class="text-decoration-none">{{ $card['title'] ?? '' }}</a>
                                    </h3>

                                    @if($card['role'] ?? false)
                                        <p class="card-text fw-semibold mb-2">{{ $card['role'] }}</p>
                                    @endif

                                    @if($card['description'] ?? false)
                                        <p class="card-text text-muted">{{ $card['description'] }}</p>
                                    @endif

                                    <a class="read-more mt-3" href="{{ $card['url'] ?? '#' }}">
                                        <span class="text">Vai alla pagina</span>
                                        <svg class="icon" aria-hidden="true">
                                            <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-lg-5">
                <div class="card shadow-sm rounded border border-light h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
                            <h2 class="title-xxlarge mb-0">Eventi</h2>
                            @if($month)
                                <span class="text-uppercase fw-semibold text-primary">{{ $month }}</span>
                            @endif
                        </div>

                        @if($slides !== [])
                            <div class="calendar-list">
                                @foreach($slides as $slide)
                                    <div class="calendar-event mb-3 pb-3 border-bottom">
                                        <div class="row g-3">
                                            <div class="col-3 col-md-2 text-center">
                                                <span class="calendar-date text-primary h3 d-block mb-0">{{ $slide['day'] ?? '' }}</span>
                                                <span class="calendar-day text-muted small text-uppercase">{{ $slide['weekday'] ?? '' }}</span>
                                            </div>
                                            <div class="col-9 col-md-10">
                                                @foreach(($slide['events'] ?? []) as $event)
                                                    <a href="{{ $event['url'] ?? '#' }}" class="d-block text-decoration-none fw-semibold mb-2">
                                                        {{ $event['title'] ?? '' }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <a class="read-more" href="/it/tests/eventi">
                            <span class="text">Vai al calendario eventi</span>
                            <svg class="icon" aria-hidden="true">
                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
