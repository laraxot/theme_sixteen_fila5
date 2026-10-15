@props(['data' => []])

{{--
    Consenso al trattamento dei dati personali.

    PERCHE' QUESTO BLOCCO ESISTE
    ===========================
    Nel catalogo Design Comuni (`segnalazione-01-privacy.html`) questo e' lo **step 1
    di tutti e sette i flussi di servizio**, senza eccezioni: graduatoria, permessi,
    vantaggi economici, multa via pagoPA, IMU via F24, servizi a pagamento, segnalazione
    disservizio. Non e' una schermata in piu' da mettere quando si ha tempo: e' la
    condizione perche' il Comune possa trattare dati personali.

    Misurato il 2026-09-27: `Modules\Fixcity\Models\Ticket` ha `email` fra i campi
    `fillable`, e il blocco non esisteva da nessuna parte. Si raccoglievano dati
    personali senza schermata di consenso.

    IL PERCHE' E' BLOCCO E NON PAGINA
    ================================
    Perche' il consenso compare in piu' punti del flusso e cambia forma a seconda
    del passaggio, e riscriverlo ogni volta e' il modo di non averlo in due posti. Un
    blocco ha un solo contratto, `@props(['data' => []])`, e si monta dove serve.

    IL CONTRATTO
    =============
    $data['title']         titolo della sezione
    $data['intro']         testo introduttivo dell'informativa (HTML consentito)
    $data['points']        lista dei trattamenti, array di stringhe
    $data['link']          href dell'informativa completa (privacy policy)
    $data['linkLabel']     etichetta del link
    $data['name']          name del checkbox, default 'consenso'
    $data['required']      true rende il checkbox obbligatorio, default true
    $data['action']        azione del form, se il blocco e' dentro un <form>
    $data['method']        metodo del form, default 'POST'
    $data['disabled']      true rende il blocco non interattivo (riepilogo, anteprima)

    ACCESSIBILITA'
    =============
    - il checkbox ha un <label> collegato per id: non e' un box cliccabile con del
      testo a parte, che non e' cliccabile e non e' annunciato
    - `aria-describedby` punta all'informativa, cosi' il motivo del consenso e' letto
      insieme al campo e non scoperto
    - l'errore e' in un elemento con `role="alert"`, perche' un errore di validazione
      che non viene annunciato non e' un errore per chi usa uno screen reader
    - il bottone ha `:disabled` fintanto che il consenso non e' dato, con `aria-disabled`
      che spiega il perche'
--}}

@php
    $title = (string) ($data['title'] ?? __('pub_theme::consenso.title'));
    $intro = (string) ($data['intro'] ?? __('pub_theme::consenso.intro'));
    $points = array_values(array_filter((array) ($data['points'] ?? []), static fn ($p) => $p !== null && $p !== ''));
    $link = (string) ($data['link'] ?? '');
    $linkLabel = (string) ($data['linkLabel'] ?? __('pub_theme::consenso.link_label'));
    $name = (string) ($data['name'] ?? 'consenso');
    $required = (bool) ($data['required'] ?? true);
    $action = (string) ($data['action'] ?? '');
    $method = (string) ($data['method'] ?? 'POST');
    $disabled = (bool) ($data['disabled'] ?? false);
    // Errore di validazione rimandato dal server dopo un invio respinto. Viene
    // passato dall'esterno: il blocco non decide se il consenso e' stato dato, lo
    // registra. Se manca, non si stampa alcun messaggio e `aria-describedby` non
    // punta a un elemento inesistente.
    $serverError = trim((string) ($data['serverError'] ?? ''));
    $consentId = 'consenso-' . uniqid();
    $infoId = $consentId . '-info';
    $errorId = $consentId . '-errore';
@endphp

{{--
    UN SOLO AMBITO Alpine, sul contenitore.

    Il checkbox e il bottone sono FRATELLI, non padre e figlio. Mettere `x-data` su
    entrambi crea due ambiti separati: il `x-model` del checkbox aggiorna il proprio
    ambito, il bottone legge il SUO, che non cambia mai, e il bottone resta
    disabilitato per sempre. Un nome di stato identico in due ambiti fratelli non
    condivide niente: è la ragione per cui questo blocco nasceva con un bottone
    che non si sblocca.

    L'ambito unico va sul contenitore: il checkbox scrive, il bottone legge.
--}}
<div class="cmp-consenso" data-consenso x-data="{ accettato: {{ $disabled ? 'true' : 'false' }} }">
    <h2 class="title-xxlarge mb-3">{{ $title }}</h2>

    {{-- L'informativa: e' il contenuto che rende il consenso informato. --}}
    <div id="{{ $infoId }}" class="cmp-consenso__info mb-4">
        @if ($intro !== '')
            <div class="mb-3">{!! $intro !!}</div>
        @endif

        @if ($points !== [])
            <ul class="cmp-consenso__points mb-3">
                @foreach ($points as $point)
                    <li>{{ $point }}</li>
                @endforeach
            </ul>
        @endif

        @if ($link !== '')
            <a href="{{ $link }}" class="link-secondary" target="_blank" rel="noopener noreferrer">
                {{ $linkLabel }}
                <span class="visually-hidden">({{ __('pub_theme::consenso.opens_new_window') }})</span>
            </a>
        @endif
    </div>

    {{-- Il consenso. Un solo checkbox, collegato al suo label. --}}
    <div class="form-check mb-2">
        <input
            class="form-check-input"
            type="checkbox"
            id="{{ $consentId }}"
            name="{{ $name }}"
            value="1"
            x-model="accettato"
            @if ($required) required @endif
            @if ($disabled) disabled @endif
            aria-describedby="{{ $infoId }}{{ $required && filled($serverError) ? ' ' . $errorId : '' }}"
            @if ($required) aria-required="true" @endif
        >
        <label class="form-check-label" for="{{ $consentId }}">
            {{ __('pub_theme::consenso.label') }}
            @if ($required)
                <span class="text-danger" aria-hidden="true">*</span>
            @endif
        </label>
    </div>

    @if ($required)
        {{--
            L'errore di validazione lato server, non un messaggio che compare da solo.

            Con il bottone disabilitato finche' non si acconsente, l'utente non puo'
            nemmeno inviare: un errore che compare automaticamente quando NON si ha
            spuntato il box servirebbe solo a dare tono. Questo testo esiste per
            l'errore REALE, quello che il server rimanda dopo un invio respinto, e
            sta in `role="alert"` perche' un errore non annunciato non e' un errore
            per chi usa uno screen reader. Se il server non ha mandato nulla, qui non
            si stampa niente e il checkbox non ha un riferimento vuoto: si usa
            `aria-describedby` solo quando l'errore esiste davvero.
        --}}
        @if (filled($serverError))
            <p id="{{ $errorId }}" class="form-hint text-danger mb-0" role="alert">{{ $serverError }}</p>
        @endif
    @endif

    @if ($action !== '')
        <button
            type="submit"
            class="btn btn-primary btn-lg mt-3"
            @if ($required && ! $disabled) :disabled="!accettato" @elseif ($disabled) disabled @endif
            @if ($required && ! $disabled && filled($serverError)) aria-describedby="{{ $errorId }}" @endif
        >
            {{ __('pub_theme::consenso.action') }}
        </button>
    @endif
</div>
