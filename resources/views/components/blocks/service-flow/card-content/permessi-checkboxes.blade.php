{{-- Caselle di scelta multipla (tipo di permesso). `content`: class, options[] {id, name, value, label}; name e value valgono id se mancano. --}}
<div class="{{ $content['class'] ?? 'form-check d-flex flex-column align-items-center bg-white w-100 p-3 p-lg-4 mt-0' }}">
    @foreach ($content['options'] ?? [] as $option)
        <div class="checkbox-body border-light py-3 d-flex align-items-center w-100">
            <input type="checkbox" id="{{ $option['id'] ?? '' }}" name="{{ $option['name'] ?? ($option['id'] ?? '') }}" value="{{ $option['value'] ?? ($option['id'] ?? '') }}">
            <label for="{{ $option['id'] ?? '' }}" class="subtitle-small_semi-bold mb-0">{{ $option['label'] ?? '' }}</label>
        </div>
    @endforeach
</div>
