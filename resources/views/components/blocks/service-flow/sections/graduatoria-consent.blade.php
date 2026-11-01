{{--
    Corpo del consenso (informativa privacy), senza contenitore. `section`: paragraphs[] {text, class, link {label, url, class}},
    checkbox {class, body_class, id, label, label_class} (id, name e value coincidono), button {label, class}.
--}}
@foreach ($section['paragraphs'] ?? [] as $paragraph)
    <p class="{{ $paragraph['class'] ?? 'text-paragraph' }}"> {{ $paragraph['text'] ?? '' }}@if (filled($paragraph['link'] ?? null)) <a href="{{ $paragraph['link']['url'] ?? '#' }}" class="{{ $paragraph['link']['class'] ?? 't-primary' }}">{{ $paragraph['link']['label'] ?? '' }}</a>@endif</p>
@endforeach
@if (filled($section['checkbox'] ?? null))
    <div class="{{ $section['checkbox']['class'] ?? 'form-check' }}">
        <div class="{{ $section['checkbox']['body_class'] ?? 'checkbox-body d-flex align-items-center' }}">
            <input type="checkbox" id="{{ $section['checkbox']['id'] ?? '' }}" name="{{ $section['checkbox']['name'] ?? ($section['checkbox']['id'] ?? '') }}" value="{{ $section['checkbox']['name'] ?? ($section['checkbox']['id'] ?? '') }}">
            <label class="{{ $section['checkbox']['label_class'] ?? '' }}" for="{{ $section['checkbox']['id'] ?? '' }}">{{ $section['checkbox']['label'] ?? '' }}</label>
        </div>
    </div>
@endif
@if (filled($section['button'] ?? null))
    <button type="button" class="{{ $section['button']['class'] ?? 'btn btn-primary' }}"><span class="">{{ $section['button']['label'] ?? '' }}</span></button>
@endif
