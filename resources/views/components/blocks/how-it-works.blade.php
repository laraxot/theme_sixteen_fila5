{{--
    How It Works Block - Design Comuni compliant
    Uses civic design tokens: fc-how-section, fc-how-grid, fc-how-card
    WCAG 2.1 AA compliant contrast ratios
    Motion animations with prefers-reduced-motion support
--}}
@php
    $heading      = $heading ?? __('pub_theme::home.how.title');
    $intro        = $intro ?? __('pub_theme::home.how.intro');
    $steps_label  = $steps_label ?? 'Steps';
    $steps        = is_array($steps ?? null) ? $steps : [];
    $step_numbers = $step_numbers ?? [
        'aria_hidden' => true,
        'style'       => 'width:2.5rem;height:2.5rem',
        'class'       => 'fc-how-card__number'
    ];
@endphp

<section
    class="fc-how-section"
    aria-labelledby="how-it-works-heading"
    data-section="how-it-works"
    x-data="howItWorks()"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-5" data-reveal="fade-up" data-delay="0">
            <h2 id="how-it-works-heading" class="mb-3 text-3xl font-bold md:text-4xl">{{ $heading }}</h2>
            <p class="mb-0 text-slate-600">{{ $intro }}</p>
        </div>

        <div class="fc-how-grid" role="list" aria-label="{{ $steps_label }}">
            @foreach ($steps as $index => $step)
                @php
                    $number = $step['number'] ?? ($loop->iteration);
                    $title  = (string) __($step['title'] ?? '');
                    $body   = (string) __($step['body'] ?? '');
                    $icon   = $step['icon'] ?? null;
                @endphp
                <article
                    class="fc-how-card"
                    data-reveal="fade-up"
                    data-delay="{{ $index * 100 }}"
                    role="listitem"
                    tabindex="0"
                >
                    <span
                        class="{{ $step_numbers['class'] }}"
                        style="{{ $step_numbers['style'] }}"
                        aria-hidden="{{ $step_numbers['aria_hidden'] ? 'true' : 'false' }}"
                    >{{ $number }}</span>

                    @if($icon)
                        <div class="fc-how-card__icon mb-3" aria-hidden="true">
                            @include('pub_theme::components.ui.icon', ['name' => $icon, 'class' => 'h-6 w-6 text-emerald-600'])
                        </div>
                    @endif

                    <h3 class="mb-2 text-lg font-semibold">{{ $title }}</h3>
                    <p class="mb-0 text-slate-600">{{ $body }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>
