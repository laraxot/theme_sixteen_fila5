<div class="space-y-6">
    <form wire:submit="resetPassword" class="space-y-6" aria-label="{{ __('Reimposta la password') }}">
        {{ $this->form }}
        @error('email') <p class="text-sm text-red-700" role="alert">{{ $message }}</p> @enderror
        <button type="submit" wire:loading.attr="disabled" class="min-h-11 w-full rounded-lg bg-sky-900 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-sky-800 focus-visible:ring-offset-2">
            {{ __('pub_theme::auth.reset.submit') }}
        </button>
    </form>
</div>
