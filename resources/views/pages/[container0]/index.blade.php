<?php

declare(strict_types=1);

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Modules\Cms\Models\Page;

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use function Laravel\Folio\render;

name('container0.index');
middleware(PageSlugMiddleware::class);

/**
 * Alias Design Comuni (path IT) → container FixCity canonici.
 * Shell senza CMS = 404 (mai pagina bianca con solo header/footer).
 *
 * @return array<string, string>
 */
$foIndexAliases = static fn (): array => [
    'servizi' => 'services',
    'eventi' => 'events',
    'novita' => 'blog',
    'faq' => 'domande-frequenti',
    'segnalazioni' => 'tickets',
];

render(function (View $view, string $container0) use ($foIndexAliases): View|RedirectResponse {
    $aliases = $foIndexAliases();
    if (isset($aliases[$container0])) {
        return redirect()->to(
            route('container0.index', ['container0' => $aliases[$container0]]),
            301,
        );
    }

    if ($container0 === 'area-personale') {
        return redirect()->to(
            Auth::check()
                ? route('container0.view', ['container0' => 'area-personale', 'slug0' => 'pratiche'])
                : route('login'),
        );
    }

    if (Page::findUniqueBySlug($container0.'.index') === null) {
        abort(404);
    }

    return $view;
});

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
