<?php

declare(strict_types=1);

use function Laravel\Folio\middleware;
use function Laravel\Folio\name;
use Livewire\Volt\Component;
use Modules\Cms\Http\Middleware\PageSlugMiddleware;
use Modules\Cms\Models\Page as CmsPage;

name('container0.list');
middleware(PageSlugMiddleware::class);

new class extends Component {
    public string $container0 = '';
    public string $pageSlug = '';

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(string $container0): void
    {
        $this->container0 = $container0;
        $supportedLocales = array_keys(config('laravellocalization.supportedLocales', ['it' => []]));

        $this->pageSlug = match (true) {
            $container0 === 'segnalazione-crea' => 'tests.segnalazione-crea',
            in_array($container0, $supportedLocales, true) => 'home',
            default => $container0 . '.index',
        };
        $this->data = [
            'container0' => $container0,
        ];
    }
};
?>

@php
    $folioContainer = (string) (request()->route('container0') ?? '');
    $folioSupportedLocales = array_keys(config('laravellocalization.supportedLocales', ['it' => []]));
    $folioIsLocaleHome = in_array($folioContainer, $folioSupportedLocales, true);

    $folioPageTitle = match (true) {
        $folioContainer === 'predicts' => 'Mercati di Predizione',
        $folioIsLocaleHome => (function (): string {
            $page = CmsPage::query()->where('slug', 'home')->first();
            if ($page === null) {
                return (string) __('fixcity::ticket.heading.title.label');
            }

            $title = $page->getTranslation('title', app()->getLocale());

            return is_string($title) && $title !== ''
                ? $title
                : (string) __('fixcity::ticket.heading.title.label');
        })(),
        default => ucfirst(str_replace('-', ' ', $folioContainer)),
    };

    $folioMetaDescription = match (true) {
        $folioContainer === 'predicts' => 'Esplora i mercati di predizione attivi, con probabilita, volume e accesso diretto ai dettagli.',
        $folioIsLocaleHome => 'Consulta le segnalazioni aperte nel territorio e filtra i risultati per categoria.',
        default => 'Pagina pubblica ' . $folioPageTitle,
    };
@endphp

<x-layouts.app :title="$folioPageTitle" :meta-description="$folioMetaDescription">
    @volt('container0.list')
    <div>
        <x-page side="content" :slug="$pageSlug" :data="$data" />
    </div>
    @endvolt
</x-layouts.app>
