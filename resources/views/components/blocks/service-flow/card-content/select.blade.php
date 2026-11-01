{{-- Menu a tendina. `content`: class, id, label, placeholder, required, options[]. --}}
<div class="{{ $content['class'] ?? 'select-wrapper p-big p-4 select-partials' }}">
    <label for="{{ $content['id'] ?? '' }}" class="visually-hidden">{{ $content['label'] ?? '' }}</label>
    <select id="{{ $content['id'] ?? '' }}" class=""{{ ($content['required'] ?? false) ? ' required' : '' }}>
        <option selected="selected" value="">{{ $content['placeholder'] ?? '' }}</option>
        @foreach ($content['options'] ?? [] as $option)
            <option value="{{ $option }}">{{ $option }}</option>
        @endforeach
    </select>
</div>
