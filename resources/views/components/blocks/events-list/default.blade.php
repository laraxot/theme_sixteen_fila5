@props(['data' => []])
<section class="max-w-6xl mx-auto px-6 py-10" aria-labelledby="all-events-title">
    <header class="mb-8 border-b border-gray-200 pb-4">
        <nav class="text-sm text-gray-500 mb-2" aria-label="Breadcrumb"><a href="/" class="underline hover:text-primary">Home</a> <span aria-hidden="true">/</span> <span class="font-semibold text-gray-900" aria-current="page">Eventi</span></nav>
        <h1 id="all-events-title" class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight">{{ $data['title'] ?? 'Tutti gli eventi' }}</h1>
    </header>
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">@foreach (($data['items'] ?? []) as $item)<article class="dc-event-list-card"><p class="dc-event-card__meta">{{ $item['date'] ?? '' }}</p><p class="dc-event-card__category">{{ $item['category'] ?? '' }}</p><h3><a href="{{ $item['url'] ?? '#' }}">{{ $item['title'] ?? '' }}</a></h3><p>{{ $item['description'] ?? '' }}</p></article>@endforeach</div>
    </div>
</section>
