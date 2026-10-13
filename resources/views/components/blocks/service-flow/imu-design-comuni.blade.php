@props(['data' => []])
{{--
    Ingresso del flusso IMU (servizi/pagamenti-imu-*): come `design-comuni`, ma sceglie prima `pages/imu-<kind>` (varianti del solo IMU) e,
    se non esiste, `pages/<kind>` condiviso. Nessun testo nelle viste: tutto arriva dal JSON. Modello dati: story DCP-27 e DCP-21.
--}}
@php
    $kind = preg_replace('/[^a-z-]/', '', (string) data_get($data, 'kind', 'wizard-step'));
    $pages = 'pub_theme::components.blocks.service-flow.pages.';
@endphp
@includeFirst([$pages.'imu-'.$kind, $pages.$kind], ['data' => $data])
