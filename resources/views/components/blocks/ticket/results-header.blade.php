@props([
    'ns' => 'fixcity::ticket',
    'resultsCount' => 0,
    'sprite' => '',
])

<div class="mt-8 flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 pb-4">
    <span
        id="block-results-count"
        class="font-semibold text-slate-950"
        data-count-template="{{ __($ns . '.results.count.text', ['count' => ':count']) }}"
        data-reference-total="{{ (int) $resultsCount }}"
    >{{ __($ns . '.results.count.text', ['count' => $resultsCount]) }}</span>

    <button type="button" data-filter-open x-on:click="filterOpen = true" class="inline-flex min-h-11 items-center rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20 lg:hidden">
        <span>{{ __($ns . '.filter.button.label') }}</span>
    </button>

    <button type="button" id="block-clear-filters" class="hidden min-h-11 rounded-lg border-2 border-sky-800 px-4 py-2 font-semibold text-sky-900 hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20 lg:block">
        <span>{{ __($ns . '.filter.remove.label') }}</span>
    </button>
</div>
