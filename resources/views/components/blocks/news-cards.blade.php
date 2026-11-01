{{--
    News cards component — real data, token #007A52, Tailwind+Alpine+Lit.
    NO Bootstrap Italia. Dati reali da pages JSON (tests.novita-dettaglio / novita-dettaglio).
    Stack: Tailwind CSS + Alpine.js + Lit + DaisyUI + Flowbite.
--}}
@props(['items' => [], 'title' => __('pub_theme::header.center.nav.novita.label')])

<section aria-label="{{ __('pub_theme::header.center.nav.novita.label') }}" class="bg-[#F8F9FB] py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-[#0B1D36] mb-10 tracking-tight leading-tight">
            {{ $title }}
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($items as $item)
            <article class="group rounded-2xl overflow-hidden bg-white shadow-md hover:shadow-xl transition-shadow duration-300 border border-[#E5E7EB] flex flex-col">
                @if (!empty($item['image']))
                <a href="{{ $item['url'] ?? '#' }}" class="block overflow-hidden" aria-label="{{ __('pub_theme::components_content.news.read.label', ['title' => $item['title'] ?? '']) }}">
                    <img src="{{ $item['image'] }}" alt="{{ $item['image_alt'] ?? ($item['title'] ?? __('pub_theme::header.center.nav.novita.label')) }}"
                        class="w-full h-52 object-cover transform group-hover:scale-[1.03] transition-transform duration-300"
                        loading="lazy">
                </a>
                @endif
                <div class="p-6 flex flex-col flex-1">
                    <div class="flex items-center gap-3 text-sm text-[#6B7280] mb-3">
                        @if (!empty($item['date']))
                        <time datetime="{{ $item['date'] }}">{{ $item['date'] }}</time>
                        @endif
                        @if (!empty($item['category']))
                        <span class="inline-flex items-center rounded-full bg-[#EAF5EE] text-[#007A52] px-2.5 py-0.5 text-xs font-semibold tracking-wide uppercase">{{ $item['category'] }}</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-[#0B1D36] mb-3 leading-snug">
                        <a href="{{ $item['url'] ?? '#' }}" class="hover:text-[#007A52] transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-[#007A52] focus-visible:ring-offset-2 rounded-sm">
                            {{ $item['title'] ?? '' }}
                        </a>
                    </h3>
                    <p class="text-[#374151] mb-5 leading-relaxed flex-1">
                        {{ $item['excerpt'] ?? ($item['text'] ?? '') }}
                    </p>
                    <a href="{{ $item['url'] ?? '#' }}"
                        class="inline-flex items-center gap-2 text-[#007A52] font-semibold hover:text-[#005E3F] transition-colors mt-auto focus:outline-none focus-visible:ring-2 focus-visible:ring-[#007A52] focus-visible:ring-offset-2 rounded-sm"
                        aria-label="{{ __('pub_theme::components_content.news.read_item.label', ['title' => $item['title'] ?? '']) }}">
                        {{ __('pub_theme::components_common.actions.read_more.label') }}
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
