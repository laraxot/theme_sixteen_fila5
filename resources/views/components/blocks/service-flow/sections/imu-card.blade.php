{{--
    Scheda grigia IMU (cmp-card) con contenuto a blocchi. `section`: wrap (`section` = <section class="it-page-section {class}" id>, altrimenti nessun involucro), id, class,
    wrapper_class, card_class, header_class, title, title_tag (h2|h3), title_class, subtitle, subtitle_class, header_content {kind, ...} (nell'intestazione, dopo il sottotitolo),
    content {kind, ...}: `kind` = nome del file in card-content/ (imu-stack, imu-select, imu-input, imu-toggle, imu-check-cards, imu-total, info-cards, ...).
--}}
@php
    $titleTag = ($section['title_tag'] ?? 'h2') === 'h3' ? 'h3' : 'h2';
    $wrap = ($section['wrap'] ?? 'none') === 'section';
    $cc = 'pub_theme::components.blocks.service-flow.card-content.';
@endphp
@if ($wrap)<section class="{{ trim('it-page-section '.($section['class'] ?? '')) }}" id="{{ $section['id'] ?? '' }}">@endif
    <div class="{{ trim('cmp-card '.($section['wrapper_class'] ?? '')) }}">
        <div class="{{ $section['card_class'] ?? 'card has-bkg-grey shadow-sm' }}">
            <div class="{{ $section['header_class'] ?? 'card-header border-0 p-0 mb-lg-20' }}">
                <div class="d-flex"><{{ $titleTag }} class="{{ $section['title_class'] ?? 'title-xxlarge mb-1' }}">{{ $section['title'] ?? '' }}</{{ $titleTag }}></div>
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
@if ($wrap)</section>@endif
