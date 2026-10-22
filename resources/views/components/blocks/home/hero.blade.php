{{--
    Hero guest FO — Design Comuni `#head-section.bg-primary` + map-lit (homepage-guest-visual-contract).
    Marketing civico: trust istituzionale (verde ente) + task above-the-fold (segnala / elenco / accedi).
    Vietato charcoal `fc-home-hero`: rompe chrome DC e riduce conversione residenti.
    Schema JSON: eyebrow, heading, intro, primary_*, secondary_*, map_*.
--}}
@props([
    'eyebrow' => '',
    'heading' => '',
    'intro' => '',
    'primary_label' => '',
    'primary_url' => '#',
    'secondary_label' => '',
    'secondary_url' => '#',
    'map_data_url' => '/api/tickets/geojson',
    'map_height' => 'clamp(260px, 38vh, 380px)',
    'map_aria_label' => '',
    'map_caption' => '',
    'map_cta_label' => '',
    'map_cta_url' => '#',
])

@php
    $eyebrow = $eyebrow !== '' ? $eyebrow : (string) __('pub_theme::navigation.site_title');
    $heading = $heading !== '' ? $heading : (string) __('pub_theme::home.hero.title');
    $intro = $intro !== '' ? $intro : (string) __('pub_theme::home.hero.subtitle');
    $primary_label = $primary_label !== '' ? $primary_label : (string) __('pub_theme::home.hero.cta_create');
    $mapAria = $map_aria_label !== '' ? $map_aria_label : (string) __('pub_theme::home.list.map_aria');
    $mapCaption = $map_caption !== '' ? $map_caption : (string) __('pub_theme::home.map.caption');
    $mapCta = $map_cta_label !== '' ? $map_cta_label : (string) __('pub_theme::home.map.cta_list');
    $sprites = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base().'/bootstrap-italia/dist/svg/sprites.svg';
    $localize = static fn (string $path): string => (string) \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL($path);
    $listUrl = $map_cta_url !== '#' && $map_cta_url !== '' ? $map_cta_url : $localize('/tickets');
@endphp

<section id="head-section" class="bg-primary py-4 py-lg-5" aria-labelledby="fc-home-hero-heading">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-12 col-lg-6">
                <p class="title-xsmall-semi-bold text-uppercase mb-2 opacity-75">{{ $eyebrow }}</p>
                <h1 id="fc-home-hero-heading" class="title-xxxlarge mb-3">{{ $heading }}</h1>
                <p class="lead mb-4">{{ $intro }}</p>
                <div class="d-flex flex-column flex-sm-row flex-wrap gap-2 align-items-stretch align-items-sm-center">
                    <a class="btn btn-lg fw-semibold btn-hero-primary" href="{{ $primary_url }}">
                        {{ $primary_label }}
                    </a>
                    <a class="btn btn-lg btn-hero-secondary" href="{{ $listUrl }}">
                        {{ $secondary_label !== '' ? $secondary_label : __('pub_theme::home.map.cta_list') }}
                    </a>
                    @auth
                        <a class="btn btn-lg btn-hero-link px-sm-3" href="{{ $localize('/area-personale/pratiche') }}">
                            {{ __('pub_theme::home.hero.cta_practices') }}
                        </a>
                    @else
                        <a class="btn btn-lg btn-hero-link px-sm-3" href="{{ $localize('/auth/login') }}" data-element="personal-area-login">
                            {{ __('pub_theme::home.hero.cta_login') }}
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-0">
                        <map-lit
                            id="home-ticket-map"
                            data-url="{{ $map_data_url }}"
                            height="{{ $map_height }}"
                            aria-label="{{ $mapAria }}"
                        ></map-lit>
                    </div>
                    <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center flex-wrap gap-2 py-3">
                        <span class="text-secondary small mb-0">{{ $mapCaption }}</span>
                        <a class="read-more" href="{{ $listUrl }}">
                            <span class="text">{{ $mapCta }}</span>
                            <svg class="icon" aria-hidden="true"><use href="{{ $sprites }}#it-arrow-right"></use></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
