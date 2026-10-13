{{--
    Sezione con scheda grigia (cmp-card). `section`: id, tag (section|div|none, default section: involucro esterno, `none` = nessun involucro), plain (true = involucro senza
    class ne' id), class, heading {tag (h2|h3), class, text} (titolo prima dell'involucro), wrapper_class, card_class, header_class, title, title_tag (h2|h3, default h2), title_class,
    title_id (id del titolo), subtitle, subtitle_class, header_content {kind, ...} (nell'intestazione, dopo il sottotitolo), content {kind, ...}.
    `kind` = nome del file in card-content/ (select, radios, info-cards, messages, activities, ...).
--}}
@php
    $tag = in_array($section['tag'] ?? 'section', ['div', 'none'], true) ? $section['tag'] : 'section';
    $headingTag = in_array(data_get($section, 'heading.tag'), ['h2', 'h3'], true) ? data_get($section, 'heading.tag') : 'h2';
    $plain = (bool) ($section['plain'] ?? false);
    $titleTag = ($section['title_tag'] ?? 'h2') === 'h3' ? 'h3' : 'h2';
    $cc = 'pub_theme::components.blocks.service-flow.card-content.';
@endphp
@if (filled(data_get($section, 'heading.text')))<{{ $headingTag }} class="{{ data_get($section, 'heading.class', 'title-xxlarge mb-4') }}">{{ data_get($section, 'heading.text') }}</{{ $headingTag }}>@endif
@if ($tag !== 'none')<{{ $tag }}{!! $plain ? '' : ' class="'.e(trim('it-page-section '.($section['class'] ?? ''))).'" id="'.e($section['id'] ?? '').'"' !!}>{!! $plain ? '' : "\n" !!}@endif
<div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? '')) }}">
        <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm' }}">
            <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
                <div class="d-flex"><{{ $titleTag }} class="{{ $section['title_class'] ?? 'title-xxlarge' }}"@if (filled($section['title_id'] ?? null)) id="{{ $section['title_id'] }}"@endif>{{ $section['title'] ?? '' }}</{{ $titleTag }}></div>
                @if (filled($section['subtitle'] ?? null))<p class="{{ $section['subtitle_class'] ?? 'subtitle-small mb-0' }}">{{ $section['subtitle'] }}</p>@endif
                @if (filled($section['header_content'] ?? null))
                    @includeIf($cc.preg_replace('/[^a-z0-9-]/', '', (string) data_get($section, 'header_content.kind', '')), ['content' => $section['header_content']])
                @endif
            </div>
            <div class="card-body p-0">
                @includeIf($cc.preg_replace('/[^a-z0-9-]/', '', (string) data_get($section, 'content.kind', '')), ['content' => $section['content'] ?? []])
            </div>
        </div>
    </div>
@if ($tag !== 'none')</{{ $tag }}>@endif
