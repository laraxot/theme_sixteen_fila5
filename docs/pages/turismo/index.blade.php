<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('turismo.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'turismo.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('turismo.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Turismo</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Turismo</h1>
                <p class="text-lg opacity-90">Scopri il territorio, le bellezze artistiche e le tradizioni locali</p>
            </div>
        </section>

        <x-section slug="turismo-hero" :data="$data" />
        <x-section slug="turismo-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/turismo/luoghi" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Luoghi di Interesse</h3>
                        <p class="text-gray-600 dark:text-gray-300">Monumenti, chiese e palazzi storici</p>
                    </div>
                </div>
            </a>
            <a href="/it/turismo/itinerari" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Itinerari</h3>
                        <p class="text-gray-600 dark:text-gray-300">Percorsi turistici e tematici</p>
                    </div>
                </div>
            </a>
            <a href="/it/turismo/ricettivita" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Ricettività</h3>
                        <p class="text-gray-600 dark:text-gray-300">Hotel, B&B e agriturismi</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="turismo-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
