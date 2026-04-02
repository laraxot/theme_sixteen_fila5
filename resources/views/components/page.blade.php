{{-- Page Component --}}
@props([
    'blocks' => [],
    'side' => 'content',
    'slug' => '',
    'page' => null,
    'data' => [],
])

@if (!empty($blocks))
    @foreach ($blocks as $block)
        @include($block->view, array_merge($data, $block->data, ['data' => $block->data]))
    @endforeach
@endif
