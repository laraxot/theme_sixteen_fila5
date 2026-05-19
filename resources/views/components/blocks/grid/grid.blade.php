@props(['data' => []])

{{-- 
    Grid Block
    Usage: <x-blocks.grid.grid :data="$gridData" />
    
    Data structure:
    - title: string (optional)
    - columns: 2 | 3 | 4 (default: 3)
    - gap: 'small' | 'medium' | 'large' (default: 'medium')
    - items: array of content (any blade content)
    - content: slot content
--}}

@php
    $columns = $data['columns'] ?? 3;
    $gap = $data['gap'] ?? 'medium';
    $title = $data['title'] ?? '';
    $items = $data['items'] ?? [];
@endphp

<div class="grid-block">
    @if($title)
    <h3 class="grid-title text-2xl font-bold text-gray-900 mb-6">
        {{ $title }}
    </h3>
    @endif
    
    <div class="grid-wrapper grid grid-cols-1 {{ $columns === 2 ? 'md:grid-cols-2' : ($columns === 3 ? 'md:grid-cols-2 lg:grid-cols-3' : 'md:grid-cols-2 lg:grid-cols-4') }} {{ $gap === 'small' ? 'gap-4' : ($gap === 'large' ? 'gap-8' : 'gap-6') }}">
        {{-- Slot Content --}}
        @if(isset($slot) && !$slot->isEmpty())
            {{ $slot }}
        @else
            {{-- Items Array --}}
            @foreach($items as $item)
            <div class="grid-item">
                @if(is_array($item))
                    @if(isset($item['blade']))
                        @include($item['blade'], $item['data'] ?? [])
                    @elseif(isset($item['html']))
                        {!! $item['html'] !!}
                    @endif
                @else
                    {!! $item !!}
                @endif
            </div>
            @endforeach
        @endif
    </div>
</div>
