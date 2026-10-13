@props(['data' => []])

@php
    $kind = (string) ($data['kind'] ?? $data['slug'] ?? '');
    $imageBase = rtrim((string) ($data['image_base'] ?? 'https://italia.github.io/design-comuni-pagine-statiche/assets/images'), '/');
    $image = static fn (string $value): string => str_starts_with($value, 'http') ? $value : $imageBase.'/'.$value;
@endphp

<div class="mx-auto w-full max-w-[1296px] px-4 pb-16 sm:px-6 lg:px-8">
    <nav aria-label="Breadcrumb" class="mb-8 pt-8 text-sm text-[#5d7083]"><a class="text-[#007a52] underline" href="{{ $data['home_url'] ?? '#' }}">Home</a><span class="mx-2" aria-hidden="true">/</span><span aria-current="page">{{ $data['title'] ?? '' }}</span></nav>
    <header class="pb-12"><h1 class="text-4xl font-bold leading-tight text-[#191919] md:text-5xl">{{ $data['title'] ?? '' }}</h1><p class="mt-5 max-w-4xl text-xl leading-9 text-[#17324d]">{{ $data['intro'] ?? '' }}</p></header>

    @if ($kind === 'events')
        <section aria-labelledby="eventi-in-evidenza"><h2 id="eventi-in-evidenza" class="mb-6 text-3xl font-bold text-[#17324d]">Eventi in evidenza</h2><div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($data['featured'] ?? []) as $item)<article class="overflow-hidden rounded border border-[#d9d9d9] bg-white shadow-sm">@if(!empty($item['image']))<img src="{{ $image($item['image']) }}" alt="{{ $item['image_alt'] ?? $item['title'] ?? '' }}" class="h-48 w-full object-cover" loading="lazy">@endif<div class="p-5"><p class="text-sm font-semibold text-[#5d7083]">{{ $item['date'] ?? '' }}{{ !empty($item['time']) ? ' · '.$item['time'] : '' }}</p><h3 class="mt-2 text-xl font-bold"><a class="text-[#007a52] underline" href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p class="mt-2 leading-7 text-[#17324d]">{{ $item['description'] ?? '' }}</p>@if(!empty($item['location']))<p class="mt-3 text-sm text-[#17324d]">{{ $item['location'] }}</p>@endif</div></article>@endforeach
        </div></section>
        <section aria-labelledby="luoghi-in-evidenza" class="mt-14"><h2 id="luoghi-in-evidenza" class="mb-6 text-3xl font-bold text-[#17324d]">Luoghi in evidenza</h2><div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($data['places'] ?? []) as $item)<article class="overflow-hidden rounded border border-[#d9d9d9] bg-white shadow-sm"><img src="{{ $image($item['image'] ?? '') }}" alt="{{ $item['image_alt'] ?? $item['title'] ?? '' }}" class="h-48 w-full object-cover" loading="lazy"><div class="p-5"><h3 class="text-xl font-bold"><a class="text-[#007a52] underline" href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p class="mt-2 leading-7 text-[#17324d]">{{ $item['description'] ?? '' }}</p></div></article>@endforeach
        </div></section>
    @elseif ($kind === 'news')
        <section aria-labelledby="novita-in-evidenza"><h2 id="novita-in-evidenza" class="mb-6 text-3xl font-bold text-[#17324d]">In evidenza</h2><div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($data['featured'] ?? []) as $item)<article class="overflow-hidden rounded border border-[#d9d9d9] bg-white shadow-sm">@if(!empty($item['image']))<img src="{{ $image($item['image']) }}" alt="{{ $item['image_alt'] ?? $item['title'] ?? '' }}" class="h-48 w-full object-cover" loading="lazy">@endif<div class="p-5"><p class="text-sm text-[#5d7083]">{{ $item['date'] ?? '' }}</p><h3 class="mt-2 text-xl font-bold"><a class="text-[#007a52] underline" href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p class="mt-2 leading-7 text-[#17324d]">{{ $item['description'] ?? '' }}</p></div></article>@endforeach
        </div></section>
        <section aria-labelledby="tutte-le-novita" class="mt-14"><h2 id="tutte-le-novita" class="mb-6 text-3xl font-bold text-[#17324d]">Esplora tutte le novità</h2><div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach(($data['items'] ?? []) as $item)<article class="rounded border border-[#d9d9d9] bg-white p-5 shadow-sm"><p class="text-sm text-[#5d7083]">{{ $item['date'] ?? '' }}</p><h3 class="mt-2 text-xl font-bold"><a class="text-[#007a52] underline" href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p class="mt-2 leading-7 text-[#17324d]">{{ $item['description'] ?? '' }}</p></article>@endforeach
        </div></section>
    @elseif ($kind === 'services')
        <section aria-labelledby="servizi-catalogo"><h2 id="servizi-catalogo" class="mb-6 text-3xl font-bold text-[#17324d]">Trova il servizio del Comune che ti serve</h2><div class="grid gap-5 md:grid-cols-2">
            @foreach(($data['categories'] ?? []) as $item)<a href="{{ $item['url'] ?? '#' }}" class="rounded border border-[#d9d9d9] bg-white p-6 shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#007a52]"><h3 class="text-xl font-bold text-[#007a52] underline">{{ $item['title'] ?? '' }}</h3><p class="mt-2 leading-7 text-[#17324d]">{{ $item['description'] ?? '' }}</p></a>@endforeach
        </div></section>
    @else
        <div class="mt-2 grid gap-10 lg:grid-cols-[240px_minmax(0,1fr)]"><aside><h2 class="text-sm font-bold uppercase text-[#191919]">Indice della pagina</h2><ul class="mt-3 border-l-2 border-[#007a52] pl-4 text-[#007a52]"><li><a class="underline" href="#contenuti">Contenuti</a></li><li><a class="underline" href="#contatti">Contatti</a></li></ul></aside><main id="contenuti" class="min-w-0"><h2 class="text-3xl font-bold text-[#191919]">{{ $data['content_title'] ?? 'Contenuti' }}</h2><p class="mt-4 max-w-3xl text-base leading-7 text-[#191919]">{{ $data['content'] ?? 'Consulta le informazioni disponibili e scegli il servizio o il contenuto che ti interessa.' }}</p><div class="mt-8 grid gap-4 sm:grid-cols-2">@foreach($data['items'] ?? [] as $item)<a href="{{ $item['url'] ?? '#' }}" class="rounded border border-[#d9d9d9] bg-white p-5 text-[#007a52] shadow-sm hover:shadow-md focus:outline-none focus:ring-4 focus:ring-[#007a52]"><h3 class="font-bold underline">{{ $item['title'] ?? '' }}</h3>@if(!empty($item['description']))<p class="mt-2 text-sm leading-6 text-[#191919]">{{ $item['description'] }}</p>@endif</a>@endforeach</div></main></div><section id="contatti" class="mt-14 border-t border-[#d9d9d9] pt-8"><h2 class="text-3xl font-bold text-[#191919]">Contatti</h2><p class="mt-3 text-base leading-7">Per informazioni contatta il Comune attraverso i canali disponibili.</p></section>
    @endif
</div>
