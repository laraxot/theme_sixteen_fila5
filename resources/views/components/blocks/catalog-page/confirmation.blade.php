@props(['data' => []])

<div class="mx-auto w-full max-w-[1296px] px-4 pb-16 sm:px-6 lg:px-8">
    <nav aria-label="Breadcrumb" class="mb-8 pt-8 text-sm text-[#5d7083]"><a class="text-[#007a52] underline" href="{{ $data['home_url'] ?? '#' }}">Home</a><span class="mx-2" aria-hidden="true">/</span><span aria-current="page">{{ $data['title'] ?? '' }}</span></nav>
    <section class="max-w-3xl pb-16" aria-labelledby="confirmation-title">
        <h1 id="confirmation-title" class="flex items-center gap-3 text-4xl font-bold leading-tight text-[#191919] md:text-5xl"><span class="inline-flex h-8 w-8 items-center justify-center rounded-full border-2 border-[#007a52] text-xl text-[#007a52]" aria-hidden="true">✓</span>{{ $data['title'] ?? 'Richiesta inviata' }}</h1>
        <p class="mt-3 text-2xl leading-9 text-[#17324d]">{{ $data['intro'] ?? 'La richiesta è stata inviata con successo, sarai ricontattato presto.' }}</p>
        <p class="mt-10 text-2xl leading-9 text-[#17324d]">Abbiamo inviato il riepilogo all’email:<br><strong>{{ $data['email'] ?? 'giulia.bianchi@gmail.com' }}</strong></p>
    </section>
    <section class="-mx-4 bg-[#007a52] px-4 py-20 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8" aria-labelledby="feedback-title">
        <div class="mx-auto max-w-2xl bg-white p-8 shadow-lg"><h2 id="feedback-title" class="text-2xl font-bold text-[#191919]">Quanto è stato facile usare questo servizio?</h2><div class="mt-5 text-3xl tracking-widest text-[#8097b0]" aria-label="Valuta il servizio da una a cinque stelle">★★★★★</div></div>
    </section>
</div>
