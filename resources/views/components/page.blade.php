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
        @php
            $isActive = data_get($block, 'active', true);
        @endphp

        @if ($isActive)
            @include($block->view, array_merge($data, $block->data, ['data' => $block->data]))
        @endif
    @endforeach
@endif
