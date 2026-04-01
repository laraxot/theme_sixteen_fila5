<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('ambiente.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'ambiente.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('ambiente.index')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Ambiente</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Ambiente</h1>
                <p class="text-lg opacity-90">Rifiuti, verde pubblico e sostenibilità ambientale</p>
            </div>
        </section>

        <x-section slug="ambiente-hero" :data="$data" />
        <x-section slug="ambiente-content" :data="$data" />

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <a href="/it/ambiente/rifiuti" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Rifiuti e Riciclo</h3>
                        <p class="text-gray-600 dark:text-gray-300">Raccolta differenziata e calendari</p>
                    </div>
                </div>
            </a>
            <a href="/it/ambiente/verde" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Verde Pubblico</h3>
                        <p class="text-gray-600 dark:text-gray-300">Parchi, giardini e aree verdi</p>
                    </div>
                </div>
            </a>
            <a href="/it/ambiente/sostenibilita" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">Sostenibilità</h3>
                        <p class="text-gray-600 dark:text-gray-300">Progetti green e mobilità sostenibile</p>
                    </div>
                </div>
            </a>
        </section>

        <x-section slug="ambiente-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
