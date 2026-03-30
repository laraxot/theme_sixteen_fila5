<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.appuntamento-01-ufficio');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'tests.appuntamento-01-ufficio';
    public array $data = [];
    
    public function getOffices(): array
    {
        return [
            ['id' => 'anagrafe', 'name' => 'Servizi Demografici', 'description' => 'Certificati, carte d'identità, residenza', 'icon' => 'heroicon-o-identification', 'location' => 'Piano 1, Ufficio 101-105'],
            ['id' => 'stato-civile', 'name' => 'Stato Civile', 'description' => 'Nascite, matrimoni, decessi', 'icon' => 'heroicon-o-heart', 'location' => 'Piano 1, Ufficio 106-108'],
            ['id' => 'tributi', 'name' => 'Ufficio Tributi', 'description' => 'TARI, IMU, TASI', 'icon' => 'heroicon-o-banknotes', 'location' => 'Piano 2, Ufficio 201-205'],
            ['id' => 'polizia-locale', 'name' => 'Polizia Locale', 'description' => 'Permessi, contravvenzioni, sanzioni', 'icon' => 'heroicon-o-shield-check', 'location' => 'Piano Terra, Ufficio 001-005'],
            ['id' => 'lavori-pubblici', 'name' => 'Lavori Pubblici', 'description' => 'Edilizia, urbanistica, manutenzione', 'icon' => 'heroicon-o-wrench-screwdriver', 'location' => 'Piano 2, Ufficio 206-210'],
            ['id' => 'servizi-sociali', 'name' => 'Servizi Sociali', 'description' => 'Assistenza, sostegno, agevolazioni', 'icon' => 'heroicon-o-heart', 'location' => 'Piano 1, Ufficio 109-112'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('tests.appuntamento-01-ufficio')
    <div>
        {{-- Skip Links --}}
        <a class="skiplinks" href="#main">Vai al contenuto principale</a>
        
        {{-- Header --}}
        <x-section slug="header" :data="$headerData ?? []" />
        
        {{-- Main Content --}}
        <main class="container" id="main">
            {{-- Breadcrumbs --}}
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-decoration-none" href="/it/tests/appuntamento">Appuntamenti</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Scegli ufficio</li>
                </ol>
            </nav>
            
            {{-- Progress Stepper --}}
            <div class="row mt-8">
                <div class="col-12">
                    <x-blocks.steps.steps :data="[
                        'title' => 'Prenotazione appuntamento',
                        'layout' => 'horizontal',
                        'steps' => [
                            ['number' => 1, 'title' => 'Ufficio', 'active' => true],
                            ['number' => 2, 'title' => 'Data e Ora', 'pending' => true],
                            ['number' => 3, 'title' => 'Dettagli', 'pending' => true],
                            ['number' => 4, 'title' => 'Richiedente', 'pending' => true],
                            ['number' => 5, 'title' => 'Riepilogo', 'pending' => true],
                            ['number' => 6, 'title' => 'Conferma', 'pending' => true],
                        ]
                    ]" />
                </div>
            </div>
            
            {{-- Form Content --}}
            <div class="row mt-8">
                <div class="col-lg-8">
                    <h2 class="title-xxlarge mb-4">Seleziona l'ufficio</h2>
                    <p class="lead mb-6">Scegli l'ufficio per il quale prenotare l'appuntamento</p>
                    
                    <div class="row g-4">
                        @foreach($this->getOffices() as $office)
                        <div class="col-12 col-md-6">
                            <label class="block cursor-pointer">
                                <input type="radio" name="office" value="{{ $office['id'] }}" class="peer sr-only" />
                                <div class="p-6 border-2 border-gray-200 rounded-lg peer-checked:border-primary peer-checked:bg-primary/5 transition-all hover:shadow-md">
                                    <div class="flex items-start gap-4">
                                        <x-filament::icon :icon="$office['icon']" class="w-10 h-10 text-primary flex-shrink-0" />
                                        <div>
                                            <h3 class="font-semibold text-lg mb-2">{{ $office['name'] }}</h3>
                                            <p class="text-gray-600 text-sm mb-2">{{ $office['description'] }}</p>
                                            <p class="text-gray-500 text-sm"><x-filament::icon icon="heroicon-o-map-pin" class="w-4 h-4 inline mr-1" />{{ $office['location'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                {{-- Sidebar --}}
                <div class="col-lg-4">
                    <aside class="sticky-top top-100">
                        <x-blocks.info-box :data="[
                            'title' => 'Hai bisogno di aiuto?',
                            'content' => 'Per informazioni sugli uffici e i servizi offerti, contatta l'URP.',
                            'icon' => 'heroicon-o-information-circle',
                            'link_text' => 'Contatta l'URP',
                            'link_url' => '/it/tests/assistenza',
                        ]" />
                    </aside>
                </div>
            </div>
            
            {{-- Navigation Buttons --}}
            <div class="row mt-8">
                <div class="col-12">
                    <div class="flex justify-end gap-4">
                        <a href="/it/tests/homepage" class="btn btn-secondary px-6 py-3">Annulla</a>
                        <button type="submit" form="appointment-form" class="btn btn-primary px-6 py-3">
                            Avanti
                            <x-filament::icon icon="heroicon-m-arrow-right" class="w-5 h-5 ml-2" />
                        </button>
                    </div>
                </div>
            </div>
        </main>
        
        {{-- Footer --}}
        <x-section slug="footer" :data="$footerData ?? []" tpl="full" />
    </div>
    @endvolt
</x-layouts.app>
