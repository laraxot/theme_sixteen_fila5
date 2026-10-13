@props(['data' => []])
{{--
    Ingresso del flusso graduatoria (DCP-26): stesse regole di design-comuni.blade.php, in piu' i tipi di pagina `graduatoria-wizard`, `graduatoria-document`
    e `graduatoria-consent` (pages/graduatoria-*.blade.php) che il flusso condiviso non ha. I tipi condivisi si rendono con le pagine condivise.
    Modello dati: story DCP-21 (service-flow) e DCP-26 (estensioni graduatoria).
--}}
@php
    $kind = data_get($data, 'kind', 'service-sheet');
@endphp
@includeWhen(in_array($kind, ['service-sheet', 'personal-area', 'wizard-step', 'confirmation', 'payment', 'graduatoria-wizard', 'graduatoria-document', 'graduatoria-consent'], true), 'pub_theme::components.blocks.service-flow.pages.'.$kind, ['data' => $data])
