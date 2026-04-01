{{--
    Design Comuni - Homepage
    Template: Bootstrap Italia HTML-identical
    Source: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
    Body Length: 1331 righe HTML
--}}

@extends('pub_theme::layouts.bootstrap-italia')

@section('title', 'Il mio Comune')

@section('body_class', 'cmp-homepage-page')

@section('content')

{{-- Skip Links --}}
<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
    <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>

{{-- Header Component --}}
@include('pub_theme::bootstrap-italia.header')

{{-- Main Content --}}
<main>
    <h1 class="visually-hidden" id="main-container">Il mio Comune</h1>
    
    {{-- Hero Section --}}
    <section id="head-section">
        <h2 class="visually-hidden">Contenuti in evidenza</h2>
        <div class="container">
            <div class="row">
                {{-- News Card --}}
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="card mb-5">
                        <div class="card-body pb-5 px-0">
                            <div class="category-top">
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-calendar"></use>
                                </svg>
                                <span class="title-xsmall-semi-bold fw-semibold">Notizie</span>
                                <span class="data fw-normal">18 mag 2026</span>
                            </div>
                            <a href="/it/tests/novita-dettaglio" class="text-decoration-none">
                                <h3 class="card-title">
                                    Parte l'estate con oltre 300 eventi in centro e nei quartieri, tutti gli eventi previsti
                                </h3>
                            </a>
                            <p class="mb-4 pt-3 lora">
                                <strong>Inaugurazione lunedì 2 luglio</strong> con il concerto
                                gratuito in piazza XX Settembre degli Sweet Soul Music Revue. Sul palco 20 musicisti dal tutto il mondo
                            </p>
                            <a class="chip chip-simple" href="/it/tests/novita-dettaglio">
                                <span class="chip-label">Estate in città</span>
                            </a>
                            <a class="read-more pb-3" href="/it/tests/novita">
                                <span class="text">Tutte le novità</span>
                                <svg class="icon">
                                    <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                
                {{-- Hero Image --}}
                <div class="col-lg-6 order-1 order-lg-2 px-0 px-lg-3">
                    <img src="https://picsum.photos/800/600" title="titolo immagine" alt="descrizione immagine" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h2 class="title-xxlarge mb-4">Servizi</h2>
                <div class="row g-4">
                    @foreach($servizi ?? [] as $servizio)
                    <div class="col-sm-6 col-lg-4">
                        <div class="it-grid-item-wrapper it-grid-item-overlay">
                            <a href="{{ $servizio['url'] ?? '#' }}" class="text-decoration-none">
                                <div class="card card-bg card-teaser shadow">
                                    <div class="card-body">
                                        <div class="category-top">
                                            <span class="text">Servizio</span>
                                        </div>
                                        <h3 class="card-title h5">{{ $servizio['nome'] ?? 'Servizio' }}</h3>
                                        <p class="card-text">{{ $servizio['descrizione'] ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-primary" href="/it/tests/servizi">
                        Tutti i servizi
                        <svg class="icon icon-sm">
                            <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Administration Section --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h2 class="title-xxlarge mb-4">Amministrazione</h2>
                <div class="row g-4">
                    @foreach($amministrazione ?? [] as $item)
                    <div class="col-sm-6 col-lg-4">
                        <div class="it-grid-item-wrapper">
                            <a href="{{ $item['url'] ?? '#' }}" class="text-decoration-none">
                                <div class="card card-bg card-teaser shadow">
                                    <div class="card-body">
                                        <h3 class="card-title h5">{{ $item['titolo'] ?? 'Amministrazione' }}</h3>
                                        <p class="card-text">{{ $item['descrizione'] ?? '' }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-primary" href="/it/tests/amministrazione">
                        Tutta l'amministrazione
                        <svg class="icon icon-sm">
                            <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- News Section --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h2 class="title-xxlarge mb-4">Novità</h2>
                <div class="row g-4">
                    @foreach($novita ?? [] as $notizia)
                    <div class="col-sm-6 col-lg-4">
                        <div class="it-grid-item-wrapper">
                            <a href="{{ $notizia['url'] ?? '#' }}" class="text-decoration-none">
                                <div class="card card-bg card-teaser shadow">
                                    <div class="card-body">
                                        <div class="category-top">
                                            <svg class="icon icon-sm" aria-hidden="true">
                                                <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-calendar"></use>
                                            </svg>
                                            <span class="title-xsmall-semi-bold fw-semibold">{{ $notizia['categoria'] ?? 'Notizie' }}</span>
                                            <span class="data fw-normal">{{ $notizia['data'] ?? '' }}</span>
                                        </div>
                                        <h3 class="card-title h5">{{ $notizia['titolo'] ?? 'Notizia' }}</h3>
                                        <p class="card-text">{{ Str::limit($notizia['contenuto'] ?? '', 100) }}</p>
                                        <a class="read-more pb-3" href="{{ $notizia['url'] ?? '#' }}">
                                            <span class="text">Leggi tutto</span>
                                            <svg class="icon">
                                                <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-primary" href="/it/tests/novita">
                        Tutte le novità
                        <svg class="icon icon-sm">
                            <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Events Section (Vivere il Comune) --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h2 class="title-xxlarge mb-4">Vivere il Comune</h2>
                <div class="row g-4">
                    @foreach($eventi ?? [] as $evento)
                    <div class="col-sm-6 col-lg-4">
                        <div class="it-grid-item-wrapper">
                            <a href="{{ $evento['url'] ?? '#' }}" class="text-decoration-none">
                                <div class="card card-bg card-teaser shadow">
                                    <div class="card-body">
                                        <div class="category-top">
                                            <svg class="icon icon-sm" aria-hidden="true">
                                                <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-calendar"></use>
                                            </svg>
                                            <span class="title-xsmall-semi-bold fw-semibold">{{ $evento['categoria'] ?? 'Eventi' }}</span>
                                            <span class="data fw-normal">{{ $evento['data'] ?? '' }}</span>
                                        </div>
                                        <h3 class="card-title h5">{{ $evento['titolo'] ?? 'Evento' }}</h3>
                                        <p class="card-text">{{ Str::limit($evento['descrizione'] ?? '', 100) }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center mt-4">
                    <a class="btn btn-outline-primary" href="/it/tests/eventi">
                        Tutti gli eventi
                        <svg class="icon icon-sm">
                            <use xlink:href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Footer Component --}}
@include('pub_theme::footer-comune')

@endsection

@push('scripts')
{{-- Bootstrap Italia JS --}}
<script src="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/js/themes/Sixteen/design-comuni/assets/bootstrap-italia.bundle.min.js"></script>
@endpush
