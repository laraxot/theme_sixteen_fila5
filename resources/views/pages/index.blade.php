<?php

use function Laravel\Folio\{middleware, name};
use Modules\Cms\Models\Page as CmsPage;

/** @var array $base_middleware */
$base_middleware = [];

name('home');
middleware($base_middleware);
?>

@php
    $homePage = CmsPage::query()->where('slug', 'home')->first();
    $homeTitle = (string) __('pub_theme::home.heading.title');
    if ($homePage !== null) {
        $translatedHomeTitle = $homePage->getTranslation('title', app()->getLocale());
        if (is_string($translatedHomeTitle) && $translatedHomeTitle !== '') {
            $homeTitle = $translatedHomeTitle;
        }
    }
@endphp

@php
    $mapLitPreload = null;
    $manifestPath = public_path('themes/Sixteen/manifest.json');
    if (is_readable($manifestPath)) {
        $manifest = json_decode((string) file_get_contents($manifestPath), true);
        $entry = is_array($manifest) ? ($manifest['../../Modules/Geo/resources/js/components/map-lit.js'] ?? null) : null;
        $relativeFile = is_array($entry) ? ($entry['file'] ?? null) : null;
        if (is_string($relativeFile) && is_readable(public_path('themes/Sixteen/'.$relativeFile))) {
            $mapLitPreload = $relativeFile;
        }
    }
@endphp

@if ($mapLitPreload)
    @push('styles')
        <link rel="modulepreload" href="{{ asset('themes/Sixteen/'.$mapLitPreload) }}" crossorigin>
    @endpush
@endif

<x-layouts.app :title="$homeTitle" :meta-description="__('pub_theme::home.meta.description')" body-page="home">
    <x-page side="content" slug="home" />
</x-layouts.app>
