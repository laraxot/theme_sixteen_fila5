<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('cultura.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'cultura.index';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('cultura.index')

    {{-- Breadcrumb --}}
    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Cultura</span></li>
            </ol>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container py-8">
        {{-- Hero Section --}}
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Cultura</h1>
                <p class="text-lg opacity-90">Eventi, biblioteche, musei e iniziative culturali del territorio</p>
            </div>
        </section>

        {{-- CMS Sections --}}
        <x-section slug="cultura-hero" :data="$data" />
        <x-section slug="cultura-content" :data="$data" />
        <x-section slug="cultura-events" :data="$data" />
        <x-section slug="cultura-services" :data="$data" />

        {{-- Featured Content --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            {{-- Biblioteche --}}
            <a href="/it/cultura/biblioteche" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-3">
                            <x-filament::icon icon="heroicon-ui-brands.facebook" class="w-6 h-6 text-primary" />
                            <h3 class="text-xl font-semibold">Biblioteche</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">Orari, servizi e catalogo delle biblioteche comunali</p>
                    </div>
                </div>
            </a>

            {{-- Musei --}}
            <a href="/it/cultura/musei" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-3">
                            <x-filament::icon icon="heroicon-ui-brands.instagram" class="w-6 h-6 text-primary" />
                            <h3 class="text-xl font-semibold">Musei</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">Collezioni, mostre e percorsi espositivi</p>
                    </div>
                </div>
            </a>

            {{-- Teatri --}}
            <a href="/it/cultura/teatri" class="card-wrapper">
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <div class="flex items-center gap-3 mb-3">
                            <x-filament::icon icon="heroicon-ui-brands.youtube" class="w-6 h-6 text-primary" />
                            <h3 class="text-xl font-semibold">Teatri</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">Stagioni teatrali, concerti e spettacoli</p>
                    </div>
                </div>
            </a>
        </section>

        {{-- Latest News --}}
        <x-section slug="cultura-news" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
