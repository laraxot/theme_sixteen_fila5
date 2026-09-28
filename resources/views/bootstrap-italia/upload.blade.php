{{-- Bootstrap Italia Upload Component --}}

@php
$uploadId = $id ?? 'upload-' . uniqid();
@endphp

<div class="upload upload-italia">
    @if(isset($label))
    <label for="{{ $uploadId }}" class="form-label">{{ $label }}</label>
    @endif
    <div class="upload-drag-area" data-upload-drag>
        <div class="upload-drag-content">
            <svg class="icon upload-icon" aria-hidden="true">
                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#it-upload"></use>
            </svg>
            <p class="upload-drag-text">
                Trascina qui il file oppure
                <span class="upload-drag-link">sfoglia</span>
            </p>
        </div>
        <input type="file"
               id="{{ $uploadId }}"
               name="{{ $name }}"
               class="upload-input"
               @if($multiple ?? false) multiple @endif
               @if(isset($accept)) accept="{{ $accept }}" @endif>
    </div>
    @if(isset($hint))
    <small class="form-text text-muted">{{ $hint }}</small>
    @endif
</div>
