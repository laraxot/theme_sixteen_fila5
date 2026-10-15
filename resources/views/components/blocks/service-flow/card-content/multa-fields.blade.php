{{--
    Campi del modulo "dati specifici" della multa (DCP-28). `content.fields[]`, in ordine, ciascuno con `type`:
    text {class, value (stringa o segmenti: parts/multa-inline), link {label, url, class}}, title {tag, class, text},
    radios {wrapper_class, name, required, options[] {label (\n = a capo), body_class, label_class}} (id = <name>-<n>),
    input {wrapper_class (contenitore esterno, opzionale), group_class, label, label_class, type, class, id, name, required, value},
    date {wrapper_class, group_class, label, label_class, class, id, name, required} (campo data nativo),
    summary {group} (parts/info-summary), box {class, fields[]} (contenitore con altri campi).
    Il testo va nel JSON; qui solo il markup. La validazione (#justValidateMulta) e' del comportamento condiviso.
--}}
@foreach ($content['fields'] ?? [] as $field)
    @switch($field['type'] ?? '')
        @case('text')
            <p class="{{ $field['class'] ?? '' }}">@include('pub_theme::components.blocks.service-flow.parts.multa-inline', ['value' => $field['value'] ?? ''])@if (filled($field['link'] ?? null)) <a href="{{ $field['link']['url'] ?? '#' }}" class="{{ $field['link']['class'] ?? 't-primary' }}">{{ $field['link']['label'] ?? '' }}</a>@endif</p>
            @break
        @case('title')
            @php($tag = in_array($field['tag'] ?? 'h3', ['h2', 'h3', 'h4'], true) ? ($field['tag'] ?? 'h3') : 'h3')
            <{{ $tag }} class="{{ $field['class'] ?? '' }}">{{ $field['text'] ?? '' }}</{{ $tag }}>
            @break
        @case('radios')
            <div class="{{ $field['wrapper_class'] ?? 'cmp-card-radio mb-4' }}">
                <div class="card">
                    <div class="card-body">
                        <div class="form-check m-0">
                            @foreach ($field['options'] ?? [] as $option)
                                <div class="{{ $option['body_class'] ?? 'radio-body' }}">
                                    <input name="{{ $field['name'] ?? '' }}" type="radio" id="{{ $field['name'] ?? '' }}-{{ $loop->iteration }}"{!! ($loop->first && ($field['required'] ?? false)) ? ' required=""' : '' !!}>
                                    <label for="{{ $field['name'] ?? '' }}-{{ $loop->iteration }}"{!! filled($option['label_class'] ?? null) ? ' class="'.e($option['label_class']).'"' : '' !!}>@include('pub_theme::components.blocks.service-flow.parts.rich', ['text' => $option['label'] ?? ''])</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @break
        @case('input')
            @if (filled($field['wrapper_class'] ?? null))<div class="{{ $field['wrapper_class'] }}">@endif
            <div class="{{ $field['group_class'] ?? 'form-group cmp-input mb-0 mt-0' }}">
                <label class="{{ $field['label_class'] ?? 'cmp-input__label' }}" for="{{ $field['id'] ?? '' }}">{{ $field['label'] ?? '' }}</label>
                <input type="{{ $field['input_type'] ?? 'text' }}" class="{{ $field['class'] ?? 'form-control' }}" id="{{ $field['id'] ?? '' }}" name="{{ $field['name'] ?? '' }}"{!! ($field['required'] ?? false) ? ' required' : '' !!}@if (array_key_exists('value', $field)) value="{{ $field['value'] }}"@endif>
            </div>
            @if (filled($field['wrapper_class'] ?? null))</div>@endif
            @break
        @case('date')
            <div class="{{ $field['wrapper_class'] ?? 'calendar-partials card px-0' }}">
                <div class="{{ $field['group_class'] ?? 'form-group mb-4' }}">
                    <label class="{{ $field['label_class'] ?? 'active' }}" for="{{ $field['id'] ?? '' }}">{{ $field['label'] ?? '' }}</label>
                    <input type="date" class="{{ $field['class'] ?? 'it-date-datepicker icon-primary form-control' }}" id="{{ $field['id'] ?? '' }}" name="{{ $field['name'] ?? '' }}"{!! ($field['required'] ?? false) ? ' required' : '' !!}>
                </div>
            </div>
            @break
        @case('summary')
            @include('pub_theme::components.blocks.service-flow.parts.info-summary', ['group' => $field['group'] ?? []])
            @break
        @case('box')
            <div class="{{ $field['class'] ?? '' }}">
                @include('pub_theme::components.blocks.service-flow.card-content.multa-fields', ['content' => ['fields' => $field['fields'] ?? []]])
            </div>
            @break
    @endswitch
@endforeach
