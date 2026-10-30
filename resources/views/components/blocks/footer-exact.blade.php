@props(['data' => []])

{{--
    Footer Component - EXACT Design Comuni HTML Structure
    Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/homepage.html
    
    EXACT Structure Required:
    - it-footer
    - it-footer-main
    - footer-items-wrapper (on all columns)
    - logo-wrapper (first column)
    - ue-logo (EU flag)
    - it-brand-wrapper with SVG
    - footer-heading-title
    - footer-list (on all ul)
--}}

@php
    $cityName = $data['city_name'] ?? 'Nome del Comune';
    $ueLogoUrl = $data['ue_logo_url'] ?? asset('themes/sixteen/images/logo-eu-inverted.svg');
    $homeUrl = $data['home_url'] ?? '/it/tests/homepage';
    
    $adminLinks = $data['admin_links'] ?? [
        ['label' => __('pub_theme::footer_blocks.shared.governing_bodies.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.administrative_areas.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.offices.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.shared.bodies_and_foundations.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.shared.politicians.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.administrative_staff.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.documents_and_data.label'), 'url' => '#'],
    ];
    
    $serviceCategories = $data['service_categories'] ?? [
        ['label' => __('pub_theme::footer_blocks.full.registry_office_and_civil_status.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.culture_and_leisure.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.working_life.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.business_and_commerce.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.public_procurement.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.land_registry_and_urban_planning.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.tourism.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.mobility_and_transport.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.education_and_training.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.justice_and_public_safety.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.taxes_finance_and_fines.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.environment.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.health_wellbeing_and_care.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.authorisations.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.agriculture_and_fishing.label'), 'url' => '#'],
    ];
    
    $newsLinks = $data['news_links'] ?? [
        ['label' => __('pub_theme::footer_blocks.shared.news.label'), 'url' => '/it/tests/novita'],
        ['label' => __('pub_theme::footer_blocks.full.announcements.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.full.notices.label'), 'url' => '#'],
    ];
    
    $liveLinks = $data['live_links'] ?? [
        ['label' => __('pub_theme::footer_blocks.full.places.label'), 'url' => '#'],
        ['label' => __('pub_theme::blocks_common.shared.events.label'), 'url' => '/it/tests/eventi'],
    ];
    
    $contactLinks = $data['contact_links'] ?? [
        ['label' => __('pub_theme::blocks_content.services.read_the_faq.label'), 'url' => '/it/tests/domande-frequenti'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.appointment_booking.label'), 'url' => '/it/tests/appuntamento-01-ufficio'],
        ['label' => __('pub_theme::flow_report.shared.service_issue_report.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.assistance_request.label'), 'url' => '/it/tests/assistenza-01-dati'],
    ];
    
    $legalLinks = $data['legal_links'] ?? [
        ['label' => __('pub_theme::footer_blocks.shared.transparent_administration.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.privacy_notice.label'), 'url' => '#'],
        ['label' => __('pub_theme::footer_blocks.footer_exact.legal_notes.label'), 'url' => '#'],
        ['label' => __('pub_theme::auth_pages.register.accessibility_statement.label'), 'url' => '#'],
    ];
    
    $socialLinks = $data['social_links'] ?? [
        ['platform' => 'twitter', 'url' => '#', 'label' => 'Twitter'],
        ['platform' => 'facebook', 'url' => '#', 'label' => 'Facebook'],
        ['platform' => 'youtube', 'url' => '#', 'label' => 'YouTube'],
        ['platform' => 'telegram', 'url' => '#', 'label' => 'Telegram'],
        ['platform' => 'whatsapp', 'url' => '#', 'label' => 'Whatsapp'],
        ['platform' => 'rss', 'url' => '#', 'label' => 'RSS'],
    ];
@endphp

{{-- EXACT Design Comuni footer structure --}}
<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                {{-- Logo and Brand Section --}}
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    {{-- EU Logo - REQUIRED --}}
                    <img class="ue-logo" 
                         src="{{ $ueLogoUrl }}" 
                         alt="{{ __('pub_theme::footer_blocks.footer_exact.european_union_logo.label') }}">
                    
                    {{-- Brand with SVG --}}
                    <div class="it-brand-wrapper">
                        <a href="{{ $homeUrl }}">
                            <svg class="icon" aria-hidden="true">
                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa"></use>
                            </svg>
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ $cityName }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row">
                {{-- Administration Column --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::footer_blocks.shared.administration.label') }}</h4>
                    <ul class="footer-list">
                        @foreach($adminLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Service Categories Column (wider) --}}
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::footer_blocks.shared.service_categories.label') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($serviceCategories, 0, 7) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer-list">
                                @foreach(array_slice($serviceCategories, 7) as $link)
                                <li>
                                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                {{-- News Column --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::blocks_common.shared.news.label') }}</h4>
                    <ul class="footer-list">
                        @foreach($newsLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <div class="row">
                {{-- Live Column --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::footer_blocks.footer_exact.living_in_the_municipality.label') }}</h4>
                    <ul class="footer-list">
                        @foreach($liveLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Contact Column --}}
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::blocks_common.shared.contacts.label') }}</h4>
                    <ul class="footer-list">
                        @foreach($contactLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                
                {{-- Legal Column --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::footer_blocks.shared.transparent_administration.label') }}</h4>
                    <ul class="footer-list">
                        @foreach($legalLinks as $link)
                        <li>
                            <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            {{-- Social Links Section --}}
            <div class="row">
                <div class="col-12 footer-items-wrapper">
                    <div class="it-social-list">
                        <h4 class="footer-heading-title">{{ __('pub_theme::footer_blocks.shared.follow_us_on.label') }}</h4>
                        <ul class="list-inline">
                            @foreach($socialLinks as $social)
                            <li class="list-inline-item">
                                <a href="{{ $social['url'] }}" 
                                   target="_blank"
                                   rel="noopener"
                                   aria-label="{{ __('pub_theme::footer_blocks.footer_exact.external_link.label', ['platform' => $social['platform']]) }}"
                                   title="{{ $social['platform'] }}">
                                    {{ $social['label'] }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
