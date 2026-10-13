@props(['data' => []])
{{--
    Ingresso della famiglia "pagamento multa" (DCP-28, riferimento servizi/pagamenti-multa-*). Delega allo scheletro condiviso (design-comuni) i tipi di pagina
    che coincidono (`service-sheet`, `personal-area`) e gestisce qui i due che hanno un markup diverso: `multa-wizard` (passi con stepper: dati personali,
    dati specifici fase 1-3, riepilogo) e `multa-confirmation` (esito del pagamento). Il modello dei dati e' descritto nella story DCP-28.
--}}
@php
    $kind = data_get($data, 'kind', 'service-sheet');
@endphp
@if (in_array($kind, ['multa-wizard', 'multa-confirmation'], true))
    @include('pub_theme::components.blocks.service-flow.pages.'.$kind, ['data' => $data])
@else
    @include('pub_theme::components.blocks.service-flow.design-comuni', ['data' => $data])
@endif
