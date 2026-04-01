<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('sport.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'sport.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('sport.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Sport</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Sport</h1>
                <p class="text-lg opacity-90">Impianti, eventi sportivi e attività per il benessere fisico</p>
            </div>
        </section>

        <x-section slug="sport-hero" :data="$data" />
        <x-section slug="sport-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/sport/impianti" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Impianti Sportivi</h3>
                        <p class="text-gray-600 dark:text-gray-300">Palestre, piscine e campi da gioco</p>
                    </div>
                </div>
            </a>
            <a href="/it/sport/corsi" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Corsi e Attività</h3>
                        <p class="text-gray-600 dark:text-gray-300">Corsi organizzati dal comune</p>
                    </div>
                </div>
            </a>
            <a href="/it/sport/eventi" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Eventi Sportivi</h3>
                        <p class="text-gray-600 dark:text-gray-300">Gare, tornei e manifestazioni</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="sport-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
