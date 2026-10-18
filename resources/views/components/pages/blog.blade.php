@php
/**
 * Design Comuni — Blog / Novità
 * Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap Italia)
 * Reference: https://italia.github.io/design-comuni-pagine-statiche/sito/novita.html / lista-risorse
 * Riferimento blog: https://www.afcformazione.it/blog/, https://www.aferrari.it/articoli/, https://www.assodellavendita.it/blog/
 * Blokci riconosciuti: breadcrumbs, hero, cards-grid, pagination, tag, sidebar/related
 */
@endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    {{-- Breadcrumbs --}}
    <nav aria-label="Breadcrumb" class="mb-6">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
            <li><a href="{{ url('/') }}" class="hover:text-primary-700 underline">{{ __('Home') }}</a></li>
            <li aria-hidden="true">/</li>
            <li class="text-gray-900 font-semibold" aria-current="page">{{ __('Blog') }}</li>
        </ol>
    </nav>

    {{-- Hero --}}
    <header class="mb-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold leading-tight text-gray-900 tracking-tight">{{ __('Blog e Novità') }}</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-3xl">Notizie, eventi e aggiornamenti dal Comune per restare informati su progetti, iniziative e servizi per i cittadini.</p>
    </header>

    {{-- Featured / Hero Card --}}
    <section aria-label="In evidenza" class="mb-12">
        <a href="#" class="group block rounded-3xl overflow-hidden shadow-xl bg-gradient-to-br from-primary-700 to-primary-900 text-white relative">
            <div class="aspect-[21/9] md:aspect-[2.35/1] bg-gray-800 relative">
                <img src="/images/blog/hero.jpg" alt="Blog in evidenza" class="w-full h-full object-cover opacity-60 group-hover:scale-105 transition-transform duration-700" loading="eager">
            </div>
            <div class="absolute inset-0 p-6 md:p-10 flex flex-col justify-end bg-gradient-to-t from-black/80 via-black/40 to-transparent">
                <span class="inline-block w-fit rounded-full bg-white/20 text-white text-xs font-bold px-3 py-1 mb-3 backdrop-blur-sm">{{ __('In evidenza') }}</span>
                <h2 class="text-2xl md:text-4xl font-extrabold leading-tight mb-2">Nuova piazza pedonale in centro storico</h2>
                <p class="text-white/90 max-w-2xl">Il progetto di riqualificazione approvato dal Comune trasforma il cuore della città in uno spazio vivibile, sostenibile e accessibile a tutti.</p>
            </div>
        </a>
    </section>

    {{-- Cards Grid (Design Comuni) --}}
    <section aria-label="Articoli recenti" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach ([
            ['title'=>'Festa della Cultura 2026','type'=>'event','date'=>'15–18 maggio 2026','img'=>'/images/blog/cultura.jpg','tag'=>'Eventi'],
            ['title'=>'Restauro della fontana monumentale','type'=>'post','date'=>'3 giorni fa','img'=>'/images/blog/fontana.jpg','tag'=>'Cultura'],
            ['title'=>'Mercato contadino del sabato','type'=>'event','date'=>'Ogni sabato','img'=>'/images/blog/mercato.jpg','tag'=>'Economia'],
            ['title'=>'Nuovi servizi digitali per i cittadini','type'=>'post','date'=>'2 giorni fa','img'=>'/images/blog/digital.jpg','tag'=>'Tecnologia'],
            ['title'=>'Conferenza sul cambiamento climatico','type'=>'event','date'=>'60 giorni','img'=>'/images/blog/clima.jpg','tag'=>'Ambiente'],
        ] as $post)
        <article class="rounded-2xl border border-gray-200 bg-white shadow-sm hover:shadow-lg transition-shadow overflow-hidden flex flex-col">
            <a href="#" class="block relative aspect-[16/10] overflow-hidden">
                <img src="{{ $post['img'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" loading="lazy">
                <span class="absolute top-3 left-3 rounded-full bg-white/90 text-gray-900 text-xs font-bold px-3 py-1 shadow-sm">{{ $post['tag'] }}</span>
            </a>
            <div class="p-5 flex-1 flex flex-col">
                <div class="flex items-center gap-2 text-xs text-gray-500 mb-2 font-medium">
                    <span>{{ $post['type'] === 'event' ? 'Evento' : 'Articolo' }}</span>
                    <span aria-hidden="true">·</span>
                    <time>{{ $post['date'] }}</time>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug"><a href="#" class="hover:text-primary-700 hover:underline underline-offset-4">{{ $post['title'] }}</a></h3>
                <a href="#" class="inline-flex items-center gap-1 text-sm font-semibold text-primary-700 hover:text-primary-900 transition-colors mt-auto pt-3">{{ __('Leggi tutto') }} <span aria-hidden="true">→</span></a>
            </div>
        </article>
        @endforeach
    </section>

    {{-- Pagination (Flowbite-style) --}}
    <nav aria-label="Paginazione" class="flex justify-center mb-12">
        <div class="flex items-center gap-2">
            <a href="#" aria-label="Pagina precedente" class="rounded-xl px-4 py-2 border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">←</a>
            <a href="#" aria-current="page" class="rounded-xl px-4 py-2 bg-primary-700 text-white font-semibold shadow-md">1</a>
            <a href="#" class="rounded-xl px-4 py-2 border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">2</a>
            <a href="#" class="rounded-xl px-4 py-2 border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">3</a>
            <a href="#" aria-label="Pagina successiva" class="rounded-xl px-4 py-2 border border-gray-200 text-gray-700 hover:bg-gray-50 transition-colors">→</a>
        </div>
    </nav>

    {{-- Sidebar / Related (optional block) --}}
    <aside aria-label="Categorie e tag" class="rounded-2xl border border-gray-200 bg-gradient-to-b from-gray-50 to-white p-6 shadow-sm">
        <h2 class="font-bold text-lg mb-4">{{ __('Categorie') }}</h2>
        <div class="flex flex-wrap gap-2">
            @foreach (['Urbanistica','Eventi','Cultura','Ambiente','Tecnologia','Economia'] as $cat)
            <a href="#" class="rounded-full border border-gray-200 bg-white px-3 py-1 text-sm font-medium text-gray-700 hover:border-primary-300 hover:text-primary-700 transition-colors">{{ $cat }}</a>
            @endforeach
        </div>
    </aside>

    {{-- Footer Design Comuni --}}
    <footer class="mt-10 rounded-2xl border border-gray-200/60 bg-gradient-to-r from-gray-900 to-gray-800 text-white p-6 shadow-xl" aria-label="Accessibilità e navigazione">
        <div class="grid md:grid-cols-2 gap-6 text-sm">
            <div>
                <h3 class="font-bold text-base mb-2 flex items-center gap-2"><span aria-hidden="true">♿</span> {{ __('Accessibilità') }}</h3>
                <p>{{ __('Conforme a WCAG 2.1 AA') }} • <a href="/accessibility" class="underline hover:text-blue-200 transition-colors">{{ __('Dichiarazione di accessibilità') }}</a></p>
            </div>
            <div>
                <h3 class="font-bold text-base mb-2">{{ __('Navigazione') }}</h3>
                <p>{{ __('Tab per spostarsi • Invio per confermare') }}</p>
            </div>
        </div>
    </footer>
</div>
