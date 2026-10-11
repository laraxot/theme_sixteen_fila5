@props(['data' => []])

@php
    $title = $data['title'] ?? __('fixcity::segnalazione.riepilogo.title.label');
@endphp

<div class="mx-auto max-w-4xl px-4 py-8">
    <h2 class="mb-6 text-3xl font-bold text-[#17324d]">{{ $title }}</h2>

    <!-- Warning callout -->
    <div class="mb-8 rounded-md border-l-4 border-[#007a52] bg-[#e6f3ee] p-4">
        <div class="flex items-start gap-3">
            <svg class="h-5 w-5 flex-shrink-0 text-[#007a52]" aria-hidden="true">
                <path fill="currentColor" d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-3.5h-2v-6h2v6z"></path>
            </svg>
            <div>
                <h3 class="font-semibold text-[#17324d]">{{ __('fixcity::segnalazione.riepilogo.warning.title') }}</h3>
                <p class="mt-1 text-sm text-[#334e68]">{{ __('fixcity::segnalazione.riepilogo.warning.text') }}</p>
            </div>
        </div>
    </div>

    <!-- Disservizio summary -->
    <div class="mb-8 rounded-lg bg-[#f5f7f9] p-6 shadow-sm">
        <h3 class="mb-4 text-xl font-bold text-[#17324d]">{{ __('fixcity::segnalazione.riepilogo.disservizio.title') }}</h3>
        <dl class="space-y-3">
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.disservizio.type.label') }}</dt>
                <dd class="text-[#334e68]" x-text="tipoDisservizio || 'Verde pubblico'"></dd>
            </div>
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.disservizio.title.label') }}</dt>
                <dd class="text-[#334e68]" x-text="titolo || 'Buca in via Solferino'"></dd>
            </div>
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.disservizio.description.label') }}</dt>
                <dd class="text-[#334e68]" x-text="dettagli || 'Segnalazione di una buca...'"></dd>
            </div>
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.disservizio.place.label') }}</dt>
                <dd class="text-[#334e68]" x-text="luogo || 'Via Solferino, 15'"></dd>
            </div>
        </dl>
    </div>

    <!-- Contacts summary -->
    <div class="mb-8 rounded-lg bg-[#f5f7f9] p-6 shadow-sm">
        <h3 class="mb-4 text-xl font-bold text-[#17324d]">{{ __('fixcity::segnalazione.riepilogo.contacts.title') }}</h3>
        <dl class="space-y-3">
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.contacts.email.label') }}</dt>
                <dd class="text-[#334e68]" x-text="email || 'mario.rossi@email.it'"></dd>
            </div>
            <div>
                <dt class="text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.riepilogo.contacts.phone.label') }}</dt>
                <dd class="text-[#334e68]" x-text="telefono || '333 1234567'"></dd>
            </div>
        </dl>
    </div>

    <!-- Terms checkbox -->
    <div class="mb-6 flex items-start gap-3" x-data="{ accepted: false }">
        <input type="checkbox" id="accetto-termini" x-model="accepted" data-element="terms-accept"
               class="mt-1 h-5 w-5 cursor-pointer rounded border-2 border-[#5d7083] text-[#007a52] focus:ring-2 focus:ring-[#80c8ad] focus:ring-offset-2">
        <label class="cursor-pointer font-semibold text-[#17324d]" for="accetto-termini">
            {{ __('fixcity::segnalazione.riepilogo.terms.accept.label') }}
            <a href="#" class="font-semibold text-[#007a52] underline underline-offset-2">{{ __('fixcity::segnalazione.riepilogo.terms.link.label') }}</a>
        </label>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between gap-3">
        <a href="/it/tests/segnalazione-dati"
           class="inline-flex min-h-11 min-w-[120px] items-center justify-center rounded-md border-2 border-[#007a52] px-5 py-3 font-bold text-[#007a52] transition-colors hover:bg-[#e6f3ee] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2"
           data-element="step-prev">
            <span>{{ __('fixcity::segnalazione.buttons.back.label') }}</span>
        </a>
        <a href="/it/tests/segnalazione-conferma"
           class="inline-flex min-h-11 min-w-[120px] items-center justify-center rounded-md bg-[#007a52] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005c3d] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2"
           data-element="step-next">
            <span>{{ __('fixcity::segnalazione.riepilogo.submit.label') }}</span>
        </a>
    </div>
</div>

<div class="bg-[#f5f7f9] py-12">
    <div class="mx-auto max-w-4xl px-4">
        <div class="rounded-lg bg-white p-6 shadow-sm">
            @include('pub_theme::components.sections.contacts.default', ['data' => [
                'title' => 'Contatta il comune',
                'description' => 'Se non trovi quello che cerchi o hai bisogno di chiarimenti, contattaci.',
                'button_label' => 'Contattaci',
                'button_url' => '#',
            ]])
        </div>
    </div>
</div>
