{{--
  BMAD Component: Sponsor Section (reusable block)
  Props: sponsors (array of {name, url, image, alt})
  Owners: Sixteen theme
  Usage: <x-block slug="sponsor" sponsors="[...]" />
  AdSense-ready: no, pure sponsored links
--}}
@props([
    'sponsors' => [],
    'title' => 'Sponsor',
    'subtitle' => 'I nostri partner',
])
<section class="py-10 border-t border-slate-100 bg-slate-50" aria-label="Sezione sponsor" data-block="sponsor">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-xl font-bold text-slate-900">{{ $title }}</h2>
        @if ($subtitle)
            <p class="text-center text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
        @endif
        <div class="mt-8 flex flex-wrap justify-center gap-8 items-center">
            @forelse($sponsors as $sp)
                <a href="{{ $sp['url'] ?? '#' }}" class="inline-block" aria-label="{{ $sp['alt'] ?? $sp['name'] }}">
                    @if (filled($sp['image'] ?? null))
                        <img src="{{ asset($sp['image']) }}" alt="{{ $sp['alt'] ?? $sp['name'] }}" class="h-16 w-auto object-contain opacity-80 hover:opacity-100 transition" loading="lazy">
                    @else
                        <span class="inline-block bg-slate-200 text-slate-700 px-4 py-3 rounded-md text-sm font-medium">{{ $sp['name'] }}</span>
                    @endif
                </a>
            @empty
                <span class="text-sm text-slate-400">Nessuno sponsor configurato.</span>
            @endforelse
        </div>
    </div>
</section>
