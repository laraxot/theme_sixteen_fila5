<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('tests.design-comuni.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $slug = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->pageSlug = 'tests.'.$slug;
        $this->data = [
            'slug' => $slug
        ];
    }
};

?>

<x-layouts.design-comuni>
    @volt('tests.design-comuni.view')
    <x-page side="content" :slug="$pageSlug" :data="$data" />
    @endvolt
</x-layouts.design-comuni>