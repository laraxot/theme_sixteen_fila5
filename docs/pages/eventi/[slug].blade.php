<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('eventi.slug');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'eventi.slug';
    public array $data = [];
};
?>

<x-layouts.app>
    @volt('eventi.slug')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/eventi" class="text-primary hover:underline">Eventi</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Dettaglio</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <article class="max-w-4xl mx-auto">
            {{-- Hero --}}
            <div class="bg-primary text-white rounded-lg p-8 mb-8">
                <h1 class="text-4xl font-bold mb-4">Nome dell'Evento</h1>
                <div class="flex flex-wrap gap-6 text-lg">
                    <span class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-calendar" class="w-6 h-6" />
                        20 Marzo 2026
                    </span>
                    <span class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-clock" class="w-6 h-6" />
                        15:00 - 18:00
                    </span>
                    <span class="flex items-center gap-2">
                        <x-filament::icon icon="heroicon-o-map-pin" class="w-6 h-6" />
                        Piazza Roma
                    </span>
                </div>
            </div>

            {{-- Image --}}
            <div class="mb-8">
                <img src="/images/event-placeholder.jpg" alt="Immagine evento" class="w-full h-96 object-cover rounded-lg" />
            </div>

            {{-- Info Box --}}
            <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-6 mb-8">
                <h2 class="text-2xl font-bold mb-4">Informazioni</h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <dt class="font-semibold text-gray-700 dark:text-gray-300">Data</dt>
                        <dd class="text-gray-900 dark:text-white">20 Marzo 2026</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-700 dark:text-gray-300">Orario</dt>
                        <dd class="text-gray-900 dark:text-white">15:00 - 18:00</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-700 dark:text-gray-300">Luogo</dt>
                        <dd class="text-gray-900 dark:text-white">Piazza Roma, FixCity</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-gray-700 dark:text-gray-300">Costo</dt>
                        <dd class="text-gray-900 dark:text-white">Gratuito</dd>
                    </div>
                </dl>
            </div>

            {{-- Description --}}
            <div class="prose prose-lg dark:prose-invert max-w-none mb-8">
                <h2 class="text-2xl font-bold mb-4">Descrizione</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <h3 class="text-xl font-bold mt-6 mb-3">Programma</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 dark:text-gray-300">
                    <li>15:00 - Apertura evento</li>
                    <li>16:00 - Intervento ospiti</li>
                    <li>17:00 - Intrattenimento</li>
                    <li>18:00 - Chiusura</li>
                </ul>
            </div>

            {{-- CTA --}}
            <div class="flex gap-4">
                <a href="#" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary-dark transition-colors font-semibold">
                    <x-filament::icon icon="heroicon-o-ticket" class="w-5 h-5" />
                    Prenota Ora
                </a>
                <a href="#" class="inline-flex items-center gap-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white px-6 py-3 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors font-semibold">
                    <x-filament::icon icon="heroicon-o-share" class="w-5 h-5" />
                    Condividi
                </a>
            </div>
        </article>

        <x-section slug="eventi-correlati" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
