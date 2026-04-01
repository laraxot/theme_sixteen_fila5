{{--
    Hero Homepage Block
    Reference: design-comuni-pagine-statiche/src/pages/sito/homepage.hbs #head-section
--}}
@props([
    'title'          => '',
    'subtitle'       => '',
    'news'           => [],
    'image'          => 'https://picsum.photos/800/600',
    'all_news_label' => 'Tutte le novità',
    'all_news_url'   => '#',
])

<section id="head-section">
    <h2 class="visually-hidden">Contenuti in evidenza</h2>
    <div class="container">
        <div class="row">
            {{-- Left: News card (order-2 mobile, order-1 desktop) --}}
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="card mb-5">
                    <div class="card-body pb-5 px-0">
                        @if(!empty($news))
                        <div class="category-top">
                            <svg class="icon icon-sm" aria-hidden="true">
                                <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-calendar') }}"></use>
                            </svg>
                            <span class="title-xsmall-semi-bold fw-semibold">{{ $news['category'] ?? 'Notizie' }}</span>
                            <span class="data fw-normal">{{ $news['date'] ?? '' }}</span>
                        </div>
                        <a href="{{ $news['url'] ?? '#' }}" class="text-decoration-none">
                            <h3 class="card-title">{{ $news['title'] ?? '' }}</h3>
                        </a>
                        <p class="mb-4 pt-3 lora"><strong>{{ $news['excerpt'] ?? '' }}</strong></p>
                        @if(!empty($news['tag']))
                        <a class="chip chip-simple" href="{{ $news['url'] ?? '#' }}">
                            <span class="chip-label">{{ $news['tag'] }}</span>
                        </a>
                        @endif
                        @endif
                        <a class="read-more pb-3" href="{{ $all_news_url }}">
                            <span class="text">{{ $all_news_label }}</span>
                            <svg class="icon">
                                <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right') }}"></use>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            {{-- Right: Hero image (order-1 mobile, order-2 desktop) --}}
            <div class="col-lg-6 order-1 order-lg-2 px-0 px-lg-3">
                <img src="{{ $image }}"
                     title="{{ $title }}"
                     alt="{{ $subtitle }}"
                     class="img-fluid" />
            </div>
        </div>
    </div>
</section>
