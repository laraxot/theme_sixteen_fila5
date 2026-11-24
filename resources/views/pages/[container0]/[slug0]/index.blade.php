<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.view');
middleware(PageSlugMiddleware::class);

/** @see docs/folio-page-pattern.md */
new class extends Component {
    #[Locked]
    public string $container0 = '';

    #[Locked]
    public string $slug0 = '';

    #[Locked]
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    #[Locked]
    public array $data = [];

    /** @see docs/folio-page-pattern.md */
    public function mount(string $container0, string $slug0 = ''): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;
        $this->pageSlug = $container0.'.view';
        $this->data = [
            'container0' => $container0,
            'slug0' => $slug0,
            'slug' => $slug0,
        ];
    }
};
?>

<x-layouts.app>
    @volt('container0.view')
        <div class="page-content content" data-dc data-slug="{{ $this->pageSlug }}" data-side="content">
            <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
        </div>
    @endvolt
</x-layouts.app>
