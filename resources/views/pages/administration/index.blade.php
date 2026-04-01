{{-- Template Pagina Amministrazione - AGID Compliant --}}
<x-layouts.main 
    title="Amministrazione"
    metaDescription="Amministrazione trasparente del Comune - Organizzazione, documenti, bandi e dati amministrativi"
    breadcrumbTitle="Amministrazione"
>
    
    {{-- Hero Section --}}
    <section class="bg-primary-600 text-white py-12">
        <div class="container-italia">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="text-4xl font-bold mb-6">Amministrazione</h1>
                <p class="text-xl text-primary-100 mb-8">
                    Tutte le informazioni sull'organizzazione, i documenti amministrativi, i bandi e i dati del Comune
                </p>
                
                {{-- Quick Navigation --}}
                <div class="flex flex-wrap justify-center gap-4 mt-8">
                    <a href="#organizzazione" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-building-office" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Organizzazione
                    </a>
                    <a href="#documenti" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-document-text" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Documenti
                    </a>
                    <a href="#bandi" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-clipboard-document-list" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Bandi e Gare
                    </a>
                    <a href="#dati" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-chart-bar" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Dati e Statistiche
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Organizzazione Section --}}
    <section id="organizzazione" class="py-16 bg-white" aria-labelledby="organizzazione-heading">
        <div class="container-italia">
            <div class="text-center mb-12">
                <h2 id="organizzazione-heading" class="text-3xl font-bold text-gray-900 mb-4">Organizzazione</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    La struttura organizzativa del Comune, gli uffici e i servizi a disposizione dei cittadini
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Uffici --}}
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <x-filament::icon icon="heroicon-o-building-office" class="w-8 h-8 text-primary-600 mr-3" />
f7ac8eda (.)
                        <h3 class="text-xl font-semibold text-gray-900">Uffici Comunali</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Tutti gli uffici comunali con indirizzi, orari di apertura e contatti
                    </p>
                    <a href="{{ route('pages.view', ['slug' => 'uffici-comunali']) }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800">
                        Esplora gli uffici
                        <x-filament::icon icon="heroicon-o-arrow-right" class="w-4 h-4 ml-1" />
f7ac8eda (.)
                    </a>
                </div>

                {{-- Organigramma --}}
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <x-filament::icon icon="heroicon-o-user-group" class="w-8 h-8 text-primary-600 mr-3" />
f7ac8eda (.)
                        <h3 class="text-xl font-semibold text-gray-900">Organigramma</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        La struttura organizzativa e le responsabilità degli uffici
                    </p>
                    <a href="{{ route('pages.view', ['slug' => 'organigramma']) }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800">
                        Visualizza organigramma
                        <x-filament::icon icon="heroicon-o-arrow-right" class="w-4 h-4 ml-1" />
f7ac8eda (.)
                    </a>
                </div>

                {{-- Personale --}}
                <div class="bg-gray-50 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <x-filament::icon icon="heroicon-o-users" class="w-8 h-8 text-primary-600 mr-3" />
f7ac8eda (.)
                        <h3 class="text-xl font-semibold text-gray-900">Personale</h3>
                    </div>
                    <p class="text-gray-600 mb-4">
                        Informazioni sul personale e sulle posizioni organizzative
                    </p>
                    <a href="{{ route('pages.view', ['slug' => 'personale']) }}" class="inline-flex items-center text-primary-600 font-medium hover:text-primary-800">
                        Dettagli personale
                        <x-filament::icon icon="heroicon-o-arrow-right" class="w-4 h-4 ml-1" />
f7ac8eda (.)
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Documenti Section --}}
    <section id="documenti" class="py-16 bg-gray-50" aria-labelledby="documenti-heading">
        <div class="container-italia">
            <div class="text-center mb-12">
                <h2 id="documenti-heading" class="text-3xl font-bold text-gray-900 mb-4">Documenti e Dati</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Tutti i documenti amministrativi, i regolamenti e i dati del Comune
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Documenti Amministrativi --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Documenti Amministrativi</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('pages.view', ['slug' => 'regolamenti']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Regolamenti Comunali</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'delibere']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Delibere di Giunta e Consiglio</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'statuti']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Statuto Comunale</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'piani']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Piani e Programmi</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                    </div>
                </div>

                {{-- Amministrazione Trasparente --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Amministrazione Trasparente</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('pages.view', ['slug' => 'bilanci']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Bilanci e Conti Consuntivi</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'contratti']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Contratti e Convenzioni</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'incarichi']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Incarichi e Nomine</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'beni-immobili']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Beni Immobili</span>
                            <x-filament::icon icon="heroicon-o-document-arrow-down" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                    </div>
                </div>
            </div>

            {{-- Open Data Section --}}
            <div class="mt-12 bg-primary-50 rounded-lg p-8">
                <div class="flex items-center mb-4">
                    <x-filament::icon icon="heroicon-o-cloud-arrow-down" class="w-8 h-8 text-primary-600 mr-3" />
f7ac8eda (.)
                    <h3 class="text-xl font-semibold text-gray-900">Dati Aperti (Open Data)</h3>
                </div>
                <p class="text-gray-600 mb-6">
                    Accedi ai dataset aperti del Comune in formato machine-readable
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('pages.view', ['slug' => 'open-data']) }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition-colors">
                        <x-filament::icon icon="heroicon-o-arrow-down-tray" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Scarica Open Data
                    </a>
                    <a href="{{ route('pages.view', ['slug' => 'api']) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-cpu-chip" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        API e Web Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Bandi e Gare Section --}}
    <section id="bandi" class="py-16 bg-white" aria-labelledby="bandi-heading">
        <div class="container-italia">
            <div class="text-center mb-12">
                <h2 id="bandi-heading" class="text-3xl font-bold text-gray-900 mb-4">Bandi e Gare</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Bandi di gara, avvisi pubblici e opportunità per imprese e cittadini
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('pages.view', ['slug' => 'bandi-lavori']) }}" class="group text-center p-6 bg-gray-50 rounded-lg hover:bg-primary-50 transition-colors">
                    <x-filament::icon icon="heroicon-o-wrench-screwdriver" class="w-12 h-12 text-primary-600 mx-auto mb-4 group-hover:text-primary-700" />
f7ac8eda (.)
                    <h3 class="font-semibold text-gray-900 mb-2">Lavori Pubblici</h3>
                    <p class="text-sm text-gray-600">Bandi per appalti e lavori</p>
                </a>

                <a href="{{ route('pages.view', ['slug' => 'bandi-forniture']) }}" class="group text-center p-6 bg-gray-50 rounded-lg hover:bg-primary-50 transition-colors">
                    <x-filament::icon icon="heroicon-o-truck" class="w-12 h-12 text-primary-600 mx-auto mb-4 group-hover:text-primary-700" />
f7ac8eda (.)
                    <h3 class="font-semibold text-gray-900 mb-2">Forniture</h3>
                    <p class="text-sm text-gray-600">Acquisti di beni e servizi</p>
                </a>

                <a href="{{ route('pages.view', ['slug' => 'bandi-servizi']) }}" class="group text-center p-6 bg-gray-50 rounded-lg hover:bg-primary-50 transition-colors">
                    <x-filament::icon icon="heroicon-o-briefcase" class="w-12 h-12 text-primary-600 mx-auto mb-4 group-hover:text-primary-700" />
f7ac8eda (.)
                    <h3 class="font-semibold text-gray-900 mb-2">Servizi</h3>
                    <p class="text-sm text-gray-600">Servizi professionali</p>
                </a>

                <a href="{{ route('pages.view', ['slug' => 'avvisi-pubblici']) }}" class="group text-center p-6 bg-gray-50 rounded-lg hover:bg-primary-50 transition-colors">
                    <x-filament::icon icon="heroicon-o-megaphone" class="w-12 h-12 text-primary-600 mx-auto mb-4 group-hover:text-primary-700" />
f7ac8eda (.)
                    <h3 class="font-semibold text-gray-900 mb-2">Avvisi Pubblici</h3>
                    <p class="text-sm text-gray-600">Comunicazioni e avvisi</p>
                </a>
            </div>

            {{-- Bandi in Scadenza --}}
            <div class="mt-12">
                <h3 class="text-xl font-semibold text-gray-900 mb-6">Bandi in Scadenza</h3>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <div class="flex items-center mb-4">
                        <x-filament::icon icon="heroicon-o-exclamation-triangle" class="w-6 h-6 text-yellow-600 mr-2" />
f7ac8eda (.)
                        <span class="font-semibold text-yellow-800">Nessun bando in scadenza</span>
                    </div>
                    <p class="text-yellow-700">
                        Al momento non ci sono bandi in scadenza imminente.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Dati e Statistiche Section --}}
    <section id="dati" class="py-16 bg-gray-50" aria-labelledby="dati-heading">
        <div class="container-italia">
            <div class="text-center mb-12">
                <h2 id="dati-heading" class="text-3xl font-bold text-gray-900 mb-4">Dati e Statistiche</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dati statistici, indicatori e report sull'attività del Comune
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Statistiche --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Statistiche Comunali</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('pages.view', ['slug' => 'statistiche-demografiche']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Dati Demografici</span>
                            <x-filament::icon icon="heroicon-o-user-group" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'statistiche-economiche']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Indicatori Economici</span>
                            <x-filament::icon icon="heroicon-o-currency-euro" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'statistiche-territorio']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Dati Territoriali</span>
                            <x-filament::icon icon="heroicon-o-map" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'report-annuali']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Report Annuali</span>
                            <x-filament::icon icon="heroicon-o-document-chart-bar" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                    </div>
                </div>

                {{-- Performance --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Performance e Qualità</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('pages.view', ['slug' => 'performance-servizi']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Performance dei Servizi</span>
                            <x-filament::icon icon="heroicon-o-chart-bar" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'soddisfazione-utenti']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Soddisfazione Utenti</span>
                            <x-filament::icon icon="heroicon-o-face-smile" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'qualita-servizi']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Qualità dei Servizi</span>
                            <x-filament::icon icon="heroicon-o-shield-check" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                        
                        <a href="{{ route('pages.view', ['slug' => 'indicatori-efficiency']) }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <span class="text-gray-700">Indicatori di Efficienza</span>
                            <x-filament::icon icon="heroicon-o-cog-6-tooth" class="w-5 h-5 text-gray-400" />
f7ac8eda (.)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-primary-600 text-white">
        <div class="container-italia">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Hai bisogno di informazioni?</h2>
                <p class="text-xl text-primary-100 mb-8">
                    L'Ufficio Relazioni con il Pubblico è a tua disposizione per qualsiasi informazione
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('pages.view', ['slug' => 'urp']) }}" class="inline-flex items-center px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-primary-50 transition-colors">
                        <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Contatta URP
                    </a>
                    
                    <a href="{{ route('pages.view', ['slug' => 'faq-amministrazione']) }}" class="inline-flex items-center px-6 py-3 border border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition-colors">
                        <x-filament::icon icon="heroicon-o-question-mark-circle" class="w-5 h-5 mr-2" />
f7ac8eda (.)
                        Consulta le FAQ
                    </a>
                </div>
            </div>
        </div>
    </section>

</x-layouts.main>