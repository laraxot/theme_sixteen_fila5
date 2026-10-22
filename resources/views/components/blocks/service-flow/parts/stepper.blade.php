{{-- Stepper del wizard. `stepper`: items[] {label, state: confirmed|active|''}, confirmed_label, active_label, index (es. "2/4"). --}}
@php
    $d = static fn (string $key, mixed $default = '') => data_get($data, $key, $default);
    $assets = \Themes\Sixteen\Infrastructure\Assets\DesignComuniAssets::base();
    $icon = static fn (string $name): string => $assets.'/bootstrap-italia/dist/svg/sprites.svg#'.$name;
@endphp
<div class="steppers">
    <div class="steppers-header">
        <ul>
            @foreach ($d('stepper.items', []) as $step)
                <li class="{{ $step['state'] ?? '' }}"> {{ $step['label'] ?? '' }}
                    @if (($step['state'] ?? '') === 'confirmed')<svg class="icon steppers-success" aria-hidden="true"><use href="{{ $icon('it-check') }}"></use></svg><span class="visually-hidden">{{ $d('stepper.confirmed_label') }}</span>@endif
                    @if (($step['state'] ?? '') === 'active')<span class="visually-hidden">{{ $d('stepper.active_label') }}</span>@endif
                </li>
            @endforeach
        </ul>
        <span class="steppers-index" aria-hidden="true">{{ $d('stepper.index') }}</span>
    </div>
</div>
