<section class="bg-slate-50 px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="auth-password-reset-heading">
    <div class="mx-auto max-w-md">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 id="auth-password-reset-heading" class="text-3xl font-bold tracking-tight text-slate-950">{{ __('Reimposta la password') }}</h1>
            <p class="mt-2 text-slate-700">{{ __('Inserisci la tua email e ti invieremo un link per reimpostarla.') }}</p>
            <div class="mt-8">@livewire(\Modules\User\Filament\Widgets\Auth\ForgotPasswordWidget::class)</div>
        </div>
    </div>
</section>
