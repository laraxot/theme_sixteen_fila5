@props(['data' => []])

@php
    $hero = $data['hero'] ?? [];
    $government = $data['government'] ?? [];
    $events = $data['events'] ?? [];
    $topics = $data['topics'] ?? [];
    $otherTopics = $data['other_topics'] ?? [];
    $themeSites = $data['theme_sites'] ?? [];
    $usefulLinks = $data['useful_links'] ?? [];
    $links = $data['links'] ?? [];
    $feedback = $data['feedback'] ?? [];
    $contacts = $data['contacts'] ?? [];
@endphp

<div class="design-comuni-homepage bg-white text-[#17324d]">
    <section id="head-section" class="border-b border-[#d9e2e8] bg-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 lg:grid-cols-2 lg:px-12 lg:py-20">
            <div class="flex flex-col justify-center">
                <p class="mb-4 text-sm font-bold uppercase tracking-[.12em] text-[#007a52]">{{ $hero['eyebrow'] ?? 'Contenuti in evidenza' }}</p>
                <h1 id="main-container" class="max-w-3xl text-4xl font-bold leading-tight text-[#007a52] md:text-5xl">{{ $hero['heading'] ?? ($hero['title'] ?? 'Nome del comune') }}</h1>
                <p class="mt-4 max-w-2xl text-lg leading-8 text-[#334e68]">{{ $hero['intro'] ?? '' }}</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    @foreach(($hero['actions'] ?? []) as $action)
                        <a href="{{ $action['url'] ?? '#' }}" class="inline-flex min-h-11 items-center rounded-md px-5 py-3 font-bold focus:outline-none focus:ring-4 focus:ring-[#007a52] {{ ($action['style'] ?? 'primary') === 'primary' ? 'bg-[#007a52] text-white hover:bg-[#005c3d]' : 'border-2 border-[#007a52] text-[#007a52] hover:bg-[#e6f3ee]' }}">{{ $action['label'] ?? '' }}</a>
                    @endforeach
                </div>
            </div>
            <div class="flex items-center justify-center rounded-lg bg-[#dcefe8] p-8" aria-label="{{ $hero['image_alt'] ?? 'Immagine del comune' }}">
                @if(! empty($hero['image']))
                    <img class="h-full max-h-[420px] w-full rounded-lg object-cover" src="{{ asset($hero['image']) }}" alt="{{ $hero['image_alt'] ?? '' }}" loading="eager">
                @else
                    <div class="w-full max-w-md rounded-lg border-8 border-white bg-[#007a52] p-10 text-white shadow-xl">
                        <p class="text-sm font-bold uppercase tracking-wider">{{ $hero['meta_label'] ?? 'Il Comune' }}</p>
                        <p class="mt-3 text-3xl font-bold">{{ $hero['meta_value'] ?? 'Al servizio della comunità' }}</p>
                        <p class="mt-4 leading-7">{{ $hero['meta_body'] ?? '' }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-6 py-14 lg:px-12" aria-labelledby="government-heading">
        <h2 id="government-heading" class="text-3xl font-bold">{{ $government['title'] ?? 'Amministrazione' }}</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            @foreach($government['items'] ?? [] as $item)
                <a href="{{ $item['url'] ?? '#' }}" class="group rounded-lg border border-[#d9e2e8] bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#007a52]">
                    <p class="text-sm font-bold uppercase tracking-wider text-[#007a52]">{{ $item['eyebrow'] ?? 'Organi di governo' }}</p>
                    <h3 class="mt-3 text-xl font-bold text-[#17324d] group-hover:underline">{{ $item['title'] ?? '' }}</h3>
                    <p class="mt-3 leading-7 text-[#334e68]">{{ $item['description'] ?? '' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section id="calendario" class="bg-[#f5f7f9]" aria-labelledby="events-heading">
        <div class="mx-auto max-w-7xl px-6 py-14 lg:px-12">
            <h2 id="events-heading" class="text-3xl font-bold">{{ $events['title'] ?? 'Eventi' }}</h2>
            @if(! empty($events['days']))
                <div class="mt-6 overflow-hidden rounded-md border border-[#d9e2e8] bg-white md:grid md:grid-cols-4">
                    @foreach($events['days'] as $day)
                        <div class="border-b border-[#d9e2e8] p-5 last:border-b-0 md:border-b-0 md:border-r md:last:border-r-0">
                            <p class="text-3xl font-semibold text-[#5d7083]">{{ $day['number'] ?? '' }}</p>
                            <p class="text-sm text-[#5d7083]">{{ $day['weekday'] ?? '' }}</p>
                            <ul class="mt-5 space-y-3 text-sm">
                                @foreach($day['items'] ?? [] as $event)
                                    <li class="border-t border-[#d9e2e8] pt-3"><a href="{{ $event['url'] ?? '#' }}" class="font-semibold text-[#007a52] underline underline-offset-2 focus:outline-none focus:ring-4 focus:ring-[#007a52]">{{ $event['title'] ?? '' }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mt-8 grid gap-6 md:grid-cols-3">
                @foreach($events['items'] ?? [] as $event)
                    <a href="{{ $event['url'] ?? '#' }}" class="rounded-lg bg-white p-6 shadow-sm focus:outline-none focus:ring-4 focus:ring-[#007a52]">
                        <p class="text-sm font-bold text-[#007a52]">{{ $event['date'] ?? '' }}</p>
                        <h3 class="mt-2 text-xl font-bold">{{ $event['title'] ?? '' }}</h3>
                        <p class="mt-3 leading-7 text-[#334e68]">{{ $event['description'] ?? '' }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-[#006b4f] text-white" style="background-image: linear-gradient(rgba(0,107,79,.94),rgba(0,107,79,.94)), url('/themes/Sixteen/design-comuni/assets/images/evidenza-header.png'); background-size: cover;" aria-labelledby="topics-heading">
        <div class="mx-auto max-w-7xl px-6 py-14 lg:px-12">
        <h2 id="topics-heading" class="text-3xl font-bold">{{ $topics['title'] ?? 'Argomenti in evidenza' }}</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-3">
            @foreach($topics['items'] ?? [] as $topic)
                <a href="{{ $topic['url'] ?? '#' }}" class="rounded-lg bg-white p-6 text-[#17324d] shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-white">
                    <h3 class="text-xl font-bold">{{ $topic['label'] ?? '' }}</h3>
                    <p class="mt-3 leading-7">{{ $topic['description'] ?? '' }}</p>
                    @if(! empty($topic['links']))<ul class="mt-4 space-y-2 text-[#007a52]">@foreach($topic['links'] as $link)<li><span class="underline">{{ $link }}</span></li>@endforeach</ul>@endif
                    <span class="mt-5 inline-block font-bold text-[#007a52]">Esplora argomento →</span>
                </a>
            @endforeach
        </div>
        @if($otherTopics !== [])
            <div class="mx-auto mt-12 max-w-3xl"><h3 class="text-sm font-bold uppercase tracking-wider">Altri argomenti</h3><div class="mt-4 flex flex-wrap gap-2">@foreach($otherTopics as $topic)<a href="{{ $topic['url'] ?? '#' }}" class="rounded-full border border-white px-4 py-2 text-sm hover:bg-white hover:text-[#006b4f] focus:outline-none focus:ring-4 focus:ring-white">{{ $topic['label'] ?? '' }}</a>@endforeach</div></div>
        @endif
        @if($themeSites !== [])
            <h2 class="mt-14 text-3xl font-bold">Siti tematici</h2><div class="mt-8 grid gap-4 md:grid-cols-3">@foreach($themeSites as $site)<a href="{{ $site['url'] ?? '#' }}" class="rounded-lg bg-white p-5 text-[#17324d] shadow-sm focus:outline-none focus:ring-4 focus:ring-white"><h3 class="font-bold">{{ $site['label'] ?? '' }}</h3><p class="mt-2 text-sm leading-6">{{ $site['description'] ?? '' }}</p></a>@endforeach</div>
        @endif
        </div>
    </section>

    <section class="bg-[#f5f7f9]" aria-labelledby="links-heading">
        <div class="mx-auto max-w-7xl px-6 py-14 lg:px-12">
            <div class="mx-auto max-w-2xl"><label for="homepage-search" class="sr-only">Cerca una parola chiave</label><div class="flex gap-2"><input id="homepage-search" type="search" placeholder="Cerca una parola chiave" class="min-h-12 flex-1 rounded-md border-2 border-[#5d7083] bg-white px-4 text-[#17324d] focus:border-[#007a52] focus:outline-none focus:ring-4 focus:ring-[#007a52]"><button type="button" class="min-h-12 rounded-md bg-[#007a52] px-5 font-bold text-white focus:outline-none focus:ring-4 focus:ring-[#007a52]">Cerca</button></div>
            <h2 id="links-heading" class="mt-10 text-3xl font-bold">{{ $links['title'] ?? 'Link utili' }}</h2>
            <div class="mt-8 grid gap-4">
                @foreach($links['items'] ?? [] as $link)
                    <a href="{{ $link['url'] ?? '#' }}" class="font-bold text-[#007a52] underline underline-offset-4 focus:outline-none focus:ring-4 focus:ring-[#007a52]">{{ $link['label'] ?? '' }}</a>
                @endforeach
            </div>
            </div>
        </div>
    </section>

    <section id="rating" class="bg-[#007a52] px-6 py-20 text-white" aria-labelledby="feedback-heading" x-data="{ step: 1, rating: 0, hover: 0, feedbackType: '', selectedOption: '', textFeedback: '' }">
        <div class="mx-auto max-w-2xl rounded-lg bg-white p-8 shadow-xl">
            <h2 id="feedback-heading" class="text-2xl font-bold text-[#17324d]">{{ $feedback['title'] ?? 'Quanto sono chiare le informazioni su questa pagina?' }}</h2>
            <template x-if="step === 1">
                <div>
                    <p class="mt-3 text-[#334e68]">{{ $feedback['description'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il sito del Comune.' }}</p>
                    <fieldset class="rating mt-5">
                        <legend class="visually-hidden">Valuta da 1 a 5 stelle la pagina</legend>
                        <div class="flex gap-1" role="radiogroup" aria-label="Valuta la chiarezza della pagina">
                            @for($star = 5; $star >= 1; $star--)
                                @php
                                    $starLabels = [
                                        5 => 'Valuta 5 stelle su 5',
                                        4 => 'Valuta 4 stelle su 5',
                                        3 => 'Valuta 3 stelle su 5',
                                        2 => 'Valuta 2 stelle su 5',
                                        1 => 'Valuta 1 stelle su 5',
                                    ];
                                @endphp
                                <input type="radio" id="star{{ $star }}a" name="ratingA" value="{{ $star }}" x-model="rating" class="hidden">
                                <label
                                    class="full rating-star cursor-pointer text-2xl"
                                    for="star{{ $star }}a"
                                    data-element="feedback-rate-{{ $star }}"
                                    :class="rating >= {{ $star }} || hover >= {{ $star }} ? 'text-yellow-400' : 'text-slate-300/30'"
                                    @click="rating = {{ $star }}; feedbackType = {{ $star }} >= 4 ? 'positive' : 'negative'; step = 2"
                                    @mouseenter="hover = {{ $star }}"
                                    @mouseleave="hover = 0"
                                >
                                    <svg class="icon icon-sm" role="img" aria-labelledby="star{{ $star }}-label" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" :class="rating >= {{ $star }} || hover >= {{ $star }} ? 'fill-yellow-400 text-yellow-400' : 'fill-slate-300/30 text-slate-300/30'">
                                        <path d="M12 1.7L9.5 9.2H1.6L8 13.9l-2.4 7.6 6.4-4.7 6.4 4.7-2.4-7.6 6.4-4.7h-7.9L12 1.7z"></path>
                                        <path fill="none" d="M0 0h24v24H0z"></path>
                                    </svg>
                                    <span class="visually-hidden" id="star{{ $star }}-label">{{ $starLabels[$star] }}</span>
                                </label>
                            @endfor
                        </div>
                    </fieldset>
                </div>
            </template>

            <template x-if="step === 2">
                <div>
                    <fieldset
                        class="fieldset-rating-one"
                        data-element="feedback-rating-positive"
                        x-show="feedbackType === 'positive'"
                    >
                        <legend class="iscrizioni-header w-100">
                            <h3 class="step-title">Quali sono stati gli aspetti che hai preferito?</h3>
                        </legend>
                        <div class="cmp-steps-rating__body">
                            <div class="space-y-2">
                                <template x-if="feedbackType === 'positive'">
                                    <div>
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
                                </template>
                                <template x-if="feedbackType === 'negative'">
                                    <div>
                                        <legend class="iscrizioni-header w-100">
                                            <h3 class="step-title">Dove hai incontrato le maggiori difficoltà?</h3>
                                        </legend>
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
                                </template>
                            </div>
                        </div>
                    </fieldset>
                    <template x-if="selectedOption === '5'">
                        <div class="cmp-steps-rating">
                            <div class="cmp-steps-rating__body">
                                <div class="form-group">
                                    <label for="rating-step3-text" class="block text-sm font-bold mb-2">Aggiungi altri dettagli</label>
                                    <textarea id="rating-step3-text" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-[#17324d] focus:outline-none focus:ring-4 focus:ring-[#007a52]/20" rows="3" maxlength="200" x-model="textFeedback" placeholder="Inserire massimo 200 caratteri"></textarea>
                                </div>
                            </div>
                        </div>
                    </template>
                    <div class="flex justify-between pt-4">
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-lg border-2 border-white px-5 py-3 font-bold text-white transition hover:bg-white hover:text-[#007a52] focus:outline-none focus:ring-4 focus:ring-white" @click="step = 1; rating = 0; selectedOption = ''; textFeedback = ''">Indietro</button>
                        <button type="button" class="inline-flex min-h-11 items-center justify-center rounded-lg bg-white px-5 py-3 font-bold text-[#007a52] transition hover:bg-slate-100 focus:outline-none focus:ring-4 focus:ring-white" @click="step = 3" :class="!selectedOption ? 'opacity-50 cursor-not-allowed' : ''" :disabled="!selectedOption">Avanti</button>
                    </div>
                </div>
            </template>

            <template x-if="step === 3">
                <p class="mt-4 font-semibold text-[#007a52]">{{ $feedback['success_message'] ?? 'Grazie, il tuo parere ci aiuterà a migliorare il servizio!' }}</p>
            </template>
        </div>
    </section>

    <section class="bg-[#eef0f2] text-[#17324d]" aria-labelledby="contacts-heading">
        <div class="mx-auto grid max-w-7xl gap-8 px-6 py-14 lg:grid-cols-2 lg:px-12">
            <div>
                <h2 id="contacts-heading" class="text-3xl font-bold">{{ $contacts['title'] ?? 'Contatta il comune' }}</h2>
                <p class="mt-4 leading-7">{{ $contacts['description'] ?? 'Trova i contatti e gli orari degli uffici comunali.' }}</p>

                <ul class="contact-list mt-6 space-y-3 p-0">
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C7.58 3 4 6.58 4 11c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8zm0 14c-3.3 0-6-2.7-6-6s2.7-6 6-6 6 2.7 6 6-2.7 6-6 6zm0-10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        <span>Leggi le domande frequenti</span></a></li>
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C9.79 3 8 4.79 8 7h2c0-1.66 1.34-3 3-3s3 1.34 3 3c0 2.33-1.53 4.28-3.61 4.82.01-.18.39-.92.39-1.07 0-.54-.45-1-1-1s-1 .46-1 1c0 1.34 1.07 2.43 2.5 2.84v1.16h2c0-1.34.82-2.5 2-3 .18-.34.32-.72.32-1.12 0-2.33-1.67-4.29-4-4.29s-4 1.97-4 4.31H7C7 6.99 9.24 5 12 5c3.31 0 6 2.69 6 6 0 2.64-1.65 4.87-4 5.73v2.02c3.39-.82 6-3.87 6-7.49 0-3.59-2.81-6.5-6.29-6.53z"/></svg>
                        <span>Richiedi assistenza</span></a></li>
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M6.62 9.11L5 8.19c-.38.73-1.17 1.33-2.11 1.6l-2.31.83c-.05.19-.05.38-.05.57 0 2.44 1.39 4.58 3.51 5.61 1.58.76 3.4.99 5.13.64l.94-.22 1.3 1.01c1.21.92 2.68 1.4 4.22 1.4.86-.02 1.72-.2 2.54-.53l1.87-.8c.42-.18.85-.39 1.25-.67l1.19-.83c.15-.1.28-.23.38-.38.06-.08.1-.17.1-.26v-1.4c0-.46-.28-.85-.72-1.07l-2.31-.83c-1.34-.49-2.29-1.72-2.29-3.12 0-.62.18-1.23.48-1.75l.58-.97c.29-.47.4-1.04.28-1.63l-.61-2.43c-.21-.87-.92-1.49-1.81-1.55l-1.99-.13c-.87-.06-1.59-.89-1.59-1.76v-2.1c0-.86-.68-1.56-1.54-1.59l-1.49-.06c-1.46-.06-2.64-1.31-2.64-2.77v-3.17c0-.83-.65-1.5-1.47-1.53l-2.67-.12c-.98-.04-1.79-.87-1.79-1.86v-2.75c0-.99-.8-1.8-1.78-1.8-1.55-.01-2.94-.86-3.73-2.22l-.88-1.55c-.22-.38-.6-.57-1-.57h-2.35c-.4 0-.78.34-.78.77v2.9c0 .42.33.77.75.77h2.49c.95 0 1.79-.77 1.79-1.73v-2.81c0-.42.33-.77.75-.77.42 0 .75.34.75.77v3.04c0 1.64 1.34 2.97 2.99 3.26l1.44.23c1.15.18 2.12-.49 2.32-1.63.08-.5.37-.92.79-1.21l1.14-.81c.13-.1.29-.15.44-.15s.31.05.44.15l1.19.81c.44.3 1.1.45 1.73.36l1.98-.31c1.95-.31 3.39-1.95 3.39-3.93v-2.93c0-.39-.14-.76-.4-1.05l-.83-.82c-.3-.31-.4-.77-.28-1.19.34-1.19.12-2.49-.51-3.5-.31-.49-.77-.85-1.27-1.1-1.05-.52-2.21-.6-3.3-.12-.26.09-.54.14-.82.14-.28 0-.56-.05-.83-.15l-2.77-.92c-.59-.19-1.12-.72-1.3-1.34-.06-.21-.14-.42-.14-.64v-3.91c0-.42-.33-.77-.75-.77s-.75.34-.75.77v3.91c0 1.16.36 2.26 1.12 3.16l2.4 2.75c1.13 1.34 2.63 2.25 4.27 2.53l2.57.4c1.51.23 2.88.01 4.02-.64.34-.18.67-.42.98-.73l1.53-1.52c.24-.24.4-.58.4-1.01v-5.27c0-.54-.44-.98-.98-.98-.54 0-.98.44-.98.98v5.27c0 1.11-.45 2.13-1.25 2.89l-1.4 1.37c-.34.33-.75.6-1.21.77-.39.14-.8.21-1.21.21l-1.86-.29c-1.09-.17-2.1-.39-3.03-.71-2.55-.86-4.56-2.92-5.66-5.66-.51-1.25-.88-2.59-.88-3.96 0-2.46 1.41-4.62 3.59-5.62 1.34-.64 2.86-.92 4.37-.67l2.68.43c1.08.17 2.06-.13 2.89-.84.4-.34.72-.79.93-1.31.2-.54.31-1.13.31-1.71V6.67c0-.62-.13-1.24-.37-1.79-.25-.57-.62-1.08-1.09-1.51-.4-.37-.85-.68-1.35-.9-1.12-.48-2.33-.57-3.49-.25l-2.19.56c-.89.22-1.68.78-2.18 1.6l-.79 1.17c-.34.5-.81.87-1.34 1.07-.54.2-1.12.1-1.59-.3l-1.89-1.69c-.26-.24-.58-.39-.91-.39h-2.03c-.54 0-.98-.44-.98-.98 0-.54.44-.98.98-.98h2.03c.51 0 .99.22 1.34.62l1.89 1.69c.36.32.82.59 1.3.79.52.22 1.1.2 1.56-.04.46-.24.84-.64 1.08-1.14l.59-.15c.92-.23 1.9-.12 2.76.27.87.39 1.62 1.14 1.98 2.1v5.6c0 1.04-.14 2.07-.41 3.08-.08.28-.17.55-.26.82-.05.14-.1.29-.15.43-.01.04-.02.08-.03.12v.35c0 1.16.56 2.25 1.52 2.96l1.55 1.23c.51.4.92.95 1.18 1.62.27.67.38 1.39.32 2.11v5.99c0 .33.34.6.76.6.42 0 .76-.34.76-.76v-5.99c.06-.72-.05-1.44-.32-2.11-.26-.67-.67-1.22-1.18-1.62l-1.55-1.23c-.87-.71-1.52-1.8-1.52-2.96v-.35c0-.04-.01-.08-.03-.12-.05-.14-.1-.29-.15-.43-.09-.27-.18-.54-.26-.82-.27-1.01-.41-2.04-.41-3.08v-5.6c0-1.16.68-2.17 1.77-2.66l1.53-.55c.45-.16.96-.22 1.43-.14.47.08.91.3 1.27.65.36.35.63.79.81 1.29.18.5.3 1.03.3 1.55v5.99c0 .42.34.76.76.76.42 0 .76-.44.76-.76v-5.99c0-1.04-.14-2.07-.41-3.08-.08-.28-.17-.55-.26-.82-.05-.14-.1-.29-.15-.43-.01-.04-.02-.08-.03-.12v-.35c0-1.16-.56-2.25-1.52-2.96l-1.55-1.23c-.51-.4-.92-.95-1.18-1.62-.27-.67-.38-1.39-.32-2.11v-5.6c0-1.04.14-2.07.41-3.08.08-.28.17-.55.26-.82.05-.14.1-.29.15-.43.01-.04.02-.08.03-.12v-.35c0-1.16.56-2.25 1.52-2.96l1.55-1.23c.51-.4.92-.95 1.18-1.62.27-.67.38-1.39.32-2.11v-5.99c0-.42-.34-.76-.76-.76s-.76.34-.76.76v5.99c-.06.72.05 1.44.32 2.11.26.67.67 1.22 1.18 1.62l1.55 1.23c.87.71 1.52 1.8 1.52 2.96v.35c0 .04.01.08.03.12.05.14.1.29.15.43.09.27.18.54.26.82.27 1.01.41 2.04.41 3.08v5.6c0 1.16-.68 2.17-1.77 2.66l-1.53.55c-.45.16-.96.22-1.43.14-.47-.08-.91-.3-1.27-.65-.36-.35-.63-.79-.81-1.29-.18-.5-.3-1.03-.3-1.55V6.67c0-.62.13-1.24.37-1.79.25-.57.62-1.08 1.09-1.51.4-.37.85-.68 1.35-.9 1.12-.48 2.33-.57 3.49-.25l2.19.56c.89.22 1.68.78 2.18 1.6l.79 1.17c.34.5.81.87 1.34 1.07.54.2 1.12.1 1.59-.3l1.89-1.69c.26-.24.58-.39.91-.39h2.03c.54 0 .98-.44.98-.98 0-.54-.44-.98-.98-.98h-2.03c-.51 0-.99-.22-1.34-.62l-1.89-1.69c-.36-.32-.82-.59-1.3-.79-.52-.22-1.1-.2-1.56.04-.46.24-.84.64-1.08 1.14l-.59.15c-.92.23-1.9.12-2.76-.27-.87-.39-1.62-1.14-1.98-2.1v-5.6c0-1.04.14-2.07.41-3.08.08-.28.17-.55.26-.82.05-.14.1-.29.15-.43.01-.04.02-.08.03-.12v-.35c0-1.16.56-2.25 1.52-2.96l1.55-1.23c.51-.4.92-.95 1.18-1.62.27-.67.38-1.39.32-2.11v-5.99c0-.42-.34-.76-.76-.76s-.76.34-.76.76v5.99c-.06.72-.17 1.44-.41 2.1-.08.28-.17.55-.26.82-.05.14-.1.29-.15.43-.01.04-.02.08-.03.12v.35c0 1.16-.56 2.25-1.52 2.96l-1.55 1.23c-.51.4-.92.95-1.18 1.62-.27.67-.38 1.39-.32 2.11v5.99c0 .42-.34.76-.76.76s-.76-.34-.76-.76v-5.99c-.06-.72.05-1.44.32-2.11.26-.67.67-1.22 1.18-1.62l1.55-1.23c.87-.71 1.52-1.8 1.52-2.96v-.35c0-.04-.01-.08-.03-.12-.05-.14-.1-.29-.15-.43-.09-.27-.18-.54-.26-.82-.27-1.01-.41-2.04-.41-3.08v-5.6c0-1.16-.68-2.17-1.77-2.66l-1.53-.55c-.45-.16-.96-.22-1.43-.14-.47.08-.91.3-1.27.65-.36.35-.63.79-.81 1.29-.18.5-.3 1.03-.3 1.55v.35c0 .54.44.98.98.98.54 0 .98-.44.98-.98v-.35c0-1.04-.14-2.07-.41-3.08-.08-.28-.17-.55-.26-.82-.05-.14-.1-.29-.15-.43-.01-.04-.02-.08-.03-.12v-.35c0-1.16-.56-2.25-1.52-2.96l-1.55-1.23c-.51-.4-.92-.95-1.18-1.62-.27-.67-.38-1.39-.32-2.11v-.35c0-.42-.34-.76-.76-.76s-.76.34-.76.76v.35c-.01.04-.02.08-.03.12-.05.14-.1.29-.15.43-.09.27-.18.54-.26.82-.27.67-.41 1.01-.41 1.55v.98c0 .54-.44.98-.98.98-.54 0-.98-.44-.98-.98v-.98c0-1.04.14-2.07.41-3.08.08-.28.17-.55.26-.82.05-.14.1-.29.15-.43.01-.04.02-.08.03-.12v-.35c0-1.16-.56-2.25-1.52-2.96l-1.55-1.23c-.51-.4-.92-.95-1.18-1.62-.27-.67-.38-1.39-.32-2.11v-.35"</svg>
                        <span>Chiama il numero verde {{ $contacts['phone'] ?? '05 0505' }}</span></a></li>
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M19 19h1V8H4v1h1V6c0-1.66 1.34-3 3-3h6c1.66 0 3 1.34 3 3v3h2v11zm-3-7H8c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h6c1.1 0 2 .9 2 2v4c0 1.1-.9 2-2 2zm-8 8c0 .55.45 1 1 1h8c.55 0 1-.45 1-1v-1H8v1zm10-1.5c-.28 0-.5-.22-.5-.5s.22-.5.5-.5.5.22.5.5-.22.5-.5.5z"/></svg>
                        <span>Prenota appuntamento</span></a></li>
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        <span>Segnala disservizio</span></a></li>
                </ul>
                <h3 class="mt-4 title-medium-2-semi-bold">Problemi in città</h3>
                <ul class="contact-list mt-3 space-y-3 p-0">
                    <li><a class="list-item flex items-center gap-2 rounded-lg p-3 text-sky-900 underline decoration-slate-400 underline-offset-4 transition hover:bg-sky-50 focus:outline-none focus:ring-4 focus:ring-sky-800/20" href="#">
                        <svg class="icon icon-primary icon-sm" aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.07L5.09 8.97C3.09 10.96 2 13.03 2 15.14C2 19.53 6.46 23 12 23C17.54 23 22 19.53 22 15.14C22 13.03 20.91 10.96 18.91 8.97L12 2.07M13 17H11V15H13V17M17.59 8.59L18.99 10L12 17L5.01 10L6.41 8.59L12 14.41L17.59 8.59Z"/></svg>
                        <span>Segnala disservizio</span></a></li>
                </ul>
            </div>
            <div class="space-y-3">
                <p>{{ $contacts['address'] ?? 'Piazza della Libertà, 1' }}</p>
                <p>{{ $contacts['phone'] ?? 'Telefono 050 505' }}</p>
                <p>{{ $contacts['email'] ?? 'info@comune.example.it' }}</p>
            </div>
        </div>
    </section>
</div>
