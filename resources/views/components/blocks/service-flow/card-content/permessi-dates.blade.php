{{-- Campi data affiancati (periodo di validita'). `content`: class (riga), fields[] {id, name, label, class (gruppo)}. --}}
<div class="{{ $content['class'] ?? 'd-lg-flex justify-content-between flex-column flex-lg-row' }}">
    @foreach ($content['fields'] ?? [] as $field)
        <div class="calendar-partials card p-big">
            <div class="{{ $field['class'] ?? 'form-group mb-0 p-3' }}">
                <label class="active" for="{{ $field['id'] ?? '' }}">{{ $field['label'] ?? '' }}</label>
                <input type="date" class="it-date-datepicker icon-primary form-control" id="{{ $field['id'] ?? '' }}" name="{{ $field['name'] ?? '' }}" required>
            </div>
        </div>
    @endforeach
</div>
