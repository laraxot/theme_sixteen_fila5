@props([
    'title' => 'Informazioni sul servizio',
    'sections' => [],
])

<div class="service-details mx-auto max-w-4xl px-4 py-8">
    <h2 class="mb-6 text-3xl font-bold text-[#17324d]">{{ $title }}</h2>

    <div class="grid gap-4 sm:grid-cols-2">
        @foreach($sections as $section)
            <div class="rounded-lg border border-[#d9e2e8] bg-white p-4 shadow-sm">
                <h3 class="mb-2 text-xl font-bold text-[#17324d]">{{ $section['title'] ?? '' }}</h3>
                <p class="text-[#334e68]">{{ $section['content'] ?? '' }}</p>
            </div>
        @endforeach
    </div>
</div>
