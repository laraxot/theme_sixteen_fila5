{{--
    Testo in linea della famiglia multa (DCP-28). `$value` = stringa (come parts/rich: **grassetto** e \n) oppure elenco di segmenti separati da uno spazio:
    stringa (rich), {span: classi, text} (span con classi), {br: classi} (a capo con classi), {strong: testo}. L'escape e' sempre applicato.
--}}
@if (is_array($value ?? null))
    @foreach ($value as $segment)
        @if (is_string($segment))@include('pub_theme::components.blocks.service-flow.parts.rich', ['text' => $segment])
        @elseif (array_key_exists('br', $segment))<br class="{{ $segment['br'] }}">
        @elseif (array_key_exists('strong', $segment))<strong>{{ $segment['strong'] }}</strong>
        @else<span class="{{ $segment['span'] ?? '' }}">{{ $segment['text'] ?? '' }}</span>
        @endif
    @endforeach
@else
    @include('pub_theme::components.blocks.service-flow.parts.rich', ['text' => (string) ($value ?? '')])
@endif
