<section class="bg-slate-50 px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="auth-register-heading">
    <div class="mx-auto max-w-2xl">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 id="auth-register-heading" class="text-3xl font-bold tracking-tight text-slate-950">
                {{ __('fixcity::auth.register.title.text') }}
            </h1>
            <p class="mt-2 text-slate-700">
                {{ __('fixcity::auth.register.intro.text') }}
            </p>
            <div class="mt-8">
                @livewire(\Modules\Gdpr\Filament\Widgets\Auth\RegisterWidget::class)
            </div>
            <p class="mt-3 text-sm text-slate-700"><a class="font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ url('/'.app()->getLocale().'/accessibilita') }}">{{ __('pub_theme::accessibility.page.title.text') }}</a></p>
        </div>
    </div>
</section>
