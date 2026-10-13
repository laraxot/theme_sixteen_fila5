@props(['data' => []])
{{--
    Flusso di servizio Design Comuni (cartella servizi/ del riferimento): scheda servizio, area personale, passi del wizard con
    stepper (dati, preferenze, riepilogo), pagamento ed esito. Un solo punto di ingresso: la chiave `kind` del JSON sceglie il
    tipo di pagina (pages/<kind>), le sezioni si scelgono per `type` (sections/<type>), il resto sono parti condivise (parts/).
    Nessun testo e' nelle viste: tutto arriva dal JSON della pagina. Il modello dei dati e' descritto nella story DCP-21
    (docs/bmad/stories/2026-10-13-dcp-21-servizi-pagamento-e-service-flow.story.md). Stili: resources/css/design-comuni/.
--}}
@php
    $kind = data_get($data, 'kind', 'service-sheet');
@endphp
@includeWhen(in_array($kind, ['service-sheet', 'personal-area', 'wizard-step', 'confirmation', 'payment'], true), 'pub_theme::components.blocks.service-flow.pages.'.$kind, ['data' => $data])
