{{--
    Feedback Rating Block - Multi-Step Wizard
    Reference: italia.github.io/design-comuni-pagine-statiche/sito/homepage.html #rating
    Structure: Star rating → follow-up questions → thank you
    Tech: Bootstrap class names (HTML parity) + Tailwind @apply (styling) + Alpine.js (interactivity)
    Multilingual: ALL text from translations via __('namespace::context.collection.element.type')
    Usage: <x-pub_theme::components.blocks.feedback.rating :data="$blockData" />
--}}
@props(['data' => []])

@php
    // Translation namespace
    $ns = 'fixcity::rating';

    // Helper: resolve translation key or fallback to value (always returns string)
    $t = function (mixed $value, string $fallbackKey) use ($ns): string {
        if (is_array($value)) {
            $value = $value[app()->getLocale()] ?? null;
        }
        if (empty($value)) {
            return __($ns . '.' . $fallbackKey);
        }
        if (str_contains((string) $value, '::')) {
            return __((string) $value);
        }
        return (string) $value;
    };

    // Title & subtitle
    $titleRaw = $data['title'] ?? null;
    $title = $t($titleRaw, 'fields.title.label');

    $subtitleRaw = $data['subtitle'] ?? null;
    $subtitle = $t($subtitleRaw, 'fields.subtitle.label');

    // Star rating
    $starLegend = $t($data['star_legend'] ?? null, 'fields.star.legend.label');
    $starLabels = [];
    for ($i = 1; $i <= 5; $i++) {
        $key = 'fields.star.labels.' . $i . '.label';
        $raw = $data['star_labels'][app()->getLocale()][$i] ?? null;
        $starLabels[$i] = $t($raw, $key);
    }

    // Positive feedback options
    $positiveQuestion = $t($data['positive_question'][app()->getLocale()] ?? null, 'fields.positive_question.label');
    $positiveOptions = [];
    $posOptionsRaw = $data['positive_options'][app()->getLocale()] ?? [];
    if (is_array($posOptionsRaw) && count($posOptionsRaw) > 0) {
        foreach ($posOptionsRaw as $idx => $opt) {
            $positiveOptions[$idx] = $t($opt, 'fields.positive_options.options.' . ($idx + 1) . '.label');
        }
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $positiveOptions[$i - 1] = __($ns . '.fields.positive_options.options.' . $i . '.label');
        }
    }

    // Negative feedback options
    $negativeQuestion = $t($data['negative_question'][app()->getLocale()] ?? null, 'fields.negative_question.label');
    $negativeOptions = [];
    $negOptionsRaw = $data['negative_options'][app()->getLocale()] ?? [];
    if (is_array($negOptionsRaw) && count($negOptionsRaw) > 0) {
        foreach ($negOptionsRaw as $idx => $opt) {
            $negativeOptions[$idx] = $t($opt, 'fields.negative_options.options.' . ($idx + 1) . '.label');
        }
    } else {
        for ($i = 1; $i <= 5; $i++) {
            $negativeOptions[$i - 1] = __($ns . '.fields.negative_options.options.' . $i . '.label');
        }
    }

    // Text feedback
    $textQuestion = $t($data['text_question'][app()->getLocale()] ?? null, 'fields.text_question.label');
    $textLabel = $t($data['text_label'][app()->getLocale()] ?? null, 'fields.text_field.label.label');
    $textHelp = $t($data['text_help'][app()->getLocale()] ?? null, 'fields.text_field.help_text.text');
    $textMaxlength = $data['text_maxlength'] ?? 200;

    // Buttons
    $btnBack = $t($data['btn_back'][app()->getLocale()] ?? null, 'actions.back.label');
    $btnNext = $t($data['btn_next'][app()->getLocale()] ?? null, 'actions.next.label');
    $btnSubmit = $t($data['btn_submit'][app()->getLocale()] ?? null, 'actions.submit.label');
    $thankYouMsg = $t($data['thank_you'][app()->getLocale()] ?? null, 'messages.thank_you.text');
@endphp

{{-- Rating Block Container --}}
<div
    id="rating"
    class="cmp-rating pb-lg-80 pt-lg-80"
    x-data="{
        rating: 0,
        hover: 0,
        step: 1,
        selectedOption: null,
        textFeedback: '',
        feedbackType: '',
        submitted: false
    }"
    data-element="feedback"
>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-lg-6">
                <div class="card shadow card-wrapper" data-element="feedback">
                    <div class="cmp-rating__card-first">
                        {{-- Header --}}
                        <div class="card-header border-0">
                            <h2 class="title-medium-2-semi-bold mb-0" data-element="feedback-title">
                                {{ $title }}
                            </h2>
                        </div>

                        {{-- Body --}}
                        <div class="card-body p-lg-0 px-4">
                            {{-- Step 1: Star Rating --}}
                            <div x-show="step === 1" x-transition>
                                <fieldset class="rating" id="fieldset-rating">
                                    <legend class="visually-hidden">{{ $starLegend }}</legend>

                                        {{-- Stars 5→1 for CSS hover --}}
                                        @for ($star = 5; $star >= 1; $star--)
                                        <input
                                            type="radio"
                                            id="star{{ $star }}"
                                            name="rating"
                                            value="{{ $star }}"
                                            x-model="rating"
                                            class="visually-hidden"
                                        >
                                        <label
                                            for="star{{ $star }}"
                                            class="full rating-star"
                                            :class="(hover >= {{ $star }} || rating >= {{ $star }}) ? 'active' : ''"
                                            @click="rating = {{ $star }}; feedbackType = {{ $star }} >= 4 ? 'positive' : 'negative'; step = 2"
                                            @mouseenter="hover = {{ $star }}"
                                            @mouseleave="hover = 0"
                                            data-element="feedback-rate-{{ $star }}"
                                        >
                                            <svg class="icon icon-sm" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"/>
                                            </svg>
                                            <span class="visually-hidden">{{ $starLabels[$star] }}</span>
                                        </label>
                                        @endfor
                                    </fieldset>
                                </div>

                                {{-- Step 2: Follow-up Questions --}}
                                <div class="cmp-rating__card-second" x-show="step === 2" x-cloak x-transition>
                                    <p class="text-wrapper">{{ $subtitle }}</p>

                                    {{-- Positive feedback --}}
                                    <fieldset
                                        x-show="feedbackType === 'positive'"
                                        x-cloak
                                        data-element="feedback-rating-positive"
                                    >
                                        <legend>
                                            <span data-element="feedback-rating-question">{{ $positiveQuestion }}</span>
                                        </legend>
                                        @foreach($positiveOptions as $index => $option)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="pos-{{ $index }}"
                                                name="positiveFeedback"
                                                value="{{ $index }}"
                                                x-model="selectedOption"
                                            >
                                            <label class="form-check-label" for="pos-{{ $index }}" data-element="feedback-rating-answer">
                                                <span>{{ $option }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </fieldset>

                                    {{-- Negative feedback --}}
                                    <fieldset
                                        x-show="feedbackType === 'negative'"
                                        x-cloak
                                        data-element="feedback-rating-negative"
                                    >
                                        <legend>
                                            <span data-element="feedback-rating-question">{{ $negativeQuestion }}</span>
                                        </legend>
                                        @foreach($negativeOptions as $index => $option)
                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="radio"
                                                id="neg-{{ $index }}"
                                                name="negativeFeedback"
                                                value="{{ $index }}"
                                                x-model="selectedOption"
                                            >
                                            <label class="form-check-label" for="neg-{{ $index }}" data-element="feedback-rating-answer">
                                                <span>{{ $option }}</span>
                                            </label>
                                        </div>
                                        @endforeach
                                    </fieldset>

                                    {{-- Text feedback --}}
                                    <div class="mt-4">
                                        <label class="form-label" for="feedback-text">{{ $textQuestion }}</label>
                                        <textarea
                                            class="form-control"
                                            id="feedback-text"
                                            x-model="textFeedback"
                                            maxlength="{{ $textMaxlength }}"
                                            data-element="feedback-input-text"
                                            rows="3"
                                        ></textarea>
                                        <p class="form-text">{{ $textHelp }} (<span x-text="textFeedback.length"></span>/{{ $textMaxlength }})</p>
                                    </div>

                                    {{-- Navigation buttons --}}
                                    <div class="mt-4 d-flex gap-3">
                                        <button
                                            type="button"
                                            class="btn btn-outline-primary"
                                            @click="step = 1; selectedOption = null"
                                        >
                                            {{ $btnBack }}
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-primary"
                                            @click="submitted = true; step = 3"
                                        >
                                            {{ $btnSubmit }}
                                        </button>
                                    </div>
                                </div>

                                {{-- Step 3: Thank You --}}
                                <div class="cmp-rating__card-second" x-show="step === 3" x-cloak x-transition>
                                    <div class="text-center p-4">
                                        <svg class="icon icon-xl text-success mx-auto mb-3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        <p class="text-wrapper">{{ $thankYouMsg }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
