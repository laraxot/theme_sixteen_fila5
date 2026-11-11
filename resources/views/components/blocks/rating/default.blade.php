@props(['data' => []])

@php
    $title = (string) ($data['title'] ?? __('pub_theme::news.index.feedback.title'));
    $max = max(1, (int) ($data['max'] ?? 5));
@endphp

<section {{ $attributes->class(['dc-rating']) }} aria-label="{{ __('pub_theme::components_reports.rating.region.label') }}" x-data="{ selected: 0 }">
    <div class="dc-rating__card">
        <p class="dc-rating__title">{{ $title }}</p>
        <div class="dc-rating__stars" role="radiogroup" aria-label="{{ __('pub_theme::components_reports.rating.rate_range.label', ['max' => $max]) }}">
            @for ($star = 1; $star <= $max; $star++)
                <button type="button" role="radio" :aria-checked="selected === {{ $star }}" aria-label="{{ trans_choice('pub_theme::components_reports.rating.stars.label', $star) }}" @click="selected = {{ $star }}">★</button>
            @endfor
        </div>
    </div>
</section>
