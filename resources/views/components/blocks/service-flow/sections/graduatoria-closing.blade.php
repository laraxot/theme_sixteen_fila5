{{-- Chiusura di pagina con testo, link e coda. `section`: class, text, text_class, link {label, url, class}, suffix, suffix_class. --}}
<div class="{{ $section['class'] ?? '' }}">
    <p class="{{ $section['text_class'] ?? 'text-paragraph mb-3' }}">{{ $section['text'] ?? '' }}</p>
    <a href="{{ data_get($section, 'link.url', '#') }}" class="{{ data_get($section, 'link.class', 't-primary text-paragraph') }}">{{ data_get($section, 'link.label') }}</a>
    <span class="{{ $section['suffix_class'] ?? 'text-paragraph' }}">{{ $section['suffix'] ?? '' }}</span>
</div>
