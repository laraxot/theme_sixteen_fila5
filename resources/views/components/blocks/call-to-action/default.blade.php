@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $primaryLabel = $data['primary_label'] ?? ($data['cta_primary']['label'] ?? '');
    $primaryUrl = $data['primary_url'] ?? ($data['cta_primary']['url'] ?? '#');
    $secondaryLabel = $data['secondary_label'] ?? ($data['cta_secondary']['label'] ?? '');
    $secondaryUrl = $data['secondary_url'] ?? ($data['cta_secondary']['url'] ?? '#');
@endphp

@if($title || $description || $primaryLabel)
    <section class="my-12 rounded-xl bg-slate-50 dark:bg-slate-900 p-8 text-center">
        @if($title)
            <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                {{ $title }}
            </h2>
        @endif
        @if($description)
            <p class="mb-6 text-slate-600 dark:text-slate-400">
                {{ $description }}
            </p>
        @endif
        @if($primaryLabel || $secondaryLabel)
            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                @if($primaryLabel)
                    <a href="{{ $primaryUrl }}"
                       class="inline-flex items-center justify-center rounded-lg bg-sky-600 px-6 py-3 text-base font-semibold text-white shadow-sm hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        {{ $primaryLabel }}
                    </a>
                @endif
                @if($secondaryLabel)
                    <a href="{{ $secondaryUrl }}"
                       class="inline-flex items-center justify-center rounded-lg border border-slate-300 dark:border-slate-600 bg-transparent px-6 py-3 text-base font-semibold text-slate-800 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
                        {{ $secondaryLabel }}
                    </a>
                @endif
            </div>
        @endif
    </section>
@endif
