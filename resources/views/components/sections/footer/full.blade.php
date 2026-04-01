{{--
|--------------------------------------------------------------------------
| Footer Full - Design Comuni Complete (4 colonne)
|--------------------------------------------------------------------------
|
| Usage:
|   <x-section slug="footer" tpl="full" />
|
| Structure:
|   1. Amministrazione
|   2. Categorie di Servizio
|   3. Novità + Vivere
|   4. Contatti + Social + Legal
|
--}}

@php
    $footerBlock = Arr::first($blocks ?? [], fn($item) => $item->slug == 'footer');
    $data = $footerBlock->data ?? [];
    
    // Default data per Design Comuni
    $brand = $data['brand'] ?? [
        'name' => 'Comune di FixCity',
        'subtitle' => 'Città Metropolitana',
        'description' => 'Sito istituzionale del Comune di FixCity',
    ];
    
    $administration = $data['administration'] ?? [
        'title' => 'Amministrazione',
        'items' => [
            ['label' => 'Organi di governo', 'url' => '/amministrazione/organi'],
            ['label' => 'Aree amministrative', 'url' => '/amministrazione/aree'],
            ['label' => 'Uffici', 'url' => '/uffici'],
            ['label' => 'Enti e fondazioni', 'url' => '/enti'],
            ['label' => 'Politici', 'url' => '/politici'],
            ['label' => 'Personale amministrativo', 'url' => '/personale'],
            ['label' => 'Documenti e dati', 'url' => '/documenti'],
        ]
    ];
    
    $services = $data['services'] ?? [
        'title' => 'Categorie di Servizio',
        'columns' => [
            [
                'items' => [
                    ['label' => 'Anagrafe e stato civile', 'url' => '/servizi/anagrafe'],
                    ['label' => 'Cultura e tempo libero', 'url' => '/servizi/cultura'],
                    ['label' => 'Vita lavorativa', 'url' => '/servizi/lavoro'],
                    ['label' => 'Imprese e commercio', 'url' => '/servizi/imprese'],
                    ['label' => 'Appalti pubblici', 'url' => '/servizi/appalti'],
                    ['label' => 'Catasto e urbanistica', 'url' => '/servizi/catasto'],
                    ['label' => 'Turismo', 'url' => '/servizi/turismo'],
                    ['label' => 'Mobilità e trasporti', 'url' => '/servizi/mobilita'],
                ]
            ],
            [
                'items' => [
                    ['label' => 'Educazione e formazione', 'url' => '/servizi/educazione'],
                    ['label' => 'Giustizia e sicurezza', 'url' => '/servizi/giustizia'],
                    ['label' => 'Tributi e contravvenzioni', 'url' => '/servizi/tributi'],
                    ['label' => 'Ambiente', 'url' => '/servizi/ambiente'],
                    ['label' => 'Salute e assistenza', 'url' => '/servizi/salute'],
                    ['label' => 'Autorizzazioni', 'url' => '/servizi/autorizzazioni'],
                    ['label' => 'Agricoltura e pesca', 'url' => '/servizi/agricoltura'],
                ]
            ]
        ]
    ];
    
    $news = $data['news'] ?? [
        'title' => 'Novità',
        'items' => [
            ['label' => 'Notizie', 'url' => '/novita/notizie'],
            ['label' => 'Comunicati', 'url' => '/novita/comunicati'],
            ['label' => 'Avvisi', 'url' => '/novita/avvisi'],
        ]
    ];
    
    $live = $data['live'] ?? [
        'title' => 'Vivere il Comune',
        'items' => [
            ['label' => 'Luoghi', 'url' => '/vivere/luoghi'],
            ['label' => 'Eventi', 'url' => '/vivere/eventi'],
        ]
    ];
    
    $contact = $data['contact'] ?? [
        'title' => 'Contatti',
        'address' => 'Via Roma, 1',
        'city' => '00100 FixCity (FC)',
        'phone' => '06 1234567',
        'email' => 'info@fixcity.gov.it',
        'pec' => 'comune@pec.fixcity.gov.it',
    ];
    
    $social = $data['social'] ?? [
        'twitter' => '#',
        'facebook' => '#',
        'youtube' => '#',
        'telegram' => '#',
        'whatsapp' => '#',
        'rss' => '#',
    ];
    
    $legal = $data['legal'] ?? [
        'links' => [
            ['label' => 'Amministrazione trasparente', 'url' => '/trasparenza'],
            ['label' => 'Informativa privacy', 'url' => '/privacy'],
            ['label' => 'Note legali', 'url' => '/note-legali'],
            ['label' => 'Dichiarazione di accessibilità', 'url' => '/accessibilita'],
        ],
        'bottom' => [
            ['label' => 'Media policy', 'url' => '/media-policy'],
            ['label' => 'Mappa del sito', 'url' => '/mappa'],
        ],
        'copyright' => 'Comune di FixCity - Tutti i diritti riservati',
        'piva' => '00000000000',
        'cf' => '00000000000',
    ];
@endphp

<footer class="it-footer" role="contentinfo">
    
    {{-- Main Footer (4 columns) --}}
    <div class="it-footer-main bg-dark text-white py-12">
        <div class="container">
            <div class="row g-4">
                
                {{-- Column 1: Brand + Amministrazione --}}
                <div class="col-12 col-lg-3">
                    <div class="it-brand-wrapper mb-4">
                        <a href="/" class="text-white text-decoration-none d-flex align-items-center gap-3">
                            <svg width="82" height="82" class="icon" aria-hidden="true">
                                <image xlink:href="/themes/sixteen/images/stemma-comune.svg"/>
                            </svg>
                            <div class="it-brand-text">
                                <div class="it-brand-title h4 mb-0">{{ $brand['name'] }}</div>
                                <div class="it-brand-tagline small text-white-50">{{ $brand['subtitle'] }}</div>
                            </div>
                        </a>
                    </div>
                    
                    <h4 class="h5 mt-4 mb-3">{{ $administration['title'] }}</h4>
                    <ul class="link-list list-unstyled">
                        @foreach($administration['items'] as $item)
                            <li class="mb-2">
                                <a class="text-white-50 text-decoration-none hover-white transition-colors" href="{{ $item['url'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Column 2: Servizi (2 sub-columns) --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ $services['title'] }}</h4>
                    <div class="row">
                        @foreach($services['columns'] as $column)
                            <div class="col-6">
                                <ul class="link-list list-unstyled">
                                    @foreach($column['items'] as $item)
                                        <li class="mb-2">
                                            <a class="text-white-50 text-decoration-none hover-white transition-colors" href="{{ $item['url'] }}">
                                                {{ $item['label'] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                {{-- Column 3: Novità + Vivere --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ $news['title'] }}</h4>
                    <ul class="link-list list-unstyled mb-4">
                        @foreach($news['items'] as $item)
                            <li class="mb-2">
                                <a class="text-white-50 text-decoration-none hover-white transition-colors" href="{{ $item['url'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <h4 class="h5 mb-3">{{ $live['title'] }}</h4>
                    <ul class="link-list list-unstyled">
                        @foreach($live['items'] as $item)
                            <li class="mb-2">
                                <a class="text-white-50 text-decoration-none hover-white transition-colors" href="{{ $item['url'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Column 4: Contatti + Social + Legal --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">{{ $contact['title'] }}</h4>
                    <address class="mb-4 text-white-50 not-italic">
                        <p class="mb-1"><strong>{{ $brand['name'] }}</strong></p>
                        <p class="mb-1">{{ $contact['address'] }}</p>
                        <p class="mb-1">{{ $contact['city'] }}</p>
                        <p class="mb-1">Tel: {{ $contact['phone'] }}</p>
                        <p class="mb-1">Email: {{ $contact['email'] }}</p>
                        <p class="mb-1">PEC: {{ $contact['pec'] }}</p>
                    </address>
                    
                    <h4 class="h5 mb-3">Link Istituzionali</h4>
                    <ul class="link-list list-unstyled mb-4">
                        @foreach($legal['links'] as $item)
                            <li class="mb-2">
                                <a class="text-white-50 text-decoration-none hover-white transition-colors" href="{{ $item['url'] }}">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    
                    <h4 class="h5 mb-3">Seguici su</h4>
                    <div class="it-socials">
                        <ul class="list-inline d-flex gap-2 mb-0">
                            @if($social['twitter'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['twitter'] }}" class="text-white-50 hover-white transition-colors" aria-label="Twitter">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use></svg>
                                    </a>
                                </li>
                            @endif
                            @if($social['facebook'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['facebook'] }}" class="text-white-50 hover-white transition-colors" aria-label="Facebook">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use></svg>
                                    </a>
                                </li>
                            @endif
                            @if($social['youtube'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['youtube'] }}" class="text-white-50 hover-white transition-colors" aria-label="YouTube">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use></svg>
                                    </a>
                                </li>
                            @endif
                            @if($social['telegram'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['telegram'] }}" class="text-white-50 hover-white transition-colors" aria-label="Telegram">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use></svg>
                                    </a>
                                </li>
                            @endif
                            @if($social['whatsapp'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['whatsapp'] }}" class="text-white-50 hover-white transition-colors" aria-label="Whatsapp">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use></svg>
                                    </a>
                                </li>
                            @endif
                            @if($social['rss'] ?? null)
                                <li class="list-inline-item">
                                    <a href="{{ $social['rss'] }}" class="text-white-50 hover-white transition-colors" aria-label="RSS">
                                        <svg class="icon icon-sm"><use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use></svg>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    {{-- Bottom Bar --}}
    <div class="it-footer-bottom bg-darker text-white py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0 small">
                        &copy; {{ date('Y') }} {{ $brand['name'] }} - {{ $legal['copyright'] }}
                    </p>
                    <p class="mb-0 small">
                        P.IVA: {{ $legal['piva'] }} - Codice Fiscale: {{ $legal['cf'] }}
                    </p>
                </div>
                <div class="col-12 col-md-6 text-center text-md-end">
                    <ul class="list-inline mb-0 small d-flex gap-3 justify-content-center justify-content-md-end">
                        @foreach($legal['bottom'] as $item)
                            <li class="list-inline-item">
                                <a href="{{ $item['url'] }}" class="text-white-50 hover-white text-decoration-none transition-colors">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</footer>

@push('styles')
<style>
/* Footer Styles - Bootstrap Italia compliant */
.it-footer {
    font-family: "Titillium Web", Geneva, Tahoma, sans-serif;
}

.it-footer-main {
    background-color: #17334f !important;
}

.it-footer-main .link-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.it-footer-main .link-list li a {
    color: rgba(255, 255, 255, 0.9);
    transition: color 0.2s;
}

.it-footer-main .link-list li a:hover {
    color: #ffffff;
}

.it-footer-main address {
    font-style: normal;
    line-height: 1.6;
}

.it-socials ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.it-footer-bottom {
    background-color: #0f2338;
    font-size: 0.875rem;
}

.it-footer-bottom a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
}

.it-footer-bottom a:hover {
    color: #ffffff;
}

/* Responsive */
@media (max-width: 768px) {
    .it-footer-main .row > div {
        margin-bottom: 2rem;
    }
}
</style>
@endpush
