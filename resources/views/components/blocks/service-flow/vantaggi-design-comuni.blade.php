@props(['data' => []])
{{--
    Ingresso del flusso vantaggi (servizi/vantaggi-*): come `design-comuni`, ma sceglie prima `pages/vantaggi-<kind>` (varianti dei soli vantaggi)
    e, se non esiste, `pages/<kind>` condiviso. Nessun testo nelle viste: tutto arriva dal JSON. Modello dati: story DCP-30 e DCP-21.
--}}
@php
    $kind = preg_replace('/[^a-z-]/', '', (string) data_get($data, 'kind', 'service-sheet'));
    $pages = 'pub_theme::components.blocks.service-flow.pages.';
@endphp
@includeFirst([$pages.'vantaggi-'.$kind, $pages.$kind], ['data' => $data])
