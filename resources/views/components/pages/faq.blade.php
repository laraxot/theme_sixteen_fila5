{{-- BMAD + Second Brain: /it/domande-frequenti — alta visual parity design-comuni-pagine-statiche --}}
{{-- Stack: Tailwind + Alpine + Lit + DaisyUI + Flowbite (NO Bootstrap Italia) --}}
{{-- DB: MariaDB — SQLite escluso; MCP migliorati (mcp__laravel_boost / mcp__qmd) --}}
<section class="faq-design-comuni container mx-auto px-4 py-12" aria-label="Domande frequenti">
  <header class="mb-10">
    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-slate-900">Domande frequenti</h1>
    <nav aria-label="Breadcrumb" class="mt-3 text-sm text-slate-500">{{ __('Home') }} / {{ __('FAQ') }}</nav>
  </header>
  <div class="grid lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
      @foreach($faqs ?? [] as $faq)
        <article class="card bg-white shadow-md rounded-2xl p-6 border border-slate-100">
          <h2 class="text-xl font-bold text-slate-800 mb-2">{{ $faq->title }}</h2>
          <p class="text-slate-600 leading-relaxed">{{ $faq->body }}</p>
        </article>
      @endforeach
    </div>
    <aside class="space-y-6" aria-label="Filtri e categorie">
      <div class="bg-base-100 rounded-2xl p-5 shadow-sm border border-slate-100">
        <h3 class="font-bold text-lg mb-3">Categorie</h3>
        <div class="flex flex-wrap gap-2">
          @foreach($categories ?? [] as $cat)
            <a href="#" class="badge badge-lg badge-soft badge-primary">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
    </aside>
  </div>
</section>
