<footer class="it-footer" role="contentinfo">
    {{-- EU Logo Section --}}
    <div class="it-footer-small-helper py-4 py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <img class="ue-logo" src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-eu-inverted.svg') }}" alt="logo Unione Europea" style="height: 60px;">
                </div>
            </div>
        </div>
    </div>
    
    {{-- Brand Section --}}
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-brand-wrapper py-4">
                        <a href="{{ url('/'.app()->getLocale()) }}" title="Vai alla homepage">
                            <svg width="82" height="82" class="icon" aria-hidden="true">
                                <image xlink:href="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-comune.svg') }}"/>
                            </svg>
                            <div class="it-brand-text">
                                <div class="it-brand-title">{{ config('app.name', 'Il mio Comune') }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Top Section: Main Footer --}}
    <div class="it-footer-main">
        <div class="container">
            <div class="row g-4">
                {{-- Column 1: Administration --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">Amministrazione</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Organi di governo</a></li>
                        <li><a href="#" class="text-decoration-none">Aree amministrative</a></li>
                        <li><a href="#" class="text-decoration-none">Uffici</a></li>
                        <li><a href="#" class="text-decoration-none">Enti e fondazioni</a></li>
                        <li><a href="#" class="text-decoration-none">Politici</a></li>
                        <li><a href="#" class="text-decoration-none">Personale amministrativo</a></li>
                        <li><a href="#" class="text-decoration-none">Documenti e dati</a></li>
                    </ul>
                </div>
                
                {{-- Column 2: Service Categories --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">Categorie di Servizio</h4>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">Anagrafe</a></li>
                                <li><a href="#" class="text-decoration-none">Cultura</a></li>
                                <li><a href="#" class="text-decoration-none">Vita lavorativa</a></li>
                                <li><a href="#" class="text-decoration-none">Imprese</a></li>
                                <li><a href="#" class="text-decoration-none">Appalti</a></li>
                                <li><a href="#" class="text-decoration-none">Catasto</a></li>
                                <li><a href="#" class="text-decoration-none">Turismo</a></li>
                                <li><a href="#" class="text-decoration-none">Mobilità</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li><a href="#" class="text-decoration-none">Educazione</a></li>
                                <li><a href="#" class="text-decoration-none">Giustizia</a></li>
                                <li><a href="#" class="text-decoration-none">Tributi</a></li>
                                <li><a href="#" class="text-decoration-none">Ambiente</a></li>
                                <li><a href="#" class="text-decoration-none">Salute</a></li>
                                <li><a href="#" class="text-decoration-none">Autorizzazioni</a></li>
                                <li><a href="#" class="text-decoration-none">Agricoltura</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- Column 3: News & Live --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">Novità</h4>
                    <ul class="list-unstyled mb-4">
                        <li><a href="#" class="text-decoration-none">Notizie</a></li>
                        <li><a href="#" class="text-decoration-none">Comunicati</a></li>
                        <li><a href="#" class="text-decoration-none">Avvisi</a></li>
                    </ul>
                    
                    <h4 class="h5 mb-3">Vivere il Comune</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none">Luoghi</a></li>
                        <li><a href="#" class="text-decoration-none">Eventi</a></li>
                    </ul>
                </div>
                
                {{-- Column 4: Contacts --}}
                <div class="col-12 col-lg-3">
                    <h4 class="h5 mb-3">Contatti</h4>
                    <address class="text-muted">
                        <p><strong>Comune di Nome Comune</strong></p>
                        <p>Via Roma 123, 00100 Nome Comune (RM)</p>
                        <p>CF: 00000000000 - P.IVA: 00000000000</p>
                    </address>
                    
                    <h5 class="h6 mb-2 mt-3">URP - Ufficio Relazioni con il Pubblico</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="tel:061234567" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-phone" class="icon icon-sm inline me-1" aria-hidden="true" />
                                Numero verde: 06 1234567
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="icon icon-sm inline me-1" aria-hidden="true" />
                                SMS/WhatsApp: +39 333 0000000
                            </a>
                        </li>
                        <li>
                            <a href="mailto:urp@comune.it" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-envelope" class="icon icon-sm inline me-1" aria-hidden="true" />
                                urp@comune.it
                            </a>
                        </li>
                        <li>
                            <a href="mailto:comune@pec.it" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-shield-check" class="icon icon-sm inline me-1" aria-hidden="true" />
                                comune@pec.it
                            </a>
                        </li>
                        <li>
                            <a href="tel:0612345678" class="text-decoration-none">
                                <x-filament::icon icon="heroicon-o-phone" class="icon icon-sm inline me-1" aria-hidden="true" />
                                Centralino: 06 12345678
                            </a>
                        </li>
                    </ul>
                    
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">FAQ</a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">Appuntamento</a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2">Segnalazione</a>
                        <a href="#" class="btn btn-outline-primary btn-sm">Assistenza</a>
                    </div>
                </div>
            </div>
            
@if(config('comune.adsense.footer_enabled', true))
    <div class="it-footer-sponsor-ad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="ad-slot ad-slot-desk d-none d-lg-block">
                        <span class="ad-label">{{ config('comune.adsense.labels.desk', 'Spazio in vendita - Desktop') }}</span>
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:728px;height:90px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_desk', 'footer-sponsor-desk') }}"></ins>
                    </div>
                    <div class="ad-slot ad-slot-tablet d-none d-md-block d-lg-none">
                        <span class="ad-label">{{ config('comune.adsense.labels.tablet', 'Spazio in vendita - Tablet') }}</span>
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:468px;height:60px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_tablet', 'footer-sponsor-tablet') }}"></ins>
                    </div>
                    <div class="ad-slot ad-slot-mobile d-block d-md-none">
                        <span class="ad-label">{{ config('comune.adsense.labels.mobile', 'Spazio in vendita - Mobile') }}</span>
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:320px;height:50px"
                             data-ad-client="{{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
                             data-ad-slot="{{ config('comune.adsense.slots.spazio_in_vendita_mobile', 'footer-sponsor-mobile') }}"></ins>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(config('comune.sponsor.area_enabled', true))
    <div class="row sponsor-section mt-5 pt-4 border-top">
        <div class="col-12">
            <h4 class="h5 mb-3 text-center">{{ config('comune.sponsor.area_title', 'Partner e Sostenitori') }}</h4>
            <div class="mb-3 text-center">
                <p class="text-muted small">{{ config('comune.sponsor.area_description', 'Grazie ai nostri partner e sostenitori che rendono possibile questo servizio.')}}</p>
            </div>
            <div class="sponsor-logos d-flex flex-wrap justify-content-center gap-3 mb-4">
                @php
                    $maxLogos = config('comune.sponsor.logos_max', 8);
                    $logos = array_filter(config('comune.sponsor.logos', []));
                @endphp
                @foreach($logos as $logoKey => $logoUrl)
                    @if($logoUrl && $loop->iteration <= $maxLogos)
                        <div class="sponsor-logo-item bg-light p-3 rounded border" style="width: {{ 100 / min($maxLogos, count($logos)) }}%; max-width: 150px;">
                            <img src="{{ $logoUrl }}" alt="Logo partner {{ $logoKey }}" class="img-fluid" loading="lazy">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="sponsor-disclosure text-muted small text-center">
                <p><em>I partner e sostenitori supportano questo servizio pubblico in modo trasparente, senza tracking commerciale o privilegi speciali.</em></p>
            </div>
        </div>
    </div>
    @endif

    {{-- AdSense Script --}}
    @if(config('comune.adsense.footer_enabled', true))
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('comune.adsense.client_id', 'ca-pub-XXXXXXXX') }}"
            crossorigin="anonymous"></script>
    @endif
        </div>
    </div>
    
    {{-- Bottom Section --}}
    <div class="it-footer-bottom">
        <div class="container">
            <div class="row align-items-center py-3">
                {{-- Legal Links --}}
                <div class="col-12 col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Amministrazione trasparente</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Informativa privacy</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Note legali</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Dichiarazione di accessibilità</a>
                        </li>
                    </ul>
                </div>
                
                {{-- Social Media --}}
                <div class="col-12 col-md-6 text-center text-md-end">
                    <span class="me-2">Seguici su</span>
                    <a href="#" class="text-decoration-none me-2" aria-label="Twitter">
                        <x-filament::icon icon="ui-brands.twitter" class="icon icon-sm" aria-hidden="true" />
                    </a>
                    <a href="#" class="text-decoration-none me-2" aria-label="Facebook">
                        <x-filament::icon icon="ui-brands.facebook" class="icon icon-sm" aria-hidden="true" />
                    </a>
                    <a href="#" class="text-decoration-none me-2" aria-label="YouTube">
                        <x-filament::icon icon="ui-brands.youtube" class="icon icon-sm" aria-hidden="true" />
                    </a>
                    <a href="#" class="text-decoration-none me-2" aria-label="Telegram">
                        <x-filament::icon icon="ui-brands.telegram" class="icon icon-sm" aria-hidden="true" />
                    </a>
                    <a href="#" class="text-decoration-none me-2" aria-label="Whatsapp">
                        <x-filament::icon icon="ui-brands.whatsapp" class="icon icon-sm" aria-hidden="true" />
                    </a>
                    <a href="#" class="text-decoration-none" aria-label="RSS">
                        <x-filament::icon icon="ui-brands.rss" class="icon icon-sm" aria-hidden="true" />
                    </a>
                </div>
            </div>
            
            {{-- Bottom Links --}}
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Media policy</a>
                        </li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item">
                            <a href="#" class="text-decoration-none">Mappa del sito</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
