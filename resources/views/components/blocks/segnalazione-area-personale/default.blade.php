@props(['data' => []])

@php
    $title = $data['title'] ?? 'Segnalazione - Area personale';
    $subtitle = $data['subtitle'] ?? 'Le tue segnalazioni';
    $segnalazioni = $data['segnalazioni'] ?? [
        ['titolo' => 'Segnalazione 1', 'stato' => 'In lavorazione'],
        ['titolo' => 'Segnalazione 2', 'stato' => 'Completata'],
    ];
@endphp

<div class="main-container" id="main-container">
    <div class="mx-auto max-w-5xl px-4 py-8 lg:py-12">
        <nav class="mb-6 text-sm text-[#5d7083]" aria-label="Breadcrumb">
            <ol class="flex flex-wrap items-center gap-2">
                <li><a href="{{ route('tests.view', ['slug' => 'homepage']) }}" class="underline-offset-2 hover:text-[#007a52] hover:underline">Home</a></li>
                <li aria-hidden="true">/</li>
                <li><a href="{{ route('tests.view', ['slug' => 'area-personale']) }}" class="underline-offset-2 hover:text-[#007a52] hover:underline">Area personale</a></li>
                <li aria-hidden="true">/</li>
                <li aria-current="page">{{ $title }}</li>
            </ol>
        </nav>

        <div class="cmp-hero mb-8" data-element="page-name">
            <h1 class="text-3xl font-bold text-[#17324d] lg:text-4xl">{{ $title }}</h1>
        </div>

        <h2 class="mb-6 text-2xl font-bold text-[#17324d]">{{ $subtitle }}</h2>

        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($segnalazioni as $segnalazione)
                <div class="card-wrapper rounded border border-[#d9e2e8] bg-white p-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="t-primary text-lg font-bold">{{ $segnalazione['titolo'] }}</h3>
                        <p class="mt-2 text-sm text-[#334e68]">Stato: {{ $segnalazione['stato'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@if (!empty($data['contacts']))
    <section class="bg-[#f5f7f9] py-12">
        <div class="mx-auto max-w-4xl px-4">
            <div class="rounded-lg bg-white p-6 shadow-sm">
                @include('pub_theme::components.sections.contacts.default', ['data' => $data['contacts']])
            </div>
        </div>
    </section>
@endif
