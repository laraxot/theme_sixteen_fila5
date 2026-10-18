<footer class="it-footer">
    <div class="it-footer-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="it-brand-wrapper">
                        <a href="{{ route('comune.homepage') }}">
                            <img src="{{ theme_asset('images/logo-comune.png') }}" alt="Logo Comune" class="icon">
                            <div class="it-brand-text">
                                <h3>{{ config('comune.nome', 'Nome Comune') }}</h3>
                                <small>Comune di {{ config('comune.nome', 'Nome Comune') }}</small>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h4>Contatti</h4>
                    <div class="it-footer-address">
                        <p>{{ config('comune.indirizzo', 'Via, 1') }}</p>
                        <p>{{ config('comune.cap', '00000') }} {{ config('comune.nome', 'Nome Comune') }} ({{ config('comune.provincia', 'Provincia') }})</p>
                        <p>Tel: {{ config('comune.telefono', '000-0000000') }}</p>
                        <p>Email: {{ config('comune.email', 'info@comune.it') }}</p>
                        <p>PEC: {{ config('comune.pec', 'comune@pec.it') }}</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h4>Link Utili</h4>
                    <ul class="it-footer-list">
                        <li><a href="{{ route('comune.servizi') }}">Servizi</a></li>
                        <li><a href="{{ route('comune.novita') }}">Novità</a></li>
                        <li><a href="{{ route('comune.contatti') }}">Contatti</a></li>
                        <li><a href="{{ route('comune.documenti') }}">Documenti</a></li>
                        <li><a href="{{ route('comune.eventi') }}">Eventi</a></li>
                        <li><a href="{{ route('fixcity.tickets.index') }}">Segnalazioni</a></li>
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
                        <p>&copy; {{ date('Y') }} Comune di {{ config('comune.nome', 'Nome Comune') }} - Tutti i diritti riservati</p>
                        <p>P.IVA: {{ config('comune.piva', '00000000000') }} - Codice Fiscale: {{ config('comune.cf', '00000000000') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


