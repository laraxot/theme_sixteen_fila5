<section class="bg-slate-50 px-4 py-12 sm:px-6 lg:px-8" aria-labelledby="auth-login-heading">
    <div class="mx-auto max-w-md">
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
            <h1 id="auth-login-heading" class="text-3xl font-bold tracking-tight text-slate-950">{{ __('user::auth.login.title.text') }}</h1>
            <p class="mt-2 text-slate-700">{{ __('user::auth.login.intro.text') }}</p>
            <p class="mt-3 text-sm text-slate-700">{{ __('user::auth.login.no_account.text') }} <a class="font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/register') }}">{{ __('user::auth.login.create_account.text') }}</a></p>
            <div class="mt-8">
                @livewire(\Modules\User\Filament\Widgets\Auth\LoginWidget::class)
            </div>
            <div class="mt-6">
                @include('components.utilities.google-button')
            </div>
            <p class="mt-3 text-sm text-slate-700"><a class="font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/password/forgot') }}">{{ __('user::auth.login.forgot_password.text') }}</a></p>
            <p class="mt-3 text-sm text-slate-700"><a class="font-semibold text-sky-900 underline underline-offset-4 focus:outline-none focus:ring-2 focus:ring-sky-800" href="{{ url('/'.app()->getLocale().'/accessibilita') }}">{{ __('pub_theme::accessibility.page.title.text') }}</a></p>
        </div>
    </div>
</section>
