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

    <section id="rating" class="bg-[#007a52] py-12 lg:py-20" x-data="{ step: 1, rating: 0, hover: 0, feedbackType: '', selectedOption: '', textFeedback: '' }" aria-labelledby="feedback-heading">
        <div class="mx-auto max-w-2xl px-4">
            <div class="rounded-lg bg-white p-6 shadow-xl lg:p-12">
                <h2 id="feedback-heading" class="text-2xl font-bold text-[#17324d]">Quanto sono chiare le informazioni su questa pagina?</h2>
                <template x-if="step === 1">
                    <div>
                        <p class="mt-3 text-[#334e68]">Grazie, il tuo parere ci aiuterà a migliorare il sito del Comune.</p>
                        <div class="mt-5 flex gap-1" role="radiogroup" aria-label="Valuta la chiarezza della pagina">
                            <template x-for="star in [5,4,3,2,1]" :key="star">
                                <div>
                                    <input type="radio" :id="'star' + star + 'a'" name="ratingA" :value="star" x-model="rating" class="hidden">
                                    <label
                                        class="full rating-star cursor-pointer text-2xl"
                                        :for="'star' + star + 'a'"
                                        :data-element="'feedback-rate-' + star"
                                        :class="rating >= star || hover >= star ? 'text-yellow-400' : 'text-slate-300/30'"
                                        x-on:click="rating = star; feedbackType = star >= 4 ? 'positive' : 'negative'; step = 2"
                                        x-on:mouseenter="hover = star"
                                        x-on:mouseleave="hover = 0"
                                    >
                                        <svg class="icon icon-sm" role="img" :aria-labelledby="'star' + star + '-label'" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" :class="rating >= star || hover >= star ? 'fill-yellow-400 text-yellow-400' : 'fill-slate-300/30 text-slate-300/30'">
                                            <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                            <path fill="none" d="M0 0h24v24H0z"></path>
                                        </svg>
                                        <span class="visually-hidden" :id="'star' + star + '-label'" x-text="{{ \Illuminate\Support\Js::from(collect(range(1, 5))->mapWithKeys(fn (int $n): array => [$n => __('pub_theme::navigation.homepage.rate_'.$n)])) }}[star]"></span>
                                    </label>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="step === 2">
                    <div>
                        <div x-show="feedbackType === 'positive'" data-element="feedback-rating-positive">
                            <h3 class="step-title">Quali sono stati gli aspetti che hai preferito?</h3>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating1" type="radio" id="radio-1" value="1" x-model="selectedOption">
                                <label for="radio-1" class="active block cursor-pointer">Le indicazioni erano chiare</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating1" type="radio" id="radio-2" value="2" x-model="selectedOption">
                                <label for="radio-2" class="active block cursor-pointer">Le indicazioni erano complete</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating1" type="radio" id="radio-3" value="3" x-model="selectedOption">
                                <label for="radio-3" class="active block cursor-pointer">Capivo sempre che stavo procedendo correttamente</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating1" type="radio" id="radio-4" value="4" x-model="selectedOption">
                                <label for="radio-4" class="active block cursor-pointer">Non ho avuto problemi tecnici</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating1" type="radio" id="radio-5" value="5" x-model="selectedOption">
                                <label for="radio-5" class="active block cursor-pointer">Altro</label>
                            </div>
                        </div>

                        <div x-show="feedbackType === 'negative'" data-element="feedback-rating-negative">
                            <h3 class="step-title">Dove hai incontrato le maggiori difficoltà?</h3>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating2" type="radio" id="radio-6" value="1" x-model="selectedOption">
                                <label for="radio-6" class="active block cursor-pointer">A volte le indicazioni non erano chiare</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating2" type="radio" id="radio-7" value="2" x-model="selectedOption">
                                <label for="radio-7" class="active block cursor-pointer">A volte le indicazioni non erano complete</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating2" type="radio" id="radio-8" value="3" x-model="selectedOption">
                                <label for="radio-8" class="active block cursor-pointer">A volte non capivo se stavo procedendo correttamente</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating2" type="radio" id="radio-9" value="4" x-model="selectedOption">
                                <label for="radio-9" class="active block cursor-pointer">Ho avuto problemi tecnici</label>
                            </div>
                            <div class="radio-body border-b border-white/20 pb-3 last:border-0">
                                <input name="rating2" type="radio" id="radio-10" value="5" x-model="selectedOption">
                                <label for="radio-10" class="active block cursor-pointer">Altro</label>
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="selectedOption === '5'">
                    <div class="cmp-steps-rating">
                        <label for="rating-step3-text" class="block text-sm font-bold mb-2">Aggiungi altri dettagli</label>
                        <textarea id="rating-step3-text" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-[#17324d] focus:outline-none focus:ring-4 focus:ring-[#007a52]/20" rows="3" maxlength="200" x-model="textFeedback" placeholder="Inserire massimo 200 caratteri"></textarea>
                    </div>
                </template>

                <div class="flex justify-between pt-4">
                    <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-lg border-2 border-white px-5 py-3 font-bold text-white transition hover:bg-white hover:text-[#007a52] focus:outline-none focus:ring-4 focus:ring-white" x-on:click="step = 1; rating = 0; selectedOption = ''; textFeedback = ''">Indietro</button>
                    <template x-if="step === 1">
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-white px-5 py-3 font-bold text-[#007a52] transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-white" :class="!selectedOption ? 'opacity-50 cursor-not-allowed' : ''" :disabled="!selectedOption" x-on:click="step = 3">Avanti</button>
                    </template>
                    <template x-if="step === 2">
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-white px-5 py-3 font-bold text-[#007a52] transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-white" x-on:click="step = 3">Invia</button>
                    </template>
                </div>

                <div x-show="step === 3" x-cloak>
                    <p class="mt-4 font-semibold text-[#007a52]">Grazie, il tuo parere ci aiuterà a migliorare il servizio!</p>
                </div>
            </div>
        </div>
    </section>

    <section id="contacts" class="bg-[#f5f7f9] py-12">
        <div class="mx-auto max-w-xl px-4">
            <div class="rounded bg-white p-6 shadow-sm lg:p-8">
                <div class="flex items-start justify-between border-b border-[#d9e2e8] pb-4" data-element="contacts">
                    <h2 class="text-2xl font-semibold">Contatta il comune</h2>
                </div>
                <ul class="mt-4 divide-y divide-[#d9e2e8]">
                    <li><a href="{{ route('tests.view', ['slug' => 'domande-frequenti']) }}" class="list-item block flex items-center gap-2 rounded-lg py-4 text-[#007a52] underline-offset-2 hover:underline">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-.55 0-1 .45-1 1H9c0 .55.45 1 1 1h2c0 .55.45 1 1 1s1-.45 1-1c0-.55-.45-1-1-1h-2v-2h2c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>
                        <span>Leggi le domande frequenti</span></a></li>
                    <li><a href="#" class="list-item block flex items-center gap-2 rounded-lg py-4 text-[#007a52] underline-offset-2 hover:underline" data-element="contacts">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-.55 0-1 .45-1 1H9c0 .55.45 1 1 1h2c0 .55.45 1 1 1s1-.45 1-1c0-.55-.45-1-1-1h-2v-2h2c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>
                        <span>Richiedi assistenza</span></a></li>
                    <li><a href="tel:050505" class="list-item block flex items-center gap-2 rounded-lg py-4 text-[#007a52] underline-offset-2 hover:underline">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-.55 0-1 .45-1 1H9c0 .55.45 1 1 1h2c0 .55.45 1 1 1s1-.45 1-1c0-.55-.45-1-1-1h-2v-2h2c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>
                        <span>Chiama il numero verde 05 0505</span></a></li>
                    <li><a href="#" class="list-item block flex items-center gap-2 rounded-lg py-4 text-[#007a52] underline-offset-2 hover:underline" data-element="appointment-booking">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-.55 0-1 .45-1 1H9c0 .55.45 1 1 1h2c0 .55.45 1 1 1s1-.45 1-1c0-.55-.45-1-1-1h-2v-2h2c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>
                        <span>Prenota appuntamento</span></a></li>
                    <li><a href="#" class="list-item block flex items-center gap-2 rounded-lg py-4 text-[#007a52] underline-offset-2 hover:underline">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-.55 0-1 .45-1 1H9c0 .55.45 1 1 1h2c0 .55.45 1 1 1s1-.45 1-1c0-.55-.45-1-1-1h-2v-2h2c.55 0 1-.45 1-1s-.45-1-1-1z"/></svg>
                        <span>Segnala disservizio</span></a></li>
                </ul>
            </div>
        </div>
    </section>
</main>
