<?php

declare(strict_types=1);

use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;

name('tests.view');
middleware(PageSlugMiddleware::class);

new class extends Component
{
    public string $slug = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $slug = ''): void
    {
        $this->slug = $slug;
        $this->pageSlug = $slug ? 'tests.'.$slug : 'tests.index';
        $this->data = ['slug' => $slug];
    }
};
?>

{{-- Layout dal JSON (`layout`): `design-comuni-bare` per i cataloghi senza header/footer (servizi/index.html), altrimenti il chrome completo. --}}
<x-dynamic-component :component="\Modules\Cms\Models\Page::findUniqueBySlug('tests.'.$slug)?->layout === 'design-comuni-bare' ? 'layouts.design-comuni-bare' : 'layouts.design-comuni'">
    @volt('tests.view')
    <div class="page-content content" data-slug="{{ $pageSlug }}" data-side="content">
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-dynamic-component>
