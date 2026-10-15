<div class="space-y-6">
    @if (session('status'))
        <div class="rounded-lg border border-green-300 bg-green-50 p-4 text-sm font-semibold text-green-900" role="status">{{ session('status') }}</div>
    @endif
    <form wire:submit="sendResetLink" class="space-y-6" aria-label="{{ __('Reimposta la password') }}">
        {{ $this->form }}
        @error('email') <p class="text-sm text-red-700" role="alert">{{ $message }}</p> @enderror
        <button type="submit" wire:loading.attr="disabled" class="min-h-11 w-full rounded-lg bg-sky-900 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-800 focus-visible:ring-offset-2">
            {{ __('pub_theme::auth.reset.submit') }}
        </button>
        <a href="{{ url('/'.app()->getLocale().'/auth/login') }}" class="block text-center text-sm font-semibold text-sky-900 underline underline-offset-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-800">{{ __('pub_theme::auth.login.submit') }}</a>
    </form>
</div>
