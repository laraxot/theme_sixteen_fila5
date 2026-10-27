@props(['links' => []])

@php
    use Themes\Sixteen\Infrastructure\Url\FrontofficeRoutes;
    use Themes\Sixteen\Presentation\Search\FrontofficeSearchSuggestions;

    // Regola FO: solo container0.* via FrontofficeRoutes; niente URL costruiti a mano.
    $searchListUrl = FrontofficeRoutes::ticketsIndex();
    $displayLinks = ! empty($links) ? $links : FrontofficeSearchSuggestions::defaults();
@endphp

<div id="search-modal" x-data="{ open: false }" x-cloak x-show="open" x-trap.noscroll="open" x-on:open-search.window="open = true; $nextTick(() => $refs.searchInput.focus())" x-on:keydown.escape.window="open = false" class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 p-4 sm:p-8" role="dialog" aria-modal="true" aria-labelledby="search-modal-title">
    <div class="mx-auto mt-4 max-w-3xl rounded-2xl bg-white p-6 shadow-2xl sm:mt-12 sm:p-8" @click.outside="open = false">
        <div class="flex items-start justify-between gap-4">
            <h2 id="search-modal-title" class="text-2xl font-bold text-slate-950">{{ __('pub_theme::ui.search') }}</h2>
            <button type="button" class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-lg text-2xl text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-sky-800/30" aria-label="{{ __('pub_theme::ui.close') }}" @click="open = false">&times;</button>
        </div>

        <form class="mt-6 flex flex-col gap-3 sm:flex-row" action="{{ $searchListUrl }}" method="get" role="search">
            <label class="sr-only" for="search-modal-input">{{ __('pub_theme::ui.search_site_aria') }}</label>
            <input x-ref="searchInput" id="search-modal-input" name="q" type="search" class="min-h-12 flex-1 rounded-lg border-2 border-slate-300 px-4 text-base text-slate-950 focus:border-sky-800 focus:outline-none focus:ring-4 focus:ring-sky-800/20" placeholder="{{ __('pub_theme::ui.search_site_aria') }}">
            <button type="submit" class="inline-flex min-h-12 items-center justify-center rounded-lg bg-sky-800 px-6 font-semibold text-white transition hover:bg-sky-900 focus:outline-none focus:ring-4 focus:ring-sky-800/30">{{ __('pub_theme::ui.search') }}</button>
        </form>

        <div class="mt-8 border-t border-slate-200 pt-6">
            <h3 class="text-sm font-bold uppercase tracking-wide text-slate-700">{{ __('pub_theme::navigation.homepage.maybe_searching') }}</h3>
            <ul class="mt-3 grid gap-2 sm:grid-cols-2">
                @foreach ($displayLinks as $link)
                    <li><a class="block rounded-lg p-3 font-semibold text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
