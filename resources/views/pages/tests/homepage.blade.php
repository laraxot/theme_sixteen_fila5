<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.homepage');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'tests.homepage';
    public array $data = [];

    public function getFeaturedServices(): array
    {
        return [
            ['title' => 'Anagrafe', 'description' => 'Servizi demografici e stato civile', 'url' => '#', 'icon' => 'it-user'],
            ['title' => 'Cultura', 'description' => 'Eventi, biblioteche e musei', 'url' => '#', 'icon' => 'it-camera'],
            ['title' => 'Servizi sociali', 'description' => 'Assistenza e sostegno alla persona', 'url' => '#', 'icon' => 'it-users'],
            ['title' => 'Mobilità', 'description' => 'Trasporti, traffico e parcheggi', 'url' => '#', 'icon' => 'it-bus'],
            ['title' => 'Ambiente', 'description' => 'Rifiuti, verde pubblico e sostenibilità', 'url' => '#', 'icon' => 'it-leaf'],
            ['title' => 'Polizia locale', 'description' => 'Sicurezza e ordinanze comunali', 'url' => '#', 'icon' => 'it-shield'],
        ];
    }

    public function getLatestNews(): array
    {
        return [
            ['title' => 'Nuovo orario uffici comunali', 'excerpt' => 'Dal 1 aprile 2026 il nuovo orario di apertura al pubblico degli uffici comunali.', 'date' => '15 Mar 2026', 'url' => '#'],
            ['title' => 'Bandi pubblicati', 'excerpt' => 'Disponibili i nuovi bandi per contributi alle associazioni sportive.', 'date' => '10 Mar 2026', 'url' => '#'],
            ['title' => 'Eventi di primavera', 'excerpt' => 'Calendario completo degli eventi primaverili in programma.', 'date' => '5 Mar 2026', 'url' => '#'],
        ];
    }

    public function getEvents(): array
    {
        return [
            ['title' => 'Mercatino dell\'artigianato', 'description' => 'Piazza Roma - Esposizione e vendita prodotti artigianali.', 'date' => '20 Mar 2026', 'url' => '#'],
            ['title' => 'Concerto di primavera', 'description' => 'Teatro comunale - Orchestra sinfonica.', 'date' => '25 Mar 2026', 'url' => '#'],
            ['title' => 'Mostra fotografica', 'description' => 'Galleria d\'arte - Fotografie del territorio.', 'date' => '30 Mar 2026', 'url' => '#'],
        ];
    }

    public function getTopics(): array
    {
        return [
            ['title' => 'Cultura', 'description' => 'Eventi e informazioni culturali', 'url' => '/it/cultura', 'icon' => 'it-camera'],
            ['title' => 'Sport', 'description' => 'Impianti e attività sportive', 'url' => '/it/sport', 'icon' => 'it-bicycle'],
            ['title' => 'Famiglia', 'description' => 'Servizi educativi e sostegni', 'url' => '/it/famiglia', 'icon' => 'it-users'],
            ['title' => 'Lavoro', 'description' => 'Orientamento e opportunità', 'url' => '/it/lavoro', 'icon' => 'it-briefcase'],
            ['title' => 'Ambiente', 'description' => 'Qualità ambientale e monitoraggi', 'url' => '/it/ambiente', 'icon' => 'it-leaf'],
            ['title' => 'Mobilità', 'description' => 'Linee, orari e servizi', 'url' => '/it/mobilita', 'icon' => 'it-bus'],
            ['title' => 'Turismo', 'description' => 'Scopri il territorio', 'url' => '/it/turismo', 'icon' => 'it-map'],
            ['title' => 'Salute', 'description' => 'Servizi sanitari e benessere', 'url' => '/it/salute', 'icon' => 'it-health'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('tests.homepage')
    <div>
        {{-- Skip Links --}}
        <a class="skiplinks" href="#main">Vai al contenuto principale</a>

        {{-- Header --}}
        <x-section slug="header" :data="$headerData ?? []" />

        {{-- Main Content --}}
        <main class="container" id="main">
        {{-- Hero Section --}}
        <section class="hero-section py-12">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="title-xxxlarge mb-4">{{ $this->data['site_name'] ?? 'Nome del Comune' }}</h1>
                        <p class="lead">{{ $this->data['welcome_text'] ?? 'Benvenuto nel sito del Comune di Example' }}</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="featured-services py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Servizi in evidenza</h2>
                <div class="row g-4">
                    @foreach($this->getFeaturedServices() as $service)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ $service['title'] }}
                                    </h3>
                                    <p class="card-text">{{ $service['description'] }}</p>
                                    <a href="{{ $service['url'] }}" class="read-more">
                                        <span class="text">Leggi di più</span>
                                        <x-filament::icon icon="heroicon-o-arrow-right" class="icon icon-sm" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Latest News --}}
        <section class="latest-news py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Ultime notizie</h2>
                <div class="row g-4">
                    @foreach($this->getLatestNews() as $news)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">{{ $news['date'] }}</span>
                                    <h3 class="card-title">{{ $news['title'] }}</h3>
                                    <p class="card-text">{{ $news['excerpt'] }}</p>
                                    <a href="{{ $news['url'] }}" class="read-more">
                                        <span class="text">Leggi di più</span>
                                        <x-filament::icon icon="heroicon-o-arrow-right" class="icon icon-sm" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Events --}}
        <section class="events py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Eventi</h2>
                <div class="row g-4">
                    @foreach($this->getEvents() as $event)
                    <div class="col-12 col-md-6 col-lg-4">
                        <article class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <span class="card-date">{{ $event['date'] }}</span>
                                    <h3 class="card-title">{{ $event['title'] }}</h3>
                                    <p class="card-text">{{ $event['description'] }}</p>
                                    <a href="{{ $event['url'] }}" class="read-more">
                                        <span class="text">Scopri di più</span>
                                        <x-filament::icon icon="heroicon-o-arrow-right" class="icon icon-sm" />
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        
        {{-- Topics Grid --}}
        <section class="topics py-8">
            <div class="container">
                <h2 class="title-xxlarge mb-6">Esplora per argomento</h2>
                <div class="row g-4">
                    @foreach($this->getTopics() as $topic)
                    <div class="col-12 col-md-6">
                        <div class="card-wrapper card-space">
                            <div class="card card-bg">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ $topic['title'] }}
                                    </h3>
                                    <p class="card-text">{{ $topic['description'] }}</p>
                                    <a href="{{ $topic['url'] }}" class="read-more">
                                        <span class="text">Esplora</span>
                                        <x-filament::icon icon="heroicon-o-arrow-right" class="icon icon-sm" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    
    {{-- Footer --}}
    <x-section slug="footer" :data="$footerData ?? []" tpl="full" />
    </div>
    @endvolt
</x-layouts.app>
