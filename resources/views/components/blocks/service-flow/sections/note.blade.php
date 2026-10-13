{{-- Paragrafo di nota (es. campi obbligatori). `section`: class (default `text-paragraph-small mb-40`), text. --}}
<p class="{{ $section['class'] ?? 'text-paragraph-small mb-40' }}">{{ $section['text'] ?? '' }}</p>
