@props(['title' => '', 'metaDescription' => '', 'bodyPage' => 'tests', 'searchLinks' => []])

<x-layouts.main :title="$title" :description="$metaDescription" :body-page="$bodyPage">
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
        <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
    </div>

    <x-section slug="header" />
    <main id="main-container" tabindex="-1" class="dc-page !p-0">{{ $slot }}</main>
    @include('pub_theme::components.sections.search-modal', ['links' => $searchLinks])
    <x-section slug="footer" tpl="full" />
</x-layouts.main>
