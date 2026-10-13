<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Actions\ResolvePageAction;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('container0.view');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $slug0 = '';

    public string $pageSlug = '';

    /** Chrome Design Comuni (JSON `layout` = design-comuni*): attiva lo scope CSS di resources/css/design-comuni. */
    public bool $isDesignComuni = false;

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0, string $slug0 = ''): void
    {
        $this->container0 = $container0;
        $this->slug0 = $slug0;

        $resolved = app(ResolvePageAction::class)->execute($container0, $slug0);

        $this->pageSlug = $resolved->pageSlug;
        $item = $resolved->item;
        $cmsPage = \Modules\Cms\Models\Page::findUniqueBySlug($this->pageSlug);
        // ne' un modello ne' una pagina CMS: 404 vero, non un 200 con <main> vuoto (soft-404: i motori di ricerca lo indicizzano)
        abort_if($item === null && $cmsPage === null, 404);
        $this->isDesignComuni = str_starts_with((string) $cmsPage?->layout, 'design-comuni');

        $this->data = [
            'container0' => $container0,
            'slug0' => $slug0,
            'slug' => $slug0,
            'item' => $item,
        ];
    }
};
?>

@php
    $cmsPage = \Modules\Cms\Models\Page::findUniqueBySlug(request()->segment(2).'.'.request()->segment(3));
    $specialPage = $container0 === 'auth' && $slug0 === 'login'
        ? 'auth-login'
        : ($container0 === 'auth' && $slug0 === 'register'
        ? 'auth-register'
        : ($container0 === 'tickets' && $slug0 === 'track'
        ? 'ticket-track'
        : ($container0 === 'tickets' && ctype_digit($slug0) ? 'ticket-detail' : null)));
    $pageTitle = $specialPage === 'auth-login'
        ? __('Accedi a FixCity')
        : ($specialPage === 'auth-register'
        ? __('Crea il tuo account')
        : ($specialPage === 'ticket-track'
        ? __('fixcity::ticket.track.title')
        : ($specialPage === 'ticket-detail' ? __('pub_theme::home.map.details')
        : ($cmsPage?->getTranslation('title', app()->getLocale(), false) ?? config('app.name')))));
    $pageDescription = $cmsPage?->getAttribute('description') ?? '';
    // pagine con chrome Design Comuni: asset con percorso relativo come il riferimento (DesignComuniAssets) e voce di menu attiva dal JSON
    $isDesignComuni = str_starts_with((string) ($cmsPage?->getAttribute('layout') ?? ''), 'design-comuni');
    $isDesignComuni && view()->share('dcRelativeAssets', true);
    $headerActive = $isDesignComuni ? (string) data_get($cmsPage?->content_blocks, '0.data.header_active', '') : '';
    // `layout` del JSON: `test` (chrome v1), `design-comuni*` (chrome Design Comuni, vedi layouts/design-comuni*), altrimenti `app`
    $jsonLayout = $cmsPage?->getAttribute('layout') ?? 'app';
    $layoutComponent = $jsonLayout === 'test'
        ? 'layouts.test'
        : (str_starts_with($jsonLayout, 'design-comuni') ? 'layouts.'.$jsonLayout : 'layouts.app');
@endphp
<x-dynamic-component :component="$layoutComponent" :title="$pageTitle" :meta-description="$pageDescription" :header-active="$headerActive">
    @if ($specialPage !== null)
        <div class="page-content content" data-slug="{{ request()->segment(2).'.'.request()->segment(3) }}" data-side="content">
            @if ($specialPage === 'auth-login')
                @include('pub_theme::components.pages.auth-login')
            @elseif ($specialPage === 'auth-register')
                @include('pub_theme::components.pages.auth-register')
            @elseif ($specialPage === 'ticket-track')
                @include('pub_theme::components.pages.ticket-track')
            @else
                @include('pub_theme::components.pages.ticket-detail')
            @endif
        </div>
    @else
        {{--
            Il div.page-content e' la radice del componente Volt. Livewire stampa wire:id sul primo tag a inizio
            riga del fragment: con <x-page> come unico contenuto finiva dentro il widget Livewire di un blocco
            (es. CreateTicketWizardWidget) e ogni wire:model / callSchemaComponentMethod colpiva il Volt.
        --}}
        @volt('container0.view')
            <div class="page-content content"{!! $this->isDesignComuni ? ' data-dc' : '' !!} data-slug="{{ $this->container0.'.'.$this->slug0 }}" data-side="content">
                <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
            </div>
        @endvolt
    @endif
</x-dynamic-component>
