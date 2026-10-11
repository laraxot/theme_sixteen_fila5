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

<section class="fc-how-section" aria-labelledby="how-it-works-heading" data-section="how-it-works">
    <div class="container">
        {{-- Section Header --}}
        <div class="row mb-5" data-reveal="fade-up" data-delay="0">
            <div class="col-12 col-lg-8">
                <h2 id="how-it-works-heading" class="title-xxlarge mb-3">{{ $heading }}</h2>
                <p class="text-secondary mb-0">{{ $intro }}</p>
            </div>
        </div>
        
        {{-- Steps Grid --}}
        <div class="fc-how-grid" role="list" aria-label="{{ $steps_label }}">
            @foreach ($steps as $index => $step)
                @php
                    $number = $step['number'] ?? ($loop->iteration);
                    $title  = (string) __($step['title'] ?? '');
                    $body   = (string) __($step['body'] ?? '');
                    $icon   = $step['icon'] ?? null;
                @endphp
                <article class="fc-how-card"
                         data-reveal="fade-up" 
                         data-delay="{{ $index * 100 }}"
                         role="listitem"
                         tabindex="0">
                    {{-- Step Number --}}
                    <span class="{{ $step_numbers['class'] }}"
                          style="{{ $step_numbers['style'] }}"
                          aria-hidden="{{ $step_numbers['aria_hidden'] ? 'true' : 'false' }}">
                        {{ $number }}
                    </span>
                    
                    {{-- Optional Icon --}}
                    @if($icon)
                        <div class="fc-how-card__icon mb-3" aria-hidden="true">
                            <svg class="icon icon-lg" aria-hidden="true">
                                <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#{{ $icon }}"></use>
                            </svg>
                        </div>
                    @endif
                    
                    {{-- Content --}}
                    <h3 class="h5 mb-2">{{ $title }}</h3>
                    <p class="text-secondary mb-0">{{ $body }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- Motion Animation Script --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Scroll reveal for section header and step cards
    const revealElements = document.querySelectorAll('[data-section="how-it-works"] [data-reveal]');
    
    if (!prefersReducedMotion && revealElements.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = parseInt(el.dataset.delay || '0', 10);
                    
                    setTimeout(() => {
                        el.classList.add('reveal-fade-up');
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, delay);
                    
                    revealObserver.unobserve(el);
                }
            });
        }, {
            rootMargin: '0px 0px -80px 0px',
            threshold: 0.1
        });
        
        revealElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            revealObserver.observe(el);
        });
    } else {
        // Reduced motion: show all immediately
        revealElements.forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        });
    }
    
    // Enhanced hover/tap interaction for step cards
    document.querySelectorAll('.fc-how-card').forEach(card => {
        let pressTimer = null;
        
        const applyPress = () => {
            if (!prefersReducedMotion) {
                card.style.transform = 'translateY(-4px)';
                card.style.boxShadow = '0 12px 24px -8px rgba(0, 0, 0, 0.15)';
                card.style.transition = 'transform 0.2s ease-out, box-shadow 0.2s ease-out';
            }
        };
        
        const releasePress = () => {
            if (!prefersReducedMotion) {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '';
                card.style.transition = 'transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s ease-out';
            }
        };
        
        // Mouse events
        card.addEventListener('mouseenter', applyPress);
        card.addEventListener('mouseleave', releasePress);
        
        // Touch events for mobile
        card.addEventListener('touchstart', () => {
            pressTimer = setTimeout(applyPress, 100);
        }, { passive: true });
        
        card.addEventListener('touchend', () => {
            clearTimeout(pressTimer);
            releasePress();
        }, { passive: true });
        
        card.addEventListener('touchcancel', () => {
            clearTimeout(pressTimer);
            releasePress();
        }, { passive: true });
        
        // Keyboard accessibility
        card.addEventListener('focus', applyPress);
        card.addEventListener('blur', releasePress);
    });
});
</script>
@endpush
