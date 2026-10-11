<section class="bg-slate-50 px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="auth-register-heading">
    <div class="mx-auto max-w-2xl">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 id="auth-register-heading" class="text-3xl font-bold tracking-tight text-slate-950">
                {{ __('Crea il tuo account') }}
            </h1>
            <p class="mt-2 text-slate-700">
                {{ __('Registrati per inviare e seguire le tue segnalazioni.') }}
            </p>
            <div class="mt-8">
                @livewire(\Modules\Gdpr\Filament\Widgets\Auth\RegisterWidget::class)
            </div>
        </div>
    </div>
</section>
