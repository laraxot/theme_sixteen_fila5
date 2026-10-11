@props(['data' => []])

<div class="mx-auto w-full max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
    <nav aria-label="Breadcrumb" class="mb-8 text-sm text-[#5d7083]"><a class="text-[#007a52] underline" href="{{ $data['home_url'] ?? '#' }}">Home</a><span class="mx-2" aria-hidden="true">/</span><span aria-current="page">{{ $data['title'] ?? '' }}</span></nav>
    <header class="max-w-3xl border-b border-[#d9d9d9] pb-8">
        <p class="text-sm font-bold uppercase tracking-[.12em] text-[#007a52]">DesignComuni</p>
        <h1 class="mt-3 text-4xl font-bold leading-tight text-[#191919] md:text-5xl">{{ $data['title'] ?? '' }}</h1>
        <p class="mt-5 text-lg leading-8 text-[#191919]">{{ $data['intro'] ?? '' }}</p>
    </header>
    <div class="mt-10 grid gap-10 lg:grid-cols-[240px_minmax(0,1fr)]">
        <aside>
            <h2 class="text-sm font-bold uppercase text-[#191919]">Indice della pagina</h2>
            <ul class="mt-3 border-l-2 border-[#007a52] pl-4 text-[#007a52]"><li><a class="underline" href="#contenuti">Contenuti</a></li><li><a class="underline" href="#contatti">Contatti</a></li></ul>
        </aside>
        <main id="contenuti" class="min-w-0">
            <h2 class="text-3xl font-bold text-[#191919]">{{ $data['content_title'] ?? 'Contenuti' }}</h2>
            <p class="mt-4 max-w-3xl text-base leading-7 text-[#191919]">{{ $data['content'] ?? 'Consulta le informazioni disponibili e scegli il servizio o il contenuto che ti interessa.' }}</p>
            <div class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach($data['items'] ?? [] as $item)
                    <a href="{{ $item['url'] ?? '#' }}" class="rounded border border-[#d9d9d9] bg-white p-5 text-[#007a52] shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#007a52]"><h3 class="font-bold underline">{{ $item['title'] ?? '' }}</h3>@if(!empty($item['description']))<p class="mt-2 text-sm leading-6 text-[#191919]">{{ $item['description'] }}</p>@endif</a>
                @endforeach
            </div>
        </main>
    </div>
    <section id="contatti" class="mt-14 border-t border-[#d9d9d9] pt-8"><h2 class="text-3xl font-bold text-[#191919]">Contatti</h2><p class="mt-3 text-base leading-7">Per informazioni contatta il Comune attraverso i canali disponibili.</p></section>
</div>
