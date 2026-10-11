{{--
    Quick Actions Block - Design Comuni compliant
    Uses civic design tokens: fc-track-section, fc-button, fc-green, fc-sun, fc-ink
    WCAG 2.1 AA compliant contrast ratios
    Motion animations with prefers-reduced-motion support
--}}
@php
    $heading         = $heading ?? __('pub_theme::home.list.track_heading');
    $body            = $body ?? __('pub_theme::home.list.track_body');
    $eyebrow         = $eyebrow ?? __('pub_theme::home.list.track_eyebrow');
    $button          = is_array($button ?? null) ? $button : ['label' => __('pub_theme::home.list.track_button'), 'url' => '{{ route(\'tickets.track\') }}', 'icon' => 'it-search'];
    $secondary_button = is_array($secondary_button ?? null) ? $secondary_button : ['label' => __('pub_theme::home.list.create_button'), 'url' => '{{ route(\'tickets.create\') }}', 'icon' => 'it-plus'];
@endphp

<section
    class="fc-track-section"
    aria-labelledby="quick-actions-heading"
    data-section="quick-actions"
    x-data="quickActions()"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="fc-track-section__inner">
            <div class="fc-track-section__copy mb-4" data-reveal="fade-up" data-delay="0">
                <p class="fc-eyebrow">{{ $eyebrow }}</p>
                <h2 id="quick-actions-heading" class="mb-1 text-2xl font-bold md:text-3xl">{{ $heading }}</h2>
                <p class="mb-0">{{ $body }}</p>
            </div>

            <div class="fc-track-section__actions" data-reveal="fade-up" data-delay="100">
                <div class="flex flex-col sm:flex-row sm:justify-end items-stretch gap-3">
                    @if($button)
                        <a href="{{ $button['url'] }}"
                           class="fc-button fc-button--sun inline-flex items-center gap-2 quick-action-btn"
                           data-action="primary">
                            @if(isset($button['icon']))
                                @include('pub_theme::components.ui.icon', ['name' => $button['icon'], 'class' => 'h-5 w-5'])
                            @endif
                            {{ $button['label'] }}
                        </a>
                    @endif

                    @if($secondary_button)
                        <a href="{{ $secondary_button['url'] }}"
                           class="fc-button fc-button--quiet inline-flex items-center gap-2 quick-action-btn"
                           data-action="secondary">
                            @if(isset($secondary_button['icon']))
                                @include('pub_theme::components.ui.icon', ['name' => $secondary_button['icon'], 'class' => 'h-5 w-5'])
                            @endif
                            {{ $secondary_button['label'] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
