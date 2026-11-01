@props([
    'label' => 'Cerca',
    'placeholder' => 'Cerca...',
    'button_label' => 'Cerca',
    'button_bg_color' => '#007A52',
    'button_text_color' => '#ffffff'
])

<div class="card card-body border-0 mb-3 search-form-block">
    @if($label)
    <label class="form-label text-dark fw-bold mb-2">{{ $label }}</label>
    @endif
    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{ $placeholder }}" aria-label="{{ $placeholder }}">
        <button type="button" class="btn btn-primary" style="background-color: {{ $button_bg_color }}; color: {{ $button_text_color }}; border-color: {{ $button_bg_color }};">{{ $button_label }}</button>
    </div>
</div>