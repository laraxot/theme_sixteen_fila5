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
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($items as $item)
                <a href="{{ $item['url'] ?? '#' }}"
                   class="group block rounded-xl border border-slate-200 dark:border-slate-700 p-6 hover:border-sky-500 transition-colors">
                    <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-lg bg-sky-100 dark:bg-sky-900/30">
                        @if($item['icon'])
                            @include('pub_theme::components.ui.icon', ['name' => $item['icon'], 'class' => 'h-6 w-6 text-sky-700 dark:text-sky-400'])
                        @endif
                    </div>
                    <h3 class="mb-1 text-lg font-medium text-slate-900 dark:text-white group-hover:text-sky-700 dark:group-hover:text-sky-400">
                        {{ $item['title'] ?? $item['name'] ?? '' }}
                    </h3>
                    @if(isset($item['description']))
                        <p class="text-sm text-slate-600 dark:text-slate-400">
                            {{ $item['description'] }}
                        </p>
                    @endif
                </a>
            @endforeach
        </div>
    </section>
@endif
