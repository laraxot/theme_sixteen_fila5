{{--
    Bootstrap Italia Full Footer
    Reference: design-comuni-pagine-statiche/src/components/cmp-footer/cmp-footer.hbs
--}}

<footer class="it-footer" id="footer">
    <div class="it-footer-main">
        <div class="container">
            {{-- Logo row --}}
            <div class="row">
                <div class="col-12 footer-items-wrapper logo-wrapper">
                    <img class="ue-logo" src="{{ asset('themes/Sixteen/design-comuni/assets/images/logo-eu-inverted.svg') }}" alt="{{ __('pub_theme::components_footer.eu.logo_alt.label') }}">
                    <div class="it-brand-wrapper">
                        <a href="#">
                            <svg class="icon" aria-hidden="true">
                                <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-pa') }}"></use>
                            </svg>
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ __('pub_theme::header.center.nav.hamburger_brand.label') }}</h2>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Links row --}}
            <div class="row">
                {{-- Amministrazione --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::header.center.nav.amministrazione.label') }}</h4>
                    <ul class="footer-list">
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.governing_bodies.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.administrative_areas.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.offices.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.bodies_foundations.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.politicians.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.staff.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.admin.documents_data.label') }}</a></li>
                    </ul>
                </div>

                {{-- Categorie di servizio --}}
                <div class="col-md-6 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::components_footer.services.heading_lower.label') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="footer-list">
                                <li><a href="#">{{ __('pub_theme::components_footer.services.registry_civil.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.culture_leisure.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.work_life.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.business_commerce.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.public_procurement.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.land_registry_planning.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.tourism.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.mobility_transport.label') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="footer-list">
                                <li><a href="#">{{ __('pub_theme::components_footer.services.education_training.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.justice_security.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.taxes_finance_fines.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.environment.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.health_welfare.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.permits.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.services.agriculture_fishing.label') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Novità + Vivere il comune --}}
                <div class="col-md-3 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::header.center.nav.novita.label') }}</h4>
                    <ul class="footer-list">
                        <li><a href="#">{{ __('pub_theme::components_footer.news.news.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.news.press_releases.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.news.notices.label') }}</a></li>
                    </ul>
                    <h4 class="footer-heading-title">{{ __('pub_theme::components_footer.live.heading_lower.label') }}10</h4>
                    <ul class="footer-list">
                        <li><a href="#">{{ __('pub_theme::components_footer.live.places.label') }}</a></li>
                        <li><a href="#">{{ __('pub_theme::components_footer.live.events.label') }}</a></li>
                    </ul>
                </div>

                {{-- Contatti --}}
                <div class="col-md-9 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::components_common.nav.contacts.label') }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="footer-info">Comune di Nome Comune<br>
                                Via Roma 123 - 00100 Comune<br>
                                {{ __('pub_theme::components_footer.contacts.tax_code_vat.label') }} 00123456789<br><br>
                                <a href="#">{{ __('pub_theme::components_footer.contacts.urp.label') }}</a><br>
                                {{ __('pub_theme::components_footer.contacts.toll_free.label') }} 800 016 123<br>
                                {{ __('pub_theme::components_footer.contacts.sms_whatsapp.label') }} +39 320 1234567<br>
                                {{ __('pub_theme::components_footer.contacts.pec.label') }}<br>
                                {{ __('pub_theme::components_footer.contacts.switchboard_single.label') }} 012 3456
                            </p>
                        </div>
                        <div class="col-md-4">
                            <ul class="footer-list">
                                <li><a href="#" data-element="faq">{{ __('pub_theme::components_footer.help.read_faq.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.help.appointment_booking.label') }}</a></li>
                                <li><a href="#" data-element="report-inefficiency">{{ __('pub_theme::components_footer.help.report_issue.label') }}</a></li>
                                <li><a href="#">{{ __('pub_theme::components_footer.help.support_request.label') }}</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <ul class="footer-list">
                                <li><a href="#">{{ __('pub_theme::components_footer.legal.transparent_administration.label') }}</a></li>
                                <li><a href="#" data-element="privacy-policy-link">{{ __('pub_theme::legal.documents.privacy.title') }}</a></li>
                                <li><a href="#" data-element="legal-notes">{{ __('pub_theme::legal.documents.legal_notes.title') }}</a></li>
                                <li><a href="#" data-element="accessibility-link">{{ __('pub_theme::accessibility.page.title.text') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Seguici su --}}
                <div class="col-md-3 mt-md-4 footer-items-wrapper">
                    <h4 class="footer-heading-title">{{ __('pub_theme::header.center.social.follow.label') }}</h4>
                    <ul class="list-inline text-start social">
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter') }}"></use>
                                </svg>
                                <span class="visually-hidden">Twitter</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook') }}"></use>
                                </svg>
                                <span class="visually-hidden">Facebook</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube') }}"></use>
                                </svg>
                                <span class="visually-hidden">YouTube</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram') }}"></use>
                                </svg>
                                <span class="visually-hidden">Telegram</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp') }}"></use>
                                </svg>
                                <span class="visually-hidden">Whatsapp</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="p-1 text-white" href="#" target="_blank">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="{{ asset('themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-rss') }}"></use>
                                </svg>
                                <span class="visually-hidden">RSS</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Footer bottom bar --}}
            <div class="row">
                <div class="col-12 footer-items-wrapper">
                    <div class="footer-bottom">
                        <a href="#">{{ __('pub_theme::legal.documents.media_policy.title') }}</a>
                        <a href="#">{{ __('pub_theme::sitemap.meta.title') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
