{{--
    Elementi di un modulo in finestra (vantaggi). `$items[]` con `type`: field {id, name, label, hint, placeholder, required (default true)},
    toggle {id, label}, upload {...parts/upload}, group {class, items[]} (ricorsivo). Solo markup: il riferimento e' statico.
--}}
@foreach ($items ?? [] as $item)
    @switch($item['type'] ?? '')
        @case('field')
            <div class="form-group cmp-input">
                <label class="cmp-input__label" for="{{ $item['id'] ?? '' }}">{{ $item['label'] ?? '' }}</label>
                <input type="text" class="form-control" id="{{ $item['id'] ?? '' }}" name="{{ $item['name'] ?? ($item['id'] ?? '') }}"@if (filled($item['placeholder'] ?? null)) placeholder="{{ $item['placeholder'] }}"@endif{!! ($item['required'] ?? true) ? ' required' : '' !!}>
                <div class="d-flex"><span class="form-text cmp-input__text"> {{ $item['hint'] ?? '' }}</span></div>
            </div>
            @break
        @case('toggle')
            <div class="form-check">
                <div class="toggles">
                    <label for="{{ $item['id'] ?? '' }}" class="title-xsmall-lg d-flex justify-content-between align-items-center"> {{ $item['label'] ?? '' }}
                        <input type="checkbox" id="{{ $item['id'] ?? '' }}">
                        <span class="lever"></span></label>
                </div>
            </div>
            @break
        @case('upload')
            @include('pub_theme::components.blocks.service-flow.parts.upload', ['upload' => $item])
            @break
        @case('group')
            <div class="{{ $item['class'] ?? '' }}">
                @include('pub_theme::components.blocks.service-flow.parts.vantaggi-form-items', ['items' => $item['items'] ?? []])
            </div>
            @break
    @endswitch
@endforeach
