{{--
    Interruttore (cmp-toggle). `content`: class (classi in piu' del contenitore), id, label, lever_class (classi in piu' di `lever me-0`).
    Il cambio di stato richiede un comportamento JS non ancora condiviso (vedi story DCP-27).
--}}
<div class="{{ trim('cmp-toggle '.($content['class'] ?? '')) }}">
    <div class="toggles">
        <label class="label mb-0" for="{{ $content['id'] ?? '' }}"> {{ $content['label'] ?? '' }}
            <input type="checkbox" id="{{ $content['id'] ?? '' }}">
            <span class="{{ trim('lever me-0 '.($content['lever_class'] ?? '')) }}"></span></label>
    </div>
</div>
