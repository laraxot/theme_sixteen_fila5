@php
    $steps = $steps ?? [];
    $totalSteps = $totalSteps ?? count($steps);

    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<ol
    x-cloak
    x-ref="header"
    class="steppers"
    role="list"
    aria-label="Progresso wizard"
>
    @foreach($steps as $index => $step)
        @php
            $stepNum = $index + 1;
            $stepLabel = $step->getLabel();
            $stepKey = $step->getKey();
        @endphp

        <li
            class="step-item"
            data-step="{{ $stepNum }}"
            x-bind:aria-current="getStepIndex(step) === {{ $index }} ? 'step' : null"
            x-bind:class="{
                'active': getStepIndex(step) === {{ $index }},
                'confirmed': getStepIndex(step) > {{ $index }},
                'text-muted': getStepIndex(step) < {{ $index }},
            }"
        >
            <button
                type="button"
                class="step-button"
                x-on:click="step = @js($stepKey)"
                x-bind:disabled="! isStepAccessible(@js($stepKey))"
            >
                <span class="step-icon" aria-hidden="true">
                    <svg
                        x-show="getStepIndex(step) > {{ $index }}"
                        class="icon step-icon-svg"
                    >
                        <use href="{{ $sprite }}#it-check"></use>
                    </svg>

                    <span
                        x-show="getStepIndex(step) <= {{ $index }}"
                        class="step-number"
                    >
                        {{ $stepNum }}
                    </span>
                </span>

                <span class="step-title">{{ $stepLabel }}</span>
            </button>

            @if($stepNum < $totalSteps)
                <span class="step-divider" aria-hidden="true"></span>
            @endif
        </li>
    @endforeach
</ol>
