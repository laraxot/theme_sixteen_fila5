@props(['data' => []])

@php
    $title = $data['title'] ?? __('fixcity::segnalazione.dati.title.label');
@endphp

<div class="mx-auto max-w-4xl px-4 py-8">
    <h2 class="mb-6 text-3xl font-bold text-[#17324d]">{{ $title }}</h2>

    <p class="mb-6 text-sm text-[#5d7083]">
        {{ __('fixcity::segnalazione.required_fields.label') }}
    </p>

    <!-- Luogo -->
    <div class="mb-8 rounded-lg bg-[#f5f7f9] p-6 shadow-sm">
        <h3 class="mb-4 text-xl font-bold text-[#17324d]">{{ __('fixcity::segnalazione.dati.place.label') }}</h3>
        <label for="report-place" class="block text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.dati.place.label') }} *</label>
        <input type="text" id="report-place"
               placeholder="{{ __('fixcity::segnalazione.dati.place.placeholder') }}"
               class="mt-2 w-full rounded-md border-2 border-[#5d7083] bg-white px-4 py-3 text-[#17324d] focus:border-[#007a52] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
               x-model="luogo" data-element="place-input">
        <div class="mt-3 flex items-center gap-3">
            <button type="button"
                    class="inline-flex items-center gap-2 rounded-md bg-white px-4 py-2 text-sm font-medium text-[#17324d] shadow-sm hover:bg-[#e6f3ee] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                    data-element="use-location">
                <svg class="h-5 w-5" aria-hidden="true">
                    <path fill="currentColor" d="M12 7a5 5 0 1 0 0 10A5 5 0 0 0 12 7z"></path>
                    <path fill="currentColor" d="M12 1C8.13 1 5 4.13 5 8c0 5.25 7 12.5 7 12.5S19 13.25 19 8C19 4.13 15.87 1 12 1z"></path>
                </svg>
                Usa la tua posizione
            </button>
        </div>
    </div>

    <!-- Disservizio -->
    <div class="mb-8 rounded-lg bg-[#f5f7f9] p-6 shadow-sm">
        <h3 class="mb-4 text-xl font-bold text-[#17324d]">{{ __('fixcity::segnalazione.dati.details.label') }}</h3>

        <div class="mb-4">
            <label for="inefficiency-type" class="block text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.dati.type.label') }}</label>
            <select class="mt-2 w-full rounded-md border-2 border-[#5d7083] bg-white px-4 py-3 text-[#17324d] focus:border-[#007a52] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                    id="inefficiency-type" x-model="tipoDisservizio" data-element="inefficiency-type-select">
                <option value="" disabled selected>{{ __('fixcity::segnalazione.dati.type.select') }}</option>
                <option value="verde">{{ __('fixcity::segnalazione.dati.types.verde') }}</option>
                <option value="illuminazione">{{ __('fixcity::segnalazione.dati.types.illuminazione') }}</option>
                <option value="strade">{{ __('fixcity::segnalazione.dati.types.strade') }}</option>
                <option value="rifiuti">{{ __('fixcity::segnalazione.dati.types.rifiuti') }}</option>
                <option value="altro">{{ __('fixcity::segnalazione.dati.types.altro') }}</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="report-title" class="block text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.dati.title.label') }}</label>
            <input type="text" id="report-title"
                   placeholder="{{ __('fixcity::segnalazione.dati.title.placeholder') }}"
                   class="mt-2 w-full rounded-md border-2 border-[#5d7083] bg-white px-4 py-3 text-[#17324d] focus:border-[#007a52] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                   x-model="titolo" data-element="report-title-input">
        </div>

        <div class="mb-4">
            <label for="report-details" class="block text-xs font-bold uppercase text-[#5d7083]">{{ __('fixcity::segnalazione.dati.description.label') }}</label>
            <textarea class="mt-2 w-full rounded-md border-2 border-[#5d7083] bg-white px-4 py-3 text-[#17324d] focus:border-[#007a52] focus:outline-none focus:ring-4 focus:ring-[#80c8ad]"
                      id="report-details" rows="4"
                      placeholder="{{ __('fixcity::segnalazione.dati.description.placeholder') }}"
                      x-model="dettagli" maxlength="200"
                      data-element="report-details-input"></textarea>
            <p class="mt-1 text-xs text-[#5d7083]">{{ __('fixcity::segnalazione.max_chars.label', ['max' => 200]) }}</p>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase text-[#5d7083] mb-2">{{ __('fixcity::segnalazione.dati.images.label') }}</label>
            <div class="flex items-center gap-3 rounded-md border-2 border-dashed border-[#5d7083] bg-white p-4">
                <svg class="h-6 w-6 text-[#007a52]" aria-hidden="true">
                    <path fill="currentColor" d="M4 4h16v12H4zm16-4v2H4V4h2V2h12v2h2zM4 18h16v2H4z"></path>
                </svg>
                <span class="text-[#334e68]">{{ __('fixcity::segnalazione.dati.images.no_file') }}</span>
            </div>
            <p class="mt-1 text-xs text-[#5d7083]">{{ __('fixcity::segnalazione.dati.images.hint') }}</p>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex justify-between gap-3">
        <a href="/it/tests/segnalazione-privacy"
           class="inline-flex min-h-11 min-w-[120px] items-center justify-center rounded-md border-2 border-[#007a52] px-5 py-3 font-bold text-[#007a52] transition-colors hover:bg-[#e6f3ee] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2"
           data-element="step-prev">
            <span>{{ __('fixcity::segnalazione.buttons.back.label') }}</span>
        </a>
        <a href="/it/tests/segnalazione-riepilogo"
           class="inline-flex min-h-11 min-w-[120px] items-center justify-center rounded-md bg-[#007a52] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005c3d] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2"
           data-element="step-next">
            <span>{{ __('fixcity::segnalazione.buttons.next.label') }}</span>
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
