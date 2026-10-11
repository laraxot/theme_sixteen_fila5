@props(['data' => []])

<section class="mx-auto w-full max-w-7xl px-5 py-10" aria-labelledby="card-grid-title">
    @if (! empty($data['heading']))
        <h2 id="card-grid-title" class="mb-6 text-3xl font-bold text-[#191919]">{{ $data['heading'] }}</h2>
    @endif
    <div class="grid gap-6 md:grid-cols-3">
        @foreach ($data['items'] ?? [] as $item)
            <a href="{{ $item['url'] ?? '#' }}" class="group rounded border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md focus:outline-none focus-visible:ring-4 focus-visible:ring-[#007a52]/40">
                <h3 class="text-xl font-bold text-[#191919] group-hover:underline">{{ $item['title'] ?? '' }}</h3>
                @if (! empty($item['description']))
                    <p class="mt-3 leading-7 text-slate-700">{{ $item['description'] }}</p>
                @endif
            </a>
        @endforeach
    </div>
</section>
