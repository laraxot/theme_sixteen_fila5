<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('eventi.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'eventi.index';
    public array $data = [];

    public function getEvents(): array
    {
        return [
            ['title' => 'Mercatino dell\'artigianato', 'date' => '20 Mar 2026', 'location' => 'Piazza Roma', 'url' => '#'],
            ['title' => 'Concerto di primavera', 'date' => '25 Mar 2026', 'location' => 'Teatro Comunale', 'url' => '#'],
            ['title' => 'Mostra fotografica', 'date' => '30 Mar 2026', 'location' => 'Galleria d\'Arte', 'url' => '#'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('eventi.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Eventi</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Eventi</h1>
                <p class="text-lg opacity-90">Calendario degli eventi, manifestazioni e iniziative sul territorio</p>
            </div>
        </section>

        <x-section slug="eventi-hero" :data="$data" />

        {{-- Events List --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Prossimi Eventi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($this->getEvents() as $event)
                <article class="card-wrapper card-space">
                    <div class="card card-bg hover:shadow-lg transition-shadow">
                        <div class="card-body">
                            <span class="text-sm text-primary font-semibold">{{ $event['date'] }}</span>
                            <h3 class="text-xl font-semibold mt-2 mb-2">{{ $event['title'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                                <x-filament::icon icon="heroicon-o-map-pin" class="w-4 h-4 inline mr-1" />
                                {{ $event['location'] }}
                            </p>
                            <a href="{{ $event['url'] }}" class="text-primary hover:underline font-medium">
                                Scopri di più →
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </section>

        <x-section slug="eventi-content" :data="$data" />
        <x-section slug="eventi-calendar" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
