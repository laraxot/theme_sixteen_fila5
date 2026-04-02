@props(['data' => []])

{{-- Breadcrumb - Bootstrap Italia Exact Replica --}}
@php
    $items = $data['items'] ?? [];
@endphp

<div class="breadcrumb-container" aria-label="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @foreach($items as $item)
                        @php
                            $isLast = $loop->last;
                            $label = $item['label'] ?? '';
                            $url = $item['url'] ?? '#';
                        @endphp
                        <li class="breadcrumb-item @if($isLast) active @endif" @if($isLast) aria-current="page" @endif>
                            @if($isLast)
                                {{ $label }}
                            @else
                                <a href="{{ $url }}">{{ $label }}</a>
                            @endif
                        </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
