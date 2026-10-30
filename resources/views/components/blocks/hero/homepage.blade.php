{{--
    Hero Homepage Block
    DesignComuni civic tokens: fc-home-hero, fc-button, fc-eyebrow, font-serif
    Tailwind utilities: mx-auto, max-w-7xl, px-4, sm:px-6, lg:px-8, flex, etc.
    References: design-comuni-pagine-statiche/src/pages/sito/homepage.hbs #head-section
--}}
@php
    // Support both @include (direct vars) and @component (via $data)
    $data = $data ?? [];
    $title = isset($title) ? $title : ($data['title'] ?? __('pub_theme::components_content.hero.municipality_name.label'));
    $news = isset($news) && is_array($news) ? $news : ($data['news'] ?? []);
    $image = isset($image) ? $image : ($data['image'] ?? 'https://picsum.photos/800/600');
    $allNewsLabel = isset($all_news_label) ? $all_news_label : ($data['all_news_label'] ?? __('pub_theme::navigation.homepage.all_news'));
    $allNewsUrl = isset($all_news_url) ? $all_news_url : ($data['all_news_url'] ?? '#');
    $excerpt = $news['excerpt'] ?? '';
    $excerptLead = $excerpt;
    $excerptTail = '';

    if ($excerpt !== '') {
        // Split: first 4 words bold, rest plain
        $parts = preg_split('/\s+/', trim($excerpt), 5);
        if (is_array($parts) && count($parts) >= 5) {
            $excerptLead = implode(' ', array_slice($parts, 0, 4));
            $excerptTail = $parts[4];
        }
    }
@endphp

<h1 class="visually-hidden">{{ $title }}</h1>
<section class="fc-home-hero" aria-labelledby="fc-home-hero-heading">
    <div class="fc-home-hero__inner mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="fc-home-hero__copy">
            <p class="fc-eyebrow">{{ __('pub_theme::components_content.hero.eyebrow.label') }}</p>
            <h1 id="fc-home-hero-heading" class="font-serif">{{ __('pub_theme::components_content.hero.heading.title') }}</h1>
            <p class="fc-home-hero__intro">{{ __('pub_theme::components_content.hero.intro.text') }}</p>
            <div class="fc-home-hero__actions">
                <a class="fc-button fc-button--primary" href="https://fixcity.eu/it/tickets/create">{{ __('pub_theme::faq.contacts.report') }}</a>
                <a class="fc-button fc-button--quiet" href="https://fixcity.eu/it/tickets">{{ __('pub_theme::components_content.hero.view_reports.label') }}</a>
            </div>
        </div>

        <aside class="fc-home-hero__signal" aria-label="{{ __('pub_theme::components_content.hero.signal_eyebrow.label') }}">
            <span class="fc-home-hero__signal-mark" aria-hidden="true"></span>
            <p class="fc-eyebrow">{{ __('pub_theme::components_content.hero.signal_eyebrow.label') }}</p>
            <p class="fc-home-hero__signal-value">{{ __('pub_theme::home.hero.signal_heading') }}</p>
            <p class="fc-home-hero__signal-body">{{ __('pub_theme::home.hero.signal_body') }}</p>
            <div class="fc-home-hero__signal-line" aria-hidden="true"></div>
        </aside>
    </div>
</section>