{{-- RegisterWidget — vestito Sixteen; logica in Modules\User\Filament\Widgets\Auth\RegisterWidget --}}
{{-- Stessa struttura del LoginWidget: card e padding stanno nella pagina, qui nessuna x-filament::section annidata. --}}
<div class="space-y-6">
    @php
        $registerErrors = collect($errors->all())->filter()->unique()->values();
    @endphp

    @if ($registerErrors->isNotEmpty())
        <div
            class="rounded-xl border-2 border-red-300 bg-red-50 px-4 py-4 shadow-sm"
            role="alert"
            aria-live="assertive"
        >
            <div class="flex items-start gap-3">
                <span class="mt-0.5 inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10A8 8 0 114.293 4.293 8 8 0 0118 10zm-8.75-3.25a.75.75 0 011.5 0v3.5a.75.75 0 01-1.5 0v-3.5zm.75 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-red-800">
                        {{ __('user::registration.actions.register.error') }}
                    </p>
                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                        @foreach ($registerErrors as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form
        wire:submit="submit"
        class="w-full min-w-0 space-y-6"
        aria-labelledby="auth-register-heading"
        aria-describedby="auth-register-hint-email auth-register-hint-password"
        novalidate
    >
        <div @class(['space-y-6', 'rounded-xl border-2 border-red-300 bg-red-50/40 p-4' => $registerErrors->isNotEmpty()])>
            <fieldset class="space-y-5">
                <legend class="text-lg font-semibold text-slate-950">{{ __('gdpr::register.sections.user_info') }}</legend>
                <div class="grid gap-5 sm:grid-cols-2">
                    <label class="block text-sm font-semibold text-slate-900">
                        <span>{{ __('gdpr::register.fields.first_name.label') }}</span>
                        <input id="first_name" type="text" wire:model="first_name" autocomplete="given-name" required class="mt-2 block min-h-11 w-full rounded-lg border border-slate-400 bg-white px-3 py-2 text-base text-slate-950 shadow-sm focus:border-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-800" />
                        @error('first_name') <span class="mt-1 block text-sm font-normal text-red-700">{{ $message }}</span> @enderror
                    </label>
                    <label class="block text-sm font-semibold text-slate-900">
                        <span>{{ __('gdpr::register.fields.last_name.label') }}</span>
                        <input id="last_name" type="text" wire:model="last_name" autocomplete="family-name" required class="mt-2 block min-h-11 w-full rounded-lg border border-slate-400 bg-white px-3 py-2 text-base text-slate-950 shadow-sm focus:border-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-800" />
                        @error('last_name') <span class="mt-1 block text-sm font-normal text-red-700">{{ $message }}</span> @enderror
                    </label>
                </div>
                <label class="block text-sm font-semibold text-slate-900">
                    <span>{{ __('gdpr::register.fields.email.label') }}</span>
                    <input id="email" type="email" wire:model="email" autocomplete="email" required class="mt-2 block min-h-11 w-full rounded-lg border border-slate-400 bg-white px-3 py-2 text-base text-slate-950 shadow-sm focus:border-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-800" />
                    <span id="auth-register-hint-email" class="mt-1 block text-sm font-normal text-slate-600">{{ __('gdpr::register.fields.email.helper_text') }}</span>
                    @error('email') <span class="mt-1 block text-sm font-normal text-red-700">{{ $message }}</span> @enderror
                </label>
                <div x-data="{show:false}">
                    <label class="block text-sm font-semibold text-slate-900">
                        <span>{{ __('gdpr::register.fields.password.label') }}</span>
                        <input id="password" :type="show ? 'text' : 'password'" wire:model="password" autocomplete="new-password" required class="mt-2 block min-h-11 w-full rounded-lg border border-slate-400 bg-white px-3 py-2 text-base text-slate-950 shadow-sm focus:border-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-800" />
                    </label>
                    <p id="auth-register-hint-password" class="mt-1 text-sm text-slate-600">{{ __('gdpr::register.fields.password.helper_text') }}</p>
                    <button type="button" class="mt-2 min-h-11 rounded-lg px-2 text-sm font-semibold text-sky-900 underline focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-800" @click="show = !show" :aria-pressed="show">
                        <span x-text="show ? '{{ __('Nascondi password') }}' : '{{ __('Mostra password') }}'"></span>
                    </button>
                    @error('password') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
                </div>
                <label class="block text-sm font-semibold text-slate-900">
                    <span>{{ __('gdpr::register.fields.password_confirmation.label') }}</span>
                    <input id="password_confirmation" type="password" wire:model="password_confirmation" autocomplete="new-password" required class="mt-2 block min-h-11 w-full rounded-lg border border-slate-400 bg-white px-3 py-2 text-base text-slate-950 shadow-sm focus:border-sky-800 focus:outline-none focus:ring-2 focus:ring-sky-800" />
                    @error('password_confirmation') <span class="mt-1 block text-sm text-red-700">{{ $message }}</span> @enderror
                </label>
            </fieldset>

            <fieldset class="space-y-4 border-t border-slate-200 pt-5">
                <legend class="text-lg font-semibold text-slate-950">{{ __('gdpr::register.consents.title') }}</legend>
                <label class="flex min-h-11 items-start gap-3 text-sm text-slate-800">
                    <input type="checkbox" wire:model="privacy_accepted" required class="mt-1 h-5 w-5 rounded border-slate-500 text-sky-800 focus:ring-2 focus:ring-sky-800" />
                    <span>{{ __('gdpr::register.consents.privacy_policy_label') }} <a class="ms-1 font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ url('/'.app()->getLocale().'/privacy') }}" target="_blank" rel="noopener">{{ __('gdpr::register.consents.privacy_policy_link') }}<span class="visually-hidden"> ({{ __('gdpr::register.consents.opens_new_tab') }})</span></a></span>
                </label>
                <label class="flex min-h-11 items-start gap-3 text-sm text-slate-800">
                    <input type="checkbox" wire:model="terms_accepted" required class="mt-1 h-5 w-5 rounded border-slate-500 text-sky-800 focus:ring-2 focus:ring-sky-800" />
                    <span>{{ __('gdpr::register.consents.terms_label') }} <a class="ms-1 font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ url('/'.app()->getLocale().'/terms') }}" target="_blank" rel="noopener">{{ __('gdpr::register.consents.terms_link') }}<span class="visually-hidden"> ({{ __('gdpr::register.consents.opens_new_tab') }})</span></a></span>
                </label>
                <label class="flex min-h-11 items-start gap-3 text-sm text-slate-800">
                    <input type="checkbox" wire:model="marketing_consent" class="mt-1 h-5 w-5 rounded border-slate-500 text-sky-800 focus:ring-2 focus:ring-sky-800" />
                    <span>{{ __('gdpr::register.consents.marketing_label') }}</span>
                </label>
            </fieldset>
        </div>

        <x-filament::button
            type="submit"
            color="primary"
            wire:loading.attr="disabled"
            class="w-full min-h-[44px]"
        >
            {{ __('user::registration.actions.register.label') }}
        </x-filament::button>

        <nav class="border-t border-slate-200 pt-4 text-sm" aria-label="{{ __('user::registration.already_registered') }}">
            <p class="text-slate-600">
                {{ __('user::registration.already_registered') }}
                <a
                    href="{{ url('/' . app()->getLocale() . '/auth/login') }}"
                    class="font-semibold text-italia-blue-700 underline decoration-italia-blue-500 underline-offset-2 hover:text-italia-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-600 focus-visible:ring-offset-2"
                >
                    {{ __('user::login.actions.login.label') }}
                </a>
            </p>
        </nav>
    </form>
</div>
