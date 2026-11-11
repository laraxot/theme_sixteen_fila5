<footer class="it-footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="it-brand-wrapper">
                        <a href="{{ route('home') }}">
                            <img src="{{ theme_asset('images/logo-comune.png') }}" alt="{{ __('pub_theme::navigation.site_title') }}" class="icon">
                            <div class="it-brand-text">
                                <h3>{{ config('comune.nome', 'Nome Comune') }}</h3>
                                <small>{{ __('pub_theme::comune_pages.shared.municipality_of_name.label', ['name' => config('comune.nome', 'Nome Comune')]) }}</small>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h4>{{ __('pub_theme::footer.contacts') }}</h4>
                    <div class="it-footer-address">
                        <p>{{ config('comune.indirizzo', 'Via, 1') }}</p>
                        <p>{{ config('comune.cap', '00000') }} {{ config('comune.nome', 'Nome Comune') }} ({{ config('comune.provincia', 'Provincia') }})</p>
                        <p>{{ __('pub_theme::footer.phone') }}: {{ config('comune.telefono', '000-0000000') }}</p>
                        <p>{{ __('pub_theme::footer.email') }}: {{ config('comune.email', 'info@comune.it') }}</p>
                        <p>{{ __('pub_theme::footer.pec') }}: {{ config('comune.pec', 'comune@pec.it') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h4>{{ __('pub_theme::footer.useful_links') }}</h4>
                    <ul class="it-footer-list">
                        <li><a href="{{ route('services.categories') }}">{{ __('pub_theme::navigation.services') }}</a></li>
                        <li><a href="{{ route('news') }}">{{ __('pub_theme::navigation.news') }}</a></li>
                        <li><a href="{{ route('contact') }}">{{ __('pub_theme::navigation.contact') }}</a></li>
                        <li><a href="{{ route('documenti') }}">{{ __('pub_theme::footer.documents', [], null) }}</a></li>
                        <li><a href="{{ route('events.index') }}">{{ __('pub_theme::navigation.homepage.events') }}</a></li>
                        <li><a href="{{ route('segnalazioni') }}">{{ __('pub_theme::home.heading.title') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="it-footer-secondary">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="it-footer-small-prints">
                        <p>&copy; {{ date('Y') }} Comune di {{ config('comune.nome', 'Nome Comune') }} - {{ __('pub_theme::footer.all_rights_reserved', [], null) }}</p>
                        <p>{{ __('pub_theme::footer.vat_number') }}: {{ config('comune.piva', '00000000000') }} - {{ __('pub_theme::footer.fiscal_code') }}: {{ config('comune.cf', '00000000000') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


