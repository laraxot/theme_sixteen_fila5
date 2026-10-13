{{-- Testo semplice dal JSON con due soli segni: **grassetto** e a capo (\n). Si esegue l'escape prima di aggiungere i tag. --}}
{!! str_replace("\n", '<br>', preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', e((string) ($text ?? '')))) !!}
