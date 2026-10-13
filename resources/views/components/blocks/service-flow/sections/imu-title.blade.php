{{-- Titolo di blocco fuori dalle schede. `section`: tag (h2|h3), class (default `title-xxlarge mb-4`), text. --}}
@php
    $tag = in_array($section['tag'] ?? 'h2', ['h2', 'h3'], true) ? ($section['tag'] ?? 'h2') : 'h2';
@endphp
<{{ $tag }} class="{{ $section['class'] ?? 'title-xxlarge mb-4' }}">{{ $section['text'] ?? '' }}</{{ $tag }}>
