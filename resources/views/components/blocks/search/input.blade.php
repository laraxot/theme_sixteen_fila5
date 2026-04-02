@props(['data' => []])

{{-- Input Search Component - Bootstrap Italia Exact Replica --}}
@php
    $placeholder = $data['placeholder'] ?? 'Cerca una parola chiave';
    $buttonLabel = $data['buttonLabel'] ?? 'Invio';
    $action = $data['action'] ?? '/it/ricerca';
    $method = $data['method'] ?? 'GET';
@endphp

<div class="cmp-input-search">
    <form action="{{ $action }}" method="{{ $method }}" class="search-form">
        <div class="form-group">
            <div class="input-group">
                <input type="search" 
                       class="form-control" 
                       name="q" 
                       placeholder="{{ $placeholder }}"
                       aria-label="Cerca">
                <button type="submit" class="btn btn-primary">
                    <span>{{ $buttonLabel }}</span>
                    <svg class="icon icon-sm">
                        <use xlink:href="#it-search"></use>
                    </svg>
                </button>
            </div>
        </div>
    </form>
</div>
