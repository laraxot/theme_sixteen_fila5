<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('famiglia.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'famiglia.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('famiglia.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Famiglia</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Famiglia</h1>
                <p class="text-lg opacity-90">Servizi educativi, sostegni alla famiglia e politiche sociali</p>
            </div>
        </section>

        <x-section slug="famiglia-hero" :data="$data" />
        <x-section slug="famiglia-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/famiglia/servizi-educativi" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Servizi Educativi</h3>
                        <p class="text-gray-600 dark:text-gray-300">Asili nido e scuole dell'infanzia</p>
                    </div>
                </div>
            </a>
            <a href="/it/famiglia/sostegni" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Sostegni Economici</h3>
                        <p class="text-gray-600 dark:text-gray-300">Bonus e contributi per le famiglie</p>
                    </div>
                </div>
            </a>
            <a href="/it/famiglia/tempo-libero" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Tempo Libero</h3>
                        <p class="text-gray-600 dark:text-gray-300">Attività per bambini e ragazzi</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="famiglia-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
