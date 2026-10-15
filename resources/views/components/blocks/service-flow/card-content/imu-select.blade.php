{{--
    Menu a tendina con etichetta visibile. `content`: wrapper_class (default `select-wrapper bg-transparent p-0`), id, label, select_class (default `bg-transparent`),
    placeholder, options[], hint {class (default `d-flex`), text} (dentro il contenitore, dopo il menu), label_flag (attributo booleano dell'etichetta, es. `mb-3`:
    il riferimento lo scrive cosi' nella finestra Immobile).
--}}
<div class="{{ $content['wrapper_class'] ?? 'select-wrapper bg-transparent p-0' }}">
    <label for="{{ $content['id'] ?? '' }}" class=""{!! filled($content['label_flag'] ?? null) ? ' '.preg_replace('/[^a-z0-9-]/', '', (string) $content['label_flag']) : '' !!}>{{ $content['label'] ?? '' }}</label>
    <select id="{{ $content['id'] ?? '' }}" class="{{ $content['select_class'] ?? 'bg-transparent' }}" required>
        <option selected="selected" value="">{{ $content['placeholder'] ?? '' }}</option>
        @foreach ($content['options'] ?? [] as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
    @if (filled($content['hint'] ?? null))
        <div class="{{ data_get($content, 'hint.class', 'd-flex') }}"><span class="form-text cmp-input__text"> {{ data_get($content, 'hint.text') }}</span></div>
    @endif
</div>
