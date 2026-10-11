@props(['data' => []])

@php
    $title = $data['title'] ?? 'Area personale';
    $userName = $data['user_name'] ?? 'Giulia Rossi';
    $fiscalCode = $data['fiscal_code'] ?? 'GLARSS72H25H501Y';
    $messages = $data['messages'] ?? [
        ['date' => '05/04/2022', 'title' => 'Richiesta servizio mensa scolastica', 'text' => 'La richiesta AN4059281 è stata approvata.'],
        ['date' => '20/03/2022', 'title' => 'Richiesta servizio mensa scolastica', 'text' => 'La richiesta AN4059281 è stata ricevuta.'],
        ['date' => '15/02/2022', 'title' => 'Iscrizione alla scuola dell’infanzia', 'text' => 'La richiesta AFG059281 è stata ricevuta.'],
    ];
    $activities = $data['activities'] ?? [
        ['title' => 'Segnalazione disservizio', 'date' => '15/04/2022'],
        ['title' => 'Pagamento contravvenzione', 'date' => '23/01/2022'],
        ['title' => 'Richiesta assegno maternità', 'date' => '01/10/2021'],
    ];
@endphp

<div class="mx-auto max-w-6xl px-4 py-8 lg:py-12">
    <nav class="mb-8 text-sm text-[#5d7083]" aria-label="Breadcrumb">
        <ol class="flex flex-wrap items-center gap-2">
            <li><a href="{{ route('tests.view', ['slug' => 'homepage']) }}" class="underline-offset-2 hover:text-[#007a52] hover:underline">Home</a></li>
            <li aria-hidden="true">/</li>
            <li aria-current="page">{{ $title }}</li>
        </ol>
    </nav>

    <div class="border-b border-[#d9e2e8] pb-8">
        <h1 class="text-4xl font-bold tracking-tight lg:text-5xl">{{ $userName }}</h1>
        <p class="mt-3 text-[#334e68]">CF: {{ $fiscalCode }}</p>
    </div>

    <div class="mt-8 border-b border-[#d9e2e8]" x-data="{ tab: 'desk' }">
        <nav class="flex flex-wrap gap-6" aria-label="Navigazione area personale">
            @foreach (['desk' => 'Scrivania', 'messages' => 'Messaggi', 'activities' => 'Attività', 'services' => 'Servizi'] as $key => $label)
                <button type="button" @click="tab = '{{ $key }}'" :aria-current="tab === '{{ $key }}' ? 'page' : false" class="border-b-4 px-1 py-3 font-semibold" :class="tab === '{{ $key }}' ? 'border-[#007a52] text-[#007a52]' : 'border-transparent text-[#334e68]'">{{ $label }}</button>
            @endforeach
        </nav>
    </div>

    <div class="mt-8 gap-10 lg:flex lg:items-start lg:gap-16">
        <aside class="hidden lg:block lg:w-1/4 lg:shrink-0">
            <h2 class="text-xs font-bold uppercase tracking-wide text-[#334e68]">Indice della pagina</h2>
            <ul class="mt-4 space-y-3 text-[#007a52]">
                <li><a href="#ultimi-messaggi" class="underline-offset-2 hover:underline">Ultimi messaggi</a></li>
                <li><a href="#ultime-attivita" class="underline-offset-2 hover:underline">Ultime attività</a></li>
            </ul>
        </aside>

        <div class="min-w-0 flex-1 space-y-12" x-show="tab === 'desk' || tab === 'messages' || tab === 'activities'">
            <section id="ultimi-messaggi" x-show="tab === 'desk' || tab === 'messages'">
                <h2 class="text-3xl font-bold">Ultimi messaggi</h2>
                <div class="mt-6 divide-y divide-[#d9e2e8] rounded bg-[#f5f7f9] shadow-sm">
                    @foreach ($messages as $message)
                        <article class="p-5 lg:p-6">
                            <p class="text-sm text-[#5d7083]">Categoria: <time datetime="{{ $message['date'] }}">{{ $message['date'] }}</time></p>
                            <h3 class="mt-2 text-xl font-bold">{{ $message['title'] }}</h3>
                            <p class="mt-2 text-[#334e68]">{{ $message['text'] }}</p>
                        </article>
                    @endforeach
                </div>
                <a href="#" class="mt-5 inline-block font-semibold text-[#007a52] underline-offset-2 hover:underline">Vedi altri messaggi</a>
            </section>

            <section id="ultime-attivita" x-show="tab === 'desk' || tab === 'activities'">
                <h2 class="text-3xl font-bold">Ultime attività</h2>
                <ul class="mt-6 divide-y divide-[#d9e2e8] border-y border-[#d9e2e8]">
                    @foreach ($activities as $activity)
                        <li class="flex items-center justify-between gap-4 py-4">
                            <span class="font-semibold">{{ $activity['title'] }}</span>
                            <time class="text-sm text-[#5d7083]" datetime="{{ $activity['date'] }}">{{ $activity['date'] }}</time>
                        </li>
                    @endforeach
                </ul>
                <a href="#" class="mt-5 inline-block font-semibold text-[#007a52] underline-offset-2 hover:underline">Vedi altre attività</a>
            </section>
        </div>
    </div>
</div>

<section class="bg-[#f5f7f9] py-12">
    <div class="mx-auto max-w-6xl px-4">
        <div class="mx-auto max-w-xl rounded bg-white p-6 shadow-sm lg:p-8">
            <h2 class="text-2xl font-semibold">Contatta il comune</h2>
            <ul class="mt-4 divide-y divide-[#d9e2e8]">
                <li><a href="{{ route('tests.view', ['slug' => 'domande-frequenti']) }}" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Leggi le domande frequenti</a></li>
                <li><a href="#" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Richiedi assistenza</a></li>
                <li><a href="tel:050505" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Chiama il numero verde 05 0505</a></li>
                <li><a href="#" class="block py-4 text-[#007a52] underline-offset-2 hover:underline">Prenota appuntamento</a></li>
            </ul>
        </div>
    </div>
</section>
