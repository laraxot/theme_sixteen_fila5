<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.servizi');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'tests.servizi';
    public array $data = [];
    
    public function getCategories(): array
    {
        return [
            ['label' => 'Tutti', 'value' => '', 'icon' => 'heroicon-o-squares-2x2'],
            ['label' => 'Anagrafe', 'value' => 'anagrafe', 'icon' => 'heroicon-o-identification'],
            ['label' => 'Cultura', 'value' => 'cultura', 'icon' => 'heroicon-o-book-open'],
            ['label' => 'Servizi sociali', 'value' => 'sociali', 'icon' => 'heroicon-o-heart'],
            ['label' => 'Mobilità', 'value' => 'mobilita', 'icon' => 'heroicon-o-truck'],
            ['label' => 'Ambiente', 'value' => 'ambiente', 'icon' => 'heroicon-o-globe-alt'],
        ];
    }
    
    public function getServices(): array
    {
        return [
            ['title' => 'Certificato di residenza', 'description' => 'Rilascio certificato di residenza online', 'icon' => 'ui-brands.facebook', 'url' => '/it/servizi/certificato-residenza', 'category' => 'anagrafe'],
            ['title' => 'Iscrizione anagrafica', 'description' => 'Iscrizione all'anagrafe della popolazione residente', 'icon' => 'heroicon-o-user-plus', 'url' => '/it/servizi/iscrizione-anagrafica', 'category' => 'anagrafe'],
            ['title' => 'Prenotazione biblioteca', 'description' => 'Prenota libri e spazi nella biblioteca comunale', 'icon' => 'heroicon-o-library', 'url' => '/it/servizi/prenotazione-biblioteca', 'category' => 'cultura'],
            ['title' => 'Asilo nido', 'description' => 'Iscrizione asilo nido comunale', 'icon' => 'heroicon-o-baby-carriage', 'url' => '/it/servizi/asilo-nido', 'category' => 'sociali'],
            ['title' => 'Permesso di sosta', 'description' => 'Richiesta permesso di sosta per veicoli', 'icon' => 'heroicon-o-truck', 'url' => '/it/servizi/permesso-sosta', 'category' => 'mobilita'],
            ['title' => 'Raccolta differenziata', 'description' => 'Informazioni sulla raccolta differenziata', 'icon' => 'heroicon-o-recycling', 'url' => '/it/servizi/raccolta-differenziata', 'category' => 'ambiente'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('tests.servizi')
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
                    <li class="breadcrumb-item active" aria-current="page">Servizi</li>
                </ol>
            </nav>
            
            {{-- Page Header --}}
            <div class="row">
                <div class="col">
                    <h1 class="title-xxxlarge mb-4">Servizi</h1>
                    <p class="lead">Tutti i servizi del Comune</p>
                </div>
            </div>
            
            {{-- Search & Filters --}}
            <div class="row mt-8">
                <div class="col-12">
                    <x-blocks.form.search :data="['placeholder' => 'Cerca servizio...']" />
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <x-blocks.filter.categories :data="[
                        'title' => 'Categorie',
                        'items' => $this->getCategories(),
                    ]" />
                </div>
            </div>
            
            {{-- Services Grid --}}
            <div class="row mt-8">
                <div class="col-12">
                    <h2 class="title-xxlarge mb-6">Servizi disponibili</h2>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($this->getServices() as $service)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-blocks.card.card :data="$service" />
                </div>
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="row mt-8">
                <div class="col-12">
                    <x-blocks.navigation.pagination :data="['items' => $this->getServices()]" />
                </div>
            </div>
        </main>
        
        {{-- Footer --}}
        <x-section slug="footer" :data="$footerData ?? []" tpl="full" />
    </div>
    @endvolt
</x-layouts.app>
