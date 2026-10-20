<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.index');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $this->pageSlug = $container0.'.index';
        $this->data = ['container0' => $container0];
    }
};
?>

{{--
  D20 shell sottile: mount lineare, no CmsPage/title/meta nel Component.
  data-dc sempre (Sixteen FO = Design Comuni CSS scope).
  body-page: opzionale da JSON parity_page — letto fuori @volt (mai $this lì).
--}}
@php
    $bodyPage = '';
    $cmsForParity = \Modules\Cms\Models\Page::findUniqueBySlug($container0.'.index');
    $parityPage = data_get($cmsForParity?->content_blocks, '0.data.parity_page', '');
    if (is_string($parityPage)) {
        $bodyPage = $parityPage;
    }
    $heading = $cmsForParity?->getTranslation('title', app()->getLocale(), false);
    $summary = \Themes\Sixteen\Support\PageDescription::resolve(
        $cmsForParity?->getAttribute('description'),
        app()->getLocale(),
    );
@endphp
<x-layouts.app :body-page="$bodyPage" :title="is_string($heading) ? $heading : ''" :meta-description="$summary">
    @volt('container0.index')
        <div class="page-content content" data-dc data-slug="{{ $this->pageSlug }}" data-side="content">
            <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
        </div>
    @endvolt
</x-layouts.app>
