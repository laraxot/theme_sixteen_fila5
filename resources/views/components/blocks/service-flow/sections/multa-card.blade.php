{{--
    Scheda grigia della famiglia multa (DCP-28), senza il contenitore `it-page-section` di `card`. `section`: heading {tag (h2|h3), class, text} (titolo prima della scheda),
    wrap (true = `<div>` esterno; stringa = con quelle classi), wrapper_class (dopo `cmp-card`), card_class, header_class, title, title_tag (h2|h3), title_class, subtitle, subtitle_class,
    content {kind, ...}: `kind` = nome del file in card-content/ (multa-fields, multa-info-cards).
--}}
@php
    $wrap = $section['wrap'] ?? null;
    $headingTag = in_array(data_get($section, 'heading.tag'), ['h2', 'h3'], true) ? data_get($section, 'heading.tag') : 'h2';
    $titleTag = ($section['title_tag'] ?? 'h2') === 'h3' ? 'h3' : 'h2';
@endphp
@if (filled(data_get($section, 'heading.text')))<{{ $headingTag }} class="{{ data_get($section, 'heading.class', 'title-xxlarge mb-4') }}">{{ data_get($section, 'heading.text') }}</{{ $headingTag }}>@endif
@if ($wrap)<div{!! is_string($wrap) ? ' class="'.e($wrap).'"' : '' !!}>@endif
<div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? '')) }}">
    <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm' }}">
        <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
            <div class="d-flex"><{{ $titleTag }} class="{{ $section['title_class'] ?? 'title-xxlarge' }}">{{ $section['title'] ?? '' }}</{{ $titleTag }}></div>
            @if (filled($section['subtitle'] ?? null))<p class="{{ $section['subtitle_class'] ?? 'subtitle-small mb-0' }}">{{ $section['subtitle'] }}</p>@endif
        </div>
        <div class="card-body p-0">
            @includeIf('pub_theme::components.blocks.service-flow.card-content.'.preg_replace('/[^a-z0-9-]/', '', (string) data_get($section, 'content.kind', '')), ['content' => $section['content'] ?? []])
        </div>
    </div>
</div>
@if ($wrap)</div>@endif
