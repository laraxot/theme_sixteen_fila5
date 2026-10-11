@props(['data' => []])

@php
    $title = $data['title'] ?? __('fixcity::segnalazione.privacy.title.label');
    $description = $data['description'] ?? __('fixcity::segnalazione.privacy.description.text');
    $nextLabel = $data['next_label'] ?? __('fixcity::segnalazione.buttons.next.label');
    $nextUrl = $data['next_url'] ?? '/it/tests/segnalazione-dati';
@endphp

<div class="mx-auto max-w-4xl px-4 py-8">
    @if($description)
        <p class="mb-4 text-lg text-[#334e68]">
            {{ $description }}
        </p>
    @endif

    <p class="mb-6 text-[#334e68]">
        {{ __('fixcity::segnalazione.privacy.details.text') }}
        <a href="#" class="font-semibold text-[#007a52] underline underline-offset-2">{{ __('fixcity::segnalazione.privacy.details.link.label') }}</a>
    </p>

    <div class="mb-6 flex items-start gap-3" x-data="{ checked: false }">
        <input type="checkbox" id="privacy" name="privacy-field" value="privacy-field"
               x-model="checked" data-element="privacy-consent"
               class="mt-1 h-5 w-5 cursor-pointer rounded border-2 border-[#5d7083] text-[#007a52] focus:ring-2 focus:ring-[#80c8ad] focus:ring-offset-2">
        <label class="cursor-pointer font-semibold text-[#17324d]" for="privacy">
            {{ __('fixcity::segnalazione.privacy.accept.label') }}
        </label>
    </div>

    <div class="flex gap-3">
        <a href="{{ $nextUrl }}"
           class="inline-flex min-h-11 min-w-[120px] items-center justify-center rounded-md bg-[#007a52] px-5 py-3 font-bold text-white transition-colors hover:bg-[#005c3d] focus:outline-none focus:ring-4 focus:ring-[#80c8ad] focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
           x-data="{ checked: false }"
           :class="{ 'disabled': !checked }"
           :disabled="!checked"
           data-element="step-next">
            <span>{{ $nextLabel }}</span>
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
