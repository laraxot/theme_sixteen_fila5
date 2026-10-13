{{-- Scelta singola. `content`: name (gli id sono <name>-<n>), required (primo radio obbligatorio), options[]. L'ultima opzione non ha il filetto. --}}
<div class="cmp-card-radio">
    <div class="card card-teaser">
        <div class="card-body">
            <div class="form-check m-0">
                @foreach ($content['options'] ?? [] as $option)
                    <div @class(['radio-body', 'border-bottom border-light' => ! $loop->last])>
                        <input name="{{ $content['name'] ?? '' }}" type="radio" id="{{ $content['name'] ?? '' }}-{{ $loop->iteration }}"{{ ($loop->first && ($content['required'] ?? false)) ? ' required' : '' }}>
                        <label for="{{ $content['name'] ?? '' }}-{{ $loop->iteration }}">{{ $option }}</label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
