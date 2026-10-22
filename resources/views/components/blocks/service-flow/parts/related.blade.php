{{--
    Contenuti correlati (carosello a schede). `related`: title, cards[] {icon, title, links[] (stringhe), more {label, items[]}}.
    Comportamento: dcCarousel (classe `carousel-4-card`: opzioni da aggiungere in resources/js/theme/design-comuni-home.js).
--}}
@php
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="it-carousel-wrapper carousel-4-card splide cmp-carousel" data-bs-carousel-splide>
    <div class="it-header-block">
        <div class="it-header-block-title"><h2 class="text-center border-0 cmp-carousel__title pb-0">{{ data_get($related, 'title') }}</h2></div>
    </div>
    <div class="splide__track">
        <ul class="splide__list it-carousel-all">
            @foreach (data_get($related, 'cards', []) as $card)
                <li class="splide__slide">
                    <div class="card-wrapper card-space h-100 pb-4">
                        <div class="card card-bg single-card rounded shadow-sm">
                            <div class="cmp-carousel__header">
                                <svg class="icon icon-md" aria-hidden="true"><use href="{{ $icon($card['icon'] ?? '') }}"></use></svg>
                                <span class="ms-3 cmp-carousel__header-title">{{ $card['title'] ?? '' }}</span>
                            </div>
                            <div class="card-body">
                                <div class="link-list-wrapper">
                                    <ul class="card-body__list">
                                        @foreach ($card['links'] ?? [] as $link)
                                            <li><a class="list-item px-0" href="#"><span>{{ $link }}</span></a></li>
                                        @endforeach
                                        @if (filled($card['more'] ?? null))
                                            <li>
                                                <a class="show-more px-0" data-bs-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    <span class="show-more d-flex align-items-center">{{ $card['more']['label'] ?? '' }} <svg class="icon icon-primary icon-md"><use href="{{ $icon('it-expand') }}"></use></svg></span></a>
                                                <ul class="collapse" id="collapseExample">
                                                    @foreach ($card['more']['items'] ?? [] as $link)
                                                        <li><a class="list-item px-0" href="#"><span>{{ $link }}</span></a></li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <span class="hr-shadow-sm d-none d-lg-block"></span>
</div>
