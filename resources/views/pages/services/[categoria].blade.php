<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('servizi.categoria');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'servizi.categoria';
    public array $data = [];

    public function getServizi(): array
    {
        return [
            ['nome' => 'Certificato di residenza', 'descrizione' => 'Rilascio certificato di residenza', 'url' => '#'],
            ['nome' => 'Carta d\'identità', 'descrizione' => 'Rilascio e rinnovo carta d\'identità', 'url' => '#'],
            ['nome' => 'Stato di famiglia', 'descrizione' => 'Certificato stato di famiglia', 'url' => '#'],
            ['nome' => 'Codice fiscale', 'descrizione' => 'Rilascio codice fiscale', 'url' => '#'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('servizi.categoria')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/servizi" class="text-primary hover:underline">Servizi</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Categoria</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Servizi</h1>
                <p class="text-lg opacity-90">Elenco dei servizi disponibili</p>
            </div>
        </section>

        <x-section slug="servizi-hero" :data="$data" />

        {{-- Servizi List --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Servizi Disponibili</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($this->getServizi() as $servizio)
                <a href="{{ $servizio['url'] }}" class="card-wrapper">
                    <div class="card card-bg hover:shadow-lg transition-shadow">
                        <div class="card-body">
                            <h3 class="text-xl font-semibold mb-2 text-primary">{{ $servizio['nome'] }}</h3>
                            <p class="text-gray-600 dark:text-gray-300">{{ $servizio['descrizione'] }}</p>
                            <span class="inline-flex items-center gap-2 text-primary font-medium mt-4">
                                Accedi al servizio
                                <x-filament::icon icon="heroicon-o-arrow-right" class="w-4 h-4" />
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>

        <x-section slug="servizi-content" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
