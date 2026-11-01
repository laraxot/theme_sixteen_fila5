{{--
    AGID Compliant Footer Component
    
    Implementa le linee guida AGID per il footer di un sito PA
    - Struttura semantica
    - Link istituzionali obbligatori
    - Informazioni di contatto
    - Social media
    - Accessibilità completa
--}}

<footer class="it-footer" id="footer" role="contentinfo">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                {{-- Logo e descrizione ente --}}
                <div class="col-12 col-md-6 col-lg-4 pb-2">
                    <div class="it-brand-wrapper">
                        <a href="{{ url('/'.app()->getLocale()) }}" aria-label="{{ config('app.name') }} - {{ __('pub_theme::common.navigation.back_home.label') }}">
                            <svg class="icon" role="img" aria-labelledby="footer-logo-title">
                                <title id="footer-logo-title">{{ config('app.name') }}</title>
                                <use href="#it-pa"></use>
                            </svg>
                            <div class="it-brand-text">
                                <h2 class="no_toc">{{ config('app.name') }}</h2>
                            </div>
                        </a>
                    </div>
                    <p class="mt-3">
                        {{ __('pub_theme::ui_components.footer.tagline.label') }}
                        {{ __('pub_theme::ui_components.footer.improving_together.label') }}
                    </p>
                </div>

                {{-- Link utili --}}
                <div class="col-12 col-md-6 col-lg-4 pb-2">
                    <h3 class="footer-heading-title">{{ __('footer.useful_links') }}</h3>
                    <nav aria-label="{{ __('footer.useful_links_aria') }}">
                        <ul class="footer-list">
                            <li>
                                <a href="{{ url('/amministrazione-trasparente') }}" title="{{ __('footer.go_to_transparent_administration') }}">
                                    {{ __('footer.amministrazione_trasparente') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/privacy') }}" title="{{ __('footer.go_to_privacy') }}">
                                    {{ __('footer.privacy') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/note-legali') }}" title="{{ __('footer.go_to_legal_notes') }}">
                                    {{ __('footer.legal_notes') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/cookie-policy') }}" title="{{ __('footer.go_to_cookie_policy') }}">
                                    {{ __('footer.cookie_policy') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/accessibilita') }}" title="{{ __('footer.go_to_accessibility') }}">
                                    {{ __('footer.accessibility') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('/sitemap') }}" title="{{ __('footer.go_to_sitemap') }}">
                                    {{ __('footer.sitemap') }}
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

                {{-- Contatti --}}
                <div class="col-12 col-md-6 col-lg-4 pb-2">
                    <h3 class="footer-heading-title">{{ __('footer.contacts') }}</h3>
                    <address>
                        <p>
                            <strong>{{ config('app.name') }}</strong><br>
                            Via Example, 123<br>
                            00100 Roma (RM)<br>
                            {{ __('pub_theme::ui_components.footer.country.label') }}
                        </p>
                        <p>
                            <strong>{{ __('footer.email') }}:</strong> 
                            <a href="mailto:info@fixcity.it" class="text-decoration-underline">info@fixcity.it</a><br>
                            <strong>{{ __('footer.pec') }}:</strong> 
                            <a href="mailto:pec@fixcity.it" class="text-decoration-underline">pec@fixcity.it</a><br>
                            <strong>{{ __('footer.phone') }}:</strong> 
                            <a href="tel:+390612345678">+39 06 1234 5678</a>
                        </p>
                        <p>
                            <strong>{{ __('footer.fiscal_code') }}:</strong> 12345678901<br>
                            <strong>{{ __('footer.vat_number') }}:</strong> 12345678901
                        </p>
                    </address>
                </div>
            </div>

            {{-- Social media --}}
            <div class="row mt-4">
                <div class="col-12">
                    <h3 class="footer-heading-title">{{ __('footer.follow_us') }}</h3>
                    <ul class="list-inline text-start social" aria-label="{{ __('footer.social_links') }}">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/fixcity" target="_blank" rel="noopener noreferrer" 
                               aria-label="{{ __('footer.social_facebook') }}" title="Facebook">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="#it-facebook"></use>
                                </svg>
                                <span class="visually-hidden">Facebook</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://twitter.com/fixcity" target="_blank" rel="noopener noreferrer"
                               aria-label="{{ __('footer.social_twitter') }}" title="Twitter">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="#it-twitter"></use>
                                </svg>
                                <span class="visually-hidden">Twitter</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/company/fixcity" target="_blank" rel="noopener noreferrer"
                               aria-label="{{ __('footer.social_linkedin') }}" title="LinkedIn">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="#it-linkedin"></use>
                                </svg>
                                <span class="visually-hidden">LinkedIn</span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/fixcity" target="_blank" rel="noopener noreferrer"
                               aria-label="{{ __('footer.social_instagram') }}" title="Instagram">
                                <svg class="icon icon-sm icon-white align-top">
                                    <use href="#it-instagram"></use>
                                </svg>
                                <span class="visually-hidden">Instagram</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer Small - Informazioni obbligatorie AGID --}}
    <div class="it-footer-small-prints">
        <div class="container">
            <ul class="it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row" 
                aria-label="{{ __('footer.footer_secondary_links') }}">
                <li class="list-inline-item">
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/privacy') }}" title="{{ __('footer.go_to_privacy') }}">
                        {{ __('footer.privacy') }}
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/note-legali') }}" title="{{ __('footer.go_to_legal_notes') }}">
                        {{ __('footer.legal_notes') }}
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/accessibilita') }}" title="{{ __('footer.go_to_accessibility') }}">
                        {{ __('footer.accessibility') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>

    {{-- Back to top button --}}
    <a href="#"
       aria-hidden="true"
       data-attribute="back-to-top"
       class="back-to-top shadow"
       title="{{ __('footer.back_to_top') }}">
        <svg class="icon icon-light">
            <use href="#it-arrow-up"></use>
        </svg>
        <span class="visually-hidden">{{ __('footer.back_to_top_aria') }}</span>
    </a>
</footer>

{{-- Cookie consent banner (GDPR compliance): lo inietta InjectCookieBanner -> Modules/Gdpr/resources/views/cookie-consent (DCP-153). Nessun include qui. --}}
