<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('lavoro.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'lavoro.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('lavoro.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Lavoro</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Lavoro</h1>
                <p class="text-lg opacity-90">Orientamento, formazione e opportunità di lavoro</p>
            </div>
        </section>

        <x-section slug="lavoro-hero" :data="$data" />
        <x-section slug="lavoro-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/lavoro/orientamento" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Orientamento</h3>
                        <p class="text-gray-600 dark:text-gray-300">Consulenza e supporto alla carriera</p>
                    </div>
                </div>
            </a>
            <a href="/it/lavoro/formazione" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Formazione</h3>
                        <p class="text-gray-600 dark:text-gray-300">Corsi di formazione professionale</p>
                    </div>
                </div>
            </a>
            <a href="/it/lavoro/offerte" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Offerte di Lavoro</h3>
                        <p class="text-gray-600 dark:text-gray-300">Opportunità nel territorio</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="lavoro-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
