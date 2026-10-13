@props(['data' => []])
{{--
    Heading Design Comuni — reference sito/servizi/accesso-servizio.html:
    cmp-heading pb-3 pb-lg-4 con h1 title-xxxlarge e p subtitle-small.
    Variante di heading/default (usata da ticket-list) con la classe di
    spaziatura del riferimento. Dati dal JSON.
--}}
@php
    $title = $data['title'] ?? ($data['heading'] ?? '');
    $subtitle = $data['subtitle'] ?? ($data['intro'] ?? ($data['description'] ?? ''));
@endphp

<div class="cmp-heading pb-3 pb-lg-4">
    <h1 class="title-xxxlarge">{{ $title }}</h1>
    @if ($subtitle)
        <p class="subtitle-small">{{ $subtitle }}</p>
    @endif
</div>
