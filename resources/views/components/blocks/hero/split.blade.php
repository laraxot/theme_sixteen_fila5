@props([
    'headline' => '',
    'subheadline' => '',
    'description' => '',
    'map_data_url' => '/api/tickets/geojson',
    'map_height' => '420px',
    'map_aria_label' => 'Map',
    'map_caption' => '',
    'map_cta_text' => '',
    'map_cta_url' => '#',
    'cta_primary' => [],
    'cta_secondary' => [],
])

@php
    $primary = is_array($cta_primary) ? $cta_primary : [];
    $secondary = is_array($cta_secondary) ? $cta_secondary : [];
    $headlineText = (string) __($headline);
    $subheadlineText = (string) __($subheadline);
    $descriptionText = (string) __($description);
    $primaryLabel = (string) __($primary['label'] ?? 'fixcity::homepage.map_preview.cta_report.label');
    $secondaryLabel = (string) __($secondary['label'] ?? 'fixcity::homepage.map_preview.cta_list.label');
@endphp

<section class="fc-home-hero" aria-labelledby="fc-home-hero-heading">
    <div class="container">
        <div class="fc-home-hero__copy">
            <p class="fc-eyebrow">{{ $subheadlineText }}</p>
            <h1 id="fc-home-hero-heading">{{ $headlineText }}</h1>
            <p class="fc-home-hero__intro">{{ $descriptionText }}</p>
            <div class="fc-home-hero__actions">
                <a class="fc-button fc-button--primary" href="{{ $primary['url'] ?? '#' }}">{{ $primaryLabel }}</a>
                <a class="fc-button fc-button--quiet" href="{{ $secondary['url'] ?? '#' }}">{{ $secondaryLabel }}</a>
            </div>
        </div>

        <div class="fc-home-hero__signal fc-home-hero__map-card">
            <p class="fc-eyebrow">{{ $map_caption !== '' ? __($map_caption) : __('fixcity::homepage.map_preview.section.title.label') }}</p>
            <map-lit class="fc-home-hero__map" data-url="{{ $map_data_url }}" height="{{ $map_height }}"></map-lit>
            <div class="fc-home-hero__map-footer">
                <span>{{ __('fixcity::homepage.map_preview.section.title.label') }}</span>
                <a href="{{ $map_cta_url }}">{{ __($map_cta_text) }}</a>
            </div>
        </div>
    </div>
</section>
