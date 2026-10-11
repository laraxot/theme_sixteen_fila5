@props(['data' => []])

@php
    $id = $data['id'] ?? '';
    $title = $data['title'] ?? '';
    $content = $data['content'] ?? '';
@endphp

@if($title || $content)
    <section @if($id) id="{{ $id }}" @endif class="mb-12">
        @if($title)
            <h2 class="mb-4 text-2xl font-bold text-slate-900 dark:text-white">
                {{ $title }}
            </h2>
        @endif
        @if($content)
            <div class="prose prose-slate max-w-none dark:prose-invert">
                {!! $content !!}
            </div>
        @endif
    </section>
@endif
