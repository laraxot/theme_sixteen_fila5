{{--
    Cards Grid Block
    Usage: <x-blocks.cards.grid :cards="$data['cards']" :title="$data['title']" />
--}}

@props(['cards' => [], 'title' => ''])

<section class="cmp-cards-grid mb-8">
    @if($title)
    <h2 class="title-xlarge mb-4">{{ $title }}</h2>
    @endif

    <div class="row g-4">
        @foreach($cards as $card)
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card-wrapper card-space">
                <div class="card card-bg card-teaser shadow">
                    <div class="card-body">
                        @if(isset($card['title']))
                        <h3 class="card-title h5">
                            <a href="{{ $card['url'] ?? '#' }}" class="text-decoration-none">
                                {{ $card['title'] }}
                            </a>
                        </h3>
                        @endif
                        @if(isset($card['description']))
                        <p class="card-text">{{ $card['description'] }}</p>
                        @endif
                        @if(isset($card['url']))
                        <a href="{{ $card['url'] }}" class="read-more">
                            <span class="text">Leggi di più</span>
                            <svg class="icon icon-primary icon-xs" aria-hidden="true">
                                <use xlink:href="{{ asset('themes/sixteen/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right') }}"></use>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
