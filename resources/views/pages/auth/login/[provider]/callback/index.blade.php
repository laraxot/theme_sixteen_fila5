<?php declare(strict_types=1); $provider = request()->segment(3); ?>
@if(!in_array($provider, ['google', 'microsoft', 'github'], true))
    @abort(404, __('user::auth.login.invalid_provider'))
@endif

{{-- BMAD + Second Brain + Filament Blueprint: Folio callback component --}}
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100 dark:from-gray-900 dark:to-gray-800 px-4 sm:px-6 lg:px-8" aria-label="OAuth callback" role="region">
    <div class="w-full max-w-md text-center">
        <div class="p-8 bg-white dark:bg-gray-800 shadow-xl rounded-2xl border border-gray-200/60 card-wrapper cmp-card-simple">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2 title-large">
                {{ __('user::auth.login.callback') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ __('user::auth.login.callback_text', ['provider' => ucfirst($provider)]) }}
            </p>
            <a href="{{ \Mcamara\LaravelLocalization\Facades\LaravelLocalization::localizeURL('/auth/login') }}" class="inline-flex items-center rounded-full px-6 py-3 bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2" aria-label="{{ __('user::auth.login.back') }}">
                {{ __('user::auth.login.back') }}
            </a>
        </div>
    </div>
</div>