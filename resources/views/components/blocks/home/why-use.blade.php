{{--
    @see docs/marketing/homepage-conversion-contract.md
    Blocco homepage data-driven: il CMS fornisce i cinque motivi e il tema cura solo la resa.
    Riusa la griglia civica di `how-it-works` per mantenere gerarchia e stile coerenti.
--}}
@props([
    'heading' => '',
    'intro' => '',
    'items' => [],
])

<section class="fc-how-section" aria-labelledby="why-use-fixcity-heading" data-section="why-use-fixcity">
    <div class="container">
        <div class="fc-section-heading" data-reveal="fade-up" data-delay="0">
            <h2 id="why-use-fixcity-heading">{{ $heading }}</h2>
            @if (filled($intro))
                <p>{{ $intro }}</p>
            @endif
        </div>

        <ol class="fc-how-grid" aria-label="{{ $heading }}">
            @foreach ($items as $item)
                <li class="fc-how-card" data-reveal="fade-up" data-delay="{{ $loop->index * 100 }}">
                    <span class="fc-how-card__number" aria-hidden="true">{{ $loop->iteration }}</span>
                    <h3>{{ $item['title'] ?? '' }}</h3>
                    <p>{{ $item['body'] ?? '' }}</p>
                </li>
            @endforeach
        </ol>
    </div>
</section>
