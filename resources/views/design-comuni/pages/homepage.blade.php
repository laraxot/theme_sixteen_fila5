{{--
    Design Comuni - Homepage (TailwindCSS)
    Source: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
    Converted: Bootstrap Italia (HTML-identical) → Tailwind CSS + Alpine.js + inline SVG icons
 --}}

@extends('pub_theme::layouts.base')

@section('title', 'Il mio Comune')

@section('body_class', 'cmp-homepage-page')

@section('content')

{{-- Skip Links --}}
<div class="skiplink">
    <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
    <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
</div>

<main>
    <h1 class="visually-hidden" id="main-container">Il mio Comune</h1>

    {{-- Hero Section --}}
    <section id="head-section" class="py-6">
        <h2 class="visually-hidden">Contenuti in evidenza</h2>
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12 lg:items-start">
                {{-- News Card --}}
                <div class="lg:col-span-6 lg:col-start-1 lg:order-2 lg:order-1">
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6 pb-5">
                            <div class="mb-3 flex items-center gap-2">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-calendar', 'class' => 'h-5 w-5 text-emerald-600'])
                                <span class="text-xs font-semibold uppercase text-slate-500">Notizie</span>
                                <span class="text-sm text-slate-500">18 mag 2026</span>
                            </div>
                            <a href="/it/tests/novita-dettaglio" class="text-decoration-none">
                                <h3 class="mb-3 text-xl font-semibold text-slate-900">
                                    Parte l'estate con oltre 300 eventi in centro e nei quartieri, tutti gli eventi previsti
                                </h3>
                            </a>
                            <p class="mb-4 text-slate-700">
                                <strong>Inaugurazione lunedì 2 luglio</strong> con il concerto
                                gratuito in piazza XX Settembre degli Sweet Soul Music Revue. Sul palco 20 musicisti dal tutto il mondo
                            </p>
                            <a class="chip chip-simple chip-green" href="/it/tests/novita-dettaglio">
                                <span class="chip-label">Estate in città</span>
                            </a>
                            <a class="read-more read-more-green pb-3" href="/it/tests/novita">
                                <span class="text">Tutte le novità</span>
                                @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-5 w-5'])
                            </a>
                        </div>
                    </article>
                </div>

                {{-- Hero Image --}}
                <div class="lg:col-span-6 lg:col-start-7 lg:order-1 lg:order-2 px-0 lg:px-0">
                    <img src="https://picsum.photos/800/600" title="titolo immagine" alt="descrizione immagine" class="w-full max-w-full rounded-lg shadow">
                </div>
            </div>
        </div>
    </section>

    {{-- Calendario / Governance Cards --}}
    @php
        $calendarioData = [
            'cards' => [
                [
                    'category' => 'Organi di governo',
                    'title' => 'Mario Rossi',
                    'role' => 'Il Sindaco della città',
                    'image' => 'https://picsum.photos/150/200',
                    'url' => '/it/tests/amministrazione#sindaco',
                ],
                [
                    'category' => 'Organi di governo',
                    'title' => 'La giunta comunale',
                    'description' => 'La giunta, nominata dal sindaco, esercita collegialmente le funzioni ad essa attribuite dalla legge.',
                    'url' => '/it/tests/amministrazione#giunta',
                ],
                [
                    'category' => 'Organi di governo',
                    'title' => 'Il consiglio comunale',
                    'description' => 'Il Consiglio è un organo collegiale ed elettivo che rimane in carica per 5 anni.',
                    'url' => '/it/tests/amministrazione#consiglio',
                ],
            ],
            'month' => 'LUGLIO 2026',
            'slides' => [
                ['day' => '1', 'weekday' => 'Lunedì', 'events' => [
                    ['title' => 'Estate in città - Inaugurazione', 'url' => '/it/tests/eventi/estate-citta'],
                ]],
                ['day' => '5', 'weekday' => 'Venerdì', 'events' => [
                    ['title' => 'Concerto in piazza', 'url' => '/it/tests/eventi/concerto', 'image' => 'https://picsum.photos/60/60'],
                ]],
                ['day' => '10', 'weekday' => 'Mercoledì', 'events' => [
                    ['title' => 'Mostra d\'arte moderna', 'url' => '/it/tests/eventi/mostra', 'image' => 'https://picsum.photos/60/61'],
                    ['title' => 'Incontro con l\'autore', 'url' => '/it/tests/eventi/incontro'],
                ]],
                ['day' => '15', 'weekday' => 'Lunedì', 'events' => [
                    ['title' => 'Festa di quartiere', 'url' => '/it/tests/eventi/festa'],
                ]],
                ['day' => '20', 'weekday' => 'Sabato', 'events' => [
                    ['title' => 'Mercato dell\'usato', 'url' => '/it/tests/eventi/mercato'],
                    ['title' => 'Laboratorio bambini', 'url' => '/it/tests/eventi/laboratorio'],
                ]],
                ['day' => '25', 'weekday' => 'Giovedì', 'events' => [
                    ['title' => 'Cinema all\'aperto', 'url' => '/it/tests/eventi/cinema', 'image' => 'https://picsum.photos/60/62'],
                ]],
                ['day' => '30', 'weekday' => 'Martedì', 'events' => [
                    ['title' => 'Torneo di scacchi', 'url' => '/it/tests/eventi/scacchi'],
                ]],
            ],
        ];
    @endphp

    <x-blocks.governance.cards :data="$calendarioData" />

    {{-- Services Section --}}
    <section class="py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.services') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($servizi ?? [] as $servizio)
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <div class="mb-2">
                                <span class="text-sm text-slate-500">Servizio</span>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $servizio['nome'] ?? 'Servizio' }}</h3>
                            <p class="mb-0 text-sm text-slate-600">{{ $servizio['descrizione'] ?? '' }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-outline-primary" href="/it/tests/servizi">
                    Tutti i servizi
                    @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4 ml-1'])
                </a>
            </div>
        </div>
    </section>

    {{-- Administration Section --}}
    <section class="bg-slate-50 py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.administration') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($amministrazione ?? [] as $item)
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $item['titolo'] ?? 'Amministrazione' }}</h3>
                            <p class="mb-0 text-sm text-slate-600">{{ $item['descrizione'] ?? '' }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-outline-primary" href="/it/tests/amministrazione">
                    Tutta l'amministrazione
                    @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4 ml-1'])
                </a>
            </div>
        </div>
    </section>

    {{-- News Section --}}
    <section class="py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.news') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($novita ?? [] as $notizia)
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <div class="mb-3 flex items-center gap-2">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-calendar', 'class' => 'h-4 w-4 text-emerald-600'])
                                <span class="text-xs font-semibold uppercase text-slate-500">{{ $notizia['categoria'] ?? 'Notizie' }}</span>
                                <span class="text-sm text-slate-500">{{ $notizia['data'] ?? '' }}</span>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $notizia['titolo'] ?? 'Notizia' }}</h3>
                            <p class="mb-3 text-sm text-slate-600">{{ Str::limit($notizia['contenuto'] ?? '', 100) }}</p>
                            <a class="read-more" href="{{ $notizia['url'] ?? '#' }}">
                                <span class="text">Leggi tutto</span>
                                @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4'])
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-outline-primary" href="/it/tests/novita">
                    Tutte le novità
                    @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4 ml-1'])
                </a>
            </div>
        </div>
    </section>

    {{-- Events Section (Vivere il Comune) --}}
    <section class="bg-slate-50 py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.live_the_town') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($eventi ?? [] as $evento)
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <div class="mb-3 flex items-center gap-2">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-calendar', 'class' => 'h-4 w-4 text-emerald-600'])
                                <span class="text-xs font-semibold uppercase text-slate-500">{{ $evento['categoria'] ?? 'Eventi' }}</span>
                                <span class="text-sm text-slate-500">{{ $evento['data'] ?? '' }}</span>
                            </div>
                            <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $evento['titolo'] ?? 'Evento' }}</h3>
                            <p class="mb-0 text-sm text-slate-600">{{ Str::limit($evento['descrizione'] ?? '', 100) }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-5 text-center">
                <a class="btn btn-outline-primary" href="/it/tests/eventi">
                    Tutti gli eventi
                    @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4 ml-1'])
                </a>
            </div>
        </div>
    </section>

    {{-- Argomenti in Evidenza Section --}}
    <section class="py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.featured_topics') }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $featuredTopics = [
                        [
                            'title' => 'Trasporto pubblico',
                            'description' => 'Informazioni sui servizi di trasporto pubblico e servizi taxi',
                            'url' => '#',
                            'image' => 'https://picsum.photos/200/200',
                        ],
                        [
                            'title' => 'Animale domestico',
                            'description' => 'Informazioni sui servizi e le norme previste dal comune per gli animali domestici.',
                            'url' => '#',
                            'links' => [
                                'Come adottare un cane al Canile Municipale',
                                'Elenco delle aree per cani',
                                'Come segnalare una colonia felina',
                                'Come segnalare lo smarrimento del proprio animale',
                            ],
                        ],
                        [
                            'title' => 'Sport',
                            'description' => 'Tutto quello che c\'è da sapere sulle strutture sportive comunali.',
                            'url' => '#',
                            'links' => [
                                'Tutte le strutture sportive della città',
                                'Da lunedì 3 settembre chiudono le vasche della piscina comunale',
                                'Concessione di contributi ad enti, associazioni, società sportive',
                            ],
                        ],
                    ];
                @endphp
                @foreach($featuredTopics as $topic)
                    <article class="overflow-hidden rounded-lg bg-white shadow">
                        <div class="p-6">
                            <h3 class="mb-2 text-lg font-semibold text-slate-900">{{ $topic['title'] }}</h3>
                            <p class="mb-3 text-sm text-slate-600">{{ $topic['description'] }}</p>
                            @if(isset($topic['links']))
                                <ul class="mb-3 list-disc list-inside space-y-1 text-sm text-slate-600">
                                    @foreach($topic['links'] as $link)
                                        <li><a href="{{ $topic['url'] }}" class="text-emerald-700 hover:text-emerald-800">{{ $link }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ $topic['url'] }}" class="read-more">
                                <span class="text">Esplora argomento</span>
                                @include('pub_theme::components.ui.icon', ['name' => 'it-arrow-right', 'class' => 'h-4 w-4'])
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Altri Argomenti Section --}}
    <section class="bg-slate-50 py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.other_topics') }}</h2>
            <div class="flex flex-wrap gap-2">
                <a href="#" class="chip chip-simple"><span class="chip-label">Associazioni</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Concorsi</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Energie rinnovabili</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Gestione rifiuti</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Imposte</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Istruzione</span></a>
                <a href="#" class="chip chip-simple"><span class="chip-label">Pista ciclabile</span></a>
            </div>
            <a class="btn btn-outline-primary mt-4" href="#">{{ __('navigation.homepage.show_all') }}</a>
        </div>
    </section>

    {{-- Siti Tematici Section --}}
    @php
        $thematicSites = [
            'title' => __('navigation.homepage.thematic_sites'),
            'sites' => [
                [
                    'title' => 'Mobilità in Comune',
                    'description' => 'Il sito del turismo del Comune e della Città Metropolitana',
                    'url' => '#',
                    'image' => 'https://picsum.photos/200/200',
                ],
                [
                    'title' => 'Turismo',
                    'description' => 'Il sito che offre informazioni sulle attività turistiche attive in città',
                    'url' => '#',
                    'image' => 'https://picsum.photos/200/201',
                ],
                [
                    'title' => 'Musei Civici',
                    'description' => 'Tutte le informazioni sui musei e gli eventi culturali della città',
                    'url' => '#',
                    'image' => 'https://picsum.photos/200/202',
                ],
            ],
        ];
    @endphp
    <section class="py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ $thematicSites['title'] }}</h2>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($thematicSites['sites'] as $site)
                    <a href="{{ $site['url'] }}" class="group block text-decoration-none">
                        <article class="overflow-hidden rounded-lg bg-white shadow transition-shadow duration-200 group-hover:shadow-md">
                            <img src="{{ $site['image'] }}" alt="{{ $site['title'] }}" class="h-48 w-full object-cover">
                            <div class="p-6">
                                <h3 class="mb-2 text-lg font-semibold text-slate-900 group-hover:text-emerald-700">{{ $site['title'] }}</h3>
                                <p class="mb-0 text-sm text-slate-600">{{ $site['description'] }}</p>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Useful Links Section --}}
    <section class="bg-slate-50 py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.useful_links') }}</h2>
            <ul class="list-none space-y-3 text-lg">
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Rilascio Carta Identità Elettronica (CIE)</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Cambio di residenza</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Tributi online</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Prenotazione appuntamenti</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Rilascio tessera elettorale</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Voucher connettività</a></li>
            </ul>
        </div>
    </section>

    {{-- Rating Section --}}
    <x-blocks.rating.default />

    {{-- Contacts Section --}}
    <section class="bg-slate-100 py-5 shadow-contacts">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl">
                <div class="rounded-lg bg-white p-6 shadow">
                    <h2 class="mb-0 text-2xl font-bold">{{ __('navigation.homepage.contacts') }}</h2>
                    <div class="mt-4 flex flex-col gap-3">
                        <a href="tel:+390512345678" class="flex items-center gap-2 text-slate-700 hover:text-emerald-700">
                            @include('pub_theme::components.ui.icon', ['name' => 'it-phone', 'class' => 'h-5 w-5 text-emerald-600'])
                            <span>05 12345678</span>
                        </a>
                        <a href="mailto:urp@comune.it" class="flex items-center gap-2 text-slate-700 hover:text-emerald-700">
                            @include('pub_theme::components.ui.icon', ['name' => 'it-mail', 'class' => 'h-5 w-5 text-emerald-600'])
                            <span>urp@comune.it</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Maybe You Were Looking For --}}
    <section class="py-5">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h2 class="mb-5 text-3xl font-bold">{{ __('navigation.homepage.maybe_searching') }}</h2>
            <ul class="list-none space-y-3 text-lg">
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Rilascio Carta Identità Elettronica (CIE)</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Cambio di residenza</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Tributi online</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Prenotazione appuntamenti</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Rilascio tessera elettorale</a></li>
                <li><a href="#" class="text-emerald-700 hover:text-emerald-800">Voucher connettività</a></li>
            </ul>
        </div>
    </section>
</main>

@include('pub_theme::footer-comune')

@endsection
