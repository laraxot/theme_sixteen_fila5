@props(['data' => []])
{{--
    Pagina "Vivere il comune" Design Comuni (riferimento sito/eventi.html): breadcrumb, hero con immagine, due sezioni di card
    (eventi con data a calendario, luoghi) e i partial condivisi rating e contatti. Testi, immagini, card e pulsanti arrivano dal JSON
    (tests.eventi.json); `sections[].style` sceglie lo sfondo (grey = fascia grigia, plain). Le immagini stanno in
    public/design-comuni/assets/images. Stili: resources/css/design-comuni/ (scope body:has(page-content tests.*)).
--}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = asset('themes/Sixteen/design-comuni/assets');
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="container" id="main-container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-breadcrumbs" role="navigation">
                <nav class="breadcrumb-container" aria-label="breadcrumb"><ol class="breadcrumb p-0" data-element="breadcrumb">
                    @foreach ($d('breadcrumb.items', []) as $crumb)
                        <li class="breadcrumb-item"><a href="{{ $crumb['url'] ?? '#' }}">{{ $crumb['label'] ?? '' }}</a><span class="separator">/</span></li>
                    @endforeach
                    <li class="breadcrumb-item active" aria-current="page">{{ $d('breadcrumb.current') }}</li>
                </ol></nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="cmp-hero">
                <section class="it-hero-wrapper bg-white align-items-start">
                    <div class="it-hero-text-wrapper pt-0 ps-0 pb-4 pb-lg-70">
                        <h1 class="text-black" data-element="page-name">{{ $d('title') }}</h1>
                        <div class="hero-text"><p>{{ $d('hero.text') }}</p></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<section class="hero-img mb-20 mb-lg-50">
    <section class="it-hero-wrapper it-hero-small-size cmp-hero-img-small">
        <div class="img-responsive-wrapper">
            <div class="img-responsive">
                <div class="img-wrapper"><img src="{{ $assets }}/images/{{ $d('hero.image.file') }}" title="{{ $d('hero.image.title') }}" alt="{{ $d('hero.image.alt') }}"></div>
            </div>
        </div>
    </section>
    <p class="title-xsmall cmp-hero-img-small__description">{{ $d('hero.caption') }}</p>
</section>
@foreach ($d('sections', []) as $section)
    @if (($section['style'] ?? '') === 'grey')<div class="bg-grey-dsk py-5"> @endif
    <div @class(['container', 'p-3 p-md-5' => ($section['style'] ?? '') !== 'grey'])>
        <h2 class="mb-4">{{ $section['title'] ?? '' }}</h2>
        <div class="row g-4">
            @foreach ($section['items'] ?? [] as $item)
                <div class="col-lg-6 col-xl-4">
                    <div class="card-wrapper border border-light rounded shadow-sm">
                        <div class="card no-after rounded">
                            <div class="img-responsive-wrapper">
                                <div class="img-responsive img-responsive-panoramic"><figure class="img-wrapper">
                                    <img class="" src="{{ $assets }}/images/{{ $item['image']['file'] ?? '' }}" title="{{ $item['image']['title'] ?? '' }}" alt="{{ $item['image']['alt'] ?? '' }}"></figure>
                                    @if (filled($item['calendar'] ?? null))
                                        <div class="card-calendar d-flex flex-column justify-content-center">
                                            <span class="card-date">{{ $item['calendar']['date'] }}</span>
                                            <span class="card-day">{{ $item['calendar']['day'] }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="category-top">
                                    <a class="category text-decoration-none" href="{{ $item['category']['url'] ?? '#' }}">{{ $item['category']['label'] ?? '' }}</a>
                                    @if (filled($item['date'] ?? null))<span class="data">{{ $item['date'] }}</span>@endif
                                </div>
                                <h3 class="card-title"><a href="{{ $item['url'] ?? '' }}" class="text-decoration-none">{{ $item['title'] ?? '' }}</a></h3>
                                <p class="card-text text-secondary pb-3">{{ $item['text'] ?? '' }}</p>
                                <a class="read-more t-primary text-uppercase" href="{{ $item['read_more_url'] ?? '#' }}" aria-label="{{ sprintf($d('card.read_more_aria'), $item['title'] ?? '') }}">
                                    <span class="text">{{ $d('card.read_more') }}</span>
                                    <span class="visually-hidden">{{ $d('card.read_more_hidden') }}</span><svg class="icon icon-inverse icon-xs ml-10"><use href="{{ $icon('it-arrow-right') }}"></use></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-end">
                <a href="{{ $section['button']['url'] ?? '#' }}" class="btn btn-outline-primary full-mb" data-element="{{ $section['button']['element'] ?? '' }}"> {{ $section['button']['label'] ?? '' }} <svg class="icon icon-primary icon-xs ml-10"><use href="{{ $icon('it-arrow-right') }}"></use></svg></a>
            </div>
        </div>
    </div>
    @if (($section['style'] ?? '') === 'grey')</div> @endif
@endforeach
@include('pub_theme::components.blocks.partials.dc-rating', ['data' => $data])
@include('pub_theme::components.blocks.partials.dc-contacts', ['data' => $data])
