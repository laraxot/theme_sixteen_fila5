@php
    // Extract and validate props
    $steps = $steps ?? [];
    $currentStep = ($currentStep ?? 0) + 1; // Convert 0-based to 1-based
    $totalSteps = $totalSteps ?? count($steps);
    
    // Bootstrap Italia sprite path
    $sprite = '/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg';
@endphp

<div class="steppers" role="navigation" aria-label="Progresso wizard">
    <div class="steppers-header">
        <ul class="step-list">
            @foreach($steps as $index => $step)
                @php
                    $stepNum = $index + 1;
                    $isActive = $stepNum === $currentStep;
                    $isCompleted = $stepNum < $currentStep;
                    $isPending = $stepNum > $currentStep;
                    
                    // Get step data from Filament Step component
                    $stepLabel = $step->getLabel();
                    $stepDescription = $step->getDescription();
                    $stepIcon = $step->getIcon();
                @endphp
                
                <li class="step-item"
                    @if($isActive) aria-current="step" @endif
                    data-step="{{ $stepNum }}"
                    :class="{ 
                        'active': {{ $isActive ? 'true' : 'false' }}, 
                        'confirmed': {{ $isCompleted ? 'true' : 'false' }},
                        'text-muted': {{ $isPending ? 'true' : 'false' }}
                    }">
                    
                    {{-- Step icon with checkmark for completed --}}
                    <span class="step-icon" aria-hidden="true">
                        @if($isCompleted)
                            {{-- Completed step: show checkmark --}}
                            <svg class="icon step-icon-svg">
                                <use href="{{ $sprite }}#it-check"></use>
                            </svg>
                        @else
                            {{-- Active or pending: show number or custom icon --}}
                            <span class="step-number">{{ $stepNum }}</span>
                        @endif
                    </span>
                    
                    {{-- Step label --}}
                    <span class="step-title">{{ $stepLabel }}</span>
                    
                    {{-- Divider between steps (not after last) --}}
                    @if($stepNum < $totalSteps)
                        <span class="step-divider" aria-hidden="true"></span>
                    @endif
                </li>
            @endforeach
        </ul>
        
        {{-- Step counter (e.g., "1/3") --}}
        <span class="steppers-index" aria-hidden="true">
            {{ $currentStep }}/{{ $totalSteps }}
        </span>
    </div>
</div>
