<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('amministrazione.aree');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'amministrazione.aree';
    public array $data = [];

    public function getAree(): array
    {
        return [
            ['nome' => 'Area Amministrativa', 'responsabile' => 'Dr. Mario Rossi', 'email' => 'amministrativa@comune.fixcity.it', 'telefono' => '0123 456789'],
            ['nome' => 'Area Tecnica', 'responsabile' => 'Ing. Luca Bianchi', 'email' => 'tecnica@comune.fixcity.it', 'telefono' => '0123 456790'],
            ['nome' => 'Area Sociale', 'responsabile' => 'Dr.ssa Anna Verdi', 'email' => 'sociale@comune.fixcity.it', 'telefono' => '0123 456791'],
            ['nome' => 'Area Culturale', 'responsabile' => 'Dr. Giuseppe Neri', 'email' => 'cultura@comune.fixcity.it', 'telefono' => '0123 456792'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('amministrazione.aree')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/amministrazione" class="text-primary hover:underline">Amministrazione</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Aree Amministrative</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Aree Amministrative</h1>
                <p class="text-lg opacity-90">Organizzazione e competenze delle aree amministrative comunali</p>
            </div>
        </section>

        <x-section slug="aree-hero" :data="$data" />

        {{-- Aree List --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Elenco Aree</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($this->getAree() as $area)
                <div class="card card-bg hover:shadow-lg transition-shadow">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-3 text-primary">{{ $area['nome'] }}</h3>
                        <dl class="space-y-2 text-sm">
                            <div>
                                <dt class="font-semibold text-gray-700 dark:text-gray-300">Responsabile</dt>
                                <dd class="text-gray-900 dark:text-white">{{ $area['responsabile'] }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-700 dark:text-gray-300">Email</dt>
                                <dd>
                                    <a href="mailto:{{ $area['email'] }}" class="text-primary hover:underline">
                                        {{ $area['email'] }}
                                    </a>
                                </dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-700 dark:text-gray-300">Telefono</dt>
                                <dd class="text-gray-900 dark:text-white">{{ $area['telefono'] }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <x-section slug="aree-content" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
