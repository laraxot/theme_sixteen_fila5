<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.eventi');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'tests.eventi';
    public array $data = [];
    
    public function getCategories(): array
    {
        return [
            ['label' => 'Tutti', 'value' => '', 'icon' => 'heroicon-o-calendar'],
            ['label' => 'Cultura', 'value' => 'cultura', 'icon' => 'heroicon-o-book-open'],
            ['label' => 'Sport', 'value' => 'sport', 'icon' => 'heroicon-o-trophy'],
            ['label' => 'Bambini', 'value' => 'bambini', 'icon' => 'heroicon-o-face-smile'],
            ['label' => 'Musica', 'value' => 'musica', 'icon' => 'heroicon-o-musical-note'],
        ];
    }
    
    public function getEvents(): array
    {
        return [
            ['title' => 'Mostra d'arte contemporanea', 'description' => 'Esposizione di opere d'arte contemporanea', 'date' => '2026-04-15', 'time' => '10:00 - 18:00', 'location' => 'Palazzo delle Arti', 'icon' => 'heroicon-o-paint-brush', 'url' => '/it/eventi/mostra-arte', 'category' => 'cultura'],
            ['title' => 'Torneo di calcio giovanile', 'description' => 'Torneo di calcio per ragazzi 12-16 anni', 'date' => '2026-04-20', 'time' => '14:00 - 18:00', 'location' => 'Stadio Comunale', 'icon' => 'heroicon-o-trophy', 'url' => '/it/eventi/torneo-calcio', 'category' => 'sport'],
            ['title' => 'Laboratorio creativo per bambini', 'description' => 'Attività creative per bambini 5-10 anni', 'date' => '2026-04-22', 'time' => '15:00 - 17:00', 'location' => 'Biblioteca Comunale', 'icon' => 'heroicon-o-face-smile', 'url' => '/it/eventi/laboratorio-bambini', 'category' => 'bambini'],
            ['title' => 'Concerto di primavera', 'description' => 'Concerto dell'orchestra sinfonica', 'date' => '2026-04-25', 'time' => '21:00', 'location' => 'Teatro Comunale', 'icon' => 'heroicon-o-musical-note', 'url' => '/it/eventi/concerto-primavera', 'category' => 'musica'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('tests.eventi')
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
                    <li class="breadcrumb-item active" aria-current="page">Eventi</li>
                </ol>
            </nav>
            
            {{-- Page Header --}}
            <div class="row">
                <div class="col">
                    <h1 class="title-xxxlarge mb-4">Eventi</h1>
                    <p class="lead">Tutti gli eventi del Comune</p>
                </div>
            </div>
            
            {{-- Filters --}}
            <div class="row mt-8">
                <div class="col-12">
                    <x-blocks.filter.categories :data="[
                        'title' => 'Categorie',
                        'items' => $this->getCategories(),
                    ]" />
                </div>
            </div>
            
            {{-- Events Grid --}}
            <div class="row mt-8">
                <div class="col-12">
                    <h2 class="title-xxlarge mb-6">Prossimi eventi</h2>
                </div>
            </div>
            
            <div class="row g-4">
                @foreach($this->getEvents() as $event)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-blocks.card.card :data="$event" />
                </div>
                @endforeach
            </div>
            
            {{-- Pagination --}}
            <div class="row mt-8">
                <div class="col-12">
                    <x-blocks.navigation.pagination :data="['items' => $this->getEvents()]" />
                </div>
            </div>
        </main>
        
        {{-- Footer --}}
        <x-section slug="footer" :data="$footerData ?? []" tpl="full" />
    </div>
    @endvolt
</x-layouts.app>
