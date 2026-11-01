@props(['data' => []])

{{-- 
    Feedback Section Component - Design Comuni Style
    Usage: <x-blocks.feedback-section :data="$feedbackData" />
    
    Data structure:
    - title: string
    - description: string
--}}

@php
    $title = $data['title'] ?? 'Dicono di noi';
    $description = $data['description'] ?? 'Valuta la qualità della pagina';
@endphp

<section class="feedback-section py-8 bg-gray-50">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="title-xxlarge mb-4">{{ $title }}</h2>
                <p class="lead text-gray-600 mb-6">{{ $description }}</p>
                
                {{-- Star Rating --}}
                <div class="rating-stars mb-6">
                    <div class="d-inline-flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                        <button 
                            class="btn btn-link p-0 text-3xl hover:text-primary transition-colors"
                            aria-label="{{ __('pub_theme::blocks_content.feedback_section.rate_stars.label', ['count' => $i]) }}"
                        >
                            <x-filament::icon icon="heroicon-o-star" class="w-10 h-10" />
                        </button>
                        @endfor
                    </div>
                </div>
                
                {{-- Feedback Options --}}
                <div class="feedback-options">
                    <h3 class="h5 font-semibold mb-3">{{ __('pub_theme::blocks_content.feedback_section.positive_aspects.label') }}</h3>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.clear_instructions.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.complete.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.progress_tracking.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.no_technical_issues.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.other.label') }}</button>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h3 class="h5 font-semibold mb-3">{{ __('pub_theme::blocks_content.feedback_section.difficulties_encountered.label') }}</h3>
                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.unclear_instructions.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.incomplete_information.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.unclear_progress.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.technical_issues.label') }}</button>
                        <button class="btn btn-outline-primary btn-sm">{{ __('pub_theme::blocks_content.feedback_section.other.label') }}</button>
                    </div>
                </div>
                
                {{-- Details Textarea --}}
                <div class="mt-6">
                    <label for="feedback-details" class="form-label h5 font-semibold">{{ __('pub_theme::blocks_content.feedback_section.details_max_200_characters.label') }}</label>
                    <textarea 
                        id="feedback-details" 
                        class="form-control" 
                        rows="3" 
                        maxlength="200"
                        placeholder="{{ __('pub_theme::blocks_content.feedback_section.describe_your_experience.placeholder') }}"
                    ></textarea>
                </div>
                
                {{-- Navigation Buttons --}}
                <div class="mt-6">
                    <button class="btn btn-secondary me-2">{{ __('pub_theme::blocks_common.shared.back.label') }}</button>
                    <button class="btn btn-primary">{{ __('pub_theme::blocks_common.shared.next.label') }}</button>
                </div>
            </div>
        </div>
    </div>
</section>
