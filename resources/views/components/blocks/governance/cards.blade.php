{{--
    Governance Cards Block - Organi di governo
    Reference: design-comuni-pagine-statiche/src/pages/sito/homepage.hbs #calendario section (card-wrapper)
--}}
@props([
    'title' => 'Organi di governo',
    'items' => [],
])

<div class="section section-muted pb-90 pb-lg-50 px-lg-5 pt-0">
    <div class="container">
        <div class="row mb-2">
            <div class="card-wrapper px-0 card-overlapping card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
                @foreach($items as $item)

                @if(!empty($item['image']))
                {{-- Card con immagine (es. Sindaco) --}}
                <div class="card card-teaser card-teaser-image card-flex no-after rounded shadow-sm border border-light mb-0">
                    <div class="card-image-wrapper with-read-more">
                        <div class="card-body p-3 pb-5">
                            <div class="category-top">
                                <span class="title-xsmall-semi-bold fw-semibold">{{ $item['category'] ?? $title }}</span>
                            </div>
                            @if(!empty($item['name']))
                            <h3 class="card-title text-paragraph-medium u-grey-light">{{ $item['name'] }}</h3>
                            @endif
                            <p class="text-paragraph-card u-grey-light m-0">{{ $item['title'] ?? '' }}</p>
                        </div>
                        <div class="card-image card-image-rounded pb-5">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] ?? ($item['title'] ?? '') }}" />
                        </div>
                    </div>
                    <a class="read-more ps-3" href="{{ $item['url'] ?? '#' }}">
                        <span class="text">Vai alla pagina</span>
                        <svg class="icon">
                            <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right') }}"></use>
                        </svg>
                    </a>
                </div>

                @else
                {{-- Card senza immagine (es. Giunta, Consiglio) --}}
                <div class="card card-teaser no-after rounded shadow-sm mb-0 border border-light">
                    <div class="card-body pb-5">
                        <div class="category-top">
                            <span class="title-xsmall-semi-bold fw-semibold">{{ $item['category'] ?? $title }}</span>
                        </div>
                        <h3 class="card-title text-paragraph-medium u-grey-light">{{ $item['title'] ?? '' }}</h3>
                        @if(!empty($item['description']))
                        <p class="text-paragraph-card u-grey-light m-0">{{ $item['description'] }}</p>
                        @endif
                    </div>
                    <a class="read-more" href="{{ $item['url'] ?? '#' }}">
                        <span class="text">Vai alla pagina</span>
                        <svg class="icon ms-0">
                            <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right') }}"></use>
                        </svg>
                    </a>
                </div>
                @endif

                @endforeach
            </div>
        </div>
    </div>
</div>
