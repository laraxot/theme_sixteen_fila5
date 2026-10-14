<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;

name('home');
middleware(PageSlugMiddleware::class);

new class extends Component {

    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->pageSlug = 'home';
        $this->data = [];
    }
};
?>

@php
    // titolo e descrizione dalla pagina CMS (JSON `home`): prima la home usciva con <title>FixCity</title> e description "FixCity"
    $cmsHome = \Modules\Cms\Models\Page::findUniqueBySlug('home');
    $homeTitle = $cmsHome?->getTranslation('title', app()->getLocale(), false) ?? config('app.name');
    // `description` non e' una colonna traducibile del modello Page: nel JSON e' un oggetto per lingua, letto come attributo grezzo
    $homeDescription = \Themes\Sixteen\Support\PageDescription::resolve($cmsHome?->getAttribute('description'), app()->getLocale());
@endphp
<x-layouts.app :title="$homeTitle" :meta-description="$homeDescription">
    @volt('home')
    {{-- `fc-home`: wrapper della home reale; dentro non valgono le regole legacy del tema (postcss/isolate-legacy-important.cjs, DCP-51). `#main-container` e' il bersaglio del link "Vai ai contenuti" e lo scope delle regole contrasto di app/16-homepage-civic-reframe.css --}}
    <div class="fc-home">
    <x-page side="content" :slug="$this->pageSlug" :data="$this->data" />
    </div>
    @endvolt
</x-layouts.app>
