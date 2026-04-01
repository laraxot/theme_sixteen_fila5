{{-- Breadcrumb Component - Bootstrap Italia Style --}}
@props([
    'items' => [],
])

<nav class="cmp-breadcrumbs mt-4" aria-label="Breadcrumb">
    <ol class="breadcrumb">
        @foreach($items as $index => $item)
            @if($index === count($items) - 1)
                {{-- Last item (current page) --}}
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $item['label'] }}
                </li>
            @else
                {{-- Link item --}}
                <li class="breadcrumb-item">
                    <a href="{{ $item['url'] }}" class="text-decoration-none">
                        {{ $item['label'] }}
                    </a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
