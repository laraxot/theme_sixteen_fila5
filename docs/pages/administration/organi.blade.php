<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('amministrazione.organi');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'amministrazione.organi';
    public array $data = [];

    public function getOrgani(): array
    {
        return [
            ['nome' => 'Sindaco', 'nome_completo' => 'Mario Rossi', 'email' => 'sindaco@comune.fixcity.it'],
            ['nome' => 'Vicesindaco', 'nome_completo' => 'Luca Bianchi', 'email' => 'vicesindaco@comune.fixcity.it'],
            ['nome' => 'Assessore alla Cultura', 'nome_completo' => 'Anna Verdi', 'email' => 'cultura@comune.fixcity.it'],
            ['nome' => 'Assessore al Bilancio', 'nome_completo' => 'Giuseppe Neri', 'email' => 'bilancio@comune.fixcity.it'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('amministrazione.organi')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/amministrazione" class="text-primary hover:underline">Amministrazione</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Organi di Governo</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Organi di Governo</h1>
                <p class="text-lg opacity-90">Giunta comunale, consiglio comunale e organi istituzionali</p>
            </div>
        </section>

        <x-section slug="organi-hero" :data="$data" />

        {{-- Organi List --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Giunta Comunale</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($this->getOrgani() as $organo)
                <div class="card card-bg">
                    <div class="card-body">
                        <h3 class="text-xl font-semibold mb-2">{{ $organo['nome'] }}</h3>
                        <p class="text-gray-800 dark:text-gray-200 font-medium mb-2">{{ $organo['nome_completo'] }}</p>
                        <a href="mailto:{{ $organo['email'] }}" class="text-primary hover:underline text-sm">
                            <x-filament::icon icon="heroicon-o-envelope" class="w-4 h-4 inline mr-1" />
                            {{ $organo['email'] }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <x-section slug="organi-content" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
