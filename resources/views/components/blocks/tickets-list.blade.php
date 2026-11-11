{{-- BMAD + Second Brain + Filament Blueprint --}}
{{-- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap Italia) --}}
{{-- Token PA #007A52 / design-comuni --}}
<div class="max-w-5xl mx-auto px-6 py-10" aria-label="{{ __('pub_theme::components_tickets_list.list.region.aria_label') }}" x-data="{ filter:'all', showMap:false, open:[] }">
  <header class="mb-8">
    <h1 id="tickets-heading" class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ __('pub_theme::blocks_common.shared.reports.label') }}</h1>
    <p class="mt-2 text-lg text-gray-600">{{ __('pub_theme::components_tickets_list.list.intro.description') }}</p>
  </header>

  <div class="flex flex-wrap gap-3 mb-8" role="group" aria-label="{{ __('pub_theme::components_tickets_list.filters.group.aria_label') }}">
    <button @click="filter='all'" :class="filter==='all' ? 'bg-primary text-white' : 'bg-white border border-gray-300 text-gray-700'" class="px-4 py-2 rounded-full font-medium transition focus:outline-none focus:ring-2 focus:ring-primary/50">{{ __('pub_theme::components_tickets_list.filters.all.label') }}</button>
    <button @click="filter='open'" :class="filter==='open' ? 'bg-primary text-white' : 'bg-white border border-gray-300 text-gray-700'" class="px-4 py-2 rounded-full font-medium transition focus:outline-none focus:ring-2 focus:ring-primary/50">{{ __('pub_theme::components_tickets_list.filters.open.label') }}</button>
    <button @click="filter='closed'" :class="filter==='closed' ? 'bg-primary text-white' : 'bg-white border border-gray-300 text-gray-700'" class="px-4 py-2 rounded-full font-medium transition focus:outline-none focus:ring-2 focus:ring-primary/50">{{ __('pub_theme::components_tickets_list.filters.closed.label') }}</button>
  </div>

  <section class="space-y-4" aria-labelledby="tickets-heading">
    <article class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 hover:shadow-md transition" x-show="filter==='all' || filter==='open'" x-data="{ open: false }">
      <div class="flex items-start justify-between gap-4">
        <div>
          <h2 class="text-xl font-bold text-gray-900">{{ __('pub_theme::components_tickets_list.items.title.title', ['number' => 1]) }}</h2>
          <p class="text-sm text-gray-600">{{ __('pub_theme::components_tickets_list.items.status.label') }} <span class="font-semibold text-primary">{{ __('pub_theme::components_tickets_list.items.open.label') }}</span> — 2026-10-13</p>
        </div>
        <button @click="open = !open" class="text-primary hover:underline text-sm font-medium focus:outline-none focus:ring-2 focus:ring-primary/50 rounded">{{ __('pub_theme::blocks_common.shared.details.label') }}</button>
      </div>
      <div x-show="open" x-transition class="mt-4 text-gray-700 leading-relaxed">{{ __('pub_theme::components_tickets_list.items.description.description') }}</div>
    </article>

    <article class="rounded-2xl border border-gray-200 bg-white shadow-sm p-6 hover:shadow-md transition" x-show="filter==='all' || filter==='closed'">
      <h2 class="text-xl font-bold text-gray-900">{{ __('pub_theme::components_tickets_list.items.title.title', ['number' => 2]) }}</h2>
      <p class="text-sm text-gray-600">{{ __('pub_theme::components_tickets_list.items.status.label') }} <span class="font-semibold text-green-700">{{ __('pub_theme::components_tickets_list.items.closed.label') }}</span> — 2026-10-10</p>
    </article>
  </section>

  <div class="mt-8">
    <button @click="showMap = !showMap" class="inline-flex items-center gap-2 px-5 py-3 rounded-full bg-primary text-white font-semibold shadow-lg shadow-primary/20 hover:bg-primary/90 transition focus:outline-none focus:ring-2 focus:ring-primary/50">{{ __('pub_theme::components_tickets_list.map.show.label') }}</button>
  </div>

  <div x-show="showMap" x-transition class="mt-6 rounded-2xl overflow-hidden border border-gray-200 shadow-md bg-gray-900 h-96 flex items-center justify-center text-white">{{ __('pub_theme::components_tickets_list.map.placeholder.message') }}</div>
</div>
