{{-- BMAD + Second Brain + Filament Blueprint: Google Login button --}}
{{-- SSoT URL: route oauth.redirect = {lang}/auth/login/{provider} (Modules/User/routes/socialite.php) --}}
{{-- Mai href senza lang: la pagina login e' /it/auth/login, quindi Google = /it/auth/login/google --}}
@props(['size' => 'md', 'variant' => 'primary'])

@php
    $classes = match ($size) {
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3 text-base',
        'lg' => 'px-8 py-4 text-lg',
        default => 'px-6 py-3 text-base',
    };

    $locale = trim((string) app()->getLocale(), '/');
    $supported = \Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLanguagesKeys();
    if (! in_array($locale, $supported, true)) {
        $locale = (string) config('app.locale', 'it');
    }

    $googleUrl = Route::has('oauth.redirect')
        ? route('oauth.redirect', ['provider' => 'google', 'lang' => $locale])
        : \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/login/google', $locale);
@endphp

@if (Route::has('oauth.redirect') || filled($googleUrl))
<div x-data="{ open: false }" class="google-login-wrapper w-full">
    <a
        href="{{ $googleUrl }}"
        class="inline-flex items-center justify-center w-full {{ $classes }} font-medium rounded-xl border border-gray-200 bg-white text-gray-900 hover:bg-gray-50 hover:border-gray-300 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-500 shadow-sm transition-all duration-200"
    >
        <svg class="mr-2 h-5 w-5" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
            <path fill="#4285F4" d="M21.35 12.27c0-.74-.07-1.45-.2-2.13H12v4.03h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.15c1.85-1.7 2.9-4.2 2.9-7.29Z" />
            <path fill="#34A853" d="M12 21.75c2.65 0 4.88-.88 6.5-2.39l-3.15-2.45c-.87.58-1.98.92-3.35.92-2.57 0-4.75-1.74-5.53-4.08H3.22v2.53A9.82 9.82 0 0 0 12 21.75Z" />
            <path fill="#FBBC05" d="M6.47 13.75A5.9 5.9 0 0 1 6.16 12c0-.61.11-1.2.31-1.75V7.72H3.22A9.75 9.75 0 0 0 2.25 12c0 1.57.38 3.06.97 4.28l3.25-2.53Z" />
            <path fill="#EA4335" d="M12 6.17c1.44 0 2.73.5 3.75 1.48l2.81-2.81C16.87 3.27 14.65 2.25 12 2.25a9.82 9.82 0 0 0-8.78 5.47l3.25 2.53C7.25 7.91 9.43 6.17 12 6.17Z" />
        </svg>
        <span>{{ __('user::auth.login.google.button.text') }}</span>
    </a>
</div>
@endif
