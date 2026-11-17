<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('cms.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container = '';
    public string $slug = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container, string $slug = ''): void
    {
        $this->container = $container;
        $this->slug = $slug;
        
        // Build pageSlug: {container}.{slug} or just {container} for index
        $this->pageSlug = $slug ? $container.'.'.$slug : $container;
        
        $this->data = [
            'container' => $container,
            'slug' => $slug,
        ];
    }
};
?>

<x-layouts.app>
    @volt('cms.view')
    {{-- Single root wrapper for Livewire --}}
    <div class="cms-view-wrapper">
        @php
            // Load blocks from CMS Page model
            $blocks = \Modules\Cms\Models\Page::getBlocksBySlug($this->pageSlug, 'content');
        @endphp

        {{-- Main Content - Page-specific content only --}}
        <div class="page-content content" data-slug="{{ $this->pageSlug }}" data-side="content">
            @foreach($blocks as $block)
                @include($block->view, array_merge(['data' => []], $block->data))
            @endforeach
        </div>
    </div>
    @endvolt
</x-layouts.app>
