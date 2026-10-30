@props(['municipality' => '', 'address' => '', 'vat' => '', 'phone' => '', 'social' => [], 'links' => []])

{{-- Footer Top - Bootstrap Italia Style --}}
<div class="footer-top py-8 border-top">
    <div class="container">
        <div class="row g-4">
            {{-- Contatta il Comune --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h3 class="h6 text-uppercase mb-3">{{ __('pub_theme::blocks_common.shared.contact_the_municipality.label') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.read_the_frequently_asked_questions.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.request_assistance.label') }}</a></li>
                    <li class="mb-2"><a href="tel:{{ $phone }}" class="text-decoration-none">{{ __('pub_theme::footer_blocks.full.call_toll_free.label', ['phone' => $phone]) }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.book_an_appointment.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Problemi in città --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h3 class="h6 text-uppercase mb-3">{{ __('pub_theme::blocks_common.shared.problems_in_the_city.label') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.report_a_service_issue.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Cerca --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h3 class="h6 text-uppercase mb-3">{{ __('pub_theme::blocks_common.shared.search.label') }}</h3>
                <form action="#" method="get">
                    <div class="mb-2">
                        <label for="footer-search" class="visually-hidden">{{ __('pub_theme::blocks_common.shared.search_the_site.label') }}</label>
                        <input type="text" class="form-control" id="footer-search" placeholder="{{ __('pub_theme::blocks_common.shared.search_the_site.label') }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('pub_theme::blocks_common.shared.search.label') }}</button>
                </form>
            </div>
            
            {{-- Forse stavi cercando --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h3 class="h6 text-uppercase mb-3">{{ __('fixcity::global.related_title') }}</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::footer_blocks.full.electronic_identity_card_issuance.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.change_of_residence.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none">{{ __('pub_theme::blocks_common.shared.online_taxes.label') }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- Footer Main --}}
<div class="footer-main py-8 bg-primary text-white">
    <div class="container">
        <div class="row g-4">
            {{-- Municipality Name --}}
            <div class="col-12 col-lg-2">
                <h3 class="h5 mb-4">{{ $municipality ?: 'NOME DEL COMUNE' }}</h3>
            </div>
            
            {{-- Amministrazione --}}
            <div class="col-12 col-md-6 col-lg-2">
                <h4 class="h6 text-uppercase mb-3">{{ __('pub_theme::footer_blocks.shared.administration.label') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.shared.governing_bodies.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.administrative_areas.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.offices.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.shared.bodies_and_foundations.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.shared.politicians.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.administrative_staff.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.documents_and_data.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Categorie di Servizio --}}
            <div class="col-12 col-md-6 col-lg-3">
                <h4 class="h6 text-uppercase mb-3">{{ __('pub_theme::footer_blocks.shared.service_categories.label') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.registry_office_and_civil_status.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.culture_and_leisure.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.working_life.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.business_and_commerce.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.tourism.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.mobility_and_transport.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Novità --}}
            <div class="col-12 col-md-6 col-lg-1">
                <h4 class="h6 text-uppercase mb-3">{{ __('pub_theme::blocks_common.shared.news.label') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.shared.news.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.announcements.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.notices.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Vivere il Comune --}}
            <div class="col-12 col-md-6 col-lg-2">
                <h4 class="h6 text-uppercase mb-3">{{ __('pub_theme::footer_blocks.full.living_in_the_municipality.label') }}</h4>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::footer_blocks.full.places.label') }}</a></li>
                    <li class="mb-2"><a href="#" class="text-white text-decoration-none">{{ __('pub_theme::blocks_common.shared.events.label') }}</a></li>
                </ul>
            </div>
            
            {{-- Contatti --}}
            <div class="col-12 col-lg-2">
                <h4 class="h6 text-uppercase mb-3">{{ __('pub_theme::blocks_common.shared.contacts.label') }}</h4>
                <address class="not-italic mb-3">
                    {{ $address ?: 'Via Roma 123 - 00100 Comune' }}<br>
                    {{ $vat ?: 'CF: 00123456789' }}
                </address>
                <p class="mb-2">URP<br>{{ __('pub_theme::footer_blocks.full.toll_free_number.label', ['phone' => $phone ?: '800 016 123']) }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Footer Bottom --}}
<div class="footer-bottom py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            {{-- Social Icons --}}
            <div class="it-socials">
                <span class="me-2">{{ __('pub_theme::footer_blocks.shared.follow_us_on.label') }}</span>
                <ul class="list-inline mb-0 d-flex gap-2">
                    @foreach($social as $network)
                    <li class="list-inline-item">
                        <a href="#" class="text-link" aria-label="{{ ucfirst($network) }}">
                            <svg class="icon icon-sm">
                                <use href="#it-{{ $network }}"></use>
                            </svg>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            
            {{-- Legal Links --}}
            <ul class="list-inline mb-0 d-flex gap-3">
                @foreach($links as $link)
                <li class="list-inline-item">
                    <a href="{{ $link['url'] }}" class="text-decoration-none">{{ $link['label'] }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

{{-- Copyright --}}
<div class="footer-copyright py-3 border-top">
    <div class="container text-center">
        <p class="mb-0 text-muted small">
            &copy; {{ date('Y') }} {{ $municipality ?: 'Comune di Nome Comune' }}. Tutti i diritti riservati.
        </p>
    </div>
</div>
