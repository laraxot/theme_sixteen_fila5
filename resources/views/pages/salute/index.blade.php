<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('salute.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'salute.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('salute.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Salute</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Salute</h1>
                <p class="text-lg opacity-90">Servizi sanitari, prevenzione e benessere</p>
            </div>
        </section>

        <x-section slug="salute-hero" :data="$data" />
        <x-section slug="salute-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/salute/servizi-sanitari" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Servizi Sanitari</h3>
                        <p class="text-gray-600 dark:text-gray-300">Ospedali, ASL e farmacie</p>
                    </div>
                </div>
            </a>
            <a href="/it/salute/prevenzione" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Prevenzione</h3>
                        <p class="text-gray-600 dark:text-gray-300">Campagne di screening e vaccinazioni</p>
                    </div>
                </div>
            </a>
            <a href="/it/salute/benessere" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Benessere</h3>
                        <p class="text-gray-600 dark:text-gray-300">Attività per la salute e lo sport</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="salute-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
