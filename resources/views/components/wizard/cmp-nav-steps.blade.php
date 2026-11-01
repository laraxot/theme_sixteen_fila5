@props([
    'steps' => [],
    'totalSteps' => 0,
    'isFirstStep' => true,
    'isLastStep' => false,
    'hasSave' => false,
])

<div class="cmp-nav-steps">
    <nav class="steppers-nav" aria-label="{{ __('pub_theme::utilities_components.wizard.steps_nav.label') }}">
        <button
            type="button"
            class="btn btn-sm steppers-btn-prev"
            x-bind:class="{ 'btn-back-step': !isFirstStep() }"
            x-on:click="goToPreviousStep"
            x-show="!isFirstStep()"
            :disabled="isFirstStep()"
            aria-label="{{ __('pub_theme::common.actions.back.label') }}"
        >
            <svg class="icon icon-primary icon-sm" aria-hidden="true">
                <path d="m15 18-6-6 6-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
            <span class="text-button-sm t-primary">{{ __('pub_theme::common.actions.back.label') }}</span>
        </button>

        <button
            type="button"
            class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-none d-lg-block"
            x-show="!isFirstStep() && !isLastStep()"
            x-on:click="$wire.save()"
        >
            <span class="text-button-sm t-primary">{{ __('pub_theme::utilities_components.wizard.save_request.label') }}</span>
        </button>

        <button
            type="button"
            class="btn btn-outline-primary bg-white btn-sm steppers-btn-save d-block d-lg-none"
            x-show="!isFirstStep() && !isLastStep()"
            x-on:click="$wire.save()"
        >
            <span class="text-button-sm t-primary">{{ __('pub_theme::common.actions.save.label') }}</span>
        </button>

        <button
            type="button"
            class="btn btn-primary btn-sm steppers-btn-confirm"
            x-bind:class="{ 'btn-next-step': !isLastStep() }"
            x-on:click="isLastStep() ? $wire.save() : requestNextStep()"
        >
            <span class="text-button-sm" x-text="isLastStep() ? 'Invia' : 'Avanti'"></span>
            <svg class="icon icon-white icon-sm" aria-hidden="true" x-show="!isLastStep()">
                <path d="m9 18 6-6-6-6" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
            </svg>
        </button>
    </nav>
</div>
