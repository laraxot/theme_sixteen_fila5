@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $description = $data['description'] ?? '';
    $items = $data['items'] ?? [];
@endphp

@if($items)
    <section class="my-12">
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
        <ul class="flex flex-wrap gap-3">
            @foreach($items as $item)
                <li>
                    <a href="{{ $item['url'] ?? '#' }}"
                       class="inline-flex items-center gap-2 rounded-lg bg-slate-100 dark:bg-slate-800 px-4 py-2 text-sm font-medium text-slate-800 dark:text-slate-200 hover:bg-sky-100 dark:hover:bg-sky-900/30 focus:outline-none focus:ring-2 focus:ring-sky-500">
                        @if($item['icon'])
                            @include('pub_theme::components.ui.icon', ['name' => $item['icon'], 'class' => 'h-4 w-4'])
                        @endif
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
@endif
