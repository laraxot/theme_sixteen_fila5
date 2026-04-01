<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('amministrazione.uffici');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $pageSlug = 'amministrazione.uffici';
    public array $data = [];

    public function getUffici(): array
    {
        return [
            ['nome' => 'Ufficio Anagrafe', 'piano' => 'Piano Terra', 'orario' => 'Lun-Ven 8:30-12:30', 'telefono' => '0123 456800'],
            ['nome' => 'Ufficio Stato Civile', 'piano' => 'Piano Terra', 'orario' => 'Lun-Ven 8:30-12:30', 'telefono' => '0123 456801'],
            ['nome' => 'Ufficio Tecnico', 'piano' => 'Primo Piano', 'orario' => 'Lun-Mer 9:00-12:00', 'telefono' => '0123 456802'],
            ['nome' => 'Ufficio Tributi', 'piano' => 'Piano Terra', 'orario' => 'Lun-Ven 8:30-12:30, Mar 14:30-16:30', 'telefono' => '0123 456803'],
            ['nome' => 'Ufficio Cultura', 'piano' => 'Secondo Piano', 'orario' => 'Lun-Ven 9:00-13:00', 'telefono' => '0123 456804'],
            ['nome' => 'Ufficio Polizia Locale', 'piano' => 'Piano Terra', 'orario' => '24h/24', 'telefono' => '0123 456805'],
        ];
    }
};
?>

<x-layouts.app>
    @volt('amministrazione.uffici')

    <nav class="bg-gray-50 dark:bg-gray-800 py-3" aria-label="Breadcrumb">
        <div class="container">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="/" class="text-primary hover:underline">Home</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="/it/amministrazione" class="text-primary hover:underline">Amministrazione</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><span class="text-gray-600 dark:text-gray-300" aria-current="page">Uffici</span></li>
            </ol>
        </div>
    </nav>

    <main class="container py-8">
        <section class="mb-8">
            <div class="bg-primary text-white rounded-lg p-8">
                <h1 class="text-3xl font-bold mb-4">Uffici Comunali</h1>
                <p class="text-lg opacity-90">Elenco degli uffici, orari di apertura e contatti</p>
            </div>
        </section>

        <x-section slug="uffici-hero" :data="$data" />

        {{-- Uffici Table --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-6">Elenco Uffici</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Ufficio</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Piano</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Orario</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold">Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($this->getUffici() as $index => $ufficio)
                        <tr class="{{ $index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-700' : 'bg-white dark:bg-gray-800' }}">
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $ufficio['nome'] }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $ufficio['piano'] }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $ufficio['orario'] }}</td>
                            <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $ufficio['telefono'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Mappa Uffici --}}
        <section class="mb-8">
            <h2 class="text-2xl font-bold mb-4">Mappa dell'Edificio</h2>
            <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded">
                        <h3 class="font-bold mb-2">Piano Terra</h3>
                        <ul class="text-sm space-y-1 text-gray-700 dark:text-gray-300">
                            <li>• Anagrafe</li>
                            <li>• Stato Civile</li>
                            <li>• Tributi</li>
                            <li>• Polizia Locale</li>
                        </ul>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded">
                        <h3 class="font-bold mb-2">Primo Piano</h3>
                        <ul class="text-sm space-y-1 text-gray-700 dark:text-gray-300">
                            <li>• Ufficio Tecnico</li>
                            <li>• Segreteria</li>
                        </ul>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded">
                        <h3 class="font-bold mb-2">Secondo Piano</h3>
                        <ul class="text-sm space-y-1 text-gray-700 dark:text-gray-300">
                            <li>• Ufficio Cultura</li>
                            <li>• Biblioteca</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <x-section slug="uffici-content" :data="$data" />
    </main>

    @endvolt
</x-layouts.app>
