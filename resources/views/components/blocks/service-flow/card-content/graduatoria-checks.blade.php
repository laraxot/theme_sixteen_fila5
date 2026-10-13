{{-- Elenco di caselle di controllo su fondo bianco. `content`: class (default `form-check d-flex flex-column bg-white p-3 p-lg-4 mt-0`), items[] {id, label}; id, name e value coincidono. --}}
<div class="{{ $content['class'] ?? 'form-check d-flex flex-column bg-white p-3 p-lg-4 mt-0' }}">
    @foreach ($content['items'] ?? [] as $item)
        <div class="checkbox-body border-light py-3 d-flex align-items-center w-100">
            <input type="checkbox" id="{{ $item['id'] ?? '' }}" name="{{ $item['id'] ?? '' }}" value="{{ $item['id'] ?? '' }}">
            <label for="{{ $item['id'] ?? '' }}" class="subtitle-small_semi-bold mb-0">{{ $item['label'] ?? '' }}</label>
        </div>
    @endforeach
</div>
