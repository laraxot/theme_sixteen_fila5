{{-- Titolo di blocco fuori dalle schede (vantaggi). `section`: tag (h2|h3|h4, default h2), class, text. --}}
@php
    $tag = in_array($section['tag'] ?? 'h2', ['h2', 'h3', 'h4'], true) ? $section['tag'] : 'h2';
@endphp
<{{ $tag }} class="{{ $section['class'] ?? 'title-xxlarge mb-4' }}">{{ $section['text'] ?? '' }}</{{ $tag }}>
