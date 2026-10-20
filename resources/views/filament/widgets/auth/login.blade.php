{{-- LoginWidget — vestito Sixteen; logica in Modules\User\Filament\Widgets\Auth\LoginWidget --}}
<div class="space-y-6">
    @php
        $loginError = $errors->first('data.email') ?: $errors->first('email');
    @endphp

    {{-- Esito negativo: password errata (data.email) o ritorno da Google rifiutato (email). Il vestito sta in
         components/pages/auth-login.blade.php: le utility Tailwind sono spente dentro data-dc (icona a tutta larghezza). --}}
    @if ($loginError)
        <div class="auth-login-alert" role="alert" aria-live="assertive">
            <svg class="auth-login-alert__icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" focusable="false">
                <path fill-rule="evenodd" d="M18 10A8 8 0 114.293 4.293 8 8 0 0118 10zm-8.75-3.25a.75.75 0 011.5 0v3.5a.75.75 0 01-1.5 0v-3.5zm.75 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
            </svg>
            <p class="auth-login-alert__text">{{ $loginError }}</p>
        </div>
    @endif

    <form
        wire:submit="login"
        class="space-y-6"
        aria-labelledby="auth-login-heading"
        novalidate
    >
        <div
            @class([
                'fo-filament-form-shell rounded-xl border border-slate-200 p-4 transition-colors',
                'border-red-300 bg-red-50/40' => (bool) $loginError,
            ])
        >
            {{ $this->form }}
        </div>

        <x-filament::button
            type="submit"
            color="primary"
            class="w-full"
            wire:loading.attr="disabled"
            wire:loading.attr="aria-busy"
            wire:target="login"
            aria-describedby="login-submit-status"
        >
            <span wire:loading wire:target="login" class="inline-flex items-center gap-2" role="status" aria-live="polite">
                <x-filament::icon icon="heroicon-o-arrow-path" class="h-5 w-5 animate-spin motion-reduce:animate-none" aria-hidden="true" />
                {{ __('user::auth.login.logging_in.text') }}
            </span>
            <span wire:loading.remove wire:target="login">
                {{ __('user::login.actions.login.label') }}
            </span>
        </x-filament::button>
        <span id="login-submit-status" class="sr-only" wire:loading wire:target="login" role="status" aria-live="polite">
            {{ __('user::auth.login.logging_in.text') }}
        </span>
    </form>
</div>
