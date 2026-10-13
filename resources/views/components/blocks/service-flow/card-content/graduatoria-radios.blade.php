{{-- Scelta singola con legenda (fieldset). `content`: name (gli id sono <name>-<n>), legend (testo nascosto), required (primo radio obbligatorio), options[]. L'ultima opzione non ha il filetto. --}}
<fieldset>
    <legend class="visually-hidden">{{ $content['legend'] ?? '' }}</legend>
    @include('pub_theme::components.blocks.service-flow.card-content.radios', ['content' => $content])
</fieldset>
