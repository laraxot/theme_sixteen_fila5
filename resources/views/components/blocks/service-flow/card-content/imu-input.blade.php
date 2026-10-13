{{--
    Campo di testo (cmp-input). `content`: outer_class (se presente un <div> esterno, es. `text-area-wrapper ...`), group_class (default `form-group cmp-input`), id, name (default id),
    type (default text), label, value, hint. Solo markup: nessuna validazione ne' calcolo (il riferimento e' statico qui).
--}}
@php
    $fieldId = $content['id'] ?? '';
@endphp
@if (filled($content['outer_class'] ?? null))<div class="{{ $content['outer_class'] }}">@endif
<div class="{{ $content['group_class'] ?? 'form-group cmp-input' }}">
    <label class="cmp-input__label" for="{{ $fieldId }}">{{ $content['label'] ?? '' }}</label>
    <input type="{{ $content['type'] ?? 'text' }}" class="form-control" id="{{ $fieldId }}" name="{{ $content['name'] ?? $fieldId }}" required{!! filled($content['value'] ?? null) ? ' value="'.e($content['value']).'"' : '' !!}>
    <div class="d-flex"><span class="form-text cmp-input__text"> {{ $content['hint'] ?? '' }}</span></div>
</div>
@if (filled($content['outer_class'] ?? null))</div>@endif
