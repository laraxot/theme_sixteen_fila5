<footer class="it-footer" id="footer" role="contentinfo">
    <div class="it-footer-main">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Logo Row --}}
            <div class="mb-6 flex items-center gap-3">
                <img class="h-8 w-auto" src="/themes/Sixteen/design-comuni/assets/images/logo-eu-inverted.svg" alt="logo Unione Europea">
                <div class="it-brand-wrapper">
                    <a href="/" class="flex items-center gap-2">
                        @include('pub_theme::components.ui.icon', ['name' => 'it-pa', 'class' => 'h-7 w-7 text-emerald-700'])
                        <h2 class="no_toc mb-0 text-xl font-bold">Nome del Comune</h2>
                    </a>
                </div>
            </div>

            {{-- Main Links Grid --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-12">

                {{-- Amministrazione --}}
                <div class="md:col-span-3">
                    <h4 class="footer-heading-title mb-3 text-lg font-semibold">Amministrazione</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Organi di governo</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Aree amministrative</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Uffici</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Enti e fondazioni</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Politici</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Personale amministrativo</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Documenti e dati</a></li>
                    </ul>
                </div>

                {{-- Categorie di servizio --}}
                <div class="md:col-span-6">
                    <h4 class="footer-heading-title mb-3 text-lg font-semibold">Categorie di servizio</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <ul class="footer-list space-y-2">
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Anagrafe e stato civile</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Cultura e tempo libero</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Vita lavorativa</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Imprese e commercio</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Appalti pubblici</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Catasto e urbanistica</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Turismo</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Mobilità e trasporti</a></li>
                        </ul>
                        <ul class="footer-list space-y-2">
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Educazione e formazione</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Giustizia e sicurezza pubblica</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Tributi, finanze e contravvenzioni</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Ambiente</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Salute, benessere e assistenza</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Autorizzazioni</a></li>
                            <li><a href="#" class="text-slate-700 hover:text-emerald-700">Agricoltura e pesca</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Novità + Vivere il comune --}}
                <div class="md:col-span-3">
                    <h4 class="footer-heading-title mb-3 text-lg font-semibold">Novità</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Notizie</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Comunicati</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Avvisi</a></li>
                    </ul>
                    <h4 class="footer-heading-title mt-4 mb-3 text-lg font-semibold">Vivere il comune</h4>
                    <ul class="footer-list space-y-2">
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Luoghi</a></li>
                        <li><a href="#" class="text-slate-700 hover:text-emerald-700">Eventi</a></li>
                    </ul>
                </div>

                {{-- Contatti --}}
                <div class="md:col-span-3 md:col-start-1 md:mt-4 border-t pt-4 md:border-0 md:pt-0">
                    <h4 class="footer-heading-title mb-3 text-lg font-semibold">Contatti</h4>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <p class="footer-info text-sm text-slate-700">
                                Comune di Nome Comune<br>
                                Via Roma 123 - 00100 Comune<br>
                                Codice fiscale / P. IVA: 00123456789<br><br>
                                <a href="#" class="text-emerald-700 hover:text-emerald-800">Ufficio Relazioni con il Pubblico</a><br>
                                Numero verde: 800 016 123<br>
                                SMS e WhatsApp: +39 320 1234567<br>
                                Posta Elettronica Certificata<br>
                                Centralino unico: 012 3456
                            </p>
                        </div>
                        <div>
                            <ul class="footer-list space-y-2">
                                <li><a href="#" data-element="faq" class="text-slate-700 hover:text-emerald-700">Leggi le FAQ</a></li>
                                <li><a href="#" class="text-slate-700 hover:text-emerald-700">Prenotazione appuntamento</a></li>
                                <li><a href="#" data-element="report-inefficiency" class="text-slate-700 hover:text-emerald-700">Segnalazione disservizio</a></li>
                                <li><a href="#" class="text-slate-700 hover:text-emerald-700">Richiesta d'assistenza</a></li>
                            </ul>
                        </div>
                        <div class="sm:col-span-2">
                            <ul class="footer-list space-y-2">
                                <li><a href="#" class="text-slate-700 hover:text-emerald-700">Amministrazione trasparente</a></li>
                                <li><a href="#" data-element="privacy-policy-link" class="text-slate-700 hover:text-emerald-700">Informativa privacy</a></li>
                                <li><a href="#" data-element="legal-notes" class="text-slate-700 hover:text-emerald-700">Note legali</a></li>
                                <li><a href="#" data-element="accessibility-link" class="text-slate-700 hover:text-emerald-700">Dichiarazione di accessibilità</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Seguici su --}}
                <div class="md:col-span-3 md:mt-4">
                    <h4 class="footer-heading-title mb-3 text-lg font-semibold">Seguici su</h4>
                    <ul class="flex flex-wrap gap-2 text-start">
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="Twitter">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-twitter', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="Facebook">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-facebook', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="YouTube">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-youtube', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="Telegram">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-telegram', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="Whatsapp">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-whatsapp', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                        <li>
                            <a class="p-1 text-white" href="#" target="_blank" aria-label="RSS">
                                @include('pub_theme::components.ui.icon', ['name' => 'it-rss', 'class' => 'h-5 w-5 text-emerald-700'])
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

            {{-- Bottom Row --}}
            <div class="mt-6 border-t pt-4">
                <div class="footer-bottom flex gap-4 text-sm text-slate-600">
                    <a href="#" class="hover:text-emerald-700">Media policy</a>
                    <a href="#" class="hover:text-emerald-700">Mappa del sito</a>
                </div>
            </div>

        </div>
    </div>
</footer>
