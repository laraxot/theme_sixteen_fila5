{{--
    Bootstrap Italia Full Footer
    Source: https://italia.github.io/design-comuni-pagine-statiche/sito/argomenti.html
    
    Usage:
    <x-section slug="footer" />
--}}

@props([
    'ueLogoUrl' => '/themes/sixteen/bootstrap-italia/dist/images/logo-eu-inverted.svg',
    'title' => 'Nome del Comune',
    'address' => 'Via Roma 123 - 00100 Comune',
    'fiscalCode' => '00123456789',
    'phone' => '012 3456',
    'greenNumber' => '800 016 123',
    'whatsapp' => '+39 320 1234567',
    'email' => 'urp@comune.it',
    'adminLinks' => [
        ['label' => 'Organi di governo', 'url' => '#'],
        ['label' => 'Aree amministrative', 'url' => '#'],
        ['label' => 'Uffici', 'url' => '#'],
        ['label' => 'Enti e fondazioni', 'url' => '#'],
        ['label' => 'Politici', 'url' => '#'],
        ['label' => 'Personale amministrativo', 'url' => '#'],
        ['label' => 'Documenti e dati', 'url' => '#'],
    ],
    'serviceCategories' => [
        ['label' => 'Anagrafe e stato civile', 'url' => '#'],
        ['label' => 'Cultura e tempo libero', 'url' => '#'],
        ['label' => 'Vita lavorativa', 'url' => '#'],
        ['label' => 'Imprese e commercio', 'url' => '#'],
        ['label' => 'Appalti pubblici', 'url' => '#'],
        ['label' => 'Catasto e urbanistica', 'url' => '#'],
        ['label' => 'Turismo', 'url' => '#'],
        ['label' => 'Mobilità e trasporti', 'url' => '#'],
        ['label' => 'Educazione e formazione', 'url' => '#'],
        ['label' => 'Giustizia e sicurezza pubblica', 'url' => '#'],
        ['label' => 'Tributi, finanze e contravvenzioni', 'url' => '#'],
        ['label' => 'Ambiente', 'url' => '#'],
        ['label' => 'Salute, benessere e assistenza', 'url' => '#'],
        ['label' => 'Autorizzazioni', 'url' => '#'],
        ['label' => 'Agricoltura e pesca', 'url' => '#'],
    ],
    'newsLinks' => [
        ['label' => 'Notizie', 'url' => '/it/tests/novita'],
        ['label' => 'Comunicati', 'url' => '#'],
        ['label' => 'Avvisi', 'url' => '#'],
    ],
    'liveLinks' => [
        ['label' => 'Luoghi', 'url' => '#'],
        ['label' => 'Eventi', 'url' => '/it/tests/eventi'],
    ],
    'contactLinks' => [
        ['label' => 'Leggi le FAQ', 'url' => '/it/tests/domande-frequenti'],
        ['label' => 'Prenotazione appuntamento', 'url' => '/it/tests/appuntamento-01-ufficio'],
        ['label' => 'Segnalazione disservizio', 'url' => '#'],
        ['label' => 'Richiesta d\'assistenza', 'url' => '/it/tests/assistenza-01-dati'],
    ],
    'legalLinks' => [
        ['label' => 'Amministrazione trasparente', 'url' => '#'],
        ['label' => 'Informativa privacy', 'url' => '#'],
        ['label' => 'Note legali', 'url' => '#'],
        ['label' => 'Dichiarazione di accessibilità', 'url' => '#'],
    ],
    'socialLinks' => [
        ['platform' => 'twitter', 'url' => '#', 'icon' => 'twitter'],
        ['platform' => 'facebook', 'url' => '#', 'icon' => 'facebook'],
        ['platform' => 'youtube', 'url' => '#', 'icon' => 'youtube'],
        ['platform' => 'telegram', 'url' => '#', 'icon' => 'telegram'],
        ['platform' => 'whatsapp', 'url' => '#', 'icon' => 'whatsapp'],
        ['platform' => 'rss', 'url' => '#', 'icon' => 'rss'],
    ]
])

<footer class="it-footer" id="footer">
    {{-- Main Footer --}}
    <div class="it-footer-main">
        <div class="container">
            {{-- Row 1: UE Logo + Brand --}}
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    <img class="ue-logo" src="{{ $ueLogoUrl }}" alt="logo Unione Europea">
                    <div class="it-brand-wrapper">
                        <a href="/it/tests/homepage">
                            <x-filament::icon
                                icon="heroicon-o-building-office-2"
                                class="w-20 h-20"
                            />
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ $title }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Row 2: Footer Columns --}}
            <div class="row">
                {{-- Column 1: Amministrazione --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">Amministrazione</h4>
                    <ul class="footer-list">
                        @foreach($adminLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Column 2: Categorie di servizio --}}
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">Categorie di servizio</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($serviceCategories, 0, 8) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($serviceCategories, 8) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Column 3: Novità + Vivere --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">Novità</h4>
                    <ul class="footer-list">
                        @foreach($newsLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                    <h4 class="footer-heading-title">Vivere il comune</h4>
                    <ul class="footer-list">
                        @foreach($liveLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Row 3: Contatti --}}
                <div class="col-md-9 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">Contatti</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="footer-info">
                                {{ $title }}<br>
                                {{ $address }}<br>
                                Codice fiscale / P. IVA: {{ $fiscalCode }}<br><br>
                                <a href="#">Ufficio Relazioni con il Pubblico</a><br>
                                Numero verde: {{ $greenNumber }}<br>
                                SMS e WhatsApp: {{ $whatsapp }}<br>
                                Posta Elettronica Certificata<br>
                                Centralino unico: {{ $phone }}
                            </p>
                        </div>
                        <div class="col-md-4">
                            <ul class="footer-list">
                                @foreach($contactLinks as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="footer-list">
                                @foreach($legalLinks as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Social - Using Filament icon component --}}
                <div class="col-md-3 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">Seguici su</h4>
                    <ul class="list-inline text-start social">
                        @foreach($socialLinks as $social)
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="{{ $social['url'] }}" target="_blank">
                                <x-filament::icon
                                    :icon="'brands.' . $social['icon']"
                                    class="icon icon-sm icon-white align-top"
                                />
                                <span class="visually-hidden">{{ ucfirst($social['platform']) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Secondary --}}
    <div class="it-footer-secondary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-footer-small-prints clearfix">
                        <div class="it-footer-small-prints-right">
                            <p class="footer-info">
                                &copy; {{ date('Y') }} {{ $title }} - Tutti i diritti riservati<br>
                                P.IVA: {{ $fiscalCode }} - Codice Fiscale: {{ $fiscalCode }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
