{{-- Contact & Services Section - Design Comuni Style --}}
@props([
    'contact_title' => __('pub_theme::blocks_content.article.contact_the_municipality.label'),
    'report_title' => __('pub_theme::blocks_common.shared.problems_in_the_city.label'),
])

<section class="py-8 bg-light">
    <div class="container">
        <div class="row g-4">
            {{-- Contact Box --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-teaser shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">{{ $contact_title }}</h3>
                        
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <x-filament::icon icon="heroicon-o-document-text" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_content.services.read_the_faq.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <x-filament::icon icon="heroicon-o-lifebuoy" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_common.shared.request_assistance.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="tel:061234567" class="text-decoration-none">
                                    <x-filament::icon icon="heroicon-o-phone" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_content.services.call_the_toll_free_number.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none">
                                    <x-filament::icon icon="heroicon-o-calendar" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_common.shared.book_an_appointment.label') }}
                                </a>
                            </li>
                        </ul>
                        
                        <a href="#" class="btn btn-outline-primary w-100">
                            {{ __('pub_theme::blocks_content.services.all_contacts.label') }}
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Reporting Box --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-teaser shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">{{ $report_title }}</h3>
                        
                        <p class="text-muted mb-4">
                            {{ __('pub_theme::blocks_content.services.report_a_service_issue_or_a.label') }}
                        </p>
                        
                        <a href="#" class="btn btn-outline-primary w-100">
                            <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-5 h-5 me-2" />
                            {{ __('pub_theme::blocks_common.shared.report_a_service_issue.label') }}
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Secondary Search --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card card-teaser shadow-sm h-100">
                    <div class="card-body p-4">
                        <h3 class="h5 mb-3">{{ __('fixcity::global.related_title') }}</h3>
                        
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-primary">
                                    <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_content.services.electronic_id_card_issuance.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-primary">
                                    <x-filament::icon icon="heroicon-o-home" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_common.shared.change_of_residence.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-primary">
                                    <x-filament::icon icon="heroicon-o-currency-euro" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_common.shared.online_taxes.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-primary">
                                    <x-filament::icon icon="heroicon-o-calendar" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_content.services.appointment_booking.label') }}
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="#" class="text-decoration-none text-primary">
                                    <x-filament::icon icon="heroicon-o-identification" class="w-4 h-4 inline me-2" />
                                    {{ __('pub_theme::blocks_content.services.issuance_of_polling_card.label') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
