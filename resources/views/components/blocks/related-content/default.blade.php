@props(['data' => []])

@php
    $title = $data['title'] ?? '';
    $sections = $data['sections'] ?? [];
@endphp

@if($sections)
    <section class="my-12">
        @if($title)
            <h3 class="mb-6 text-xl font-semibold text-slate-900 dark:text-white">
                {{ $title }}
            </h3>
        @endif
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach($sections as $section)
                <div>
                    @if(isset($section['heading']))
                        <h4 class="mb-3 text-sm font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                            {{ $section['heading'] }}
                        </h4>
                    @endif
                    @if(isset($section['links']))
                        <ul class="space-y-2">
                            @foreach($section['links'] as $link)
                                <li>
                                    <a href="{{ $link['url'] ?? '#' }}"
                                       class="text-sm text-sky-700 dark:text-sky-400 hover:text-sky-900 dark:hover:text-sky-300 hover:underline">
                                        {{ $link['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif
