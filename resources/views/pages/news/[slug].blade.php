<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('novita.slug');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'novita.slug';
    public array $data = [];

    public function getRelatedNews(): array
    {
        return [
            ['title' => 'Nuovo orario uffici comunali', 'date' => '15 Mar 2026', 'url' => '#'],
            ['title' => 'Bandi pubblicati', 'date' => '10 Mar 2026', 'url' => '#'],
            ['title' => 'Eventi di primavera', 'date' => '5 Mar 2026', 'url' => '#'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('novita.slug')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/novita" class="text-primary hover:underline">Novità</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Dettaglio</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <article class="max-w-4xl mx-auto">
            {{-- Header --}}
            <header class="mb-8">
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-calendar" class="w-4 h-4" />
                        {{ date('d M Y') }}
                    </span>
                    <span class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-tag" class="w-4 h-4" />
                        Categoria
                    </span>
                </div>
                <h1 class="text-4xl font-bold mb-4 text-gray-900 dark:text-white">Titolo della Notizia</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300">Sottotitolo e anticipazione del contenuto</p>
            </header>

            {{-- Featured Image --}}
            <div class="mb-8">
                <img src="/images/news-placeholder.jpg" alt="Immagine notizia" class="w-full h-96 object-cover rounded-lg" />
                <p class="text-sm text-gray-500 mt-2">Didascalia immagine</p>
            </div>

            {{-- Content --}}
            <div class="prose prose-lg dark:prose-invert max-w-none mb-8">
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                </p>
                <h2 class="text-2xl font-bold mt-8 mb-4">Dettagli</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>

            {{-- Share --}}
            <div class="border-t pt-6 mb-8">
                <h3 class="text-lg font-semibold mb-4">Condividi</h3>
                <div class="flex gap-3">
                    <a href="#" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700" aria-label="Condividi su Facebook">
                        <x-filament::icon icon="heroicon-ui-brands.facebook" class="w-5 h-5" />
                    </a>
                    <a href="#" class="p-2 bg-sky-500 text-white rounded hover:bg-sky-600" aria-label="Condividi su Twitter">
                        <x-filament::icon icon="heroicon-ui-brands.twitter" class="w-5 h-5" />
                    </a>
                    <a href="#" class="p-2 bg-pink-600 text-white rounded hover:bg-pink-700" aria-label="Condividi su Instagram">
                        <x-filament::icon icon="heroicon-ui-brands.instagram" class="w-5 h-5" />
                    </a>
                </div>
            </div>

            {{-- Related News --}}
            <aside class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                <h3 class="text-2xl font-bold mb-4">Notizie Correlate</h3>
                <ul class="space-y-4">
                    @foreach($this->getRelatedNews() as $news)
                    <li>
                        <a href="{{ $news['url'] }}" class="flex items-start gap-3 hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded transition-colors">
                            <x-filament::icon icon="heroicon-o-document-text" class="w-5 h-5 text-primary mt-1" />
                            <div>
                                <h4 class="font-semibold text-gray-900 dark:text-white">{{ $news['title'] }}</h4>
                                <p class="text-sm text-gray-500">{{ $news['date'] }}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </aside>
        </article>

        <x-section slug="novita-footer" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
