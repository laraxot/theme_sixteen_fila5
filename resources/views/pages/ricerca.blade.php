<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('ricerca.search');
middleware('web');

new class extends \Livewire\Volt\Component {
    public string $q = '';

    public function mount(): void
    {
        $this->q = (string) request()->query('q', '');
    }

    public function render(): \Illuminate\View\View
    {
        return view('components.blocks.search-results.design-comuni', [
            'data' => [
                'query' => $this->q,
                'results' => [
                    'items' => [],
                    'count' => 0,
                    'load_more_label' => 'Carica altri risultati',
                    'count_label' => 'Risultati',
                ],
                'filters' => ['groups' => []],
                'feedback' => ['title' => 'Quanto sono chiare le informazioni?', 'thanks' => 'Grazie!'],
                'contacts' => ['main' => ['title' => 'Contatta il comune']],
                'search' => ['label' => 'Cerca', 'button' => 'Cerca'],
                'home_url' => route('home'),
            ],
        ]);
    }
};