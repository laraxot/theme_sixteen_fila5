<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('mobilita.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'mobilita.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('mobilita.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Mobilità</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Mobilità</h1>
                <p class="text-lg opacity-90">Trasporti, traffico, parcheggi e mobilità sostenibile</p>
            </div>
        </section>

        <x-section slug="mobilita-hero" :data="$data" />
        <x-section slug="mobilita-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/mobilita/trasporti" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Trasporti Pubblici</h3>
                        <p class="text-gray-600 dark:text-gray-300">Linee, orari e abbonamenti</p>
                    </div>
                </div>
            </a>
            <a href="/it/mobilita/parcheggi" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Parcheggi</h3>
                        <p class="text-gray-600 dark:text-gray-300">Parcheggi scambiatori e strisce blu</p>
                    </div>
                </div>
            </a>
            <a href="/it/mobilita/traffico" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Traffico e ZTL</h3>
                        <p class="text-gray-600 dark:text-gray-300">Limitazioni e permessi di accesso</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="mobilita-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
