<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('home');
middleware(PageSlugMiddleware::class);

new class extends Component {

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'home';
        $this->data = [];
    }
};
?>

<x-layouts.app >
    @volt('home')
    <div class="fc-home">
    <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
    </div>
    @endvolt
</x-layouts.app>
