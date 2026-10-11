@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];
@endphp

@if($items)
    <nav class="mb-8" aria-label="Indice della pagina">
        @if($title)
            <h3 class="mb-4 text-lg font-semibold text-slate-900 dark:text-white">
                {{ $title }}
            </h3>
        @endif
        <ul class="space-y-1">
            @foreach($items as $item)
                <li>
                    <a href="{{ $item['url'] ?? '#' }}"
                       class="block text-sm text-sky-700 dark:text-sky-400 hover:text-sky-900 dark:hover:text-sky-300 hover:underline">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
@endif
