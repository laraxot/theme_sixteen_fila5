@extends('themes::Sixteen.layouts.guest')

@section('title', __('cookie-policy.title'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <header class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('cookie-policy.title') }}</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('cookie-policy.subtitle') }}</p>
        </header>

        <article class="prose dark:prose-invert max-w-none">
            <section class="mb-8">
                <h2>{{ __('cookie-policy.purpose') }}</h2>
                <p>{{ __('cookie-policy.purpose_text') }}</p>
            </section>

            <section class="mb-8">
                <h2>{{ __('cookie-policy.types') }}</h2>
                <ul>
                    <li>{{ __('cookie-policy.technical_cookies') }}</li>
                    <li>{{ __('cookie-policy.analytics_cookies') }}</li>
                    <li>{{ __('cookie-policy.marketing_cookies') }}</li>
                </ul>
            </section>

            <section class="mb-8">
                <h2>{{ __('cookie-policy.duration') }}</h2>
                <p>{{ __('cookie-policy.duration_text') }}</p>
            </section>

            <section class="mb-8">
                <h2>{{ __('cookie-policy.user_rights') }}</h2>
                <p>{{ __('cookie-policy.user_rights_text') }}</p>
            </section>

            <section class="mb-8">
                <h2>{{ __('cookie-policy.legal_basis') }}</h2>
                <p>{{ __('cookie-policy.legal_basis_text') }}</p>
            </section>

            <section class="mb-8">
                <h2>{{ __('cookie-policy.contact') }}</h2>
                <address class="not-italic">
                    <p><strong>{{ config('app.institution_name', 'Ente di appartenenza') }}</strong></p>
                    <p>{{ config('app.institution_email', 'email@ente.it') }}</p>
                    <p>{{ config('app.institution_phone', '+39 0XX XXXXXXX') }}</p>
                </address>
            </section>
        </article>

        <footer class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                {{ __('cookie-policy.last_updated', ['date' => now()->format('d/m/Y')]) }}
            </p>
        </footer>
    </div>
</div>
@endsection