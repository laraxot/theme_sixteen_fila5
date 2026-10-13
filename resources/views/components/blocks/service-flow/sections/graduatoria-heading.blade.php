{{-- Titolo di sezione isolato (fuori da scheda o sezione). `section`: text, class (default `title-xxlarge mb-4`), tag (h2|h3, default h2). --}}
@php($tag = ($section['tag'] ?? 'h2') === 'h3' ? 'h3' : 'h2')
<{{ $tag }} class="{{ $section['class'] ?? 'title-xxlarge mb-4' }}">{{ $section['text'] ?? '' }}</{{ $tag }}>
