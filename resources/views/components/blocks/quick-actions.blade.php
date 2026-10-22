{{--
    Banda CTA finale guest — contratto Design Comuni (bg-light, btn-primary).
    Niente cerchi decorativi / fc-button--sun: SVG fluidi + radius 999px
    diventavano bottoni circolari da ~200px (incoerenza FO).

    Callers: content_blocks type quick-actions via pub_theme::components.blocks.quick-actions
    in laravel/config/local/fixcity/database/content/pages/home.json.
    Same purpose as pages_old/index.blade.php final bg-light band.
    Schema: heading, body, button{label,url}, secondary_button{label,url} from block data.
    User: "la homepage http://192.168.1.40:8000/it non e' coerente"
--}}
@php
    $heading = $heading ?? __('pub_theme::home.list.track_heading');
    $body = $body ?? __('pub_theme::home.list.track_body');
    $button = is_array($button ?? null) ? $button : [
        'label' => __('pub_theme::home.list.track_button'),
        'url' => '#',
    ];
    $secondary_button = is_array($secondary_button ?? null) ? $secondary_button : null;
@endphp

<section class="fc-track-section" aria-labelledby="quick-actions-heading" data-section="quick-actions">
    <div class="fc-track-section__inner container">
        <div class="fc-track-section__copy">
            <p class="fc-eyebrow">{{ __('pub_theme::home.list.track') }}</p>
            <h2 id="quick-actions-heading">{{ $heading }}</h2>
            <p>{{ $body }}</p>
        </div>
        <div class="fc-track-section__actions">
            <div>
                @if ($button)
                    <a class="fc-button fc-button--primary quick-action-btn" href="{{ $button['url'] ?? '#' }}">
                        {{ $button['label'] ?? '' }}
                    </a>
                @endif
                @if (is_array($secondary_button) && filled($secondary_button['label'] ?? null))
                    <a class="fc-button fc-button--quiet quick-action-btn" href="{{ $secondary_button['url'] ?? '#' }}">
                        {{ $secondary_button['label'] }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
