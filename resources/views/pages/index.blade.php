<?php

use function Laravel\Folio\{middleware, name};
<<<<<<< HEAD
use Modules\Cms\Models\Page as CmsPage;

/** @var array $base_middleware */
=======
use Filament\Notifications\Notification;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Actions\Action;
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\VerticalAlignment;
use Livewire\Volt\Component;
use Modules\Tenant\Services\TenantService;

/** @var array $base_middleware */
// Per configurazioni avanzate:
// $middleware = TenantService::config('middleware');
// $base_middleware = Arr::get($middleware, 'base', []);
// @var array
>>>>>>> 6ed19256f (.)
$base_middleware = [];

name('home');
middleware($base_middleware);
<<<<<<< HEAD
?>

@php
    $homePage = CmsPage::query()->where('slug', 'home')->first();
    $homeTitle = (string) __('fixcity::ticket.heading.title.label');
    if ($homePage !== null) {
        $translatedHomeTitle = $homePage->getTranslation('title', app()->getLocale());
        if (is_string($translatedHomeTitle) && $translatedHomeTitle !== '') {
            $homeTitle = $translatedHomeTitle;
        }
    }
@endphp

@php
    $mapLitPreload = null;
    $manifestPath = base_path('Themes/Sixteen/public/manifest.json');
    if (is_readable($manifestPath)) {
        $manifest = json_decode((string) file_get_contents($manifestPath), true);
        $entry = is_array($manifest) ? ($manifest['../../Modules/Geo/resources/js/components/map-lit.js'] ?? null) : null;
        $mapLitPreload = is_array($entry) ? ($entry['file'] ?? null) : null;
    }
@endphp

@if ($mapLitPreload)
    @push('styles')
        <link rel="modulepreload" href="{{ asset('themes/Sixteen/'.$mapLitPreload) }}" crossorigin>
    @endpush
@endif

<x-layouts.app :title="$homeTitle" :meta-description="__('sixteen::home.meta.description')" body-page="segnalazioni-elenco">
    <x-page side="content" slug="home" />
=======

new class extends Component
{
    public string $slug='home';
};


?>

<x-layouts.app>
    @volt('home')
    <div>
        <x-page side="content" :slug="$slug" />
    </div>
    @endvolt
>>>>>>> 6ed19256f (.)
</x-layouts.app>
