{{-- Vista per il LoginWidget nel tema Sixteen --}}
{{-- Design ispirato a https://docs.italia.it/accounts/login/ --}}
{{-- Conforme AGID Bootstrap Italia + Filament 4.x --}}

<x-filament-widgets::widget>
    <x-filament::section class="rounded-none border-0 shadow-none">
        <div class="space-y-6 p-5 sm:p-7">
            <div class="border-b border-slate-200 pb-4">
                <h2 class="text-xl font-bold text-slate-900">
                    {{ __('user::auth.login.title') }}
                </h2>
                <p class="mt-1 text-sm text-slate-600">
                    {{ __('user::auth.login.subtitle') }}
                </p>
            </div>

            <form wire:submit="login" class="space-y-6">
                {{ $this->form }}

                <div class="mt-6">
                    <button 
                        type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full inline-flex justify-center items-center gap-2 rounded-md bg-primary-700 px-4 py-3 text-sm font-semibold text-white transition hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg wire:loading class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>{{ __('user::auth.login.submit') }}</span>
                    </button>
                </div>
            </form>

            <div class="mt-2 space-y-3 text-sm">
                <p class="text-slate-600">
                    {{ __('user::login.no_account') }}
                    <a 
                        href="{{ url('/' . app()->getLocale() . '/auth/register') }}" 
                        class="font-semibold text-primary-700 underline decoration-primary-700 underline-offset-2 hover:text-primary-800"
                    >
                        {{ __('user::login.register_now') }}
                    </a>
                </p>
                
                <p class="text-slate-600">
                    {{ __('user::login.forgot_password_text') }}
                    <a 
                        href="{{ url('/' . app()->getLocale() . '/auth/password/reset') }}" 
                        class="font-semibold text-primary-700 underline decoration-primary-700 underline-offset-2 hover:text-primary-800"
                    >
                        {{ __('user::login.reset_it') }}
                    </a>
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
