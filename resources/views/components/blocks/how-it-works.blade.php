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
>
    <div class="container">
        <div class="fc-section-heading" data-reveal="fade-up" data-delay="0">
            <h2 id="how-it-works-heading">{{ $heading }}</h2>
            <p>{{ $intro }}</p>
        </div>

        <ol class="fc-how-grid" aria-label="{{ $steps_label }}">
            @foreach ($steps as $index => $step)
                @php
                    $number = $step['number'] ?? ($loop->iteration);
                    // JSON may ship human copy OR lang keys — translate only keys.
                    $rawTitle = (string) ($step['title'] ?? '');
                    $rawBody = (string) ($step['body'] ?? '');
                    $isKey = static fn (string $v): bool => $v !== '' && (str_contains($v, '::') || str_starts_with($v, 'home.') || str_starts_with($v, 'pub_theme::'));
                    $title = $isKey($rawTitle) ? (string) __($rawTitle) : $rawTitle;
                    $body = $isKey($rawBody) ? (string) __($rawBody) : $rawBody;
                    $icon = $step['icon'] ?? null;
                @endphp
                <li
                    class="fc-how-card"
                    data-reveal="fade-up"
                    data-delay="{{ $index * 100 }}"
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

                    <h3>{{ $title }}</h3>
                    <p>{{ $body }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
