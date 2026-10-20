@props([
    'eyebrow' => 'FixCity',
    'heading' => '',
    'intro' => '',
    'primary_label' => '',
    'primary_url' => '#',
    'secondary_label' => '',
    'secondary_url' => '#',
    'meta_label' => '',
    'meta_value' => '',
    'meta_body' => '',
])

<section class="fc-home-hero" aria-labelledby="fc-home-hero-heading">
    <div class="fc-home-hero__inner mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="fc-home-hero__copy">
            <p class="fc-eyebrow">{{ $eyebrow }}</p>
            <h1 id="fc-home-hero-heading" class="font-serif">{{ $heading }}</h1>
            <p class="fc-home-hero__intro">{{ $intro }}</p>
            <div class="fc-home-hero__actions">
                <a class="fc-button fc-button--primary" href="{{ $primary_url }}">{{ $primary_label }}</a>
                <a class="fc-button fc-button--quiet" href="{{ $secondary_url }}">{{ $secondary_label }}</a>
            </div>
        </div>

        <aside class="fc-home-hero__signal" aria-label="{{ $meta_label }}">
            <span class="fc-home-hero__signal-mark" aria-hidden="true"></span>
            <p class="fc-eyebrow">{{ $meta_label }}</p>
            <p class="fc-home-hero__signal-value">{{ $meta_value }}</p>
            <p class="fc-home-hero__signal-body">{{ $meta_body }}</p>
            <div class="fc-home-hero__signal-line" aria-hidden="true"></div>
        </aside>
    </div>
</section>
