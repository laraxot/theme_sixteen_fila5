{{-- Linea orizzontale sotto il titolo: `heading.rule` = classi (assente = nessuna linea); `heading.rule_inside` = dentro la colonna del titolo. --}}
@if (filled(data_get($data, 'heading.rule')))<hr class="{{ data_get($data, 'heading.rule') }}">@endif
