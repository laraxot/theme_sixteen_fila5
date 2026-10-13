{{--
    Variante graduatoria di card (DCP-26): in piu' `title_id` (id dell'h2); il resto e' identico al tipo condiviso.
    Sezione con scheda grigia (cmp-card). `section`: id, tag (section|div), class, wrapper_class, card_class, header_class, title, title_class, subtitle,
    subtitle_class, content {kind, ...}. `content.kind` = nome del file in card-content/ (select, radios, info-cards, messages, activities).
--}}
@php
    $tag = ($section['tag'] ?? 'section') === 'div' ? 'div' : 'section';
@endphp
<{{ $tag }} class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">
    <div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? '')) }}">
        <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm' }}">
            <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
                <div class="d-flex"><h2 class="{{ $section['title_class'] ?? 'title-xxlarge' }}"@if (filled($section['title_id'] ?? null)) id="{{ $section['title_id'] }}"@endif>{{ $section['title'] ?? '' }}</h2></div>
                @if (filled($section['subtitle'] ?? null))<p class="{{ $section['subtitle_class'] ?? 'subtitle-small mb-0' }}">{{ $section['subtitle'] }}</p>@endif
            </div>
            <div class="card-body p-0">
                @includeIf('pub_theme::components.blocks.service-flow.card-content.'.preg_replace('/[^a-z0-9-]/', '', (string) data_get($section, 'content.kind', '')), ['content' => $section['content'] ?? []])
            </div>
        </div>
    </div>
</{{ $tag }}>
