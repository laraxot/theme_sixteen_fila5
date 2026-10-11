@props(['data' => []])

@php
    $title = $data['title'] ?? 'Elenco segnalazioni';
    $subtitle = $data['subtitle'] ?? 'Negli ultimi 12 mesi sono state risolte 73 segnalazioni.';
    $resultsCount = $data['results_count'] ?? 645;
    $categories = $data['categories'] ?? [
        ['id' => 'water', 'label' => 'Acqua, allagamenti, problemi fognari', 'count' => 21],
        ['id' => 'environment', 'label' => 'Ambiente, inquinamento, protezione ambientale', 'count' => 14],
        ['id' => 'street-furniture', 'label' => 'Arredo urbano', 'count' => 7],
        ['id' => 'pest-control', 'label' => 'Disinfestazione, derattizazione, animali randagi', 'count' => 208],
        ['id' => 'waste', 'label' => 'Igiene urbana, rifiuti, pulizia e decoro', 'count' => 321],
        ['id' => 'maintenance', 'label' => 'Manutenzione immobili, edifici pubblici, scuole, barriere architettoniche, cimiteri', 'count' => 302],
        ['id' => 'public-order', 'label' => 'Ordine pubblico, disturbo della quiete', 'count' => 302],
        ['id' => 'green', 'label' => 'Parchi e verde pubblico', 'count' => 302],
        ['id' => 'service', 'label' => 'Servizi del comune', 'count' => 302],
        ['id' => 'security', 'label' => 'Sicurezza, degrado urbano e sociale', 'count' => 302],
        ['id' => 'road', 'label' => 'Strade, marciapiedi, segnaletica e viabilità', 'count' => 302],
    ];
    $reports = $data['segnalazioni'] ?? [
        ['titolo' => 'Buca in via Solferino', 'tipologia' => 'Verde pubblico e arredo urbano', 'indirizzo' => 'Via Solferino - 50100 Firenze', 'dettaglio' => 'Sulla strada c’è una buca piuttosto profonda che andrebbe sistemata con urgenza'],
        ['titolo' => 'Titolo segnalazione 2', 'tipologia' => 'Tipologia segnalazione', 'indirizzo' => 'Via Solferino - 50100 Firenze', 'dettaglio' => 'Sulla strada c’è una buca piuttosto profonda che andrebbe sistemata con urgenza'],
    ];
@endphp

<main id="main-container" class="bg-white text-[#17324d]">
    <div class="mx-auto max-w-6xl px-4 py-8 lg:py-12">
        <div class="mx-auto max-w-5xl">
            <nav class="mb-8 text-sm text-[#5d7083]" aria-label="Breadcrumb">
                <ol class="flex flex-wrap items-center gap-2">
                    <li><a href="{{ route('tests.view', ['slug' => 'homepage']) }}" class="underline-offset-2 hover:text-[#007a52] hover:underline">Home</a></li>
                    <li aria-hidden="true">/</li>
                    <li aria-current="page">Elenco segnalazioni</li>
                </ol>
            </nav>
            <h1 class="text-4xl font-bold tracking-tight lg:text-5xl">{{ $title }}</h1>
            @if ($subtitle !== '')
                <p class="mt-3 text-lg text-[#334e68]">{{ $subtitle }}</p>
            @endif
            <hr class="my-8 hidden border-[#d9e2e8] lg:block">
        </div>

        <div class="mx-auto max-w-6xl gap-10 lg:flex lg:items-start lg:gap-16">
            <aside class="hidden lg:block lg:w-1/4 lg:shrink-0">
                <fieldset>
                    <legend class="mb-3 text-xs font-bold uppercase tracking-wide text-[#334e68]">Categoria</legend>
                    <div class="space-y-1">
                        @foreach ($categories as $category)
                            @php($categoryId = $category['id'] ?? 'category-'.$loop->index)
                            <label for="{{ $categoryId }}" class="flex cursor-pointer items-start gap-2 border-b border-[#d9e2e8] py-2 text-sm leading-5 text-[#334e68]">
                                <input id="{{ $categoryId }}" name="category" type="checkbox" value="{{ $category['label'] }}" class="mt-1 h-4 w-4 rounded border-[#5d7083] text-[#007a52] focus:ring-[#007a52]">
                                <span>{{ $category['label'] }} ({{ $category['count'] }})</span>
                            </label>
                        @endforeach
                    </div>
                </fieldset>
            </aside>

            <section class="min-w-0 flex-1" x-data="{ tab: 'map', openReport: null }">
                <div class="flex items-center justify-between border-b border-[#d9e2e8] pb-3 text-sm text-[#334e68]">
                    <span>{{ $resultsCount }} Risultati</span>
                    <button type="button" class="font-semibold text-[#007a52] underline lg:hidden" @click="$dispatch('open-filters')">Filtra</button>
                    <button type="button" class="hidden font-semibold text-[#007a52] underline lg:block">Rimuovi tutti i filtri</button>
                </div>

                <div class="mt-6 flex w-full border-b border-[#d9e2e8]" role="tablist" aria-label="Visualizzazione segnalazioni">
                    <button type="button" role="tab" :aria-selected="tab === 'map'" @click="tab = 'map'" class="w-1/2 border-b-4 px-4 py-3 text-center font-semibold" :class="tab === 'map' ? 'border-[#007a52] text-[#007a52]' : 'border-transparent text-[#334e68]'">Mappa</button>
                    <button type="button" role="tab" :aria-selected="tab === 'list'" @click="tab = 'list'" class="w-1/2 border-b-4 px-4 py-3 text-center font-semibold" :class="tab === 'list' ? 'border-[#007a52] text-[#007a52]' : 'border-transparent text-[#334e68]'">Elenco</button>
                </div>

                <div x-show="tab === 'map'" role="tabpanel" class="pt-6">
                    <div class="relative flex min-h-[300px] items-center justify-center overflow-hidden rounded bg-[#e8edf0]" aria-label="Mappa delle segnalazioni">
                        <span class="text-sm text-[#5d7083]">Mappa delle segnalazioni</span>
                        <button type="button" @click="openReport = 0" class="absolute left-1/2 top-1/2 h-10 w-10 -translate-x-1/2 -translate-y-1/2 rounded-full border-4 border-white bg-[#007a52] shadow-lg focus:outline-none focus:ring-4 focus:ring-[#80c8ad]" aria-label="Apri segnalazione sulla mappa"><span class="sr-only">Apri segnalazione</span></button>
                    </div>
                    <div class="mt-10 max-w-xl">
                        <h2 class="text-3xl font-bold">Fai una segnalazione</h2>
                        <p class="mt-3 text-[#334e68]">Se vuoi aggiungere una segnalazione, puoi farlo dopo esserti autenticato con le tue credenziali SPID o CIE.</p>
                        <a href="{{ route('tests.view', ['slug' => 'segnalazione-privacy']) }}" class="mt-5 inline-flex min-h-12 items-center rounded bg-[#007a52] px-6 py-3 font-bold text-white shadow-sm hover:bg-[#005c3d] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2">Segnala disservizio</a>
                    </div>
                </div>

                <div x-show="tab === 'list'" role="tabpanel" class="space-y-5 pt-6" x-cloak>
                    @foreach ($reports as $index => $report)
                        <article class="rounded bg-[#f5f7f9] p-4 shadow-sm lg:p-6">
                            <h2 class="text-xl font-bold">{{ $report['titolo'] }}</h2>
                            <p class="mt-4 text-sm text-[#334e68]">Tipologia di segnalazione<br><span>{{ $report['tipologia'] }}</span></p>
                            <button type="button" @click="openReport = {{ $index }}" class="mt-4 flex w-full items-center justify-between border-t border-[#d9e2e8] pt-4 text-left font-semibold text-[#007a52]">Mostra tutto <span aria-hidden="true" class="text-xl">⌄</span></button>
                            <div x-show="openReport === {{ $index }}" class="mt-4 space-y-4 border-t border-[#d9e2e8] pt-4" x-cloak>
                                <div><h3 class="text-sm font-semibold">Indirizzo</h3><p class="mt-1">{{ $report['indirizzo'] ?? '' }}</p></div>
                                <div><h3 class="text-sm font-semibold">Dettaglio</h3><p class="mt-1">{{ $report['dettaglio'] ?? '' }}</p></div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>

    <section id="rating" class="bg-[#007a52] py-12 lg:py-20">
        <div class="mx-auto max-w-xl px-4">
            <div class="rounded bg-white p-6 shadow-xl lg:p-8" x-data="{ rated: false }">
                <div x-show="!rated">
                    <h2 class="text-2xl font-semibold">Quanto sono chiare le informazioni su questa pagina?</h2>
                    <fieldset class="mt-6">
                        <legend class="sr-only">Valuta da 1 a 5 stelle la pagina</legend>
                        <div class="flex flex-row-reverse justify-end gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <input id="star{{ $i }}a" name="ratingA" value="{{ $i }}" type="radio" class="peer sr-only" @change="rated = true">
                                <label for="star{{ $i }}a" class="cursor-pointer text-3xl text-[#007a52] peer-focus-visible:outline peer-focus-visible:outline-4 peer-focus-visible:outline-[#80c8ad]" data-element="feedback-rate-{{ $i }}"><span aria-hidden="true">★</span><span class="sr-only">Valuta {{ $i }} stelle su 5</span></label>
                            @endfor
                        </div>
                    </fieldset>
                </div>
                <div x-show="rated" x-cloak><h2 class="text-2xl font-bold">Grazie, il tuo parere ci aiuterà a migliorare il servizio!</h2></div>
            </div>
        </div>
    </section>

    <section id="contacts" class="bg-[#f5f7f9] py-12">
        <div class="mx-auto max-w-xl px-4">
            <div class="rounded bg-white p-6 shadow-sm lg:p-8">
                <h2 class="text-2xl font-semibold">Contatta il comune</h2>
                <ul class="mt-4 divide-y divide-[#d9e2e8]">
                    <li><a href="{{ route('tests.view', ['slug' => 'domande-frequenti']) }}" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Leggi le domande frequenti</a></li>
                    <li><a href="#" class="block py-4 text-[#007a52] underline-offset-2 hover:underline" data-element="contacts">Richiedi assistenza</a></li>
                    <li><a href="tel:050505" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Chiama il numero verde 05 0505</a></li>
                    <li><a href="#" class="block py-4 text-[#007a52] underline-offset-2 hover:underline" data-element="appointment-booking">Prenota appuntamento</a></li>
                </ul>
            </div>
        </div>
    </section>
</main>
