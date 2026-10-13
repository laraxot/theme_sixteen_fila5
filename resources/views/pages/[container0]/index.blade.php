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

    /** Chrome Design Comuni (JSON `layout` = design-comuni*): attiva lo scope CSS di resources/css/design-comuni. */
    public bool $isDesignComuni = false;

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $this->pageSlug = $container0.'.index';
        $this->isDesignComuni = str_starts_with((string) \Modules\Cms\Models\Page::findUniqueBySlug($this->pageSlug)?->layout, 'design-comuni');
        $this->data = ['container0' => $container0];
    }
};
?>

@php
    $cmsPage = \Modules\Cms\Models\Page::findUniqueBySlug(request()->segment(2).'.index');
    $utilityPage = match ($container0) {
        'domande-frequenti' => 'faq',
        'mappa-sito' => 'sitemap',
        default => null,
    };
    // `tickets` NON e' piu' nativo: l'elenco e' la pagina CMS tickets.index (JSON + blocco), come tickets.create e tickets.confirmation
    $nativePage = in_array($container0, ['services', 'segnalazioni'], true) ? $container0 : null;
    abort_if($cmsPage === null && $utilityPage === null && $nativePage === null && $container0 !== 'lista-categorie', 404);
    $pageTitle = match (true) {
        $container0 === 'lista-categorie' => __('pub_theme::services.categories.title'),
        $utilityPage === 'faq' => __('pub_theme::faq.meta.title'),
        $utilityPage === 'sitemap' => __('pub_theme::sitemap.meta.title'),
        $nativePage === 'services' => __('pub_theme::services.meta.title'),
        $nativePage === 'segnalazioni' => __('pub_theme::segnalazione.elenco.title'),
        default => $cmsPage?->getTranslation('title', app()->getLocale(), false) ?? config('app.name'),
    };
    $pageDescription = match (true) {
        $container0 === 'lista-categorie' => __('pub_theme::services.categories.subtitle'),
        $utilityPage === 'faq' => __('pub_theme::faq.meta.description'),
        $utilityPage === 'sitemap' => __('pub_theme::sitemap.meta.description'),
        $nativePage === 'services' => __('pub_theme::services.meta.description'),
        $nativePage === 'segnalazioni' => __('pub_theme::segnalazione.elenco.subtitle', ['count' => 73]),
        default => $cmsPage?->getAttribute('description') ?? '',
    };
    // `layout` del JSON: `test` (chrome v1), `design-comuni*` (chrome Design Comuni, asset relativi e voce di menu dal JSON), altrimenti `app`
    $jsonLayout = $cmsPage?->getAttribute('layout') ?? 'app';
    $isDesignComuni = str_starts_with($jsonLayout, 'design-comuni');
    $isDesignComuni && view()->share('dcRelativeAssets', true);
    $headerActive = $isDesignComuni ? (string) data_get($cmsPage?->content_blocks, '0.data.header_active', '') : '';
    $layoutComponent = $jsonLayout === 'test'
        ? 'layouts.test'
        : ($isDesignComuni ? 'layouts.'.$jsonLayout : 'layouts.app');
    $isNativeOrUtility = $nativePage !== null || $utilityPage !== null || $container0 === 'lista-categorie';
@endphp
<x-dynamic-component :component="$layoutComponent" :title="$pageTitle" :meta-description="$pageDescription" :header-active="$headerActive">
    @if ($isNativeOrUtility)
    <div class="page-content content" data-slug="{{ request()->segment(2).'.index' }}" data-side="content">
        @if ($nativePage === 'services')
            @include('pub_theme::components.pages.services')
        @elseif ($nativePage === 'segnalazioni')
            @include('pub_theme::components.pages.segnalazioni')
        @elseif ($container0 === 'lista-categorie')
            @include('pub_theme::components.pages.categories')
        @elseif ($container0 === 'domande-frequenti')
            @include('pub_theme::components.pages.faq')
        @elseif ($container0 === 'mappa-sito')
            @include('pub_theme::components.pages.sitemap')
        @endif
    </div>
    @else
        {{-- Il div.page-content e' la radice del componente Volt (vedi pages/[container0]/[slug0]/index.blade.php) --}}
        @volt('container0.index')
            <div class="page-content content"{!! $this->isDesignComuni ? ' data-dc' : '' !!} data-slug="{{ $this->container0.'.index' }}" data-side="content">
                <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
            </div>
        @endvolt
    @endif
</x-dynamic-component>
