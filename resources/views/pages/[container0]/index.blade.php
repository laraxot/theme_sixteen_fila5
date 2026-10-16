<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Modules\Cms\Models\Page;

name('container0.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';

    public string $pageSlug = '';

    /** Attiva CSS `body:has(.page-content[data-dc])` se JSON `layout` = design-comuni*. */
    public bool $isDesignComuni = false;

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $this->pageSlug = $container0.'.index';
        $this->data = ['container0' => $container0];
        $layout = (string) (Page::findUniqueBySlug($this->pageSlug)?->layout ?? '');
        $this->isDesignComuni = str_starts_with($layout, 'design-comuni');
    }
};
?>

{{-- body-page fuori da @volt: $this non esiste nel contesto Folio esterno. --}}
@php
    $cmsIndex = Page::findUniqueBySlug($container0.'.index');
    $parityPage = data_get($cmsIndex?->content_blocks, '0.data.parity_page', '');
    $bodyPage = is_string($parityPage) ? $parityPage : '';
@endphp
<x-layouts.app :body-page="$bodyPage">
    @volt('container0.index')
        <div class="page-content content" @if ($isDesignComuni) data-dc @endif data-slug="{{ $pageSlug }}" data-side="content">
            <x-page side="content" :slug="$pageSlug" :data="$data" />
        </div>
    @endvolt
</x-layouts.app>
