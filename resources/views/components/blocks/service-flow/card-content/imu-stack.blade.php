{{--
    Sequenza di blocchi (e, se serve, un involucro). `content`: wrapper_class (se presente i blocchi stanno in un <div> con quelle classi),
    blocks[] {kind, ...} (kind = nome del file in card-content/, anche imu-stack annidato).
--}}
@php
    $cc = 'pub_theme::components.blocks.service-flow.card-content.';
    $wrapper = $content['wrapper_class'] ?? null;
@endphp
@if (filled($wrapper))<div class="{{ $wrapper }}">@endif
@foreach ($content['blocks'] ?? [] as $block)
    @includeIf($cc.preg_replace('/[^a-z0-9-]/', '', (string) ($block['kind'] ?? '')), ['content' => $block])
@endforeach
@if (filled($wrapper))</div>@endif
