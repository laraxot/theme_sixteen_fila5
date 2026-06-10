<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Actions\ResolvePageAction;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tickets.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $slug = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $slug = ''): void
    {
        $this->slug = $slug;

        $resolved = app(ResolvePageAction::class)->execute('tickets', $slug);

        $this->pageSlug = $resolved->pageSlug;

        $this->data = [
            'container0' => 'tickets',
            'slug0' => $slug,
            'slug' => $slug,
            'item' => $resolved->item,
        ];
    }
};
?>

<x-layouts.app>
    @volt('tickets.view')
    <div class="page-content content" data-slug="{{ $this->pageSlug }}" data-side="content">
        <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
    </div>
    @endvolt
</x-layouts.app>
