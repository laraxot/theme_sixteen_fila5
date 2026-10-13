@props(['data' => []])
{{--
    Ingresso dei flussi "permessi" (servizi/permessi-*): stesse pagine di service-flow piu' le varianti permessi-* (kind `permessi-wizard-step`,
    `permessi-payment`) che servono dove il riferimento ha classi o tag che le pagine condivise non esprimono. Modello dati: story DCP-21 e DCP-29.
--}}
@php
    $kind = data_get($data, 'kind', 'service-sheet');
@endphp
@includeWhen(in_array($kind, ['service-sheet', 'personal-area', 'wizard-step', 'confirmation', 'payment', 'permessi-wizard-step', 'permessi-payment'], true), 'pub_theme::components.blocks.service-flow.pages.'.$kind, ['data' => $data])
