{{--
    Totale da versare (cmp-tot). `content`: class (classi in piu' di `cmp-tot bg-white`), label, value, input {id, label, hint, value, group_class}, remaining {label, value}.
    I valori sono quelli del JSON (nessun calcolo: il ricalcolo al variare dei campi e' un comportamento JS da condividere, vedi story DCP-27).
--}}
<div class="{{ trim('cmp-tot bg-white '.($content['class'] ?? '')) }}">
    <div class="tot-wrapper border-bottom border-light d-lg-flex justify-content-between">
        <p class="title-tot mb-0">{{ $content['label'] ?? '' }}</p>
        <span class="value-tot">{{ $content['value'] ?? '' }}</span>
    </div>
    @include('pub_theme::components.blocks.service-flow.card-content.imu-input', ['content' => $content['input'] ?? []])
    <div class="wrapper d-flex justify-content-between border-bottom border-light subtitle-small">
        <p>{{ data_get($content, 'remaining.label') }} </p>
        <span>{{ data_get($content, 'remaining.value') }}</span>
    </div>
</div>
