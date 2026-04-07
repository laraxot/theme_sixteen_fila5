@props([
    'title' => '',
    'description' => '',
    'steps' => [],
    'currentStep' => 1,
    'variant' => 'horizontal',
    'size' => 'md',
    'navigable' => false,
    'showDescription' => true,
    'showNumbers' => true,
    'theme' => 'primary',
    'nonLinear' => false,
])

@php
    $steps = collect($steps)->map(function ($step, $index) {
        if (is_string($step)) {
            return [
                'title' => $step,
                'description' => null,
                'completed' => false,
                'disabled' => false,
                'optional' => false,
            ];
        }
        
        return array_merge([
            'title' => 'Step ' . ($index + 1),
            'description' => null,
            'completed' => false,
            'disabled' => false,
            'optional' => false,
        ], $step);
    });
@endphp

<section class="stepper-flow-section py-8" x-data="{ currentStep: {{ $currentStep }} }">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($title || $description)
            <div class="mb-8">
                @if($title)
                    <h2 class="text-2xl font-bold text-gray-900" data-element="stepper-title">{{ $title }}</h2>
                @endif
                @if($description)
                    <p class="mt-2 text-gray-600" data-element="stepper-description">{{ $description }}</p>
                @endif
            </div>
        @endif

        <x-stepper
            :steps="collect($steps)->pluck('title')->values()->toArray()"
            :current-step="$currentStep"
            :variant="$variant"
            :size="$size"
            :navigable="$navigable"
            :show-description="$showDescription"
            :show-numbers="$showNumbers"
            :theme="$theme"
            :non-linear="$nonLinear"
            x-model="currentStep"
        >
            {{ $slot }}
        </x-stepper>
    </div>
</section>