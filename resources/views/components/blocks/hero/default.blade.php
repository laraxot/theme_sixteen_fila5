@props(['data' => []])

{{-- Hero Section - Bootstrap Italia Exact Replica --}}
@php
    $title = $data['title'] ?? 'NOME DEL COMUNE';
    $subtitle = $data['subtitle'] ?? 'CONTENUTI IN EVIDENZA';
    $backgroundImage = $data['backgroundImage'] ?? null;
    $overlay = $data['overlay'] ?? true;
    $theme = $data['theme'] ?? 'dark';
@endphp

<div class="it-hero-wrapper it-{{ $theme }} @if($overlay) it-overlay @endif">
    @if($backgroundImage)
    <div class="img-responsive-wrapper">
        <div class="img-responsive">
            <div class="img-wrapper">
                <img src="{{ $backgroundImage }}" alt="{{ $title }}">
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="it-hero-text-wrapper bg-{{ $theme }}">
                    <h1 class="no_toc">{{ $title }}</h1>
                    @if($subtitle)
                    <p class="d-none d-lg-block">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
