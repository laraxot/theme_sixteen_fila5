@props(['title' => ''])

<x-layouts.main>
    <div class="skiplink">
        <a class="visually-hidden-focusable" href="#main-container">{{ __('pub_theme::ui.skip_to_content') }}</a>
        <a class="visually-hidden-focusable" href="#footer">{{ __('pub_theme::ui.skip_to_footer') }}</a>
    </div><!-- /skiplink -->

    <x-section slug="header" />

    <main id="main-container"
        @if (request()->routeIs('tests.*'))
            data-page="{{ request()->route('slug') }}"
        @endif
    >
        {{ $slot }}
    </main>

    @include('pub_theme::components.sections.search-modal')

    <x-section slug="footer" tpl="full" />
</x-layouts.main>
