{{-- Bootstrap Italia Rating Component --}}

@php
$ratingId = $id ?? 'rating-' . uniqid();
$currentValue = $value ?? 0;
@endphp

<fieldset class="rating rating-italia">
    @if(isset($legend))
    <legend class="rating-legend">{{ $legend }}</legend>
    @endif
    <div class="rating-stars">
        @for($i = 1; $i <= 5; $i++)
        <div class="form-check form-check-inline rating-star">
            <input class="form-check-input"
                   type="radio"
                   name="{{ $name }}"
                   id="{{ $ratingId }}-{{ $i }}"
                   value="{{ $i }}"
                   @if($i <= $currentValue) checked @endif>
            <label class="form-check-label" for="{{ $ratingId }}-{{ $i }}">
                <svg class="icon star-icon {{ $i <= $currentValue ? 'it-star-full' : 'it-star-empty' }}" aria-hidden="true">
                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#{{ $i <= $currentValue ? 'it-star-full' : 'it-star-empty' }}"></use>
                </svg>
                <span class="visually-hidden">{{ $i }} {{ $i === 1 ? 'stella' : 'stelle' }}</span>
            </label>
        </div>
        @endfor
    </div>
    @if($showLabel ?? false)
    <small class="rating-label">{{ $currentValue }} {{ $currentValue === 1 ? 'stella' : 'stelle' }}</small>
    @endif
</fieldset>
