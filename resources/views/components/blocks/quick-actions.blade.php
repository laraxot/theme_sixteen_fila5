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

<section class="fc-track-section" aria-labelledby="quick-actions-heading" data-section="quick-actions">
    <div class="container">
        <div class="fc-track-section__inner">
            {{-- Copy --}}
            <div class="fc-track-section__copy" data-reveal="fade-up" data-delay="0">
                <p class="fc-eyebrow">{{ $eyebrow }}</p>
                <h2 id="quick-actions-heading" class="title-xlarge mb-1">{{ $heading }}</h2>
                <p class="mb-0">{{ $body }}</p>
            </div>
            
            {{-- Actions --}}
            <div class="fc-track-section__actions" data-reveal="fade-up" data-delay="100">
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-sm-end">
                    {{-- Primary Action --}}
                    @if($button)
                        <a href="{{ $button['url'] }}"
                           class="fc-button fc-button--sun d-inline-flex align-items-center gap-2 quick-action-btn"
                           data-action="primary">
                            @if(isset($button['icon']))
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#{{ $button['icon'] }}"></use>
                                </svg>
                            @endif
                            {{ $button['label'] }}
                        </a>
                    @endif
                    
                    {{-- Secondary Action --}}
                    @if($secondary_button)
                        <a href="{{ $secondary_button['url'] }}"
                           class="fc-button fc-button--quiet d-inline-flex align-items-center gap-2 quick-action-btn"
                           data-action="secondary">
                            @if(isset($secondary_button['icon']))
                                <svg class="icon icon-sm" aria-hidden="true">
                                    <use href="/themes/Sixteen/design-comuni/assets/bootstrap-italia/dist/svg/sprites.svg#{{ $secondary_button['icon'] }}"></use>
                                </svg>
                            @endif
                            {{ $secondary_button['label'] }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Motion Animation Script --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    
    // Scroll reveal
    const revealElements = document.querySelectorAll('[data-section="quick-actions"] [data-reveal]');
    
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
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        });
        
        revealElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(16px)';
            el.style.transition = 'opacity 0.5s cubic-bezier(0.16, 1, 0.3, 1), transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            revealObserver.observe(el);
        });
    } else {
        revealElements.forEach(el => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        });
    }
    
    // Micro-interactions for action buttons
    document.querySelectorAll('.quick-action-btn').forEach(btn => {
        btn.addEventListener('mousedown', function() {
            if (!prefersReducedMotion) {
                this.style.transform = 'scale(0.97)';
                this.style.transition = 'transform 0.1s ease-out';
            }
        });
        
        btn.addEventListener('mouseup', function() {
            if (!prefersReducedMotion) {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                    this.style.transition = 'transform 0.2s ease-out';
                }, 150);
            }
        });
        
        btn.addEventListener('mouseleave', function() {
            if (!prefersReducedMotion) {
                this.style.transform = 'scale(1)';
                this.style.transition = 'transform 0.2s ease-out';
            }
        });
        
        // Touch support
        btn.addEventListener('touchstart', function() {
            if (!prefersReducedMotion) {
                this.style.transform = 'scale(0.97)';
                this.style.transition = 'transform 0.1s ease-out';
            }
        }, { passive: true });
        
        btn.addEventListener('touchend', function() {
            if (!prefersReducedMotion) {
                this.style.transform = 'scale(1)';
                this.style.transition = 'transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            }
        }, { passive: true });
    });
});
</script>
@endpush
