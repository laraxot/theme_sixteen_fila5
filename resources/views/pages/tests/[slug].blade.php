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

{{-- Layout dal JSON (`layout`): `design-comuni-bare` (cataloghi senza header/footer: servizi/index.html), `design-comuni-authenticated` (header con utente), altrimenti il chrome completo. --}}
@php
    $jsonPage = \Modules\Cms\Models\Page::findUniqueBySlug('tests.'.$slug);
    $jsonLayout = $jsonPage?->layout;
    $headerActive = (string) data_get($jsonPage?->content_blocks, '0.data.header_active', '');
    view()->share('dcRelativeAssets', true);
    $chrome = in_array($jsonLayout, ['design-comuni-bare', 'design-comuni-authenticated'], true) ? $jsonLayout : 'design-comuni';
@endphp
<x-dynamic-component :component="'layouts.'.$chrome" :header-active="$headerActive">
    @volt('tests.view')
    <div class="page-content content" data-dc data-slug="{{ $pageSlug }}" data-side="content">
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-dynamic-component>
